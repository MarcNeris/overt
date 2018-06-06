@extends('layouts.crmbody')
@section('crmsidebar')

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


<li class="nav-item">
    <a class="nav-link" href="{{ route('crm.planodevoo') }}">
        <i class="material-icons">flight_takeoff</i>
        <p>Plano de Vôo</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('reg.contatos') }}">
        <i class="material-icons">contacts</i>
        <p>Contatos</p>
    </a>
</li>

<li class="nav-item active ">
    <a class="nav-link collapsed" aria-expanded="false" href="#formsExamples" data-toggle="collapse">
        <i class="material-icons">content_paste</i>
        <p> Forms
           <b class="caret"></b>
        </p>
    </a>

    <div class="collapse" id="formsExamples">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('crm.planodevoo') }}">
                  <span class="sidebar-mini"> RF </span>
                  <span class="sidebar-normal"> Regular Forms </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                  <span class="sidebar-mini"> RF </span>
                  <span class="sidebar-normal"> Regular Forms </span>
                </a>
            </li>
        </ul>
    </div>
</li>
@endsection