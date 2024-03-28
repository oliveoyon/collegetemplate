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
            'dept_id' => 0, // Adjust this value based on your needs
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faculties')->insert([
            [
                'faculty_hash_id' => 'FAC001',
                'faculty_name' => 'Faculty of Engineering',
                'faculty_slug' => 'engineering',
                'faculty_status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'faculty_hash_id' => 'FAC002',
                'faculty_name' => 'Faculty of Medicine',
                'faculty_slug' => 'medicine',
                'faculty_status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed departments table
        DB::table('departments')->insert([
            [
                'department_hash_id' => 'DEP001',
                'faculty_id' => 1, // Engineering
                'department_name' => 'Department of Computer Science',
                'department_slug' => 'computer-science',
                'department_status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_hash_id' => 'DEP002',
                'faculty_id' => 1, // Engineering
                'department_name' => 'Department of Electrical Engineering',
                'department_slug' => 'electrical-engineering',
                'department_status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_hash_id' => 'DEP003',
                'faculty_id' => 1, // Engineering
                'department_name' => 'Department of Mechanical Engineering',
                'department_slug' => 'mechanical-engineering',
                'department_status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_hash_id' => 'DEP004',
                'faculty_id' => 2, // Medicine
                'department_name' => 'Department of Surgery',
                'department_slug' => 'surgery',
                'department_status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_hash_id' => 'DEP005',
                'faculty_id' => 2, // Medicine
                'department_name' => 'Department of Pediatrics',
                'department_slug' => 'pediatrics',
                'department_status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_hash_id' => 'DEP006',
                'faculty_id' => 2, // Medicine
                'department_name' => 'Department of Obstetrics and Gynecology',
                'department_slug' => 'obstetrics-gynecology',
                'department_status' => 1, // Active
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }





}
