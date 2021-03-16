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

    
Auth::routes();

Route::get('/', [AuthController::class, 'showFormLogin' ])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin' ])->name('login');
Route::post('login', [AuthController::class, 'login' ]);
Route::get('logout', [AuthController::class, 'logout' ]);

Route::group(['middleware' => ['web', 'auth', 'roles','checkstatus']], function () {

    //ACCOUNT
    Route::get('/account', [accountController::class, 'account']);
    Route::get('/account/get', [accountController::class, 'accountGet']);
    Route::post('/account/tambah', [accountController::class, 'accountTambah']);
    Route::post('/account/editGet', [accountController::class, 'accountEditGet']);
    Route::post('/account/editStore', [accountController::class, 'accountEditStore']);
    Route::post('/account/hapus', [accountController::class, 'accountHapus']);
    Route::post('/account/activated', [accountController::class, 'accountActivated']);
    
 //DASHBOARD
 Route::get('/dashboard', [dashboardController::class, 'index'])->name('home');
 Route::post('/dashboard/serial', [dashboardController::class, 'serial']);


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
 
     //Logistic
     Route::get('/delivery/logistic', [deliveryController::class, 'logistic']);
     Route::get('/delivery/logisticGet', [deliveryController::class, 'logisticGetView']);
     Route::post('/delivery/logistic/tambah', [deliveryController::class, 'logisticTambah']);
     Route::post('/delivery/logistic/editGet', [deliveryController::class, 'logisticEditGet']);
     Route::post('/delivery/logistic/editStore', [deliveryController::class, 'logisticEditStore']);
     Route::post('/delivery/logistic/hapus', [deliveryController::class, 'logisticHapus']);
 
 
 //REPORTS
     Route::get('/report', [reportController::class, 'report']);
     Route::get('/reportGet/{data}', [reportController::class, 'reportGet']);
     Route::post('/report/download', [reportController::class, 'reportDownload']);
     Route::get('/report/cetak', [reportController::class, 'reportCetak']);
 
    
//Store
    //data toko
    Route::get('/store/data_toko', [storeController::class, 'data_toko']);
    Route::get('/store/data_toko/get', [storeController::class, 'data_tokoGet']);
    Route::post('/store/data_toko/tambah', [storeController::class, 'data_tokoTambah']);
    Route::get('/store/data_toko/editGet', [storeController::class, 'data_tokoEditGet']);
    Route::post('/store/data_toko/editStore', [storeController::class, 'data_tokoEditStore']);
    Route::post('/store/data_toko/hapus', [storeController::class, 'data_tokoHapus']);
    Route::get('/store/data_toko/penjualan', [storeController::class, 'data_tokoPenjualan']);
    Route::post('/store/data_toko/detail', [storeController::class, 'data_tokoDetail']);

    //barang toko
    Route::get('/store/barang_toko', [storeController::class, 'barang_toko']);
    Route::get('/store/barang_toko/get', [storeController::class, 'barang_tokoGet']);

    //penjualan
    Route::get('/store/penjualan', [storeController::class, 'penjualan']);
    Route::get('/store/penjualan/get', [storeController::class, 'penjualanGet']);
    Route::get('/store/penjualan/transaksi', [storeController::class, 'penjualanTransaksi']);
    Route::post('/store/penjualan/transaksi/store', [storeController::class, 'penjualanTransaksiStore']);
    Route::get('/store/penjualan/invoice/{id}', [storeController::class, 'penjualanInvoice']);
    Route::get('/store/penjualan/invoice/cetak', [storeController::class, 'penjualanInvoiceCetak']);
    Route::post('/store/penjualan/hapus', [storeController::class, 'penjualanHapus']);

    //report
    Route::get('/store/report', [storeController::class, 'report']);
    
 

});





