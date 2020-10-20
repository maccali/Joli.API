<?php

use App\Models\Costume;
use Illuminate\Database\Seeder;

class CostumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Costume::create([
        'name' => "posts_cadastrar",
        'description' => '123',
      ]);

      Costume::create([
        'name' => "posts_editar",
        'description' => '123',
      ]);

      Costume::create([
        'name' => "posts_ver",
        'description' => '123',
      ]);

      Costume::create([
        'name' => "posts_excluir",
        'description' => '123',
      ]);
    }
}
