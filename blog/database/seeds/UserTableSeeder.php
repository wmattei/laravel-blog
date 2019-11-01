<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'Admin',
            'is_admin' => true,
            'email' => 'admin@admin.com',
            'password' => '123456',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
