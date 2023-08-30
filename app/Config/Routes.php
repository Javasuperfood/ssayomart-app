<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'KategoriController::index');
$routes->get('/produk/kategori/(:any)', 'ProdukController::getProduk/$1/$2');
$routes->get('/produk/kategori/(:any)/(:any)', 'ProdukController::getProduk/$1/$2');
$routes->get('/produk/(:any)', 'ProdukController::produkShowSingle/$1');
$routes->post('/produk/(:any)', 'CartController::addToCart/$1', ['filter' => 'group:user, admin, superadmin']); // Add to cart route Dingle Produk 


$routes->group('/', ['filter' => 'group:user, admin, superadmin'], static function ($routes) {
    $routes->get('/wishlist', 'Wishlist::wishlist');

    $routes->get('/cart', 'Cart::cart');
    $routes->get('/checkout', 'Checkout::checkout');

    // Setting route
    $routes->get('/setting', 'Setting::setting');
    $routes->get('/setting/detail-user/(:any)', 'Setting::detailUser/$1');
    $routes->get('/setting/pembayaran', 'Setting::pembayaran');
    $routes->get('/setting/alamat-list', 'Setting::alamatList');
    $routes->get('/setting/create-alamat', 'Setting::createAlamat');
    $routes->post('/setting/create-alamat/save-alamat', 'Setting::saveAlamat');
    $routes->get('/setting/update-alamat/(:any)', 'Setting::updateAlamat/$1');
    $routes->get('/history', 'HistoryTransaksi::history');

    $routes->get('/produk/status', 'Status::status');
});

$routes->group('dashboard', ['filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->get('/', 'Home::dashboard');
    $routes->get('admin', 'Home::admin');
    $routes->get('input', 'Input::input');
    $routes->get('edit', 'Edit::edit');
    $routes->get('kategorisubkat', 'Kategorisubkat::kategorisubkat');
    $routes->get('inputbaner', 'Inputbanner::inputbaner');
    $routes->get('kupon', 'Kuponproduk::kupon');
    $routes->get('inputkategori', 'inputkategori::inputkategori');
});

service('auth')->routes($routes);

$routes->group('api', static function ($routes) { //nanti tambahkan filter auth via Tooken
    $routes->resource('kategori');
    $routes->resource('subkategori');
    $routes->resource('produk');
    $routes->resource('distributor');
    $routes->resource('kupon');
    $routes->resource('arsip');
    $routes->get('getcity', 'Setting::getCity');
    $routes->resource('produk');
});



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
