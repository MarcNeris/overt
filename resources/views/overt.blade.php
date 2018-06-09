@extends('layouts.home')
@section('content')

<div class="section section-header">
    <div class="parallax filter filter-color-black">
        <div class="image"
            style="background-image: url('assets/img/header-1.jpeg')">
        </div>
        <div class="container">
            <div class="content">
                <div class="title-area">
                    <p>tecnologia</p>
                    <h1 class="title-modern">software</h1>
                    <h3>CRM</h3>
                    <h3>BAM</h3>
                    <div class="separator line-separator">♦</div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section">
    <div class="container">
        <div class="row">
            <div class="title-area">
                <h2>Nossos Serviços</h2>
                <div class="separator separator-danger">✻</div>
                <p class="description">Focados em gerar resultados através da tecnoliga!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="info-icon">
                    <div class="icon text-danger">
                        <i class="pe-7s-graph2"></i>
                    </div>
                    <h3>CRM | Administração de Vendas</h3>
                    <p class="description">Administração de vendas capaz de gerenciar cada oporutindade de forma simples e eficiente.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-icon">
                    <div class="icon text-danger">
                        <i class="pe-7s-graph1"></i>
                    </div>
                    <h3>BAM | Business Activity Monitoring</h3>
                    <p class="description">Monitoramento real time das operações, gerando uma análise de negócios precisa.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-icon">
                    <div class="icon text-danger">
                        <i class="pe-7s-graph"></i>
                    </div>
                    <h3>HCM Cloud Panel</h3>
                    <p class="description">Solução de monitoramento de recursos humanos para gestão de RH.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection