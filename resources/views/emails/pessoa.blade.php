@component('mail::message')

<h1>Olá, Seja Muito Bem Vindo!</h1  >
<br/>
<div><b>Nome: </b><span>{{ $pessoa->nome }}</span></div>
<div><b>Email: </b><span>{{ $pessoa->email }}</span></div>
<div><b>Endereco: </b><span>{{ $pessoa->endereco }}</span></div>
<div><b>Telefone: </b><span>{{ $pessoa->telefone }}</span></div>
<div><b>CEP: </b><span>{{ $pessoa->cep }}</span></div>
<div><b>Cidade: </b><span>{{ $pessoa->cidade }}</span></div>
<div><b>UF: </b><span>{{ $pessoa->uf }}</span></div>
<br />
<div><b>Tipo: </b><span>{{ $pessoa->tipo }}</span></div>
<div><b>CPF: </b><span>{{ $pessoa->cpf }}</span></div>
<div><b>RG: </b><span>{{ $pessoa->rg }}</span></div>
<div><b>Nascimento: </b><span>{{ $pessoa->nascimento }}</span></div>
<br/>
<div><b>CNPJ: </b><span>{{ $pessoa->cnpj }}</span></div>
<div><b>CNAE: </b><span>{{ $pessoa->cnae }}</span></div>
<div><b>Abertura: </b><span>{{ $pessoa->abertura }}</span></div>
<div><b>Natureza Jurídica: </b><span>{{ $pessoa->natureza_jur }}</span></div>
<br/>
<br/>
<p>Esse é um email do sistema, favor não responder</p>
<p></p>
<p>Att, <br>
JOLI!</p>
@endcomponent
