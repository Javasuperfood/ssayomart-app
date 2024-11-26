<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\IncomingRequest;

class ResourceApi implements FilterInterface
{
    use ResponseTrait;
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!$request->hasHeader('X-Key-ID') || !$request->hasHeader('X-Key-Value')) {
            // Jika header tidak ada, kembalikan response dengan status Unauthorized
            return $this->resErrorCustom();
        }

        // Dapatkan nilai header 'X-key'
        $keyId = $request->getHeaderLine('X-Key-ID');
        $keyValue = $request->getHeaderLine('X-Key-Value');
        // Lakukan validasi sesuai dengan kebutuhan
        if ($keyId === 'A08b2TiZXV' && $keyValue === 'fDLVAt4LkFaizcK3ETz5g8fN8YeoyBRn') {
            // Jika nilai header tidak valid, kembalikan response dengan status Unauthorized
            return $request;
        }
        return $this->resErrorCustom();
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }

    private function resErrorCustom($txt = null)
    {
        if ($txt != null) {
            $response = [
                'status' => 400,
                'error' => 'Cannot process request',
                'messages' => $txt
            ];
            $responseObj = service('response');
            return $responseObj->setStatusCode(400)->setJSON($response);
        }
        $response = [
            'status' => 400,
            'error' => 'Cannot process request',
            'messages' => 'You don\'t have permission to access this resource'
        ];
        // Get the response object and send a JSON response
        $responseObj = service('response');
        return $responseObj->setStatusCode(400)->setJSON($response);
    }
}
