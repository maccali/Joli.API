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
    User::create([
      'name' => "Gerente",
      'email' => 'gerente@gmail.com',
      'password' => Hash::make('password'),
      'sociedade' => ['gerente'],
    ]);
  }
}
