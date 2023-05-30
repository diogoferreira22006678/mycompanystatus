@extends('_layouts.layout',
 ['title' => 'Dashboard'])
@section('body')
<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-primary mb-0">{{ $company->company_name }} - {{ $report->report_year }}</h3>
    <div class="dropdown me-2">
        <form id = year-form>
            @csrf
            
            @component('_components.formSelect', [
                'required' => true,
                'class' => '',
                'attributes' => "ajax-url='/api/select/years/$company->company_id'",
                'name' => 'year',
                'placeholder' => 'Year',
                'array' => [],
                'key' => 'id',
                'value' => 'title'
            ])
            @endcomponent
            <button type="submit" form="year-form" class="btn btn-primary">Get Report</button>
        </form>
    </div>
</div>    
<hr>
<h6 class="text-uppercase text-primary">Rácios de Liquidez</h6>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-primary py-2">
            <div class="card-body">                
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Liquidez Geral</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_liquidez_geral}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Liquidez Reduzida</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_liquidez_reduzida}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
<hr>
<h6 class="text-uppercase text-primary">Rácios de Estrutura Financeira</h6>
<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary fw-bold m-0">Autonomia Financeira</h6>
                <div class="dropdown no-arrow">
                    <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                        <i class="fas fa-ellipsis-v text-gray-400"></i>
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                        <p class="text-center dropdown-header">Action Options:</p>
                        <a class="dropdown-item" href="#">&nbsp;Concept</a>
                        <a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="graphCanvas"></canvas>
                </div>
                <div class="text-center small mt-4">
                    <span class="me-2">
                        <i class="fas fa-circle text-success"></i> &nbsp;Capital Alheio
                    </span>
                    <span class="me-2">
                        <i class="fas fa-circle text-primary"></i> &nbsp;Capital Próprio
                    </span>
                </div>                        
            </div>
        </div>
    </div>


    <div class="col-md-4 col-xl-4">
            <div class="col-md-8 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Solvabilidade</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_solvabilidade}}</span></div>
                            </div>
                            <div class="dropdown no-arrow" style="display:contents;">
                                <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                                    <i class="fas fa-ellipsis-v text-gray-400"></i>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                    <p class="text-center dropdown-header">Action Options:</p>
                                    <a class="dropdown-item" href="#">&nbsp;Concept</a>
                                    <a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>cobertura do Ativo Não Circulante</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_cobertura_anc}}</span></div>
                            </div>
                            <div class="dropdown no-arrow" style="display:contents;">
                                <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                                    <i class="fas fa-ellipsis-v text-gray-400"></i>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                    <p class="text-center dropdown-header">Action Options:</p>
                                    <a class="dropdown-item" href="#">&nbsp;Concept</a>
                                    <a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
         
        </div>
    </div>
</div>
<hr>
<h6 class="text-uppercase text-primary">Rácios de Financiamento</h6>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Peso do passivo remunerado</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_peso_passivo_remunerado}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Custos dos financiamentos obtidos</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $custos_do_financiamento_obtido}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Pressão financeira</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_pressao_financeira}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<h6 class="text-uppercase text-primary">Rácios de Rentabilidade</h6>
<div class="row">
    <div class="col-md-6 col-xl-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary fw-bold m-0">Rentabilidades</h6>
            </div>
            <div class="card-body">
                <h4 class="small fw-bold">Rentabilidade do ativo (EBITDA)<span class="float-end">{{ $ratio_rentabilidade_do_ativo }}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" aria-valuenow="{{ $ratio_rentabilidade_do_ativo }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $ratio_rentabilidade_do_ativo }}%"><span class="visually-hidden">{{ $ratio_rentabilidade_do_ativo }}%</span></div>
                </div>
                <h4 class="small fw-bold">Rentabilidade do ativo (Líquido)<span class="float-end">{{ $ratio_rentabilidade_do_ativo_liquido }}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" aria-valuenow="{{ $ratio_rentabilidade_do_ativo_liquido }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $ratio_rentabilidade_do_ativo_liquido }}%"><span class="visually-hidden">{{ $ratio_rentabilidade_do_ativo_liquido }}%</span></div>
                </div>
                <h4 class="small fw-bold">Rentabilidade das vendas (Operacional)<span class="float-end">{{ $ratio_rentabilidade_vendas_operacionais }}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" aria-valuenow="{{ $ratio_rentabilidade_vendas_operacionais }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $ratio_rentabilidade_vendas_operacionais }}%"><span class="visually-hidden">{{ $ratio_rentabilidade_vendas_operacionais }}%</span></div>
                </div>
                <h4 class="small fw-bold">Rentabilidade das vendas (Líquida)<span class="float-end">{{ $ratio_rentabilidade_liquida }}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" aria-valuenow="{{ $ratio_rentabilidade_liquida }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $ratio_rentabilidade_liquida }}%"><span class="visually-hidden">{{ $ratio_rentabilidade_liquida }}%</span></div>
                </div>
            </div>            
        </div>
    </div>
    <div class="col-md-4 col-xl-4">
        <div class="col-md-8 mb-4">
            <div class="card shadow border-start-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Alavancagem Financeira</span></div>
                            <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_alavanca_financeira}}</span></div>
                        </div>
                        <div class="dropdown no-arrow" style="display:contents;">
                            <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                                <i class="fas fa-ellipsis-v text-gray-400"></i>
                            </button>
                            <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                <p class="text-center dropdown-header">Action Options:</p>
                                <a class="dropdown-item" href="#">&nbsp;Concept</a>
                                <a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="card shadow border-start-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Rentabilidade do CP (ROE)</span></div>
                            <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_roe}}%</span></div>
                        </div>
                        <div class="dropdown no-arrow" style="display:contents;">
                            <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                                <i class="fas fa-ellipsis-v text-gray-400"></i>
                            </button>
                            <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                <p class="text-center dropdown-header">Action Options:</p>
                                <a class="dropdown-item" href="#">&nbsp;Concept</a>
                                <a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
     
    </div>
</div>
</div>
<hr>
<h6 class="text-uppercase text-primary">Rácios de actividade ou de gestão</h6>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Prazo médio recebimentos (PMR)</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_prazo_medio_recebimento}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Prazo médio pagamentos (PMP)</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_prazo_medio_pagamento}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Prazo médio rotação de inventários</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_medio_rotacao_inventarios}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span>Rotação do Ativo</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_rotacao_do_ativo}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<h6 class="text-uppercase text-primary">Rácios Técnicos</h6>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Coeficiente VAB / Gastos com pessoal</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_coeficiente_vab}}</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>VAB</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $vab}}€</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Produção</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $producao}}€</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span>CI</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ci}}€</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Action Options:</p><a class="dropdown-item" href="#">&nbsp;Concept</a><a class="dropdown-item" href="#">&nbsp;Interpretation</a>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>


@component('_components.cardModal' , [
    'id' => 'modal-option',
    'class' => 'modal-success',
    'title' => 'Select Option',
    'close' => true,
 ])
    <form id="form-option" >
		<input type="hidden" name="user_id" />
        <div class="modal-body">
            <div class="text-center mb-3">
                <a class="btn btn-primary btn-lg d-none d-sm-inline-block text-white" role="button" type="button" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-file-export fa-sm text-white-50"></i>&nbsp;Upload Excel</a>
            </div>
            <div class="row">
                <div class="col-5">
                <hr class="hr-left">
                </div>
                <div class="col-2 text-center">
                    <p class="fs-5 fw-bold text-muted mb-3">Or</p>
                </div>
                <div class="col-5">
                    <hr class="hr-right">
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-primary btn-lg d-none d-sm-inline-block text-white w-100px
                " role="button" type="button" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Fill Form</a>
            </div>
        </div>
	</form>
    @slot('footer')
    @endslot
@endComponent
@endsection

@section('scripts')
<script>

    let form = document.getElementById('year-form');
    form.addEventListener('submit', i => {
        i.preventDefault();

        let company_id = @json($company->company_id);
        let year = form.elements['year'].value;


        // Redirect the user to Url /{company_id}/reports but always root
        window.location.href = "{{ url('/') }}" + "/dashboard/" + company_id + "/reports/" + year;
    }); 


    document.addEventListener('DOMContentLoaded', function() {
        var dataPoints = <?php echo json_encode($ratio_autonomia_financeira); ?>;

        function setupGraph(dataPoints) {
        var ctx = document.getElementById('graphCanvas').getContext('2d');
        console.log(dataPoints);
        var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Capital Próprio', 'Capital Alheio'],
            datasets: [{
            label: '',
            backgroundColor: ['rgba(78, 115, 223, 0.8)', 'rgba(28, 200, 138, 0.8)', 'rgba(54, 185, 204, 0.8)'],
            borderColor: ['#ffffff', '#ffffff', '#ffffff'],
            data: [dataPoints, 100 - dataPoints],
            }],
        },
        options: {
            tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var currentValue = dataset.data[tooltipItem.index];
                var label = data.labels[tooltipItem.index];
                return label + ': ' + currentValue + '%';
                }
            }
            },
            maintainAspectRatio: false,
            legend: {
            display: false,
            // make animation smooth
            animation: {
                duration: 10000000,
            },
            labels: {
                fontStyle: 'normal',
            },
            },
            title: {
            fontStyle: 'normal',
            },
        },
        });
    }

    // Call the setupGraph function with the dataPoints array
    setupGraph(dataPoints);
    });
</script>
@endsection