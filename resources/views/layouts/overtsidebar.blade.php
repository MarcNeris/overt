@extends('layouts.overt')
@section('overtsidebar')


@if(!Session::has('module'))
<li class="nav-item">
    <a class="nav-link" href="{{ route('bam.dashboard') }}">
        <i class="material-icons">track_changes</i>
        <p>BAM</p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('crm.dashboard') }}">
        <i class="material-icons">blur_on</i>
        <p>CRM</p>
    </a>
</li>
@endif


@if(Session::get('module')=='BAM')
<li class="nav-item">
    <a class="nav-link" href="{{ route('bam.dashboard') }}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" aria-expanded="false" href="#bam" data-toggle="collapse">
        <i class="material-icons">track_changes</i>
        <p> Activity Monitor
           <b class="caret"></b>
        </p>
    </a>

    <div class="collapse" id="bam">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('bam.financas') }}">
                  <span class="sidebar-mini"> FIN </span>
                  <span class="sidebar-normal"> Finanças </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('bam.operacoes') }}">
                  <span class="sidebar-mini"> OPR </span>
                  <span class="sidebar-normal"> Operações </span>
                </a>
            </li> 
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('bam/producao') }}/1000">
                  <span class="sidebar-mini"> OPR </span>
                  <span class="sidebar-normal"> Produção </span>
                </a>
            </li> 
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('bam.faturamento') }}">
                  <span class="sidebar-mini"> Fat </span>
                  <span class="sidebar-normal"> Faturamento </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('senior.clientes') }}">
                  <span class="sidebar-mini"> Cli </span>
                  <span class="sidebar-normal"> Clientes </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('bam.controladoria') }}">
                  <span class="sidebar-mini"> CTL </span>
                  <span class="sidebar-normal"> Controladoria </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('bam.hcm') }}">
                  <span class="sidebar-mini"> HCM </span>
                  <span class="sidebar-normal"> Recursos Humanos </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('bam.folha') }}">
                  <span class="sidebar-mini"> HCM </span>
                  <span class="sidebar-normal"> Folha </span>
                </a>
            </li>
       
        </ul>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('hcm.rep') }}">
        <i class="material-icons">watch_later</i>
        <p>REP</p>
    </a>
</li>


<!-- <li class="nav-item active ">
    <a class="nav-link collapsed" aria-expanded="false" href="#senior" data-toggle="collapse">
        <i class="material-icons">work</i>
        <p> ERP Gestão Empresarial
           <b class="caret"></b>
        </p>
    </a>

    <div class="collapse" id="senior">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('senior.v070emp') }}">
                  <span class="sidebar-mini"> FL </span>
                  <span class="sidebar-normal"> Ativar Filiais </span>
                </a>
            </li>
        </ul>
    </div>
</li> -->

@endif



@if(Session::get('module')=='CRM')
<li class="nav-item">
    <a class="nav-link" href="{{ route('crm.tarefas') }}">
        <i class="material-icons">assignment</i>
        <p>Tarefas</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('crm.dashboard') }}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" aria-expanded="false" href="#formsExamples" data-toggle="collapse">
        <i class="material-icons">folder_shared</i>
        <p>Contas/Prospects
           <b class="caret"></b>
        </p>
    </a>

    <div class="collapse" id="formsExamples">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('crm.contas') }}">
                  <span class="sidebar-mini"> C </span>
                  <span class="sidebar-normal">Contas</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('crm.conta') }}">
                  <span class="sidebar-mini"> NC </span>
                  <span class="sidebar-normal">Nova Conta</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                  <span class="sidebar-mini"> P </span>
                  <span class="sidebar-normal">Prospects</span>
                </a>
            </li>
        </ul>
    </div>
</li>

@endif

@endsection