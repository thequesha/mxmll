<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = 'admin@example.com';
        $password = 'password';

        /** @var User|null $user */
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->name = 'Администратор';
            $user->password = Hash::make($password);
            $user->save();
        } else {
            User::create([
                'name' => 'Администратор',
                'email' => $email,
                'password' => Hash::make($password),
            ]);
        }
    }
}
