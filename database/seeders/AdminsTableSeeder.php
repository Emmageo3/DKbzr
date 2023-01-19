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
            ['id'=>1, 'name'=>'Emma Geo Kanfany', 'type'=>'superadmin', 'vendor_id'=>0, 'mobile'=>"+221771166073",
            'email'=>'kanfanyemma22@gmail.com', 'password'=>'$2y$10$pHlFYYh3HXNgkWgpEN8NMejFJfZzZ.V23w3tJCmmNjk0f3hO59eIe', 'image'=>'', 'status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
