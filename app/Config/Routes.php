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
$routes->get('lang/{locale}', 'Language::index');
$routes->get('/search', 'ProdukController::search');
$routes->get('/produk/kategori/(:any)', 'ProdukController::getProduk/$1/$2');
$routes->get('/produk/kategori/(:any)/(:any)', 'ProdukController::getProduk/$1/$2');
$routes->get('/produk/(:any)', 'ProdukController::produkShowSingle/$1');
$routes->get('/blog/(:segment)', 'Blog::index/$1');
$routes->get('user/home/contenBanner/conten-banner', 'Blog::contenBanner');
$routes->get('/status-gosend', 'StatusGosend::statusGosend');
$routes->get('kebijakan-privasi', 'Setting::kebijakanPrivasi');


// Rute untuk AppleAuthController
$routes->get('apple-login', 'AppleAuthController::appleLogin');

// Rute untuk AppleCallbackController
$routes->get('apple-callback', 'AppleCallbackController::appleCallback');


$routes->get('/promo/(:segment)', 'UserPromoController::index/$1');

$routes->group('/', ['filter' => 'group:user, admin, superadmin'], static function ($routes) {
    $routes->get('/wishlist', 'WishlistController::index');
    $routes->post('/wishlist/delete/(:num)', 'WishlistController::deleteProduk/$1');


    $routes->get('/buy/(:segment)', 'BuyController::index/$1');
    $routes->post('/store/(:segment)', 'BuyController::storeData/$1');
    $routes->post('/new-payment', 'BuyController::getNewPayment');

    // $routes->get('/cart', 'CartController::cart');
    $routes->get('/cart', 'CartController::cart2');
    $routes->post('/cart/delete/(:num)', 'CartController::deleteProduk/$1');

    $routes->post('/checkout', 'CheckoutController::storeData');
    $routes->get('/checkout/(:any)', 'CheckoutController::checkout/$1');
    $routes->post('/checkout/(:any)/bayar', 'CheckoutController::bayar/$1');
    $routes->get('/checkout-cart', 'CheckoutController::checkoutCart');
    $routes->post('/checkout-cart/bayar', 'CheckoutController::checkoutCartBayar');

    $routes->get('/select-alamat', 'SelectAlamat::selectAlamat');

    // Setting route
    $routes->group('setting/', static function ($routes) {
        // Get
        $routes->get('/', 'Setting::setting');
        $routes->get('detail-user/(:any)', 'Setting::detailUser/$1');
        $routes->post('detail-user/delete-account/(:segment)', 'Setting::submitDeleteRequest/$1');
        $routes->get('pembayaran', 'Setting::pembayaran');
        $routes->get('alamat-list', 'Setting::alamatList');
        $routes->get('create-alamat', 'Setting::createAlamat');
        $routes->get('update-alamat/(:any)', 'Setting::updateAlamat/$1');

        $routes->get('kebijakan-privasi', 'Setting::kebijakanPrivasi');
        $routes->get('sayo-care', 'Setting::sayoCare');

        // Post
        $routes->post('select-alamat', 'Setting::storeDataAlamat');
        $routes->post('detail-user/(:segment)', 'Setting::updateDetailUser/$1');
        $routes->post('delete-alamat/(:segment)', 'Setting::deleteAlamat/$1');
        $routes->post('create-alamat/save-alamat', 'Setting::saveAlamat');
        $routes->post('update-alamat/edit-alamat/(:segment)', 'Setting::editAlamat/$1');
        $routes->post('update-market', 'Setting::storeDataMarket');
    });

    $routes->get('/history', 'HistoryTransaksiController::index');


    $routes->get('/kupon', 'Kupon::kupon');


    $routes->get('/status', 'UserStatusController::status');
    $routes->get('/payment/(:segment)', 'PaymentController::index/$1');
    $routes->post('/payment/token', 'PaymentController::ajaxPay');
});

$routes->group('dashboard', ['filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->get('/', 'Home::dashboard');
    $routes->group('order/', static function ($routes) {
        // $routes->get('/', 'AdminPesananController::index');
        // $routes->get('2', 'AdminPesananController::index2');
        $routes->get('/', 'AdminPesananController::index2');
        $routes->get('awaiting-payment', 'AdminPesananController::awaitingPayment');
        $routes->get('in-proccess', 'AdminPesananController::inProccess');
        $routes->post('in-proccess/update-status/(:segment)', 'AdminPesananController::updateStatus/$1');
        $routes->post('in-proccess/update-resi/(:segment)', 'AdminPesananController::updateStatusResi/$1');
        $routes->get('in-proccess/print-all', 'AdminPesananController::printAllOrder');
        $routes->get('print-order/(:segment)', 'AdminPesananController::printOrder/$1');
        $routes->get('being-delivered/', 'AdminPesananController::beingDelivered');
        $routes->get('delivered/', 'AdminPesananController::delivered');
        $routes->get('(:segment)', 'AdminPesananController::detail/$1');
    });

    // Route Reporting File
    $routes->get('report/', 'ReportController::index');
    $routes->get('report/printpdf', 'ReportController::print');

    $routes->get('admin', 'Home::admin');
    $routes->get('input', 'AdminProduk::input');
    $routes->get('tambahProduk', 'AdminProduk::tambahProduk');
    $routes->get('kategorisubkat', 'Kategorisubkat::kategorisubkat');
    $routes->get('kategori', 'AdminKategoriController::index');
    $routes->get('inputkategori', 'inputkategori::inputkategori');



    //CRUD Admin kategori
    $routes->get('kategori', 'AdminKategoriController::index');
    $routes->get('kategori/shorting', 'AdminKategoriController::editKategoriShort');
    $routes->post('kategori/shorting/save', 'AdminKategoriController::saveKategoriShort');
    $routes->get('kategori/tambah-kategori', 'AdminKategoriController::tambahKategori');
    $routes->get('kategori/tambah-kategori2', 'AdminKategoriController::tambahKategori2');
    $routes->post('kategori/tambah-kategori/save', 'AdminKategoriController::saveKategori');
    $routes->post('kategori/delete-kategori/(:segment)', 'AdminKategoriController::deleteKategori/$1');
    $routes->post('kategori/edit-kategori/update/(:segment)', 'AdminKategoriController::updateKategori/$1');
    $routes->get('kategori/edit-kategori/(:segment)', 'AdminKategoriController::editKategori/$1');
    // Admin Sub Kategori
    $routes->post('kategori/delete-sub-kategori/(:segment)', 'AdminKategoriController::deleteSubKategori/$1');
    $routes->post('kategori/edit-sub-kategori/update', 'AdminKategoriController::updateSubKategori');
    $routes->get('kategori/edit-sub-kategori/(:segment)', 'AdminKategoriController::editSubKategori/$1');

    //CRUD Admin Banner
    $routes->get('banner/', 'AdminBannerController::index');
    $routes->get('banner/list-banner', 'AdminBannerController::listBanner');
    $routes->get('banner/tambah-banner', 'AdminBannerController::tambahBanner');
    $routes->post('banner/tambah-banner/save', 'AdminBannerController::saveBanner');
    $routes->post('banner/tambah-banner/delete/(:segment)', 'AdminBannerController::deleteBanner/$1');
    $routes->get('banner/update-banner/(:segment)', 'AdminBannerController::updateBanner/$1');
    $routes->post('banner/update-banner/save', 'AdminBannerController::updateBannerSave');
    // Pop Up
    $routes->get('banner/pop-up-banner', 'AdminBannerController::popUp');
    $routes->post('banner/pop-up-banner/save', 'AdminBannerController::savePopup');
    $routes->post('banner/pop-up-banner/delete/(:segment)', 'AdminBannerController::deletePopup/$1');
    $routes->get('banner/update-pop-up/(:segment)', 'AdminBannerController::updatePopup/$1');
    $routes->post('banner/update-pop-up/save-pop-up', 'AdminBannerController::savePopupEdit');
    // Adsvertisements
    $routes->get('banner/ads-konten-banner', 'AdminBannerController::kontenAds');
    $routes->post('banner/ads-konten-banner/save', 'AdminBannerController::saveKontenAds');
    $routes->post('banner/ads-konten-banner/delete/(:segment)', 'AdminBannerController::deleteKontenAds/$1');
    $routes->get('banner/update-ads-konten/(:segment)', 'AdminBannerController::updateKontenAds/$1');
    $routes->post('banner/update-ads-konten/save-ads', 'AdminBannerController::saveKontenAdsEdit');
    // Content
    $routes->get('banner/tambah-konten', 'AdminBannerController::tambahKonten');

    // CRUD routes produk
    $routes->get('produk/', 'AdminProduk::produk');
    $routes->post('produk/delete-batch', 'AdminProduk::deleteBatch');

    $routes->get('produk/detail-varian/(:segment)', 'AdminVariasiController::detail/$1');
    $routes->post('produk/detail-varian/tambah-variasi-item', 'AdminVariasiController::saveVarianItem');
    $routes->post('produk/detail-varian/update-variasi-item', 'AdminVariasiController::updateVarianItem');
    $routes->post('produk/detail-varian/delete-varian/(:segment)', 'AdminVariasiController::deleteVarianItem/$1');

    $routes->get('produk/tambah-produk', 'AdminProduk::tambahProduk');
    $routes->post('produk/tambah-produk/save', 'AdminProduk::save');

    $routes->get('produk/tambah-variasi', 'AdminVariasiController::tambahVariasi');
    $routes->post('produk/tambah-variasi/save', 'AdminVariasiController::saveVariasi');
    $routes->post('produk/tambah-variasi/delete-variasi/(:segment)', 'AdminVariasiController::deleteVariasi/$1');
    $routes->get('produk/tambah-variasi/update-variasi/(:segment)', 'AdminVariasiController::updateVariasi/$1');
    $routes->post('produk/tambah-variasi/edit-variasi/(:segment)', 'AdminVariasiController::editVariasi/$1');

    $routes->post('produk/delete-produk/(:segment)', 'AdminProduk::deleteProduk/$1');
    $routes->get('produk/update-produk/(:segment)', 'AdminProduk::updateProduk/$1');
    $routes->post('produk/update-produk/save', 'AdminProduk::saveUpdateProduk');

    // Kategori Produk Batch
    $routes->get('produk/produk-batch', 'AdminKategoriBatch::produkBatch');
    $routes->post('produk/produk-batch/save', 'AdminKategoriBatch::save');


    $routes->get('update-stok/(:segment)', 'AdminStokController::updateStock/$1');
    $routes->post('update-stok/update', 'AdminStokController::storeUpdateStok');

    //Route Admin Dashboard Kupon
    $routes->group('kupon/', static function ($routes) {
        $routes->get('/', 'AdminKupon::kupon');
        $routes->get('tambah-kupon', 'AdminKupon::tambahKupon');
        $routes->post('tambah-kupon/save', 'AdminKupon::saveKupon');
        $routes->post('delete-kupon/(:segment)', 'AdminKupon::deleteKupon/$1');
        $routes->get('edit-kupon/(:segment)', 'AdminKupon::editKupon/$1');
        $routes->post('edit-kupon/(:segment)', 'AdminKupon::updateKupon/$1');
    });

    // CRUD Marketplace
    $routes->get('marketplace', 'AdminMarketplaceController::index');
    $routes->get('marketplace/show/(:num)', 'AdminMarketplaceController::show/$1');
    $routes->get('marketplace/(:num)', 'AdminMarketplaceController::market/$1');
    $routes->post('marketplace/store', 'AdminMarketplaceController::store');
    $routes->get('marketplace/create', 'AdminMarketplaceController::create');
    $routes->get('marketplace/edit/(:segment)', 'AdminMarketplaceController::edit/$1');
    $routes->post('marketplace/update', 'AdminMarketplaceController::update');
    $routes->post('marketplace/delete/(:segment)', 'AdminMarketplaceController::delete/$1');

    //Admin Marketplace
    $routes->get('admin-market', 'AdminMarketpalceAdminController::index');
    $routes->post('admin-market/save', 'AdminMarketpalceAdminController::adminSave');
    $routes->post('admin-market/update/(:segment)', 'AdminMarketpalceAdminController::storeDataUpdate/$1');
    $routes->post('admin-market/delete/(:segment)', 'AdminMarketpalceAdminController::deleteAllAdminMarket/$1');

    // CRUD Promo
    $routes->get('promo/tambah-promo', 'AdminPromoController::tambahPromo');
    $routes->post('promo/tambah-promo/save', 'AdminPromoController::savePromo');
    $routes->post('promo/tambah-promo/delete-promo/(:segment)', 'AdminPromoController::deletePromo/$1');
    $routes->get('promo/update-promo/(:segment)', 'AdminPromoController::updatePromo/$1');
    $routes->post('promo/tambah-promo/edit-promo/(:segment)', 'AdminPromoController::editPromo/$1');

    // Promo Item
    $routes->get('promo/tambah-promo-item', 'AdminPromoController::tambahPromoItem');
    $routes->post('promo/tambah-promo-item/save-promo-item', 'AdminPromoController::savePromoItem');

    $routes->get('promo/tambah-promo-item/edit-promo-item/(:segment)', 'AdminPromoController::editPromoItem/$1');
    $routes->post('promo/tambah-promo-item/edit-promo-item/(:segment)', 'AdminPromoController::updatePromoItem/$1');

    $routes->post('promo/tambah-promo-item/delete-promo-item/(:segment)', 'AdminPromoController::deletePromoItem/$1');

    // CRUD KONTEN/BLOG/ARTIKEL
    $routes->get('blog/blog', 'AdminBlog::blog');
    $routes->get('blog/tambah-konten', 'AdminBlog::tambahKonten');
    $routes->post('blog/tambah-konten/save-konten', 'AdminBlog::saveKonten');
    $routes->get('blog/update-konten/(:segment)', 'AdminBlog::updateKonten/$1');
    $routes->post('blog/tambah-konten/edit-konten/(:segment)', 'AdminBlog::editKonten/$1');
    $routes->post('blog/delete-konten/(:segment)', 'AdminBlog::deleteKonten/$1');
    // DETAIL KONTEN/BLOG/ARTIKEL
    $routes->get('blog/detail-konten/(:segment)', 'AdminBlog::detailKonten/$1');

    // PROFILE ADMIN
    $routes->get('profil/profile-admin/(:segment)', 'AdminProfil::profilAdmin/$1');
    $routes->get('profil/edit-admin/(:any)', 'AdminProfil::editProfil/$1');
    $routes->post('profil/edit-admin/(:segment)', 'AdminProfil::saveProfil/$1');

    // USER MANAGEMENT
    $routes->get('user-management', 'AdminUserManagementController::index');
    $routes->post('user-management/update/(:segment)', 'AdminUserManagementController::updateUserRole/$1');
    // DELETE REQUEST USER
    $routes->get('user-management/delete-account', 'AdminUserManagementController::delRequest');
    $routes->post('user-management/delete-account/delete/(:segment)', 'AdminUserManagementController::delete/$1');

    // ADMIN MANAGEMENT
    $routes->get('admin-management', 'AdminManagementController::index');
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
    $routes->post('change-cart-qty', 'CartController::ajaxChangeQty', ['filter' => 'group:user, admin, superadmin']);
    $routes->post('add-to-wishlist', 'WishlistController::ajaxAdd', ['filter' => 'group:user, admin, superadmin']);
    $routes->get('getcity', 'Setting::getCity');
    $routes->get('getcost', 'Setting::getCost');
    $routes->post('set-uuid', 'NotifController::setUuid');
    $routes->Post('payment-success', 'NotifController::PaymentSuccess');

    // $routes->get('/notif', 'NotifController::PaymentSuccess2');
    // $routes->get('/notif', 'NotifController::index');
    // $routes->post('/notif', 'NotifController::post');

    $routes->group('home', ['filter' => 'resourceapi'], static function ($routes) {
        $routes->get('/', 'RestfullApiController::index');
        $routes->get('user/(:num)', 'RestfullApiController::user/$1');
        $routes->get('origin', 'RestfullApiController::originList');
        $routes->get('origin/(:num)', 'RestfullApiController::origin/$1');
        $routes->get('transaction', 'RestfullApiController::transaction');
        $routes->get('transaction/gosend', 'RestfullApiController::transactionGoSend');
        $routes->get('transaction/gosend/(:segment)', 'RestfullApiController::transactionGoSendId/$1');
        $routes->post('transaction/update-status/(:segment)', 'RestfullApiController::updateStatus/$1');
        $routes->get('transaction/waiting-payment', 'RestfullApiController::transactionWp');
        $routes->get('transaction/in-process', 'RestfullApiController::transactionIp');
        $routes->get('transaction/delivered', 'RestfullApiController::transactionDd');
        $routes->get('transaction/finish', 'RestfullApiController::transactionFh');
        $routes->get('transaction/failed', 'RestfullApiController::transactionFail');

        // GOSEND API
        $routes->get('get-order/(:segment)', 'WebhookController::getOrder/$1');
        $routes->post('get-order/pickup-item/(:segment)', 'WebhookController::pickupItem/$1');
        $routes->patch('get-order/pickup-item/(:segment)', 'WebhookController::handlerPickupItem/$1');
        $routes->get('get-order/gosend', 'WebhookController::getSingleOrder');
        $routes->post('get-order/gosend', 'WebhookController::updateSingleOrder');
    });
});

$routes->get('/maps', 'MapsController::maps');


$routes->group('/webhook', ['filter' => 'webhookFilter'], static function ($routes) {
    $routes->get('/', 'WebhookController::index');
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
