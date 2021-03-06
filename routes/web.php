<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\dashboardController;

use App\Http\Controllers\gscController;

use App\Http\Controllers\inventoryController;

use App\Http\Controllers\transaksiController;

use App\Http\Controllers\deliveryController;

use App\Http\Controllers\reportController;

use App\Http\Controllers\accountController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\storeController;

use App\Http\Controllers\gudangController;

use App\Http\Controllers\botNotifController;


Auth::routes();

Route::get('/', [AuthController::class, 'showFormLogin' ])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin' ])->name('login');
Route::post('login', [AuthController::class, 'login' ]);
Route::get('logout', [AuthController::class, 'logout' ]);

//TELEGRAM BOT
Route::post('/whgsc_bot/bot', [botNotifController::class, 'bot']);
Route::post('/whgsc_bot/setWebhook', [botNotifController::class, 'setWebhook']);
Route::post('/whgsc_bot/removeWebhook', [botNotifController::class, 'removeWebhook']);
Route::post('/whgsc_bot/getUpdates', [botNotifController::class, 'getUpdates']);

Route::group(['middleware' => ['web', 'auth','checkstatus']], function () {


    //TELEGRAM
    Route::get('/update-activity', [botNotifController::class, 'updatedActivity']);

    Route::group(['middleware' => ['superAdmin']], function () {
      //ACCOUNT
      Route::get('/account', [accountController::class, 'account']);
      Route::get('/account/get', [accountController::class, 'accountGet']);
      Route::post('/account/tambah', [accountController::class, 'accountTambah']);
      Route::post('/account/editGet', [accountController::class, 'accountEditGet']);
      Route::post('/account/editStore', [accountController::class, 'accountEditStore']);
      Route::post('/account/hapus', [accountController::class, 'accountHapus']);
      Route::post('/account/activated', [accountController::class, 'accountActivated']);

    });

    Route::group(['middleware' => ['owner']], function ()
    {
      //REPORTS
      Route::get('/report', [reportController::class, 'report']);
      Route::get('/reportGet/{data}', [reportController::class, 'reportGet']);
      Route::post('/report/download', [reportController::class, 'reportDownload']);
      Route::get('/report/cetak', [reportController::class, 'reportCetak']);
      Route::post('/report/excel', [reportController::class, 'reportExcel']);

      //data toko
      Route::get('/store/data_toko', [storeController::class, 'data_toko']);
      Route::get('/store/data_toko/get', [storeController::class, 'data_tokoGet']);
      Route::post('/store/data_toko/tambah', [storeController::class, 'data_tokoTambah']);
      Route::post('/store/data_toko/editGet', [storeController::class, 'data_tokoEditGet']);
      Route::post('/store/data_toko/editStore', [storeController::class, 'data_tokoEditStore']);
      Route::post('/store/data_toko/hapus', [storeController::class, 'data_tokoHapus']);
      Route::get('/store/data_toko/transaksi', [storeController::class, 'data_tokoPenjualan']);
      //Route::post('/store/data_toko/detail', [storeController::class, 'data_tokoDetail']);

      //platform
      Route::get('/store/platform', [storeController::class, 'platform']);
      Route::get('/store/platform/get', [storeController::class, 'platformGet']);
      Route::post('/store/platform/tambah', [storeController::class, 'platformTambah']);
      Route::post('/store/platform/editGet', [storeController::class, 'platformEditGet']);
      Route::post('/store/platform/editStore', [storeController::class, 'platformEditStore']);
      Route::post('/store/platform/hapus', [storeController::class, 'platformHapus']);
      Route::get('/store/platform/transaksi', [storeController::class, 'platformPenjualan']);
      //Route::post('/store/platform/detail', [storeController::class, 'platformDetail']);
    });

 //DASHBOARD
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('home');
    Route::post('/dashboard/serial', [dashboardController::class, 'serial']);
    Route::post('/dashboard/checkDN', [dashboardController::class, 'checkDN']);


 //GSC

     //distributor
     Route::get('/gsc/distributor', [gscController::class, 'distributorView']);
     Route::post('/gsc/distributor/tambah', [gscController::class, 'distributorTambah']);
     Route::get('/gsc/distributor/view', [gscController::class, 'distributorGet']);
     Route::post('/gsc/distributor/editGet', [gscController::class, 'distributorEditGet']);
     Route::post('/gsc/distributor/editStore', [gscController::class, 'distributorEditStore']);
     Route::post('/gsc/distributor/hapus', [gscController::class, 'distributorHapus']);

     //pogsc
     Route::get('/gsc/pogsc', [gscController::class, 'pogscView']);
     Route::post('/gsc/pogsc/tambah', [gscController::class, 'pogscTambah']);
     Route::get('/gsc/pogsc/view', [gscController::class, 'pogscGet']);
     Route::post('/gsc/pogsc/editGet', [gscController::class, 'pogscEditGet']);
     Route::post('/gsc/pogsc/editStore', [gscController::class, 'pogscEditStore']);
     Route::post('/gsc/pogsc/hapus', [gscController::class, 'pogscHapus']);
     Route::post('/gsc/pogsc/terima/', [gscController::class, 'pogscTerima']);
     Route::post('/gsc/pogsc/detail', [gscController::class, 'pogscDetail']);
     Route::get('/gsc/pogsc/select', [gscController::class, 'pogscSelect']);
     Route::get('/gsc/pogsc/detailEdit/{id}', [gscController::class, 'pogscDetailEdit']);
     Route::get('/gsc/pogsc/detailEdit/view/{id}', [gscController::class, 'pogscDetailEditView']);
     Route::post('/gsc/pogsc/detailEdit/tambah', [gscController::class, 'pogscDetailEditTambah']);
     Route::post('/gsc/pogsc/detailEdit/editStore', [gscController::class, 'pogscDetailEditEditStore']);
     Route::post('/gsc/pogsc/detailEdit/editGet', [gscController::class, 'pogscDetailEditEditGet']);
     Route::post('/gsc/pogsc/detailEdit/hapus', [gscController::class, 'pogscDetailEditHapus']);
     Route::get('/gsc/pogsc/print/{id}', [gscController::class, 'pogscPrint']);
     Route::post('/gsc/pogsc/autofill', [gscController::class, 'autofill']);
     Route::post('/gsc/pogsc/autofillCom', [gscController::class, 'autofillCom']);
     Route::get('/gsc/pogsc/wizard', [gscController::class, 'wizard']);
     Route::post('/gsc/pogsc/wizard/store', [gscController::class, 'wizardStore']);
     Route::post('/gsc/pogsc/lazy', [gscController::class, 'pogscLazy']);
     Route::post('/gsc/pogsc/cari_po', [gscController::class, 'pogscCari_po']);

     //Gudang
     Route::post('/gsc/gudang/autofill', [gscController::class, 'gudangAutofill']);
     Route::post('/gsc/gudang/autofillCom', [gscController::class, 'gudangAutofillCom']);

 //TRANSAKSI
     //po user
     Route::get('/transaksi', [transaksiController::class, 'pouser']);
     Route::get('/transaksi/po/view', [transaksiController::class, 'pouserView']);
     Route::post('/transaksi/po/tambah', [transaksiController::class, 'pouserTambah']);
     Route::post('/transaksi/po/editGet', [transaksiController::class, 'pouserEditGet']);
     Route::post('/transaksi/po/editStore', [transaksiController::class, 'pouserEditStore']);
     Route::post('/transaksi/po/hapus', [transaksiController::class, 'pouserHapus']);
     Route::post('/transaksi/po/detail', [transaksiController::class, 'pouserDetail']);
     Route::post('/transaksi/po/inv', [transaksiController::class, 'pouserInv']);
     Route::get('/transaksi/po/detailMode/{id}', [transaksiController::class, 'detailMode']);
     Route::get('/transaksi/po/detailMode/view/{id}', [transaksiController::class, 'detailModeView']);
     Route::post('/transaksi/po/detailMode/tambah', [ transaksiController::class, 'detailModeTambah']);
     Route::post('/transaksi/po/detailMode/editGet', [transaksiController::class, 'detailModeEditGet']);
     Route::post('/transaksi/po/detailMode/editStore', [transaksiController::class, 'detailModeEditStore']);
     Route::post('/transaksi/po/detailMode/hapus', [transaksiController::class, 'detailModeHapus']);
     Route::post('/transaksi/po/detailMode/serial/view', [transaksiController::class, 'detailModeSerialView']);
     Route::get('/transaksi/po/detailMode/serial/{id}/{status}', [transaksiController::class, 'detailModeSerial']);
     Route::get('/transaksi/po/detailMode/serial/get/{id}/{status}', [transaksiController::class, 'detailModeSerialGet']);
     Route::post('/transaksi/po/detailMode/serial/add', [transaksiController::class, 'detailModeSerialAdd']);
     Route::get('/transaksi/po/detailMode/inventory/select', [transaksiController::class, 'detailModeInventorySelect']);
     Route::post('/transaksi/po/detailMode/inventory/serial', [transaksiController::class, 'detailModeInventorySerial']);
     Route::post('/transaksi/po/detailMode/serial/snStore', [transaksiController::class, 'detailModeInventorySerialsnStore']);
     Route::post('/transaksi/po/detailMode/snHapus', [transaksiController::class, 'detailModeSnHapus']);
     Route::get('/transaksi/po/print_dn/{id}', [transaksiController::class, 'pouserPrint_dn']);
     Route::get('/transaksi/po/print_invoice/{id}', [transaksiController::class, 'pouserPrint_invoice']);
     Route::post('/transaksi/po/detailMode/inventory/serialImport', [transaksiController::class, 'compareSerial']);
     Route::post('/transaksi/po/detailMode/inventory/serialImportSave', [transaksiController::class, 'compareSerialSave']);
     Route::post('/transaksi/po/lihat_paket', [transaksiController::class, 'pouserLihat_paket']);
     Route::post('/transaksi/po/payment', [transaksiController::class, 'pouserPayment']);
     Route::post('/transaksi/po/arsip', [transaksiController::class, 'pouserArsip']);
     Route::get('/transaksi/arsip', [transaksiController::class, 'arsip']);
     Route::get('/transaksi/arsipView', [transaksiController::class, 'arsipView']);
     Route::post('/transaksi/arsip/lihat_paket', [transaksiController::class, 'arsipLihat_paket']);
     Route::get('/transaksi/invoice/{id}', [transaksiController::class, 'invoice']);
     Route::get('/transaksi/invoice/get/{id}', [transaksiController::class, 'invoiceGet']);
     Route::post('/transaksi/invoice/tambah', [transaksiController::class, 'invoiceTambah']);
     Route::post('/transaksi/invoice/editGet', [transaksiController::class, 'invoiceEditGet']);
     Route::post('/transaksi/invoice/editStore', [transaksiController::class, 'invoiceEditStore']);
     Route::get('/transaksi/invoice/print/{id}', [transaksiController::class, 'invoicePrint']);
     Route::post('/transaksi/invoice/hapus', [transaksiController::class, 'invoiceHapus']);
     Route::post('/transaksi/po/autofill', [transaksiController::class, 'autofill']);
     Route::post('/transaksi/po/autofillCom', [transaksiController::class, 'autofillCom']);
     //Route::post('/transaksi/detail/autofill', [transaksiController::class, 'autofill']);
     Route::post('/transaksi/detail/autofillCom', [transaksiController::class, 'detailAutofillCom']);
     Route::get('/transaksi/wizard', [transaksiController::class, 'wizard']);
     Route::post('/transaksi/wizard/store', [transaksiController::class, 'wizardStore']);
     Route::post('/transaksi/po/lazy', [transaksiController::class, 'pouserLazy']);
     Route::post('/transaksi/po/cari_dn', [transaksiController::class, 'pouserCari_dn']);
     Route::post('/transaksi/po/checkDN', [transaksiController::class, 'pouserCheckDN']);
     Route::post('/transaksi/po/checkDNEdit', [transaksiController::class, 'pouserCheckDNEdit']);


//Customer (New)
    Route::get('/customers', [transaksiController::class, 'customers']);
    Route::get('/customers/view', [transaksiController::class, 'customersView']);
    Route::post('/customers/tambah', [transaksiController::class, 'customersTambah']);
    Route::post('/customers/editGet', [transaksiController::class, 'customersEditGet']);
    Route::post('/customers/editStore', [transaksiController::class, 'customersEditStore']);
    Route::post('/customers/hapus', [transaksiController::class, 'customersHapus']);

 //INVENTORY

        //gudang
        Route::get('/inventory', [inventoryController::class, 'inventory']);
        Route::post('/inventory/gudang/cariGudang', [inventoryController::class, 'inventoryGudangCariGudang']);
        Route::post('/inventory/gudang/cariBarang', [inventoryController::class, 'inventoryGudangCariBarang']);
        Route::post('/inventory/gudang/cariBarangDestination', [inventoryController::class, 'inventoryGudangCariBarangDestination']);


        //gudang crud
        Route::get('/gudang', [gudangController::class, 'gudang']);
        Route::get('/gudang/view', [gudangController::class, 'gudangView']);
        Route::post('/gudang/tambah', [gudangController::class, 'gudangTambah']);
        Route::post('/gudang/editGet', [gudangController::class, 'gudangEditGet']);
        Route::post('/gudang/editStore', [gudangController::class, 'gudangEditStore']);

        //transfer
        Route::post('/inventory/transferStoreMake', [inventoryController::class, 'inventoryTransferMake']);
        Route::post('/inventory/transferStore', [inventoryController::class, 'inventoryTransfer']);

        //barang masuk
        Route::get('/inventory/barang_masuk/{id}',[inventoryController::class, 'barang_masukView']);
        Route::get('/inventory/barang_masuk/view/{id}',[inventoryController::class, 'barang_masukGet']);
        Route::post('/inventory/barang_masuk/tambah',[inventoryController::class, 'barang_masukTambah']);
        Route::post('/inventory/barang_masuk/editGet',[inventoryController::class, 'barang_masukEditGet']);
        Route::post('/inventory/barang_masuk/editStore',[inventoryController::class, 'barang_masukEditStore']);
        Route::post('/inventory/barang_masuk/sn_view',[inventoryController::class, 'barang_masukSn_view']);
        Route::post('/inventory/barang_masuk/hapus',[inventoryController::class, 'barang_masukHapus']);
        Route::get('/inventory/barang_masuk/snMode/{id}',[inventoryController::class, 'SnMode']);
        Route::get('/inventory/barang_masuk/snMode/get/{id}',[inventoryController::class, 'SnModeGet']);
        Route::post('/inventory/barang_masuk/snStore', [inventoryController::class, 'snStore']);
        Route::post('/inventory/barang_masuk/snEdit', [inventoryController::class, 'snEdit']);
        Route::post('/inventory/barang_masuk/snUpdate', [inventoryController::class, 'snUpdate']);
        Route::post('/inventory/barang_masuk/snHapus', [inventoryController::class, 'snHapus']);
        Route::post('/inventory/barang_masuk/snImport', [inventoryController::class, 'snImport']);
        Route::post('/inventory/barang_masuk/active', [inventoryController::class, 'active_data']);
        Route::post('/inventory/barang_masuk/inactive', [inventoryController::class, 'inactive_data']);


 //Delivery
     //Paket
     Route::get('/delivery/paket', [deliveryController::class, 'paketView']);
     Route::get('/delivery/paket/view', [deliveryController::class, 'paketGet']);
     Route::post('/delivery/paket/tambah', [deliveryController::class, 'paketTambah']);
     Route::post('/delivery/paket/editGet', [deliveryController::class, 'paketEditGet']);
     Route::post('/delivery/paket/editStore', [deliveryController::class, 'paketEditStore']);
     Route::post('/delivery/paket/hapus', [deliveryController::class, 'paketHapus']);
     Route::get('/delivery/paket/hapusGet', [deliveryController::class, 'paketHapusGet']);
     Route::post('/delivery/paket/detail', [deliveryController::class, 'paketDetail']);
     Route::get('/delivery/paket/detail/select', [deliveryController::class, 'paketDetailSelect']);
     Route::post('/delivery/paket/detail/tambah', [deliveryController::class, 'paketDetailTambah']);
     Route::post('/delivery/paket/detail/hapus', [deliveryController::class, 'paketDetailHapus']);
     Route::get('/delivery/paket/detail/view', [deliveryController::class, 'paketDetailView']);
     Route::post('/delivery/paket/detail/add', [deliveryController::class, 'paketDetailAdd']);
     Route::post('/delivery/paket/detail/delete', [deliveryController::class, 'paketDetailDelete']);
     Route::get('/delivery/paket/konfirmasi', [deliveryController::class, 'paketKonfirmasi']);
     Route::post('/delivery/paket/kirim', [deliveryController::class, 'paketKirim']);
     Route::get('/delivery/paket/print/{id}', [deliveryController::class, 'paketPrint']);
     Route::post('/delivery/paket/checkDN', [deliveryController::class, 'paketCheckDN']);
     Route::post('/delivery/paket/checkDNEdit', [deliveryController::class, 'paketCheckDNEdit']);

     //Logistic
     Route::get('/delivery/logistic', [deliveryController::class, 'logistic']);
     Route::get('/delivery/logisticGet', [deliveryController::class, 'logisticGetView']);
     Route::post('/delivery/logistic/tambah', [deliveryController::class, 'logisticTambah']);
     Route::post('/delivery/logistic/editGet', [deliveryController::class, 'logisticEditGet']);
     Route::post('/delivery/logistic/editStore', [deliveryController::class, 'logisticEditStore']);
     Route::post('/delivery/logistic/hapus', [deliveryController::class, 'logisticHapus']);



//STORE

    //transaksi
    Route::get('/store/transaksi', [storeController::class, 'transaksi']);
    Route::get('/store/transaksi/get', [storeController::class, 'transaksiGet']);
    Route::post('/store/transaksi/tambah', [storeController::class, 'transaksiTambah']);
    Route::post('/store/transaksi/editGet', [storeController::class, 'transaksiEditGet']);
    Route::post('/store/transaksi/editStore', [storeController::class, 'transaksiEditStore']);
    Route::post('/store/transaksi/hapus', [storeController::class, 'transaksiHapus']);
    Route::post('/store/transaksi/no_transaksi', [storeController::class, 'transaksiNoOtomatis']);
    Route::post('/store/transaksi/no_transaksiFilter', [storeController::class, 'transaksiNoTransaksiFilter']);
    Route::get('/store/transaksi/detail/{id}', [storeController::class, 'transaksiDetail']); //get detail_transaksi_data
    Route::get('/store/transaksi/print_transaksi/{id}', [storeController::class, 'transaksiPrintTransaksi']);
    Route::get('/store/transaksi/send/{id}', [storeController::class, 'transaksiSend']);


    //detail transaksi
    Route::get('/store/detail_transaksi/{id}', [storeController::class, 'detailTransaksi']);
    Route::get('/store/detail_transaksi/get/{id}', [storeController::class, 'detailTransaksiGet']);
    Route::post('/store/detail_transaksi/tambah', [storeController::class, 'detailTransaksiTambah']);
    Route::post('/store/detail_transaksi/editGet', [storeController::class, 'detailTransaksiEditGet']);
    Route::post('/store/detail_transaksi/editStore', [storeController::class, 'detailTransaksiEditStore']);
    Route::post('/store/detail_transaksi/hapus', [storeController::class, 'detailTransaksiHapus']);
    Route::get('/store/detail_transaksi/cari_barang/{id}', [storeController::class, 'detailTransaksiCari_barang']);

});
