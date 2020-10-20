<?php

use App\Models\Sociedade;
use Illuminate\Database\Seeder;

class SociedadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Sociedade::create([
          'name' => "administrador",
          'description' => 'mandar na ***** toda',
          'list' => [
            'posts_cadastrar',
            'posts_editar',
            'posts_ver',
            'posts_excluir',
          ],
        ]);
      Sociedade::create([
        'name' => "gerente",
        'description' => 'gerenciar',
        'list' => [
          'posts_cadastrar',
          'posts_editar',
          'posts_ver',
          'posts_excluir',
        ],
      ]);
      Sociedade::create([
        'name' => "funcionario",
        'description' => 'peão',
        'list' => [
          'posts_cadastrar',
          'posts_editar',
          'posts_ver',
          'posts_excluir',
        ],
      ]);
    }
}
