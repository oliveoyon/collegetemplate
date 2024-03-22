<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admins = [
            'admin_hash_id' => md5(uniqid(rand(), true)),
            'school_id' => 100, // Adjust this value based on your needs
            'name' => 'Admin User',
            'email' => 'admin@email.com', // Change this email address
            'password' => Hash::make(1234), // Change this password
            'verify' => 1, // Set to 1 if you want to mark the email as verified
            'remember_token' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'pin' => 102, // Adjust this if needed
            'user_status' => 1, // Set to 1 if you want to mark the user as active
        ];

        DB::table('admins')->insert($admins);

        DB::table('web_settings')->insert([
            'school_title' => 'Your School Title',
            'logo' => 'logo.png',
            'phone1' => '1234567890',
            'phone2' => null,
            'fax' => null,
            'email' => 'school@example.com',
            'address_one' => '123 Street, City',
            'address_two' => null,
            'eiin' => null,
            'facebook' => null,
            'twitter' => null,
            'linkedin' => null,
            'instagram' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('histories')->insert([
            'history' => 'Your history description goes here',
            'dept_id' => 0, // Assuming default value is 0
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('event_types')->insert([
            'type_name' => 'Academic',
            'color' => '#ebebeb', // Example color value
            'status' => 1, // Example status value
            'dept_id' => 0, // Assuming default value is 0
            'school_id' => 1, // Example school ID value
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }





}
