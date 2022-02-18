<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $permissions = array('add-post', 'edit-post', 'update-post', 'delete-post', 'add-category', 'edit-category', 'update-category', 'delete-category', 'add-comment', 'delete-comment', 'add-subscriber', 'remove-subscriber');
        $roles = array('user', 'admin');

        foreach($roles as $role)
        {
            DB::table('roles')->insert([
                'name' => $role,
                'guard_name' => 'web'
            ]);
        }

        foreach($permissions as $permission)
        {
            DB::table('permissions')->insert([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }
       
    }
}
