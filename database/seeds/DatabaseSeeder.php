<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $email = env('ADMIN_EMAIL', 'example@example.com');
        $password = env('ADMIN_PASSWORD', '12345678');
        if(!User::where('email', $email)->first())
        {
            User::create([
                'name' => 'admin',
                'email' => $email,
                'password' => Hash::make($email),
                'is_admin' => true,
                'email_verified_at' => now()
            ]);
        }
        // $this->call(UsersTableSeeder::class);
    }
}
