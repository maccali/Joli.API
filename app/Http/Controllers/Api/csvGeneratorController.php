<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use League\Csv\CannotInsertRecord;

class csvGeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pessoas = Pessoa::all();
        $ar = (array)$pessoas;
        $ac = array_values($ar)[0];
        $ab = array();
        for($i = 0; $i < sizeof($ac); $i++) {
            array_push($ab, [$ac[$i]->nome, $ac[$i]->email, 
            $ac[$i]->telefone, $ac[$i]->cidade]);
        }

        return response()->json($ab);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clienteeCsv(Request $request){
        $fis = DB::select('select p.nome, p.email, p.telefone, p.cidade, f.cpf, f.nascimento 
                           from pessoa p, fisica f where p.codigo = f.cod_pessoa');
        $jur = DB::select('select p.nome, p.email, p.telefone, p.cidade, f.cnpj, f.abertura 
                           from pessoa p, juridica f where p.codigo = f.cod_pessoa');
        $fis = array_values($fis);
        $fis[] = array_values($jur);
        return response()->json($fis);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clienteCsv(){
        $fis = DB::select('select p.nome, p.email, p.telefone, p.cidade, f.cpf, f.nascimento 
                           from pessoa p, fisica f where p.codigo = f.cod_pessoa');
        $fis = array_values($fis);
        $data = array();
        for($i = 0; $i < sizeof($fis); $i++){
            $data[] = [$fis[$i]->nome, $fis[$i]->email, $fis[$i]->telefone, 
            $fis[$i]->cidade, $fis[$i]->cpf, $fis[$i]->nascimento];
        }

        $path = public_path() . '/tes.csv';
        $writer = Writer::createFromPath($path, 'w+');
        $writer->insertOne(['nome', 'email', 'telefone', 'cidade', 'cpf', 'nasciemnto']);
        $writer->insertAll($data);


        return response()->download($path);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function funcionarioCsv(Request $request){
        $fis = DB::select('select p.nome, p.email, p.telefone, p.cidade, f.cpf, f.nascimento 
                           from pessoa p, fisica f where p.codigo = f.cod_pessoa');
        $jur = DB::select('select p.nome, p.email, p.telefone, p.cidade, f.cnpj, f.abertura 
                           from pessoa p, juridica f where p.codigo = f.cod_pessoa');
        $fis = array_values($fis);
        $fis[] = array_values($jur);

        return response()->json($fis);
    }
}
