<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();
        
        $admin = User::create([
            'name' => 'Admin_Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);
        
        $author = User::create([
            'name' => 'Author_Author',
            'email' => 'author@author.com',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'name' => 'User_User',
            'email' => 'user@user.com',
            'password' => Hash::make('password')
        ]);

        $admin->role()->attach($adminRole);
        $author->role()->attach($authorRole);
        $user->role()->attach($userRole);
    }
}
