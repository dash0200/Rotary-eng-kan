<?php

use App\Http\Controllers\BuildingFundController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataDump;
use App\Http\Controllers\FeesDetailsController;
use App\Http\Controllers\GeneralReceiptController;
use App\Http\Controllers\MastersController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard',[Controller::class, 'dashboard'])->name('dashboard');
});

Route::controller(MastersController::class)->prefix('master')->name('master.')->group(function(){
    //Fees Heads
    Route::view('fees-heads', 'pages.masters.fees-heads')->name('feesHeads');
    Route::post('save-fees-desc', 'saveFeesDesc')->name('saveFeesDesc');
    Route::get('get-fees-desc', 'getFeesDesc')->name('getFeesDesc');
    Route::put('updatefee', 'updateFee')->name('updateFee');

    //Fees Details
    Route::get('fees-details', 'feesDetails')->name('feesDetails');
    Route::post('saveDetails', 'saveDetails')->name('saveDetails');
    Route::get('getDetails', 'getDetails')->name('getDetails');

    //Cast Details
    Route::get('cast-details', 'castDetails')->name('castDetails');
    Route::post('cast-save', 'saveCategory')->name('saveCategory');
    Route::get('get-cats', 'getCategories')->name('getCategories');
    Route::put('update-cats', 'updateCat')->name('updateCat');
    Route::post('save-caste', 'saveCaste')->name('saveCaste');
    Route::get('search-caste', 'searchCast')->name('searchCast');
    Route::get('search-cat', 'searchCat')->name('searchCat');
    Route::post('save-subcat', 'subCast')->name('subCast');
    Route::get('search-subcat', 'searchSubcast')->name('searchSubcast');

    //states
    Route::get("state-dist-tal", "states")->name("states");
    Route::post("state-add", "addState")->name("addState");
    Route::post("dist-add", "addDist")->name("addDist");
    Route::post("sub-add", "addSub")->name("addSub");
});


Route::controller(TransactionController::class)->prefix('transaction')->name('trans.')->group(function(){
    Route::get('new-admission', 'newAdmission')->name('newAdmission');
    Route::get('get-district', 'getDistrict')->name('getDistrict');
    Route::get('get-taluk', 'getTaluk')->name('getTaluk');
    Route::get('get-category', 'getCat')->name('getCat');

    Route::get('get-student-for-edit', 'getStdforEdit')->name('getStdforEdit');
    
    Route::get('creating-classes', 'creatingClasses')->name('creatingClasses');
    Route::get('get-curyear', 'getCurrentClass')->name('getCurrentClass');
    Route::post('get-creat-class', 'createClass')->name('createClass');

    Route::get('leaving-certificate', 'leavingCertificate')->name('leavingCertificate');
    Route::post('save-lc', 'saveLc')->name('saveLc');
    Route::get('search-lc', 'searchLC')->name('searchLC');
    Route::get('print-lc', 'printLC')->name('printLC');
    Route::post('print-duplicate-lc', 'printDuplicateLC')->name('printDuplicateLC');
    Route::get('get-studdent', 'getStuddent')->name('getStuddent');
    Route::get('getStdId', 'getStdId')->name('getStdId');
    Route::get('getLC', 'getLC')->name('getLC');
    Route::get('editLC', 'editLC')->name('editLC');
    Route::post('updateLc', 'updateLc')->name('updateLc');


    Route::get('transaction-get-student-id', 'getStudentId')->name('getStudentId');
    Route::post('save-student-adm', 'saveAdmission')->name('saveAdmission');
    Route::get('edit-page', 'editPage')->name('editPage');
    Route::get('get-by-id', 'getByID')->name('getByID');
    Route::get('get-by-sts', 'getBysts')->name('getBysts');
    Route::get('get-by-name', 'getByName')->name('getByName');
    Route::get('get-by-info', 'getByInfo')->name('getByInfo');
    Route::post('edit-student', 'editStudent')->name('editStudent');

});


Route::controller(FeesDetailsController::class)->prefix('fees-details')->name('fees.')->group(function(){
    Route::get('fees-receipts', 'feesReceipts')->name('feesReceipts');
    Route::post('fees-paying', 'feePaying')->name("savePaidFees");

    Route::get('receipt-cancellation', 'receiptCancellation')->name('receiptCancellation');

    Route::get('fees-arrears', 'feesArrears')->name('feesArrears');
    Route::post('fees-submit', 'submitFeesArrears')->name('submitFeesArrears');

    Route::get('day-book', 'dayBook')->name('dayBook');
    Route::get('day-book-submit', 'daybookSubmit')->name('daybookSubmit');


    Route::get('fees-register', 'feesRegister')->name('feesRegister');
    Route::post('fees-register-pdf', 'pdfFeesRegister')->name('pdfFeesRegister');


    Route::get('receipt-datewise', 'receiptDatewise')->name('receiptDatewise');
    Route::post('receipt-datewise-today', 'receiptToday')->name('receiptToday');
    Route::post('receipt-between-dates', 'receiptBetweenDates')->name('receiptBetweenDates');

    Route::get('duplicate-receipt', 'duplicateReceipt')->name('duplicateReceipt');
    Route::post('duplicate-receipt-id', 'stdReceiptID')->name('stdReceiptID');
    Route::get('duplicate-receipt-get', 'getDuplicate')->name('getDuplicate');
});

Route::controller(ReportsController::class)->prefix('report')->name('report.')->group(function(){
    Route::get('cast-details', 'castDetails')->name('castDetails');
    Route::post('cast-details-cats', 'catAssocCast')->name('catAssocCast');


    Route::get('fees-structure', 'feesStructure')->name('feesStructure');

    Route::get('general-register', 'generalRegister')->name('generalRegister');

    Route::get('class-details', 'classDetails')->name('classDetails');
    Route::post('details', 'detailsClass')->name('detailsClass');
});

Route::controller(CertificateController::class)->prefix('certificate')->name('certificate.')->group(function(){
    Route::get('certificate', 'certificate')->name('certificate');

    Route::post('study-certificate', 'studyCertificate')->name('study');
    Route::post('save-study-certificate', 'saveStudyCertificate')->name('saveStudy');
    Route::get('pdf-study-certificate', 'pdfStudyCertificate')->name('studyPDF');
    Route::get('pdf-study-certificate2', 'pdfStudyCertificate2')->name('studyPDF2');

    Route::post('bonafied-certificate', 'bonafiedCertificate')->name('bonafied');
    Route::post('save-bonafied-certificate', 'saveBonafied')->name('saveBonafied');
    Route::get('pdf-bonafied-certificate', 'pdfBonafied')->name('pdfBonafied');

    Route::post('caste-certificate', 'casteCertificate')->name('caste');
    Route::post('save-caste', 'saveCaste')->name('saveCaste');
    Route::get('pdf-caste', 'castePDF')->name('castePDF');
    
    Route::post('character-certificate', 'characterCertificate')->name('character');
    Route::post('save-character-certificate', 'saveCharacterCertificate')->name('saveCharacterCertificate');
    Route::get('pdf-character-certificate', 'pdfCHaracter')->name('pdfCHaracter');

    Route::post('certificate-certificate', 'certificateCertificate')->name('certify');
    Route::post('save-certificate', 'saveCertificate')->name('saveCertify');
    Route::get('pdf-certificate', 'pdfCertify')->name('pdfCertify');
});

Route::controller(BuildingFundController::class)->prefix('building-fund')->name('building.')->group(function(){
    Route::get('receipt', 'receipt')->name('receipt');
    Route::get('duplicate-receipt', 'duplicateReceipt')->name('duplicateReceipt');
    Route::get('daily-report', 'dailyReport')->name('dailyReport');
    Route::get('report', 'report')->name('report');
    Route::get('receipt-deletion', 'receiptDeletion')->name('receiptDeletion');
});

Route::controller(GeneralReceiptController::class)->prefix('general-receipts')->name('general.')->group(function(){
    Route::get('general-receipts', 'generalReceipts')->name('generalReceipts');
    Route::post('receipts', 'receipt')->name('receipt');
    
    Route::get('singleRece', 'singleRece')->name('singleRece');
    
    Route::get('day-book', 'dayBook')->name('dayBook');
    Route::post('get-receipts', 'getReceipt')->name('getReceipt');

    Route::get('datewise', 'datewise')->name('datewise');
    Route::post('datewise-get-receipt', 'datewiseGetReceipt')->name('datewiseGetReceipt');
});

Route::get("/state", [Controller::class, "state"])->name("state");
Route::get("/dist", [Controller::class, "district"])->name("dist");
Route::get("/subDist", [Controller::class, "subDist"])->name("subDist");
Route::get("/acaYear", [Controller::class, "acaYear"])->name("acaYear");
Route::get("/class", [Controller::class, "classes"])->name("class");

Route::get("/get-student-id", [Controller::class, "getStdId"])->name("getStdId");
Route::get("/get-student", [Controller::class, "getStuddent"])->name("getstudent");
Route::get("/get-admstudent", [Controller::class, "getAdmStd"])->name("getAdmStd");
Route::get("/get-autoAddclass", [TransactionController::class, "autoAddclass"])->name("autoAddclass");

Route::controller(DataDump::class)->group(function(){
    Route::get("cat", "categories")->name("addCats");
    Route::get("cast", "addRespectiveCasteToCategory")->name("addCaste");
    Route::get("fee-head", "feeHead")->name("feeHead");
});
Route::get('check/reg', [Controller::class, 'checkReg'])->name('checkReg');