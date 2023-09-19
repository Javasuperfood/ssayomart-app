<?php

namespace Config;

use App\Controllers\Kategori;

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
// $routes->set404Override(fn () => view('404', ['title' => '404']));
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
$routes->get('/search', 'ProdukController::search');
$routes->get('/produk/kategori/(:any)', 'ProdukController::getProduk/$1/$2');
$routes->get('/produk/kategori/(:any)/(:any)', 'ProdukController::getProduk/$1/$2');
$routes->get('/produk/(:any)', 'ProdukController::produkShowSingle/$1');

$routes->get('/promo/(:segment)', 'UserPromoController::index/$1');

$routes->group('/', ['filter' => 'group:user, admin, superadmin'], static function ($routes) {
    $routes->get('/wishlist', 'WishlistController::index');
    $routes->post('/wishlist/delete/(:num)', 'WishlistController::deleteProduk/$1');


    $routes->get('/buy/(:segment)', 'BuyController::index/$1');
    $routes->post('/store/(:segment)', 'BuyController::storeData/$1');

    $routes->get('/cart', 'CartController::cart');
    $routes->post('/cart/delete/(:num)', 'CartController::deleteProduk/$1');
    $routes->post('/checkout', 'CheckoutController::storeData');
    $routes->get('/checkout/(:any)', 'CheckoutController::checkout/$1');
    $routes->post('/checkout/(:any)/bayar', 'CheckoutController::bayar/$1');
    $routes->get('/select-alamat', 'SelectAlamat::selectAlamat');

    // Setting route
    $routes->post('/setting/delete-alamat/(:segment)', 'Setting::deleteAlamat/$1');
    $routes->get('/setting', 'Setting::setting');
    $routes->get('/setting/detail-user/(:any)', 'Setting::detailUser/$1');
    $routes->post('/setting/detail-user/(:segment)', 'Setting::updateDetailUser/$1');
    $routes->get('/setting/pembayaran', 'Setting::pembayaran');
    $routes->get('/setting/alamat-list', 'Setting::alamatList');
    $routes->get('/setting/create-alamat', 'Setting::createAlamat');
    $routes->post('/setting/create-alamat/save-alamat', 'Setting::saveAlamat');
    $routes->post('update-alamat/edit-alamat/(:segment)', 'Setting::editAlamat/$1');
    $routes->get('/setting/update-alamat/(:any)', 'Setting::updateAlamat/$1');
    $routes->get('/history', 'HistoryTransaksiController::index');
    $routes->get('/kupon', 'Kupon::kupon');


    $routes->get('/status', 'UserStatusController::status');
    $routes->get('/payment/(:segment)', 'PaymentController::index/$1');
    $routes->post('/payment/token', 'PaymentController::ajaxPay');
});

$routes->group('dashboard', ['filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->get('/', 'Home::dashboard');
    $routes->get('pesanan', 'AdminPesananController::index');
    $routes->get('pesanan/(:segment)', 'AdminPesananController::detail/$1');

    $routes->get('admin', 'Home::admin');
    $routes->get('input', 'AdminProduk::input');
    $routes->get('tambahProduk', 'AdminProduk::tambahProduk');
    $routes->get('kategorisubkat', 'Kategorisubkat::kategorisubkat');
    $routes->get('kategori', 'AdminKategoriController::index');
    $routes->get('kupon', 'AdminKupon::kupon');
    $routes->get('inputkategori', 'inputkategori::inputkategori');

    //CRUD Admin kategori
    $routes->get('kategori', 'AdminKategoriController::index');
    $routes->get('kategori/tambah-kategori', 'AdminKategoriController::tambahKategori');
    $routes->post('kategori/tambah-kategori/save', 'AdminKategoriController::saveKategori');
    $routes->post('kategori/delete-kategori/(:segment)', 'AdminKategoriController::deleteKategori/$1');
    $routes->post('kategori/edit-kategori/update/(:segment)', 'AdminKategoriController::updateKategori/$1');
    $routes->get('kategori/edit-kategori/(:segment)', 'AdminKategoriController::editKategori/$1');
    // Admin Sub Kategori
    $routes->post('kategori/delete-sub-kategori/(:segment)', 'AdminKategoriController::deleteSubKategori/$1');
    $routes->post('kategori/edit-sub-kategori/update-sub-kategori/(:segment)', 'AdminKategoriController::updateSubKategori/$1');
    $routes->get('kategori/edit-sub-kategori/(:segment)', 'AdminKategoriController::editSubKategori/$1');

    //CRUD Admin Banner
    $routes->get('banner/inputbanner', 'AdminInputBanner::inputbanner');
    $routes->get('banner/tambah-banner', 'AdminInputBanner::tambahBanner');
    $routes->post('banner/tambah-banner/save', 'AdminInputBanner::saveBanner');
    $routes->post('banner/tambah-banner/delete/(:segment)', 'AdminInputBanner::deleteBanner/$1');
    $routes->get('banner/tambah-banner/update/(:segment)', 'AdminInputBanner::updateBanner/$1');
    $routes->post('banner/tambah-banner/edit/(:segment)', 'AdminInputBanner::editBanner/$1');

    // CRUD routes produk
    $routes->get('produk/produk', 'AdminProduk::produk');
    $routes->get('produk/detail-varian/(:segment)', 'AdminVariasiController::detail/$1');
    $routes->get('produk/detail-varian/(:segment)/tambah-variasi', 'AdminVariasiController::addVarianItem/$1');
    $routes->post('produk/detail-varian/tambah-variasi-item', 'AdminVariasiController::saveVarianItem');
    $routes->post('produk/detail-varian/delete-varian/(:segment)', 'AdminVariasiController::deleteVarianItem/$1');
    $routes->get('produk/tambah-produk', 'AdminProduk::tambahProduk');
    $routes->get('produk/tambah-variasi', 'AdminVariasiController::tambahVariasi');
    $routes->post('produk/tambah-variasi/save', 'AdminVariasiController::saveVariasi');
    $routes->post('produk/tambah-produk/save', 'AdminProduk::save');
    $routes->post('produk/tambah-produk/delete-produk/(:segment)', 'AdminProduk::deleteProduk/$1');
    $routes->get('produk/tambah-produk/update-produk/(:segment)', 'AdminProduk::updateProduk/$1');
    $routes->post('produk/tambah-produk/edit-produk/(:segment)', 'AdminProduk::editProduk/$1');

    // Crud Kupon
    $routes->get('kupon/tambah-kupon', 'AdminKupon::tambahKupon');
    $routes->post('kupon/tambah-kupon/save', 'AdminKupon::saveKupon');
    $routes->get('kupon/kupon/delete-kupon/(:segment)', 'AdminKupon::deleteKupon/$1');
    $routes->get('kupon/kupon/edit-kupon/(:segment)', 'AdminKupon::editKupon/$1');
    $routes->post('kupon/kupon/update-kupon/(:segment)', 'AdminKupon::updateKupon/$1');


    $routes->get('marketplace', 'AdminMarketplaceController::index');
    $routes->post('marketplace/store', 'AdminMarketplaceController::store');
    $routes->get('marketplace/create', 'AdminMarketplaceController::create');
    $routes->post('marketplace/update/(:segment)', 'AdminMarketplaceController::update/$1');
    $routes->get('marketplace/edit/(:segment)', 'AdminMarketplaceController::edit/$1');
});

service('auth')->routes($routes);

$routes->group('api', static function ($routes) { //nanti tambahkan filter auth via Tooken
    // $routes->resource('kategori');
    // $routes->resource('subkategori');
    // $routes->resource('produk');
    // $routes->resource('distributor');
    // $routes->resource('kupon');
    // $routes->resource('arsip');
    $routes->post('add-to-cart', 'CartController::ajaxAdd', ['filter' => 'group:user, admin, superadmin']);
    $routes->post('add-to-wishlist', 'WishlistController::ajaxAdd', ['filter' => 'group:user, admin, superadmin']);
    $routes->get('getcity', 'Setting::getCity');
    $routes->get('getcost', 'Setting::getCost');
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
