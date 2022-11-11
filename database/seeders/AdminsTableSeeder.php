<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id'=>1,'name'=>'Super Admin','type'=>'superadmin','vendor_id'=>0,'image'=>'','password'=>'$2a$12$pQ1DWzbXygiuW2SR0fq.jOqXAA9kxWMzNgQyi4274ga0.Qro4Czmm','mobile'=>'9800000000','email'=>'admin@admin.com','status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
