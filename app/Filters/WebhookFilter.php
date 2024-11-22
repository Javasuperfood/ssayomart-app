<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class WebhookFilter implements FilterInterface
{
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
        $env = getenv('CI_ENVIRONMENT');

        $validKeys = [
            'development' => [
                'key' => 'lNyV2LIYifQIO12TJ5MBCGwWdpsGd7tE',
                'authorization' => 'lNyV2LIYifQIO12TJ5MBCGwWdpsGd7tE',
            ],
            'production' => [
                'key' => 'Production_c3NheW9tYXJ0.a2V5',
                'authorization' => 'Production_c3NheW9tYXJ0.a2V5',
            ],
        ];

        $keyId = $request->getHeaderLine('Client-Key');
        $authorization = $request->getHeaderLine('Authorization');

        if (isset($validKeys[$env]) && ($keyId !== $validKeys[$env]['key'] && $authorization !== $validKeys[$env]['authorization'])) {
            return $this->resErrorCustom('Invalid Client-Key or Authorization header');
        }

        return $request;
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
        $response_service = \Config\Services::response();
        $method = $request->getMethod();
        $endpoint = $request->uri->getPath();

        $request_body = $request->getBody();
        $data = [
            'Method' => $method,
            'Endpoint' => $endpoint,
            'Request' => json_decode($request_body),
            'Response' => json_decode($response_service->getJSON()),

        ];
        log_message('info', '{message}', [
            'message' => json_encode($data)
        ]);
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
