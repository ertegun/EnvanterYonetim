<?php

use Illuminate\Support\Facades\Route;
//Kullanıcı Kontrolleri ve Ara Katmanları
use App\Http\Controllers\UserController;
use App\Http\Middleware\User\UserUpdate;
use App\Http\Middleware\User\UserCreate;
use App\Http\Middleware\User\UserDelete;
use App\Http\Middleware\User\UserTransaction;
//Sahiplik Kontrolleri ve Ara Katmanları
use App\Http\Controllers\OwnerController;
use App\Http\Middleware\Owner\OwnerView;
use App\Http\Middleware\Owner\OwnerCreate;
use App\Http\Middleware\Owner\OwnerDelete;
use App\Http\Middleware\Owner\OwnerDeleteView;
use App\Http\Middleware\Owner\OwnerSoftCreate;
use App\Http\Middleware\Owner\OwnerSoftDelete;
use App\Http\Middleware\Owner\OwnerSoftDeleteView;
use App\Http\Middleware\Owner\HardwareDrop;
use App\Http\Middleware\Owner\SoftwareDrop;
use App\Http\Middleware\Owner\CommonDrop;
use App\Http\Middleware\Owner\MaterialDrop;
//Birim Kontrolleri ve Ara Katmanları
use App\Http\Controllers\DepartmentController;
use App\Http\Middleware\Department\DepartmentView;
use App\Http\Middleware\Department\DepartmentUpdate;
use App\Http\Middleware\Department\DepartmentCreate;
use App\Http\Middleware\Department\DepartmentDeleteView;
use App\Http\Middleware\Department\DepartmentDelete;
//Donanım Kontrolleri ve Ara Katmanları
    use App\Http\Controllers\HardwareController;
    use App\Http\Middleware\Hardware\HardwareUpdate;
    use App\Http\Middleware\Hardware\HardwareCreate;
    use App\Http\Middleware\Hardware\HardwareDelete;
    use App\Http\Middleware\Hardware\HardwareTypeUpdate;
    use App\Http\Middleware\Hardware\HardwareTypeCreate;
    use App\Http\Middleware\Hardware\HardwareTypeDelete;
    use App\Http\Middleware\Hardware\HardwareModelUpdate;
    use App\Http\Middleware\Hardware\HardwareModelCreate;
    use App\Http\Middleware\Hardware\HardwareModelDelete;
//Yazılım Kontrolleri ve Ara Katmanları
    use App\Http\Controllers\SoftwareController;
    use App\Http\Middleware\Software\SoftwareCreate;
    use App\Http\Middleware\Software\SoftwareUpdate;
    use App\Http\Middleware\Software\SoftwareDelete;
    use App\Http\Middleware\Software\SoftwareTypeCreate;
    use App\Http\Middleware\Software\SoftwareTypeUpdate;
    use App\Http\Middleware\Software\SoftwareTypeDelete;
//Ortak Kullanım Kontrolleri ve Ara Katmanları
    use App\Http\Controllers\CommonItemController;
    use App\Http\Middleware\CommonItem\CommonItemCreate;
    use App\Http\Middleware\CommonItem\CommonItemUpdate;
    use App\Http\Middleware\CommonItem\CommonItemDelete;
    use App\Http\Middleware\CommonItem\CommonItemTypeCreate;
    use App\Http\Middleware\CommonItem\CommonItemTypeUpdate;
    use App\Http\Middleware\CommonItem\CommonItemTypeDelete;
//Malzeme Kontrolleri ve Ara Katmanları
    use App\Http\Controllers\MaterialController;
    use App\Http\Middleware\Material\MaterialCreate;
    use App\Http\Middleware\Material\MaterialUpdate;
    use App\Http\Middleware\Material\MaterialDelete;
    use App\Http\Middleware\Material\MaterialTypeCreate;
    use App\Http\Middleware\Material\MaterialTypeUpdate;
    use App\Http\Middleware\Material\MaterialTypeDelete;
//Genel Kontroller(Giriş/Çıkış/Ana Sayfa)
    use App\Http\Controllers\MainController;
    use App\Http\Middleware\LoginControl;
    use App\Http\Middleware\UserControl;

//Giriş
Route::get('/', [MainController::class, "login"])->name("login");
//Giriş Onay
Route::post('/giris', [MainController::class, "login_result"])->middleware([UserControl::class])->name("login_result");

//Çıkış
Route::get('/cikis', [MainController::class, "logout"])->name("logout");

Route::middleware([LoginControl::class])->group(function(){

    //AnaSayfa
        Route::get('/anasayfa', [MainController::class, "homepage"])->name("homepage");
        Route::post('/anasayfa/homepage_widgets', [MainController::class, "homepage_widgets"])->name('homepage_widgets');
        Route::post('/anasayfa/homepage_currentMonthTransaction', [MainController::class, "homepage_currentMonthTransaction"])->name('homepage_currentMonthTransaction');
        Route::post('/anasayfa/homepage_FiveMonthMaterial', [MainController::class, "homepage_FiveMonthMaterial"])->name('homepage_FiveMonthMaterial');
        Route::post('/anasayfa/homepage_lastFiveUser', [MainController::class, "homepage_lastFiveUser"])->name('homepage_lastFiveUser');
        Route::post('/anasayfa/homepage_lastFiveTransaction', [MainController::class, "homepage_lastFiveTransaction"])->name('homepage_lastFiveTransaction');

    //İşlem Geçmişi
    Route::get('/islemgecmisi', [MainController::class, "transaction"])->name("transaction");
    Route::post('/islemgecmisi/ajax', [MainController::class, "transaction_ajax"])->name("transaction_ajax");

    //KULLANICI
        //Kullanıcı CRUD
        Route::get('/kullanici', [UserController::class, "user"])->name("user");
        Route::get('/kullanici/ekle', [UserController::class, "user_create"])->name("user_create");
        Route::post('/kullanici/ekle/sonuc', [UserController::class, "user_create_result"])->middleware(UserCreate::class)->name("user_create_result");
        Route::post('/kullanici/duzenle', [UserController::class, "user_update"])->middleware(UserUpdate::class)->name("user_update");
        Route::post('/kullanici/sil', [UserController::class, "user_delete"])->middleware(UserDelete::class)->name("user_delete");
        //Kullanıcı İşlem Geçmişi
        Route::get('/kullanici/islemler/{id}',[UserController::class,'user_transaction'])->middleware(UserTransaction::class)->name('user_transaction');
        //Kullanıcı Ajax Sorguları
        Route::post('/kullanici/ajax',[UserController::class, 'user_table_ajax'])->name('user_table_ajax');

    //DEPARTMAN
        Route::get('/kullanici/departman', [UserController::class, "department"])->name("department");
        Route::post('/kullanici/departman/ekle', [UserController::class, "department_create"])->middleware(DepartmentCreate::class)->name("department_create");
        Route::post('/kullanici/departman/duzenle', [UserController::class, "department_update"])->middleware(DepartmentUpdate::class)->name("department_update");
        Route::post('/kullanici/departman/sil', [UserController::class, "department_delete"])->middleware(DepartmentDelete::class)->name("department_delete");

    //ZİMMET
    //Zimmet CRUD
    Route::get('/zimmet/{id}', [OwnerController::class, "owner"])->middleware(OwnerView::class)->name("owner");
    Route::post('/zimmet/donanim/sil', [OwnerController::class, "hardware_drop"])->middleware(HardwareDrop::class)->name("hardware_drop");
    Route::post('/zimmet/yazilim/sil', [OwnerController::class, "software_drop"])->middleware(SoftwareDrop::class)->name("software_drop");
    Route::post('/zimmet/ortak_kullanim/sil', [OwnerController::class, "common_drop"])->middleware(CommonDrop::class)->name("common_drop");
    Route::post('/zimmet/malzeme/sil', [OwnerController::class, "material_drop"])->middleware(MaterialDrop::class)->name("material_drop");

    Route::get('/zimmet/yeni/{id}', [OwnerController::class, "owner_create"])->name("owner_create");
    Route::post('/zimmet/yeni/sonuc', [OwnerController::class, "owner_create_result"])->middleware(OwnerCreate::class)->name("owner_create_result");
    Route::post('/zimmet/yazilim/yeni', [OwnerController::class, "owner_create_software_result"])->middleware(OwnerSoftCreate::class)->name("owner_create_software");
    //Zimmet PDF
    Route::get('zimmet/pdf/{id}',[OwnerController::class,"owner_pdf"])->name('owner_pdf');
    //Zimmet Ajax Sorguları
    Route::post('zimmet/donanim/ajax',[OwnerController::class,'owner_hardware_table_ajax'])->name('owner_hardware_table_ajax');
    Route::post('zimmet/yazilim/ajax',[OwnerController::class,'owner_software_table_ajax'])->name('owner_software_table_ajax');
    Route::post('zimmet/ortak_kullanim/ajax',[OwnerController::class,'owner_common_table_ajax'])->name('owner_common_table_ajax');
    Route::post('zimmet/malzeme/ajax',[OwnerController::class,'owner_material_table_ajax'])->name('owner_material_table_ajax');
    Route::post('zimmet/yeni/donanim_secim/ajax',[OwnerController::class,'get_useable_hardware'])->name('get_useable_hardware');
    Route::post('zimmet/yeni/donanim',[OwnerController::class,'hardware_create_ajax'])->name('hardware_create_ajax');
    //DONANIM
        //Donanım CRUD
        Route::get('/donanim', [HardwareController::class, "hardware"])->name("hardware");
        Route::post('/donanim/ekle', [HardwareController::class, "hardware_create"])->middleware(HardwareCreate::class)->name("hardware_create");
        Route::post('/donanim/duzenle', [HardwareController::class, "hardware_update"])->middleware(HardwareUpdate::class)->name("hardware_update");
        Route::post('/donanim/sil', [HardwareController::class, "hardware_delete"])->middleware(HardwareDelete::class)->name("hardware_delete");

        //Donanım Tipleri CRUD
        Route::get('/donanim/tipler',[HardwareController::class,'hardware_type'])->name('hardware_type');
        Route::post('/donanim/tipler/ekle',[HardwareController::class,'hardware_type_create'])->middleware(HardwareTypeCreate::class)->name('hardware_type_create');
        Route::post('/donanim/tipler/duzenle',[HardwareController::class,'hardware_type_update'])->middleware(HardwareTypeUpdate::class)->name('hardware_type_update');
        Route::post('/donanim/tipler/sil',[HardwareController::class,'hardware_type_delete'])->middleware(HardwareTypeDelete::class)->name('hardware_type_delete');

        //Donanım Modelleri CRUD
        Route::get('/donanim/modeller',[HardwareController::class,'hardware_model'])->name('hardware_model');
        Route::post('/donanim/modeller/ekle',[HardwareController::class,'hardware_model_create'])->middleware(HardwareModelCreate::class)->name('hardware_model_create');
        Route::post('/donanim/modeller/duzenle',[HardwareController::class,'hardware_model_update'])->middleware(HardwareModelUpdate::class)->name('hardware_model_update');
        Route::post('/donanim/modeller/sil',[HardwareController::class,'hardware_model_delete'])->middleware(HardwareModelDelete::class)->name('hardware_model_delete');

        //Donanım Ajax Sorguları
        Route::post('/donanim/ajax/getHardwareElements',[HardwareController::class,'getHardwareElements'])->name('getHardwareElements');
        Route::post('/donanim/ajax/getTable',[HardwareController::class,'hardware_table_ajax'])->name('hardware_table_ajax');
    //YAZILIM
        //Yazılım CRUD
        Route::get('/yazilim', [SoftwareController::class, "software"])->name("software");
        Route::post('/yazilim/ekle', [SoftwareController::class, "software_create"])->middleware(SoftwareCreate::class)->name("software_create");
        Route::post('/yazilim/duzenle', [SoftwareController::class, "software_update"])->middleware(SoftwareUpdate::class)->name("software_update");
        Route::post('/yazilim/sil', [SoftwareController::class, "software_delete"])->middleware(SoftwareDelete::class)->name("software_delete");

        //Yazılım Türleri CRUD
        Route::get('/yazilim/türler', [SoftwareController::class, "software_type"])->name("software_type");
        Route::post('/yazilim/türler/ekle', [SoftwareController::class, "software_type_create"])->middleware(SoftwareTypeCreate::class)->name("software_type_create");
        Route::post('/yazilim/türler/duzenle', [SoftwareController::class, "software_type_update"])->middleware(SoftwareTypeUpdate::class)->name("software_type_update");
        Route::post('/yazilim/türler/sil', [SoftwareController::class, "software_type_delete"])->middleware(SoftwareTypeDelete::class)->name("software_type_delete");

        //Yazılım Ajax Sorguları
        Route::post('/yazilim/ajax/getTable',[SoftwareController::class,'software_table_ajax'])->name('software_table_ajax');
    //ORTAK KULLANIM
        //Ortak Kullanım CRUD
        Route::get('/ortak_kullanim',[CommonItemController::class, 'common_item'])->name('common_item');
        Route::post('/ortak_kullanim/ekle', [CommonItemController::class, "common_item_create"])->middleware(CommonItemCreate::class)->name("common_item_create");
        Route::post('/ortak_kullanim/duzenle', [CommonItemController::class, "common_item_update"])->middleware(CommonItemUpdate::class)->name("common_item_update");
        Route::post('/ortak_kullanim/sil', [CommonItemController::class, "common_item_delete"])->middleware(CommonItemDelete::class)->name("common_item_delete");

        //Ortak Kullanım Türleri CRUD
        Route::get('/ortak_kullanim/türler',[CommonItemController::class, 'common_item_type'])->name('common_item_type');
        Route::post('/ortak_kullanim/türler/ekle', [CommonItemController::class, "common_item_type_create"])->middleware(CommonItemTypeCreate::class)->name("common_item_type_create");
        Route::post('/ortak_kullanim/türler/duzenle', [CommonItemController::class, "common_item_type_update"])->middleware(CommonItemTypeUpdate::class)->name("common_item_type_update");
        Route::post('/ortak_kullanim/türler/sil', [CommonItemController::class, "common_item_type_delete"])->middleware(CommonItemTypeDelete::class)->name("common_item_type_delete");

        //Ortak Kullanım Ajax Sorguları
        Route::post('/ortak_kullanim/ajax/getTable',[CommonItemController::class,'common_item_table_ajax'])->name('common_item_table_ajax');
    //MALZEME
        //Malzeme CRUD
        Route::get('/malzeme',[MaterialController::class, 'material'])->name('material');
        Route::post('/malzeme/ekle', [MaterialController::class, "material_create"])->middleware(MaterialCreate::class)->name("material_create");
        Route::post('/malzeme/duzenle', [MaterialController::class, "material_update"])->middleware(MaterialUpdate::class)->name("material_update");
        Route::post('/malzeme/sil', [MaterialController::class, "material_delete"])->middleware(MaterialDelete::class)->name("material_delete");

        //Malzeme Türleri CRUD
        Route::get('/malzeme/türler',[MaterialController::class, 'material_type'])->name('material_type');
        Route::post('/malzeme/türler/ekle', [MaterialController::class, "material_type_create"])->middleware(MaterialTypeCreate::class)->name("material_type_create");
        Route::post('/malzeme/türler/duzenle', [MaterialController::class, "material_type_update"])->middleware(MaterialTypeUpdate::class)->name("material_type_update");
        Route::post('/malzeme/türler/sil', [MaterialController::class, "material_type_delete"])->middleware(MaterialTypeDelete::class)->name("material_type_delete");

        //Malzeme Ajax Sorguları
        Route::post('/malzeme/ajax/getTable',[MaterialController::class,'material_table_ajax'])->name('material_table_ajax');


});
