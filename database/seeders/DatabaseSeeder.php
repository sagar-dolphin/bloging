<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Category::factory(100)->create();

        // $permissions = array('add-post', 'edit-post', 'update-post', 'delete-post', 'add-category', 'edit-category', 'update-category', 'delete-category', 'add-comment', 'delete-comment', 'add-subscriber', 'remove-subscriber');

        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123'),
        ]);

        // DB::table('roles')->insert([
        //     'name' => 'user',
        //     'guard_name' => 'web'
        // ]);
        
        // DB::table('roles')->insert([
        //     'name' => 'admin',
        //     'guard_name' => 'admin'
        // ]);

        // foreach($permissions as $permission)
        // {
        //     DB::table('permissions')->insert([
        //         'name' => $permission,
        //         'guard_name' => 'web'
        //     ]);
        // }  
    }
}
