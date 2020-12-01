@component('mail::message')

<h1>Olá,temos uma Movimentação do processo {{$processo->cod_processo}}</h1  >
<br/>
<div><b>Nome do Funcionário: </b><span>{{ $user->name }}</span></div>
<div><b>Nome do Cliente: </b><span>{{ $pessoa->nome }}</span></div>
<br/>
<div><b>Número: </b><span>{{ $processo->numero }}</span></div>
<div><b>Tipo: </b><span>{{ $processo->processo_tipo }}</span></div>
<div><b>Abertura: </b><span>{{ $processo->abertura }}</span></div>
<br/>
<br/>
<p>Esse é um email do sistema, favor não responder</p>
<p></p>
<p>Att, <br>
JOLI!</p>
@endcomponent
