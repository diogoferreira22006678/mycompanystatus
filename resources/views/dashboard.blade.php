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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_liquidez_geral}}%</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-1">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-1">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_liquidez_reduzida}}%</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-2">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-2">&nbsp;Interpretação</a>
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
                        <p class="text-center dropdown-header">Opções de Ação</p>
                        <a class="dropdown-item" id="concept-3">&nbsp;Conceito</a>
                        <a class="dropdown-item" id="interpretation-3">&nbsp;Interpretação</a>
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
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_solvabilidade}}%</span></div>
                            </div>
                            <div class="dropdown no-arrow" style="display:contents;">
                                <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                                    <i class="fas fa-ellipsis-v text-gray-400"></i>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                    <p class="text-center dropdown-header">Opções de Ação</p>
                                    <a class="dropdown-item" id="concept-4">&nbsp;Conceito</a>
                                    <a class="dropdown-item" id="interpretation-4">&nbsp;Interpretação</a>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
 
            </div>
            <div class="col-md-8 m
            b-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>cobertura do Ativo Não Circulante</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_cobertura_anc}}%</span></div>
                            </div>
                            <div class="dropdown no-arrow" style="display:contents;">
                                <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                                    <i class="fas fa-ellipsis-v text-gray-400"></i>
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                    <p class="text-center dropdown-header">Opções de Ação</p>
                                    <a class="dropdown-item" id="concept-5">&nbsp;Conceito</a>
                                    <a class="dropdown-item" id="interpretation-5">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_peso_passivo_remunerado}}%</span></div>
                    
                </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-6">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-6">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $custos_do_financiamento_obtido}}%</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-7">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-7">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_pressao_financeira}}%</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-8">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-8">&nbsp;Interpretação</a>
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary fw-bold m-0">Rentabilidades</h6>
                <div class="dropdown no-arrow">
                    <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                        <i class="fas fa-ellipsis-v text-gray-400"></i>
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                        <p class="text-center dropdown-header">Opções de Ação</p>
                        <a class="dropdown-item" id="concept-9">&nbsp;Conceito</a>
                        <a class="dropdown-item" id="interpretation-9-1">&nbsp;Interpretação-1</a>
                        <a class="dropdown-item" id="interpretation-9-2">&nbsp;Interpretação-2</a>
                        <a class="dropdown-item" id="interpretation-9-3">&nbsp;Interpretação-3</a>
                        <a class="dropdown-item" id="interpretation-9-4">&nbsp;Interpretação-4</a>
                    </div>
                </div>
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
 
                <h4 class="small fw-bold">Rentabilida
                    de das vendas (Operacional)<span class="float-end">{{ $ratio_rentabilidade_vendas_operacionais }}%</span></h4>
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
                                <p class="text-center dropdown-header">Opções de Ação</p>
                                <a class="dropdown-item" id="concept-10">&nbsp;Conceito</a>
                                <a class="dropdown-item" id="interpretation-10">&nbsp;Interpretação</a>
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
                                <p class="text-center dropdown-header">Opções de Ação</p>
                                <a class="dropdown-item" id="concept-11">&nbsp;Conceito</a>
                                <a class="dropdown-item" id="interpretation-11">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_prazo_medio_recebimento}} Dias</span></div>
                
            </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-12">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-12">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_prazo_medio_pagamento}} Dias</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação
                                </p><a class="dropdown-item" id="concept-13">&nbsp;Conceito
                                    </a><a class="dropdown-item" id="interpretation-13">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_medio_rotacao_inventarios}} Dias</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-14">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-14">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_rotacao_do_ativo}} Vezes</span></div>
                    </div>
                    <div class="dropdown no-arrow" style="display:contents;"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-15">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-15">&nbsp;Interpretação</a>
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
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-16">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-16">&nbsp;Interpretação</a>
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
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-17">&nbsp;Conceito</a>
                            <a class="dropdown-item" id="interpretation-17">&nbsp;Interpretação</a>
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
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-18">&nbsp;Conceito</a>
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
                            <p class="text-center dropdown-header">Opções de Ação</p>
                            <a class="dropdown-item" id="concept-19">&nbsp;Conceito</a>
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
    'id' => 'modal-Conceito',
    'class' => 'modal-success',
    'title' => 'Aprendizagem',
    'close' => true,
 ])     

    <div class="modal-body">
    </div>
    @slot('footer')
    @endslot
@endComponent

@component('_components.cardModal' , [
 
 'id' => 'modal-Interpretação',
    'class' => 'moda
    l-warning',
    'title' => 'Interpretação',
    'close' => true,
 ])     

 <div class="modal-body">
 </div>
    @slot('footer')
    @endslot
    
@endcomponent
@endsection
@section('scripts')
<script>

    let concept1 = document.getElementById('concept-1');
    let concept2 = document.getElementById('concept-2');
    let concept3 = document.getElementById('concept-3');
    let concept4 = document.getElementById('concept-4');
    let concept5 = document.getElementById('concept-5');
    let concept6 = document.getElementById('concept-6');
    let concept7 = document.getElementById('concept-7');
    let concept8 = document.getElementById('concept-8');
    let concept9 = document.getElementById('concept-9');
    let concept10 = document.getElementById('concept-10');
    let concept11 = document.getElementById('concept-11');
    let concept12 = document.getElementById('concept-12');
    let concept13 = document.getElementById('concept-13');
    let concept14 = document.getElementById('concept-14');
    let concept15 = document.getElementById('concept-15');
    let concept16 = document.getElementById('concept-16');
    let concept17 = document.getElementById('concept-17');
    let concept18 = document.getElementById('concept-18');
    let concept19 = document.getElementById('concept-19');

    let interpretation1 = document.getElementById('interpretation-1');
    let interpretation2 = document.getElementById('interpretation-2');
    let interpretation3 = document.getElementById('interpretation-3');
    let interpretation4 = document.getElementById('interpretation-4');
    let interpretation5 = document.getElementById('interpretation-5');
    let interpretation6 = document.getElementById('interpretation-6');
    let interpretation7 = document.getElementById('interpretation-7');
    let interpretation8 = document.getElementById('interpretation-8');
    let interpretation9_1 = document.getElementById('interpretation-9-1');
    let interpretation9_2 = document.getElementById('interpretation-9-2');
    let interpretation9_3 = document.getElementById('interpretation-9-3');
    let interpretation9_4 = document.getElementById('interpretation-9-4');
    let interpretation10 = document.getElementById('interpretation-10');
    let interpretation11 = document.getElementById('interpretation-11');
    let interpretation12 = document.getElementById('interpretation-12');
    let interpretation13 = document.getElementById('interpretation-13');
    let interpretation14 = document.getElementById('interpretation-14');
    let interpretation15 = document.getElementById('interpretation-15');
    let interpretation16 = document.getElementById('interpretation-16');
    let interpretation17 = document.getElementById('interpretation-17');

    let ratio_liquidez_geral = @json($ratio_liquidez_geral);
    let ratio_liquidez_reduzida = @json($ratio_liquidez_reduzida);
    let ratio_autonomia_financeira = @json($ratio_autonomia_financeira);
    let ratio_solvabilidade = @json($ratio_solvabilidade);
    let ratio_cobertura_anc = @json($ratio_cobertura_anc);
    let ratio_peso_passivo_remunerado = @json($ratio_peso_passivo_remunerado);
    let ratio_pressao_financeira = @json($ratio_pressao_financeira);
    let ratio_rentabilidade_do_ativo = @json($ratio_rentabilidade_do_ativo);
    let ratio_rentabilidade_do_ativo_liquido = @json($ratio_rentabilidade_do_ativo_liquido);
    let ratio_rentabilidade_vendas_operacionais = @json($ratio_rentabilidade_vendas_operacionais);
    let custos_do_financiamento_obtido = @json($custos_do_financiamento_obtido);
    let ratio_rentabilidade_liquida = @json($ratio_rentabilidade_liquida);
    let ratio_alavanca_financeira = @json($ratio_alavanca_financeira);
    let ratio_roe = @json($ratio_roe);
    let ratio_prazo_medio_recebimento = @json($ratio_prazo_medio_recebimento);
    let ratio_prazo_medio_pagamento = @json($ratio_prazo_medio_pagamento);
    let ratio_medio_rotacao_inventarios = @json($ratio_medio_rotacao_inventarios);
    let ratio_rotacao_do_ativo = @json($ratio_rotacao_do_ativo);
    let ratio_coeficiente_vab = @json($ratio_coeficiente_vab);
    let vab = @json($vab);
    let producao = @json($producao);
    let ci = @json($ci);


    concept1.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Liquidez Geral</h4>
        <p>O conceito de liquidez geral refere-se à capacidade de uma empresa em cumprir as suas obrigações de curto prazo utilizando os seus ativos de curto prazo, como caixa, contas a receber e estoque. Indica a saúde financeira e a solvência de uma empresa, pois mostra se ela possui recursos suficientes para liquidar as suas dívidas de curto prazo. Uma liquidez geral adequada é importante para a estabilidade e continuidade dos negócios.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept2.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Liquidez Reduzida</h4>
        <p>O conceito de liquidez reduzida diz respeito à capacidade de uma empresa em cumprir as suas obrigações de curto prazo utilizando apenas os seus ativos mais líquidos, como caixa e equivalentes de caixa. É uma medida mais conservadora de liquidez em comparação com a liquidez geral, pois exclui os ativos menos líquidos, como estoque e contas a receber. A liquidez reduzida pode ser utilizada como um indicador mais rigoroso da capacidade imediata de pagamento da empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept3.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Autonomia Financeira</h4>
        <p>O conceito de autonomia financeira refere-se à proporção do capital próprio em relação ao total de recursos utilizados por uma empresa. É uma medida que evidencia a capacidade da empresa em financiar as suas atividades com recursos próprios, sem depender excessivamente de financiamento externo. Uma autonomia financeira elevada indica uma estrutura de capital sólida e uma menor dependência de dívidas e empréstimos. É um indicador importante da estabilidade e solidez financeira de uma empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept4.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Solvabilidade</h4>
        <p>O conceito de solvabilidade refere-se à capacidade de uma empresa em cumprir as suas obrigações financeiras, tanto de curto quanto de longo prazo. Indica a saúde financeira e a capacidade da empresa em honrar os seus compromissos, incluindo o pagamento de dívidas e juros. A solvabilidade é avaliada considerando-se a relação entre os ativos e passivos da empresa, bem como a sua capacidade de gerar fluxo de caixa suficiente para cumprir as suas obrigações.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept5.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Cobertura ANC</h4>
        <p>O conceito de cobertura ANC (Ações Não Correntes) diz respeito à capacidade de uma empresa em utilizar os seus ativos não correntes, como investimentos, para cobrir as suas dívidas de longo prazo. É uma medida da segurança financeira e da capacidade da empresa em utilizar os seus ativos de longo prazo para cumprir as suas obrigações de longo prazo. Quanto maior a cobertura ANC, maior é a capacidade da empresa em honrar os seus compromissos de longo prazo.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept6.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Peso do Passivo Não Remunerado</h4>
        <p>O conceito de peso do passivo não remunerado refere-se à proporção dos recursos financeiros de uma empresa que são provenientes de passivos não remunerados, como dívidas de longo prazo. Esse rácio é uma medida da forma como uma empresa financia as suas operações e projetos de investimento através de dívidas não remuneradas.</p>
        <p>É importante que as empresas mantenham um equilíbrio adequado entre o financiamento através de dívidas e recursos próprios, de forma a garantir a sua capacidade de cumprir as obrigações de longo prazo e manter uma posição financeira saudável.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
});


    concept7.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Custos de Financiamento</h4>
        <p>O conceito de custos de financiamento refere-se aos gastos e despesas incorridos por uma empresa ao obter financiamento para as suas atividades. Inclui juros, taxas, comissões e outras despesas relacionadas a empréstimos, financiamentos e linhas de crédito. Os custos de financiamento são considerados na avaliação da viabilidade e rentabilidade de um projeto ou investimento, pois afetam o retorno financeiro e a capacidade de pagamento da empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept8.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Pressão Financeira</h4>
        <p>O conceito de pressão financeira refere-se à situação em que uma empresa enfrenta dificuldades para cumprir as suas obrigações financeiras devido à falta de recursos disponíveis. Pode ocorrer quando a empresa possui dívidas elevadas, fluxo de caixa insuficiente ou falta de rentabilidade. A pressão financeira pode levar à necessidade de renegociação de dívidas, empréstimos adicionais ou até mesmo à falência. É um indicador de fragilidade financeira e insustentabilidade das operações da empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept9.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Rentabilidade do Ativo</h4>
        <p>O conceito de rentabilidade do ativo refere-se à capacidade de uma empresa em gerar lucro em relação aos seus ativos totais. Indica a eficiência da empresa em utilizar os seus recursos para gerar retorno financeiro. A rentabilidade do ativo é calculada dividindo-se o lucro líquido pelo total de ativos da empresa. Quanto maior a rentabilidade do ativo, mais eficiente e lucrativa é a utilização dos recursos pela empresa.</p>
        <h4 class="modal-title">Conceito de Rentabilidade do Ativo Líquido</h4>
        <p>O conceito de rentabilidade do ativo líquido refere-se à capacidade de uma empresa em gerar lucro em relação aos seus ativos líquidos, ou seja, os seus ativos totais menos os seus passivos totais. É uma medida mais específica de rentabilidade, pois considera apenas os recursos próprios da empresa.</p>
        <h4 class="modal-title">Conceito de Rentabilidade das Vendas Operacionais</h4>
        <p>O conceito de rentabilidade das vendas operacionais refere-se à capacidade de uma empresa em gerar lucro a partir das suas atividades operacionais. Indica a eficiência da empresa em gerar retorno financeiro a partir das vendas dos seus produtos ou serviços. Quanto maior a rentabilidade das vendas operacionais, mais lucrativas são as operações principais da empresa.</p>
        <h4 class="modal-title">Conceito de Rentabilidade das Vendas Líquidas</h4>
        <p>O conceito de rentabilidade das vendas líquidas refere-se à capacidade de uma empresa em gerar lucro em relação às suas vendas líquidas, ou seja, as suas vendas totais menos os impostos e descontos concedidos. É uma medida mais precisa de rentabilidade, pois considera apenas o valor efetivo das vendas. Quanto maior a rentabilidade das vendas líquidas, mais lucrativas são as vendas realizadas pela empresa após considerar os impostos e descontos.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept10.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Alavancagem Financeira</h4>
        <p>O conceito de alavancagem financeira refere-se ao uso de recursos financeiros adicionais, como dívidas, para aumentar o retorno sobre o investimento dos acionistas de uma empresa. A alavancagem financeira ocorre quando uma empresa usa dívidas para financiar parte dos seus ativos ou operações. Ao fazer isso, a empresa assume um nível de risco mais elevado, uma vez que precisa de pagar juros e cumprir obrigações financeiras relacionadas à dívida.</p>
        <p>É importante que as empresas utilizem a alavancagem financeira de forma prudente, equilibrando cuidadosamente os custos e benefícios associados ao uso de dívidas para financiar as suas operações e projetos.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
});

concept11.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Rentabilidade do Capital Próprio (ROE)</h4>
        <p>O conceito de rentabilidade do capital próprio, também conhecido como ROE (Return on Equity), mede a capacidade de uma empresa em gerar lucros em relação ao capital próprio investido pelos acionistas. Esta métrica é frequentemente usada para avaliar a eficiência e a rentabilidade de uma empresa em utilizar os seus recursos financeiros para gerar retornos para os acionistas.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
});



    concept12.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Prazo Médio de Recebimentos</h4>
        <p>O conceito de prazo médio de recebimentos refere-se ao tempo médio que uma empresa leva para receber o pagamento das suas vendas. Quanto menor o prazo médio de recebimentos, mais ágil é a empresa na obtenção dos recursos provenientes de suas vendas.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept13.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Prazo Médio de Pagamentos</h4>
        <p>O conceito de prazo médio de pagamentos refere-se ao tempo médio que uma empresa leva para efetuar o pagamento das suas obrigações. Quanto menor o prazo médio de pagamentos, mais ágil é a empresa no cumprimento de suas obrigações financeiras. Mas também pode indicar que a empresa está a pagar as suas dívidas antes do prazo, o que pode ser prejudicial para a sua liquidez.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept14.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceiro de Prazo Médio de Rotação de Inventários</h4>	
        <p>O conceito de prazo médio de rotação de inventários refere-se ao tempo médio que uma empresa leva para vender o seu inventário. Quanto menor o prazo médio de rotação de inventários, mais ágil é a empresa na venda dos seus produtos. Mas também pode indicar que a empresa está a vender os seus produtos antes do prazo, o que pode ser prejudicial para a sua rentabilidade.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept15.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Rotação do Ativo</h4>
        <p>O conceito de rotação do ativo refere-se à capacidade de uma empresa em gerar vendas em relação aos seus ativos totais. Indica a eficiência da empresa em utilizar os seus recursos para gerar vendas. A rotação do ativo é calculada dividindo-se as vendas líquidas pelo total de ativos da empresa. Quanto maior a rotação do ativo, mais eficiente e lucrativa é a utilização dos recursos pela empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept16.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito do Coeficiente VAB / Gastos com Pessoal</h4>
        <p>O conceito do coeficiente VAB / gastos com pessoal refere-se à capacidade de uma empresa em gerar valor acrescentado bruto em relação aos seus gastos com pessoal. Indica a eficiência da empresa em utilizar os seus recursos para gerar valor acrescentado bruto. O coeficiente VAB / gastos com pessoal é calculado dividindo-se o valor acrescentado bruto pelos gastos com pessoal da empresa. Quanto maior o coeficiente VAB / gastos com pessoal, mais eficiente e lucrativa é a utilização dos recursos pela empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept17.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito do VAB</h4>
        <p>O conceito do VAB (Valor Acrescentado Bruto) refere-se ao valor criado por uma empresa através das suas atividades de produção e venda de bens e serviços. É calculado subtraindo-se os gastos com bens e serviços do valor das vendas. O VAB é um indicador importante da eficiência e rentabilidade de uma empresa, pois mostra a sua capacidade em gerar valor através das suas atividades operacionais.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept18.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
    <h4 class="modal-title">Conceito de Produção</h4>
    <p>O conceito de produção refere-se ao valor total dos bens e serviços produzidos por uma empresa durante um determinado período de tempo. É calculado somando-se o valor das vendas e o valor do inventário final e subtraindo-se o valor do inventário inicial. A produção é um indicador importante da atividade operacional de uma empresa, pois mostra a sua capacidade em gerar valor através da produção e venda de bens e serviços.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show(); 
    });

    concept19.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
    <h4 class ="modal-title">Conceito de CI</h4>
    <p> o conceito de CI (Custo do Investimento) refere-se ao valor total dos recursos financeiros investidos por uma empresa em ativos fixos e ativos intangíveis. É calculado somando-se o valor dos ativos fixos e o valor dos ativos intangíveis. O CI é um indicador importante da atividade de investimento de uma empresa, pois mostra a sua capacidade em gerar valor através da aquisição de ativos fixos e intangíveis.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show(); 
    });




    interpretation1.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Interpretação de Liquidez Geral</h4>`
        // em percentagem
        if(ratio_liquidez_geral > 100){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma liquidez geral superior a 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto prazo. Quanto maior a liquidez geral, maior é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }else if(ratio_liquidez_geral < 100){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma liquidez geral inferior a 100% indica que a empresa não possui recursos suficientes para liquidar suas dívidas de curto prazo. Quanto menor a liquidez geral, menor é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma liquidez geral de 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto prazo. Quanto maior a liquidez geral, maior é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation2.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Interpretação de Liquidez Reduzida</h4>`
        // em percentagem
        if(ratio_liquidez_reduzida > 100){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma liquidez reduzida superior a 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto prazo utilizando apenas seus ativos mais líquidos. Quanto maior a liquidez reduzida, maior é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }else if(ratio_liquidez_reduzida < 100){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma liquidez reduzida inferior a 100% indica que a empresa não possui recursos suficientes para liquidar suas dívidas de curto prazo utilizando apenas seus ativos mais líquidos. Quanto menor a liquidez reduzida, menor é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma liquidez reduzida de 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto prazo utilizando apenas seus ativos mais líquidos. Quanto maior a liquidez reduzida, maior é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation3.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Interpretação de Autonomia Financeira</h4>`
        // em percentagem
        if(ratio_autonomia_financeira > 50){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma autonomia financeira superior a 50% indica que a empresa possui recursos próprios suficientes para financiar as suas atividades. Quanto maior a autonomia financeira, maior é a capacidade da empresa em financiar as suas atividades com recursos próprios.</p>`;
        }else if(ratio_autonomia_financeira < 50){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma autonomia financeira inferior a 50% indica que a empresa não possui recursos próprios suficientes para financiar as suas atividades. Quanto menor a autonomia financeira, menor é a capacidade da empresa em financiar as suas atividades com recursos próprios.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma autonomia financeira de 50% indica que a empresa possui recursos próprios suficientes para financiar as suas atividades. Quanto maior a autonomia financeira, maior é a capacidade da empresa em financiar as suas atividades com recursos próprios.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation4.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Interpretação de Solvabilidade</h4>`
        // em percentagem
        if(ratio_solvabilidade > 100){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma solvabilidade superior a 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto e longo prazo. Quanto maior a solvabilidade, maior é a capacidade da empresa em honrar seus compromissos.</p>`;
        }else if(ratio_solvabilidade < 100){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma solvabilidade inferior a 100% indica que a empresa não possui recursos suficientes para liquidar suas dívidas de curto e longo prazo. Quanto menor a solvabilidade, menor é a capacidade da empresa em honrar seus compromissos.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma solvabilidade de 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto e longo prazo. Quanto maior a solvabilidade, maior é a capacidade da empresa em honrar seus compromissos.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation5.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Interpretação de Cobertura ANC</h4>`
        // em percentagem
        if(ratio_cobertura_anc > 100){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma cobertura ANC superior a 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de longo prazo utilizando apenas seus ativos não correntes. Quanto maior a cobertura ANC, maior é a capacidade da empresa em honrar seus compromissos de longo prazo.</p>`;
        }else if(ratio_cobertura_anc < 100){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma cobertura ANC inferior a 100% indica que a empresa não possui recursos suficientes para liquidar suas dívidas de longo prazo utilizando apenas seus ativos não correntes. Quanto menor a cobertura ANC, menor é a capacidade da empresa em honrar seus compromissos de longo prazo.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma cobertura ANC de 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de longo prazo utilizando apenas seus ativos não correntes. Quanto maior a cobertura ANC, maior é a capacidade da empresa em honrar seus compromissos de longo prazo.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation6.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Peso do Passivo Não Remunerado</h4>`
        // em percentagem
        if(ratio_peso_passivo_remunerado > 50){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um peso do passivo não remunerado superior a 50% indica que a empresa financia as suas operações e projetos de investimento principalmente através de dívidas não remuneradas. Quanto maior o peso do passivo não remunerado, maior é a dependência da empresa em relação a dívidas e empréstimos.</p>`;
        }else if(ratio_peso_passivo_remunerado < 50){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um peso do passivo não remunerado inferior a 50% indica que a empresa financia as suas operações e projetos de investimento principalmente através de recursos próprios. Quanto menor o peso do passivo não remunerado, menor é a dependência da empresa em relação a dívidas e empréstimos.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um peso do passivo não remunerado de 50% indica que a empresa financia as suas operações e projetos de investimento principalmente através de dívidas não remuneradas. Quanto maior o peso do passivo não remunerado, maior é a dependência da empresa em relação a dívidas e empréstimos.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation7.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Custos de Financiamento</h4>`
        // em percentagem
        if(custos_do_financiamento_obtido > 50){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um custo de financiamento superior a 50% indica que a empresa gasta mais de metade do seu lucro líquido com juros, taxas, comissões e outras despesas relacionadas a empréstimos, financiamentos e linhas de crédito. Quanto maior o custo de financiamento, menor é a rentabilidade da empresa.</p>`;
        }else if(custos_do_financiamento_obtido < 50){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um custo de financiamento inferior a 50% indica que a empresa gasta menos de metade do seu lucro líquido com juros, taxas, comissões e outras despesas relacionadas a empréstimos, financiamentos e linhas de crédito. Quanto menor o custo de financiamento, maior é a rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um custo de financiamento de 50% indica que a empresa gasta metade do seu lucro líquido com juros, taxas, comissões e outras despesas relacionadas a empréstimos, financiamentos e linhas de crédito. Quanto maior o custo de financiamento, menor é a rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation8.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Pressão Financeira</h4>`
        // em percentagem
        if(ratio_pressao_financeira > 50){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma pressão financeira superior a 50% indica que a empresa enfrenta dificuldades para cumprir as suas obrigações financeiras devido à falta de recursos disponíveis. Quanto maior a pressão financeira, maior é a fragilidade financeira e insustentabilidade das operações da empresa.</p>`;
        }else if(ratio_pressao_financeira < 50){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma pressão financeira inferior a 50% indica que a empresa não enfrenta dificuldades para cumprir as suas obrigações financeiras devido à falta de recursos disponíveis. Quanto menor a pressão financeira, menor é a fragilidade financeira e insustentabilidade das operações da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma pressão financeira de 50% indica que a empresa enfrenta dificuldades para cumprir as suas obrigações financeiras devido à falta de recursos disponíveis. Quanto maior a pressão financeira, maior é a fragilidade financeira e insustentabilidade das operações da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation9_1.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Rentabilidade do Ativo</h4>`
        // em percentagem
        if(ratio_rentabilidade_do_ativo > 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do ativo superior a 10% indica que a empresa é eficiente e lucrativa na utilização dos seus recursos para gerar retorno financeiro. Quanto maior a rentabilidade do ativo, maior é a eficiência e rentabilidade da empresa.</p>`;
        }else if(ratio_rentabilidade_do_ativo < 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do ativo inferior a 10% indica que a empresa não é eficiente e lucrativa na utilização dos seus recursos para gerar retorno financeiro. Quanto menor a rentabilidade do ativo, menor é a eficiência e rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do ativo de 10% indica que a empresa é eficiente e lucrativa na utilização dos seus recursos para gerar retorno financeiro. Quanto maior a rentabilidade do ativo, maior é a eficiência e rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation9_2.addEventListener('click', i=> {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Rentabilidade do Ativo Líquido</h4>`
        // em percentagem
        if(ratio_rentabilidade_do_ativo_liquido > 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do ativo líquido superior a 10% indica que a empresa é eficiente e lucrativa na utilização dos seus recursos próprios para gerar retorno financeiro. Quanto maior a rentabilidade do ativo líquido, maior é a eficiência e rentabilidade da empresa.</p>`;
        }else if(ratio_rentabilidade_do_ativo_liquido < 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do ativo líquido inferior a 10% indica que a empresa não é eficiente e lucrativa na utilização dos seus recursos próprios para gerar retorno financeiro. Quanto menor a rentabilidade do ativo líquido, menor é a eficiência e rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do ativo líquido de 10% indica que a empresa é eficiente e lucrativa na utilização dos seus recursos próprios para gerar retorno financeiro. Quanto maior a rentabilidade do ativo líquido, maior é a eficiência e rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation9_3.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Rentabilidade das Vendas Operacionais</h4>`
        // em percentagem
        if(ratio_rentabilidade_vendas_operacionais > 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade das vendas operacionais superior a 10% indica que a empresa é eficiente e lucrativa na geração de retorno financeiro a partir das suas atividades operacionais. Quanto maior a rentabilidade das vendas operacionais, maior é a eficiência e rentabilidade da empresa.</p>`;
        }else if(ratio_rentabilidade_vendas_operacionais < 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade das vendas operacionais inferior a 10% indica que a empresa não é eficiente e lucrativa na geração de retorno financeiro a partir das suas atividades operacionais. Quanto menor a rentabilidade das vendas operacionais, menor é a eficiência e rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade das vendas operacionais de 10% indica que a empresa é eficiente e lucrativa na geração de retorno financeiro a partir das suas atividades operacionais. Quanto maior a rentabilidade das vendas operacionais, maior é a eficiência e rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation9_4.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Rentabilidade das Vendas Líquidas</h4>`
        // em percentagem
        if(ratio_rentabilidade_liquida > 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade das vendas líquidas superior a 10% indica que a empresa é eficiente e lucrativa na geração de retorno financeiro a partir das suas vendas líquidas. Quanto maior a rentabilidade das vendas líquidas, maior é a eficiência e rentabilidade da empresa.</p>`;
        }else if(ratio_rentabilidade_liquida < 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade das vendas líquidas inferior a 10% indica que a empresa não é eficiente e lucrativa na geração de retorno financeiro a partir das suas vendas líquidas. Quanto menor a rentabilidade das vendas líquidas, menor é a eficiência e rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade das vendas líquidas de 10% indica que a empresa é eficiente e lucrativa na geração de retorno financeiro a partir das suas vendas líquidas. Quanto maior a rentabilidade das vendas líquidas, maior é a eficiência e rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation10.addEventListener('click', i =>{
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Alavancagem Financeira</h4>`
        if(ratio_alavanca_financeira > 1.0){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma alavancagem financeira superior a 1.0 indica que a empresa utiliza dívidas para financiar as suas atividades. Quanto maior a alavancagem financeira, maior é a dependência da empresa em relação a dívidas e empréstimos.</p>`;
        }else if(ratio_alavanca_financeira < 1.0){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma alavancagem financeira inferior a 1.0 indica que a empresa não utiliza dívidas para financiar as suas atividades. Quanto menor a alavancagem financeira, menor é a dependência da empresa em relação a dívidas e empréstimos.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma alavancagem financeira de 1.0 indica que a empresa utiliza dívidas para financiar as suas atividades. Quanto maior a alavancagem financeira, maior é a dependência da empresa em relação a dívidas e empréstimos.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation11.addEventListener('click', i =>{
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Rentabilidade do Capital Próprio</h4>`
        if(ratio_roe > 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do capital próprio superior a 10% indica que a empresa é eficiente e lucrativa na geração de retorno financeiro a partir dos seus recursos próprios. Quanto maior a rentabilidade do capital próprio, maior é a eficiência e rentabilidade da empresa.</p>`;
        }else if(ratio_roe < 10){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do capital próprio inferior a 10% indica que a empresa não é eficiente e lucrativa na geração de retorno financeiro a partir dos seus recursos próprios. Quanto menor a rentabilidade do capital próprio, menor é a eficiência e rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rentabilidade do capital próprio de 10% indica que a empresa é eficiente e lucrativa na geração de retorno financeiro a partir dos seus recursos próprios. Quanto maior a rentabilidade do capital próprio, maior é a eficiência e rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation12.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Prazo médio de recebimentos</h4>`
        if(ratio_prazo_medio_recebimento > ratio_prazo_medio_pagamento){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de recebimentos superior ao prazo médio de pagamentos indica que a empresa demora mais tempo a receber dos seus clientes do que a pagar aos seus fornecedores. Quanto maior o prazo médio de recebimentos, maior é a demora da empresa em receber dos seus clientes.</p>`;
        }else if(ratio_prazo_medio_recebimento < ratio_prazo_medio_pagamento){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de recebimentos inferior ao prazo médio de pagamentos indica que a empresa demora menos tempo a receber dos seus clientes do que a pagar aos seus fornecedores. Quanto menor o prazo médio de recebimentos, menor é a demora da empresa em receber dos seus clientes.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de recebimentos igual ao prazo médio de pagamentos indica que a empresa demora o mesmo tempo a receber dos seus clientes do que a pagar aos seus fornecedores. Quanto maior o prazo médio de recebimentos, maior é a demora da empresa em receber dos seus clientes.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation13.addEventListener('click', i =>{
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class ="modal-title">Prazo médio de pagamentos</h4>`
        if(ratio_prazo_medio_pagamento > ratio_prazo_medio_recebimento){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de pagamentos superior ao prazo médio de recebimentos indica que a empresa demora mais tempo a pagar aos seus fornecedores do que a receber dos seus clientes. Quanto maior o prazo médio de pagamentos, maior é a demora da empresa em pagar aos seus fornecedores.</p>`;
        }else if(ratio_prazo_medio_pagamento < ratio_prazo_medio_recebimento){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de pagamentos inferior ao prazo médio de recebimentos indica que a empresa demora menos tempo a pagar aos seus fornecedores do que a receber dos seus clientes. Quanto menor o prazo médio de pagamentos, menor é a demora da empresa em pagar aos seus fornecedores.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de pagamentos igual ao prazo médio de recebimentos indica que a empresa demora o mesmo tempo a pagar aos seus fornecedores do que a receber dos seus clientes. Quanto maior o prazo médio de pagamentos, maior é a demora da empresa em pagar aos seus fornecedores.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation14.addEventListener('click', i =>{
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class ="modal-title">Prazo médio de rotação de Inventários</h4>`;
        if(ratio_medio_rotacao_inventarios > ratio_prazo_medio_recebimento){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de rotação de inventários superior ao prazo médio de recebimentos indica que a empresa demora mais tempo a vender os seus inventários do que a receber dos seus clientes. Quanto maior o prazo médio de rotação de inventários, maior é a demora da empresa em vender os seus inventários.</p>`;
        }else if(ratio_medio_rotacao_inventarios < ratio_prazo_medio_recebimento){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de rotação de inventários inferior ao prazo médio de recebimentos indica que a empresa demora menos tempo a vender os seus inventários do que a receber dos seus clientes. Quanto menor o prazo médio de rotação de inventários, menor é a demora da empresa em vender os seus inventários.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um prazo médio de rotação de inventários igual ao prazo médio de recebimentos indica que a empresa demora o mesmo tempo a vender os seus inventários do que a receber dos seus clientes. Quanto maior o prazo médio de rotação de inventários, maior é a demora da empresa em vender os seus inventários.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation15.addEventListener('click', i =>{
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class ="modal-title">Rotação do Ativo</h4>`;
        if(ratio_rotacao_do_ativo > 1.0){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rotação do ativo superior a 1.0 indica que a empresa é eficiente e lucrativa na utilização dos seus ativos para gerar retorno financeiro. Quanto maior a rotação do ativo, maior é a eficiência e rentabilidade da empresa.</p>`;
        }else if(ratio_rotacao_do_ativo < 1.0){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rotação do ativo inferior a 1.0 indica que a empresa não é eficiente e lucrativa na utilização dos seus ativos para gerar retorno financeiro. Quanto menor a rotação do ativo, menor é a eficiência e rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Uma rotação do ativo de 1.0 indica que a empresa é eficiente e lucrativa na utilização dos seus ativos para gerar retorno financeiro. Quanto maior a rotação do ativo, maior é a eficiência e rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation16.addEventListener('click', i =>{
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Interpretação de Coeficiente VAB</h4>`;
        if(ratio_coeficiente_vab > 1.0){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um coeficiente VAB superior a 1.0 indica que a empresa é eficiente e lucrativa na utilização dos seus recursos para gerar valor acrescentado bruto. Quanto maior o coeficiente VAB, maior é a eficiência e rentabilidade da empresa.</p>`;
        }else if(ratio_coeficiente_vab < 1.0){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um coeficiente VAB inferior a 1.0 indica que a empresa não é eficiente e lucrativa na utilização dos seus recursos para gerar valor acrescentado bruto. Quanto menor o coeficiente VAB, menor é a eficiência e rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um coenficiente VAB de 1.0 indica que a empresa é eficiente e lucrativa na utilização dos seus recursos para gerar valor acrescentado bruto. Quanto maior o coeficiente VAB, maior é a eficiência e rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation17.addEventListener('click', i =>{
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">VAB</h4>`;
        // VAB = PRODUCAO - CI 
        if(vab > 0){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um VAB positivo indica que a empresa é eficiente e lucrativa na utilização dos seus recursos para gerar valor acrescentado bruto. Quanto maior o VAB, maior é a eficiência e rentabilidade da empresa.</p>`;
        }else if(vab < 0){
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um VAB negativo indica que a empresa não é eficiente e lucrativa na utilização dos seus recursos para gerar valor acrescentado bruto. Quanto menor o VAB, menor é a eficiência e rentabilidade da empresa.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML = `
            <p>Um VAB de 0 indica que a empresa é eficiente e lucrativa na utilização dos seus recursos para gerar valor acrescentado bruto. Quanto maior o VAB, maior é a eficiência e rentabilidade da empresa.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });





 
    let form = document.getElementById('year-form');
    form.addEventListener('submit', i => {
        i.preventDefault();


        let company_id = @json($company->company_id)
        ;
        let year = form.elements['year'].value;


        // Redirect the user to Url /{company_id}/reports but always root
        window.location.href = "{{ url('/') }}" + "/dashboard/" + company_id + "/reports/" + year;
    }); 


    document.addEventListener('DOMContentLoaded', function() {
        var dataPoints = <?php echo json_encode($ratio_autonomia_financeira); ?>;

 
        function setupGraph(dataPoints) {
        var
         ctx = document.getElementById('graphCanvas').getContext('2d');
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