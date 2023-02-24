<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AhsDataController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\AhsRealisasiController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PpnController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\InputMaterialController;
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

Route::middleware('guest')->group(function (){
	Route::get('/login', [UserController::class, 'viewlogin'])->name('viewlogin');
	Route::post('/login/sub', [UserController::class, 'login'])->name('login');
	Route::get('/register', [UserController::class, 'viewregister'])->name('viewregister');
	Route::post('/register/sub', [UserController::class, 'register'])->name('register');
	Route::get('/', function () {
    	return view('login');
	});

});

Route::middleware('auth')->group(function (){
	Route::get('/dashboard', [PageController::class, 'viewDashboard'])->name('viewDashboard');
	Route::get('/logout', [UserController::class, 'logout'])->name('logout');
	Route::get('/user', [UserController::class, 'viewUser'])->name('viewUser');
	Route::post('/user/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
	Route::get('/{id_proyek}/setting', [PageController::class, 'ViewSetting'])->name('ViewSetting');
	Route::get('/{id_proyek}/resetQuery', [QueryController::class, 'resetQuery'])->name('resetQuery');


	Route::get('/List-Proyek', [ProyekController::class, 'viewProyek'])->name('viewProyek');
	Route::get('/add-proyek', [ProyekController::class, 'viewAddProyek'])->name('viewAddProyek');
	Route::post('/add-proyek/sub', [ProyekController::class, 'addProyek'])->name('addProyek');
	Route::get('/{id_proyek}/viewDetailProyek', [ProyekController::class, 'viewDetailProyek'])->name('viewDetailProyek');
	Route::get('/{id_proyek}/EditProyek', [ProyekController::class, 'viewEditProyek'])->name('viewEditProyek');
	Route::post('/{id_proyek}/EditProyek/sub', [ProyekController::class, 'editProyek'])->name('editProyek');
	Route::get('/{id_proyek}/cloneProyek', [ProyekController::class, 'viewCloneProyek'])->name('viewCloneProyek');
	Route::post('/{id_proyek}/clone', [ProyekController::class, 'cloneProyek'])->name('cloneProyek');



	Route::get('/{id_proyek}/ahsData', [AhsDataController::class, 'viewAhsData'])->name('viewAhsData');
	Route::post('/{id_proyek}/ahsData/importExcel', [AhsDataController::class, 'importExcelAhsData'])->name('importExcelAhsData');
	Route::get('/{id_proyek}/ahsData/exportExcel', [AhsDataController::class, 'exportExcelAhsData'])->name('exportExcelAhsData');
	Route::get('/{id_proyek}/ahsData/pdfExcel', [AhsDataController::class, 'exportPDFAhsData'])->name('exportPDFAhsData');
	Route::get('/{id_proyek}/ahsData/deleteAll', [AhsDataController::class, 'deleteAllAhsData'])->name('deleteAllAhsData');
	Route::get('/{id_proyek}/ahsData/addAhsData', [AhsDataController::class, 'viewAddAhsData'])->name('viewAddAhsData');
	Route::post('/{id_proyek}/ahsData/addAhsData/sub', [AhsDataController::class, 'addAhsData'])->name('addAhsData');
	Route::get('/{id_proyek}/ahsData/EditAhsData/{id}', [AhsDataController::class, 'viewEditAhsData'])->name('viewEditAhsData');
	Route::post('/{id_proyek}/ahsData/EditAhsData/sub/{id}', [AhsDataController::class, 'editAhsData'])->name('editAhsData');
	Route::get('/{id_proyek}/ahsData/deleteAhsData/{id}', [AhsDataController::class, 'deleteAhsData'])->name('deleteAhsData');
    Route::get('/{id_proyek}/ahsData/{filter}/{search}', [AhsDataController::class, 'viewAhsDataFilter'])->name('viewAhsDataFilter');




	Route::get('/{id_proyek}/Bahan', [BahanController::class, 'viewBahan'])->name('viewBahan');
	Route::post('/{id_proyek}/Bahan/importExcel', [BahanController::class, 'importExcelBahan'])->name('importExcelBahan');
	Route::get('/{id_proyek}/Bahan/add', [BahanController::class, 'viewAddBahan'])->name('viewAddBahan');
	Route::get('/{id_proyek}/Bahan/edit/{id}', [BahanController::class, 'viewEditBahan'])->name('viewEditBahan');
	Route::get('/{id_proyek}/Bahan/delete/{id}', [BahanController::class, 'deleteBahan'])->name('deleteBahan');
	Route::get('/{id_proyek}/Bahan/deleteAll', [BahanController::class, 'deleteAllBahan'])->name('deleteAllBahan');
	Route::post('/{id_proyek}/Bahan/add/sub', [BahanController::class, 'addBahan'])->name('addBahan');
	Route::post('/{id_proyek}/Bahan/edit/sub/{id}', [BahanController::class, 'editBahan'])->name('editBahan');
	Route::get('/{id_proyek}/Bahan/exportExcel', [BahanController::class, 'exportExcelBahan'])->name('exportExcelBahan');
    Route::get('/{id_proyek}/Bahan/{filter}/{search}', [BahanController::class, 'viewBahanFilter'])->name('viewBahanFilter');
	



	Route::get('/{id_proyek}/AhsRealisasi', [AhsRealisasiController::class, 'viewAhsRealisasi'])->name('viewAhsRealisasi');
	Route::post('/{id_proyek}/AhsRealisasi/importExcel', [AhsRealisasiController::class, 'importExcelAhsRealisasi'])->name('importExcelAhsRealisasi');
	Route::get('/{id_proyek}/AhsRealisasi/exportExcel', [AhsRealisasiController::class, 'exportExcelAhsRealisasi'])->name('exportExcelAhsRealisasi');
	Route::get('/{id_proyek}/AhsRealisasi/pdfExcel', [AhsRealisasiController::class, 'exportPDFAhsRealisasi'])->name('exportPDFAhsRealisasi');
	Route::get('/{id_proyek}/AhsRealisasi/add', [AhsRealisasiController::class, 'viewAddAhsRealisasi'])->name('viewAddAhsRealisasi');
	Route::post('/{id_proyek}/AhsRealisasi/add/sub', [AhsRealisasiController::class, 'addAhsRealisasi'])->name('addAhsRealisasi');
	Route::get('/{id_proyek}/AhsRealisasi/edit/{id}', [AhsRealisasiController::class, 'viewEditAhsRealisasi'])->name('viewEditAhsRealisasi');
	Route::post('/{id_proyek}/AhsRealisasi/edit/sub/{id}', [AhsRealisasiController::class, 'editAhsRealisasi'])->name('editAhsRealisasi');
	Route::get('/{id_proyek}/AhsRealisasi/delete/{id}', [AhsRealisasiController::class, 'deleteAhsRealisasi'])->name('deleteAhsRealisasi');
	Route::get('/{id_proyek}/AhsRealisasi/deleteAll', [AhsRealisasiController::class, 'deleteAllAhsRealisasi'])->name('deleteAllAhsRealisasi');
    Route::get('/{id_proyek}/AhsRealisasi/{filter}/{search}', [AhsRealisasiController::class, 'viewAhsRealisasiFilter'])->name('viewAhsRealisasiFilter');



	Route::get('/{id_proyek}/rab', [RabController::class, 'viewRab'])->name('viewRab');
	Route::get('/{id_proyek}/rab/add', [RabController::class, 'viewAddRab'])->name('viewAddRab');
	Route::post('/{id_proyek}/rab/add/sub', [RabController::class, 'addRab'])->name('addRab');
    Route::get('/{id_proyek}/rab/add/filter', [RabController::class, 'viewAddFilterRab'])->name('addFilterRab');
    Route::post('/{id_proyek}/rab/add/filter/detail', [RabController::class, 'viewAddFilterDetailRab'])->name('viewAddFilterDetailRab');
    Route::post('/{id_proyek}/add/rab/create/{jenis_pekerjaan}/{lantai}sub', [RabController::class, 'createRab'])->name('createRab');
	Route::get('/{id_proyek}/rab/edit/{id}', [RabController::class, 'viewEditRab'])->name('viewEditRab');
	Route::post('/{id_proyek}/rab/edit/sub/{id}', [RabController::class, 'editRab'])->name('editRab');
	Route::get('/{id_proyek}/rab/delete/{id}', [RabController::class, 'deleteRab'])->name('deleteRab');
	Route::get('/{id_proyek}/rab/deleteAllRab', [RabController::class, 'deleteAllRab'])->name('deleteAllRab');
	Route::post('/{id_proyek}/rab/importExcel', [RabController::class, 'importExcelRab'])->name('importExcelRab');
	Route::get('/{id_proyek}/rab/exportExcel', [RabController::class, 'exportExcelRab'])->name('exportExcelRab');
    Route::get('/{id_proyek}/rab/{filter}/{search}', [RabController::class, 'viewRabFilter'])->name('viewRabFilter');
	Route::get('/{id_proyek}/rab/import/from/ahs_data/', [RabController::class, 'import_from_ahs_data'])->name('import_from_ahs_data');



	Route::get('/{id_proyek}/preview-rab', [PageController::class, 'view_preview_rab'])->name('view_preview_rab');
	Route::post('/{id_proyek}/ppn', [PpnController::class, 'insert_ppn'])->name('insert_ppn');
	Route::get('/{id_proyek}/preview-rekap', [PageController::class, 'viewPreviewRekap'])->name('viewPreviewRekap');
	Route::post('/{id_proyek}/laporan-preview-rab', [PageController::class, 'viewPreviewRabMenu'])->name('viewPreviewRabMenu');



    Route::get('/{id_proyek}/semua_ahs_pekerjaan', [PageController::class, 'viewAhsPekerjaan'])->name('viewAhsPekerjaan');
    Route::post('/{id_proyek}/semua_ahs_pekerjaan/filter', [PageController::class, 'viewAhsPekerjaanFilter'])->name('viewAhsPekerjaanFilter');
    Route::post('/{id_proyek}/semua_ahs_pekerjaan/filter/preview/{nama_pekerjaan}/{lantai}', [PageController::class, 'viewAhsPekerjaanFilterPreview'])->name('viewAhsPekerjaanFilterPreview');
    Route::get('/{id_proyek}/semua_ahs_pekerjaan/cetakSemuaAhsPekerjaan', [PageController::class, 'cetakSemuaAhsPekerjaan'])->name('cetakSemuaAhsPekerjaan');
    Route::get('/{id_proyek}/semua_ahs_pekerjaan/cetakFilterAhsPekerjaan/Filter/{nama_pekerjaan}/{lantai_data}', [PageController::class, 'cetakFilterAhsPekerjaan'])->name('cetakFilterAhsPekerjaan');
    Route::get('/{id_proyek}/semua_ahs_pekerjaan/cetakFilterFullAhsPekerjaan/Filter/{nama_pekerjaan}/{lantai_data}/{kode}', [PageController::class, 'cetakFilterFullAhsPekerjaan'])->name('cetakFilterFullAhsPekerjaan');



    Route::get('/{id_proyek}/RabRealisasi', [PageController::class, 'ViewRabRealisasi'])->name('ViewRabRealisasi');
    Route::post('/{id_proyek}/RabRealisasi/add', [PageController::class, 'addRabRealisasi'])->name('addRabRealisasi');
    Route::get('/{id_proyek}/RabRealisasi/delete/{id}', [PageController::class, 'deleteRabRealisasi'])->name('deleteRabRealisasi');
    Route::get('/{id_proyek}/RabRealisasi/edit/{id}', [PageController::class, 'viewEditRabRealisasi'])->name('viewEditRabRealisasi');
    Route::post('/{id_proyek}/RabRealisasi/edit/{id}', [PageController::class, 'editRabRealisasi'])->name('editRabRealisasi');


	Route::get('/input_material', [InputMaterialController::class, 'viewinputmaterial'])->name('viewinputmaterial');
	Route::get('/input_material/filter/{from?}/{to?}/{kode?}', [InputMaterialController::class, 'viewfilterinputmaterial'])->name('viewfilterinputmaterial');
	Route::post('/input_material', [InputMaterialController::class, 'inputmaterial'])->name('inputmaterial');
	Route::post('/edit_material/{id}', [InputMaterialController::class, 'editmaterial'])->name('editmaterial');
	Route::get('/delete_material/{id}', [InputMaterialController::class, 'deletematerial'])->name('deletematerial');
	Route::get('/exportexcelmaterial', [InputMaterialController::class, 'exportexcelmaterial'])->name('exportexcelmaterial');
	Route::get('/viewaddmaterial', [InputMaterialController::class, 'viewaddmaterial'])->name('viewaddmaterial');
	Route::get('/CetakMaterial/{from?}/{to?}/{kode?}', [InputMaterialController::class, 'cetakmaterial'])->name('cetakmaterial');
	
});
