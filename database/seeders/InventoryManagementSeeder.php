<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareType;
use App\Models\Hardware\HardwareModel;
use App\Models\Software\Software;
use App\Models\Software\SoftwareType;
use App\Models\Material\Material;
use App\Models\Material\MaterialType;
use App\Models\CommonItem\CommonItem;
use App\Models\CommonItem\CommonItemType;
use App\Models\User\Department;
use App\Models\User\User;
use App\Models\Admin\Admin;
use App\Models\Transaction\TransactionType;

class InventoryManagementSeeder extends Seeder
{
    public function run()
    {
        Admin::insert([
            ['name'=>'Taha Yerlikaya','user_name'=>'admin','password'=>'admin','email'=>'taha.yerlikaya@gruparge.com','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mehmet Portuz','user_name'=>'mp','password'=>'M1234567','email'=>'mehmet.portuz@gruparge.com','created_at'=>now(),'updated_at'=>now()]
        ]);
        Department::insert([
            ['name' => 'Yazılım','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Ar-Ge','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Satış Destek','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Sevkiyat','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Muhasebe','created_at'=> now(),'updated_at'=> now()],
        ]);
        User::insert([
            ['name'=>'Taha Yerlikaya','department_id'=>'1','email'=>'tahayerlikaya@gruparge.com','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'Baha Yerlikaya','department_id'=>'1','email'=>'bahayerlikaya@gruparge.com','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'Bedirhan Yerlikaya','department_id'=>'2','email'=>'bedirhanyerlikaya@gruparge.com','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'Ertegün Fidan','department_id'=>'2','email'=>'ertegunfidan@gruparge.com','created_at'=> now(),'updated_at'=> now()],
        ]);
        HardwareType::insert([
            ['name' => 'Bilgisayar','prefix'=>'C','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Laptop','prefix'=>'L','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Dolap','prefix'=>'D','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Masa','prefix'=>'M','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Sandalye','prefix'=>'S','created_at'=> now(),'updated_at'=> now()],
        ]);
        HardwareModel::insert([
            ['name' => 'Acer','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Dell','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'HP','created_at'=> now(),'updated_at'=> now()],
        ]);
        Hardware::insert([
            ['barcode_number' => 'C1','serial_number'=>'SN:01','type_id'=>'1','model_id'=>'1','detail'=>'Bilgisayar 01','created_at'=> now(),'updated_at'=> now()],
            ['barcode_number' => 'C2','serial_number'=>'SN:02','type_id'=>'1','model_id'=>'1','detail'=>'Bilgisayar 02','created_at'=> now(),'updated_at'=> now()],
            ['barcode_number' => 'M1','serial_number'=>'SN:03','type_id'=>'4','model_id'=>'2','detail'=>'Masa 01','created_at'=> now(),'updated_at'=> now()],
            ['barcode_number' => 'M2','serial_number'=>'SN:04','type_id'=>'4','model_id'=>'3','detail'=>'Masa 02','created_at'=> now(),'updated_at'=> now()],
            ['barcode_number' => 'L1','serial_number'=>'SN:05','type_id'=>'2','model_id'=>'2','detail'=>'Laptop 01','created_at'=> now(),'updated_at'=> now()],
        ]);
        SoftwareType::insert([
            ['name'=>'Süreli','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Süresiz','created_at'=>now(),'updated_at'=>now()],
        ]);
        Software::insert([
            ['type_id'=>'1','name'=>'Windows','license_time'=>2,'start_time'=> now(),'finish_time'=>date('Y-m-d H:i:s',strtotime("+2 year")) ],
            ['type_id'=>'1','name'=>'Visual Studio','license_time'=>10,'start_time'=> now(),'finish_time'=>date('Y-m-d H:i:s',strtotime("+10 year")) ],
            ['type_id'=>'2','name'=>'Office','license_time'=>NULL,'start_time'=> now(),'finish_time'=>date('Y-m-d H:i:s',strtotime("+10 year")) ],
            ['type_id'=>'2','name'=>'Php','license_time'=>NULL,'start_time'=> now(),'finish_time'=>date('Y-m-d H:i:s',strtotime("+3 year"))],
            ['type_id'=>'1','name'=>'Unity3D','license_time'=>1,'start_time'=> now(),'finish_time'=>date('Y-m-d H:i:s',strtotime("+1 year")) ],
        ]);
        MaterialType::insert([
            ['name' => 'Terlik','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Maktap Ucu','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Önlük','created_at'=> now(),'updated_at'=> now()],
        ]);
        Material::insert([
            ['name' => 'Deneme 01', 'type_id' => '1','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Deneme 02', 'type_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Deneme 03', 'type_id' => '1','created_at'=> now(),'updated_at'=> now()],
        ]);
        CommonItemType::insert([
            ['name' => 'Kamera','created_at'=> now(),'updated_at'=> now()],
            ['name' => '3D Printer','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Yazıcı','created_at'=> now(),'updated_at'=> now()],
        ]);
        CommonItem::insert([
            ['name' => 'Deneme 01', 'type_id' => '1','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Deneme 02', 'type_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Deneme 03', 'type_id' => '1','created_at'=> now(),'updated_at'=> now()],
        ]);
        TransactionType::insert([
            ['name' => 'Donanım Atama','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Donanım İade','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Yazılım Atama','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Yazılım İade','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Malzeme Atama','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Malzeme İade','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Ortak Kullanım Atama','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Ortak Kullanım İade','created_at'=> now(),'updated_at'=> now()]
        ]);
    }
}
