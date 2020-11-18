<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Pessoa::all();

        return response()->json($pessoas);
    }

    /**
     * Display the specified resource - id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);

        return response()->json($pessoa);

        $pessoa = new Pessoa;
        $pessoa = $request->all();
        //$id = DB::select('select max(codigo) from pessoa');
        //$id++;
        $ar = array_values($pessoa);
        if($ar[0] == "FISICA"){
            $resp = DB::select('select * from pessoa p, fisica f where p.codigo = f.cod_pessoa');
        } else if($ar[0] == "JURIDICA") {
            $resp = DB::select('select * from pessoa p, juridica f where p.codigo = f.cod_pessoa');
        }

        return response()->json($resp);
    }

    /**
     * Display the specified resource - id.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function showName($name)
    {
        $pessoa = DB::select('select * from pessoa where nome like ?', [$name]);

        return response()->json($pessoa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa = $request->all();
        //$id = DB::select('select max(codigo) from pessoa');
        //$id++;
        if($pessoa['tipo'] == "FISICA"){
            $pessoap = ["nome" => $pessoa['nome'], "email" => $pessoa['email'], 
                        "endereco" => $pessoa['endereco'], $pessoa['telefone'], 
                        "cep" => $pessoa['cep'], "cidade" => $pessoa['cidade'],
                        "uf" => $pessoa['uf']];
            $ar = array_values($pessoap);

            $insPes = DB::table('pessoa')->insert(
                ['nome' => $ar[0], 'email' => $ar[1],
                'endereco' => $ar[2], 'telefone' => $ar[3],
                'cep' => $ar[4], 'cidade' => $ar[5], 'uf' => $ar[6]],
                ['codigo']
            );

            $id = array_values(DB::select('select max(codigo) from pessoa'));
            $idc = $id[0];
            $idx = array_values(get_object_vars($idc));
            $idz = strval($idx[0]);

            $pessoaf = new PessoaFisica;
            $pessoaf = ["cod_pessoa" => $idz, "cpf" => $pessoa['cpf'],
                        "rg" => $pessoa['rg'], "nascimento" => $pessoa['nascimento']];
            $ar = array_values($pessoaf);

            $insFis = DB::table('fisica')->insert(
                ['cod_pessoa' => $ar[0], 'cpf' => $ar[1],
                'rg' => $ar[2], 'nascimento' => $ar[3]],
                ['cod_pessoa']
            );

            $pessoac = new Cliente;
            $pessoac = ["cod_juridica" => 0, "cod_fisica" => $idz];
            $ar = array_values($pessoac);

            $insCli = DB::table('cliente')->insert(
                ['cod_juridica' => $ar[0], 'cod_fisica' => $ar[1]],
                ['codigo']
            );
        } else if($pessoa['tipo'] == "JURIDICA") {
            $pessoa = new Pessoa;
            $pessoa = $request->all();
            $pessoap = ["nome" => $pessoa['nome'], "email" => $pessoa['email'], 
                        "endereco" => $pessoa['endereco'], $pessoa['telefone'], 
                        "cep" => $pessoa['cep'], "cidade" => $pessoa['cidade'],
                        "uf" => $pessoa['uf']];
            $ar = array_values($pessoap);
    
            $insPes = DB::table('pessoa')->insert(
                ['nome' => $ar[0], 'email' => $ar[1],
                 'endereco' => $ar[2], 'telefone' => $ar[3],
                 'cep' => $ar[4], 'cidade' => $ar[5], 'uf' => $ar[6]],
                 ['codigo']
            );
    
            $id = array_values(DB::select('select max(codigo) from pessoa'));
            $idc = $id[0];
            $idx = array_values(get_object_vars($idc));
            $idz = strval($idx[0]);
    
            $pessoaj = new PessoaJuridica;
            $pessoaj = ["cod_pessoa" => $idz, "cnpj" => $pessoa['cnpj'],
                        "cnae" => $pessoa['cnae'], "abertura" => $pessoa['abertura'],
                        "natureza_jur" => $pessoa['natureza_jur']];
            $ar = array_values($pessoaj);
            
            $insFis = DB::table('fisica')->insert(
                ['cod_pessoa' => $ar[0], 'cpf' => $ar[1],
                 'rg' => $ar[2], 'nascimento' => $ar[3]],
                ['cod_pessoa']
            );
    
            $pessoac = new Cliente;
            $pessoac = ["cod_juridica" => $idz, "cod_fisica" => 0];
            $ar = array_values($pessoac);
    
            $insCli = DB::table('cliente')->insert(
                ['cod_juridica' => $ar[0], 'cod_fisica' => $ar[1]],
                ['codigo']
            );
        }

        return response()->json([$insPes, $insFis, $insCli]);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFisicaCliente(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa = $request->all();
        $pessoap = ["nome" => $pessoa['nome'], "email" => $pessoa['email'], 
                    "endereco" => $pessoa['endereco'], $pessoa['telefone'], 
                    "cep" => $pessoa['cep'], "cidade" => $pessoa['cidade'],
                    "uf" => $pessoa['uf']];
        $ar = array_values($pessoap);

        $insPes = DB::table('pessoa')->insert(
            ['nome' => $ar[0], 'email' => $ar[1],
             'endereco' => $ar[2], 'telefone' => $ar[3],
             'cep' => $ar[4], 'cidade' => $ar[5], 'uf' => $ar[6]],
             ['codigo']
        );

        $id = array_values(DB::select('select max(codigo) from pessoa'));

        $pessoaf = new PessoaFisica;
        $pessoaf = ["cod_pessoa" => $id[0], "cpf" => $pessoa['cpf'],
                    "rg" => $pessoa['rg'], "nascimento" => $pessoa['nascimento']];
        $ar = array_values($pessoaf);

        $insFis = DB::table('fisica')->insert(
            ['cod_pessoa' => $ar[0], 'cpf' => $ar[1],
             'rg' => $ar[2], 'nascimento' => $ar[3]],
            ['cod_pessoa']
        );

        $pessoac = new Cliente;
        $pessoac = ["cod_juridica" => 0, "cod_fisica" => $id[0]];
        $ar = array_values($pessoac);

        $insCli = DB::table('cliente')->insert(
            ['cod_juridica' => $ar[0], 'cod_fisica' => $ar[1]],
            ['codigo']
        );

        return [$insPes, $insFis, $insCli];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJuridicaCliente(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa = $request->all();
        $pessoap = ["nome" => $pessoa['nome'], "email" => $pessoa['email'], 
                    "endereco" => $pessoa['endereco'], $pessoa['telefone'], 
                    "cep" => $pessoa['cep'], "cidade" => $pessoa['cidade'],
                    "uf" => $pessoa['uf']];
        $ar = array_values($pessoap);

        $insPes = DB::table('pessoa')->insert(
            ['nome' => $ar[0], 'email' => $ar[1],
             'endereco' => $ar[2], 'telefone' => $ar[3],
             'cep' => $ar[4], 'cidade' => $ar[5], 'uf' => $ar[6]],
             ['codigo']
        );

        $id = array_values(DB::select('select max(codigo) from pessoa'));

        $pessoaj = new PessoaJuridica;
        $pessoaj = ["cod_pessoa" => $id[0], "cnpj" => $pessoa['cnpj'],
                    "cnae" => $pessoa['cnae'], "abertura" => $pessoa['abertura'],
                    "natureza_jur" => $pessoa['natureza_jur']];
        $ar = array_values($pessoaj);
        
        $insJur = DB::table('fisica')->insert(
            ['cod_pessoa' => $ar[0], 'cpf' => $ar[1],
             'rg' => $ar[2], 'nascimento' => $ar[3]],
            ['cod_pessoa']
        );

        $pessoac = new Cliente;
        $pessoac = ["cod_juridica" => $id[0], "cod_fisica" => 0];
        $ar = array_values($pessoac);

        $insCli = DB::table('cliente')->insert(
            ['cod_juridica' => $ar[0], 'cod_fisica' => $ar[1]],
            ['codigo']
        );

        return [$insPes, $insJur, $insCli];
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFisicaFuncionario(Request $request)
    {
        $pessoa = new Pessoa;
        $pessoa = $request->all();
        $pessoap = ["nome" => $pessoa['nome'], "email" => $pessoa['email'], 
                    "endereco" => $pessoa['endereco'], $pessoa['telefone'], 
                    "cep" => $pessoa['cep'], "cidade" => $pessoa['cidade'],
                    "uf" => $pessoa['uf']];
        $ar = array_values($pessoap);

        $insPes = DB::table('pessoa')->insert(
            ['nome' => $ar[0], 'email' => $ar[1],
             'endereco' => $ar[2], 'telefone' => $ar[3],
             'cep' => $ar[4], 'cidade' => $ar[5], 'uf' => $ar[6]],
             ['codigo']
        );

        //$id = array_values(DB::select('select max(codigo) from pessoa'));
        $id = array_values(DB::select('select max(codigo) from pessoa'));
        $idc = $id[0];
        $idx = array_values(get_object_vars($idc));
        $idz = strval($idx[0]);

        $pessoaf = new PessoaFisica;
        $pessoaf = ["cod_pessoa" => $idz, "cpf" => $pessoa['cpf'],
                    "rg" => $pessoa['rg'], "nascimento" => $pessoa['nascimento']];
        $ar = array_values($pessoaf);

        $insFis = DB::table('fisica')->insert(
            ['cod_pessoa' => $ar[0], 'cpf' => $ar[1],
             'rg' => $ar[2], 'nascimento' => $ar[3]],
            ['cod_pessoa']
        );
        
        $pessoau = new Funcionario;
        $pessoau = ["cargo" => $pessoa['cargo'], "data_contrato" => $pessoa['data_contrato'],
                    "senha" => $pessoa['senha'], "cod_fisica" => $idz];
        $ar = array_values($pessoau);
        
        $insFunc = DB::table('funcionario')->insert(
            ['cargo' => $ar[0], 'data_contrato' => $ar[1],
             'senha' => $ar[2], 'cod_fisica' => $ar[3]],
            ['codigo']
        );
        
        return response()->json([$insPes, $insFis, $insFunc]);
    }

            

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pessoa = $request->all();

        $ar = array_values($pessoa);
        if($ar[0] == "FISICA"){
            $resp = PessoaController::updateFisicaCliente($request, $id);
        } else if($ar[0] == "JURIDICA") {
            $resp = PessoaController::updateJuridicaCliente($request, $id);
        }

        return response()->json($resp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFisicaCliente(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $pessoa = $request->all();
        $pessoap = ["nome" => $pessoa['nome'], "email" => $pessoa['email'], 
                    "endereco" => $pessoa['endereco'], $pessoa['telefone'], 
                    "cep" => $pessoa['cep'], "cidade" => $pessoa['cidade'],
                    "uf" => $pessoa['uf']];
        $ar = array_values($pessoap);

        $insPes = DB::table('pessoa')->where('codigo', $id)->update(
            ['nome' => $ar[0], 'email' => $ar[1],
             'endereco' => $ar[2], 'telefone' => $ar[3],
             'cep' => $ar[4], 'cidade' => $ar[5], 'uf' => $ar[6]],
             ['codigo']
        );

        $pessoaf = PessoaFisica::find($id);
        $pessoaf = new PessoaFisica;
        $pessoaf = ["cod_pessoa" => $id[0], "cpf" => $pessoa['cpf'],
                    "rg" => $pessoa['rg'], "nascimento" => $pessoa['nascimento']];
        $ar = array_values($pessoaf);

        $insFis = DB::table('fisica')->where('cod_pessoa', $id)->update(
            ['cod_pessoa' => $ar[0], 'cpf' => $ar[1],
             'rg' => $ar[2], 'nascimento' => $ar[3]],
            ['cod_pessoa']
        );

        return [$insPes, $insFis];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateJuridicaCliente(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $pessoa = $request->all();
        $pessoap = ["nome" => $pessoa['nome'], "email" => $pessoa['email'], 
                    "endereco" => $pessoa['endereco'], $pessoa['telefone'], 
                    "cep" => $pessoa['cep'], "cidade" => $pessoa['cidade'],
                    "uf" => $pessoa['uf']];
        $ar = array_values($pessoap);

        $insPes = DB::table('pessoa')->where('codigo', $id)->update(
            ['nome' => $ar[0], 'email' => $ar[1],
             'endereco' => $ar[2], 'telefone' => $ar[3],
             'cep' => $ar[4], 'cidade' => $ar[5], 'uf' => $ar[6]],
             ['codigo']
        );

        $pessoaf = PessoaJuridica::find($id);
        $pessoaf = new PessoaFisica;
        $pessoaf = ["cod_pessoa" => $id[0], "cnpj" => $pessoa['cnpj'],
                    "cnae" => $pessoa['cnae'], "abertura" => $pessoa['abertura'],
                    "naturezaJuridica" => $pessoa['naturezaJuridica']];
        $ar = array_values($pessoaf);

        $insFis = DB::table('juridica')->insert(
            ['cod_pessoa' => $ar[0], 'cnpj' => $ar[1],
             'cnae' => $ar[2], 'abertura' => $ar[3],
             'naturezaJuridica' => $ar[4]],
            ['cod_pessoa']
        );

        return [$insPes, $insFis];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFisicaFuncionario(Request $request, $id)
    {
        $pessoa = Pessoa::find($id);
        $pessoa = $request->all();
        $pessoap = ["nome" => $pessoa['nome'], "email" => $pessoa['email'], 
                    "endereco" => $pessoa['endereco'], $pessoa['telefone'], 
                    "cep" => $pessoa['cep'], "cidade" => $pessoa['cidade'],
                    "uf" => $pessoa['uf']];
        $ar = array_values($pessoap);

        $insPes = DB::table('pessoa')->where('codigo', $id)->update(
            ['nome' => $ar[0], 'email' => $ar[1],
             'endereco' => $ar[2], 'telefone' => $ar[3],
             'cep' => $ar[4], 'cidade' => $ar[5], 'uf' => $ar[6]],
             ['codigo']
        );

        $pessoaf = PessoaFisica::find($id);
        $pessoaf = new PessoaFisica;
        $pessoaf = ["cod_pessoa" => $id[0], "cpf" => $pessoa['cpf'],
                    "rg" => $pessoa['rg'], "nascimento" => $pessoa['nascimento']];
        $ar = array_values($pessoaf);

        $insFis = DB::table('fisica')->where('cod_pessoa', $id)->update(
            ['cod_pessoa' => $ar[0], 'cpf' => $ar[1],
             'rg' => $ar[2], 'nascimento' => $ar[3]],
            ['cod_pessoa']
        );

        $insFunc = Funcionario::find($id);
        $pessoau = new Funcionario;
        $pessoau = ["cargo" => $pessoa['cargo'], "data_contrato" => $pessoa['data_contrato'],
                    "senha" => $pessoa['senha'], "cod_fisica" => $id[0]];
        $ar = array_values($pessoau);

        $insFunc = DB::table('funcionario')->where('cod_fisica', $id)->update(
            ['cargo' => $ar[0], 'data_contrato' => $ar[1],
             'senha' => $ar[2], 'cod_fisica' => $ar[3]],
            ['codigo']
        );

        return response()->json([$insPes, $insFis, $insFunc]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pessoa = $request->all();

        $ar = array_values($pessoa);
        if($ar[0] == "FISICA"){
            $resp = PessoaController::destroyFisicaCliente($id);
        } else if($ar[0] == "JURIDICA") {
            $resp = PessoaController::destroyJuridicaCliente($id);
        }

        return response()->json($resp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFisicaCliente($id)
    {
        $pessoa1 = DB::delete('delete from cliente where cod_fisica = ?', [$id]);
        $pessoa2 = DB::delete('delete from fisica where cod_pessoa = ?', [$id]);
        $pessoa3 = DB::delete('delete from pessoa where codigo = ?', [$id]);

        return response()->json([$pessoa1, $pessoa2, $pessoa3]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyJuridicaCliente($id)
    {
        $pessoa1 = DB::delete('delete from cliente where cod_juridica = ?', [$id]);
        $pessoa2 = DB::delete('delete from juridica where cod_pessoa = ?', [$id]);
        $pessoa3 = DB::delete('delete from pessoa where codigo = ?', [$id]);

        return response()->json([$pessoa1, $pessoa2, $pessoa3]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFisicaFuncionario($id)
    {
        $pessoa1 = DB::delete('delete from funcionario where cod_fisica = ?', [$id]);
        $pessoa2 = DB::delete('delete from fisica where cod_pessoa = ?', [$id]);
        $pessoa3 = DB::delete('delete from pessoa where codigo = ?', [$id]);

        return response()->json([$pessoa1, $pessoa2, $pessoa3]);
    }
}
