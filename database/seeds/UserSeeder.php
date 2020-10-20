<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'sociedade' => ['administrador', 'gerente', 'funcionario'],
        ]);
    }
}
