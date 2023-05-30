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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_peso_passivo_remunerado}}</span></div>
                    
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $custos_do_financiamento_obtido}}</span></div>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_pressao_financeira}}</span></div>
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
                        <a class="dropdown-item" id="interpretation-9">&nbsp;Interpretação</a>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_prazo_medio_recebimento}}</span></div>
                
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_prazo_medio_pagamento}}</span></div>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_medio_rotacao_inventarios}}</span></div>
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
                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_rotacao_do_ativo}}</span></div>
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
                            <a class="dropdown-item" id="interpretation-18">&nbsp;Interpretação</a>
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
                            <a class="dropdown-item" id="interpretation-19">&nbsp;Interpretação</a>
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
    let interpretation9 = document.getElementById('interpretation-9');
    let interpretation10 = document.getElementById('interpretation-10');
    let interpretation11 = document.getElementById('interpretation-11');
    let interpretation12 = document.getElementById('interpretation-12');
    let interpretation13 = document.getElementById('interpretation-13');
    let interpretation14 = document.getElementById('interpretation-14');
    let interpretation15 = document.getElementById('interpretation-15');
    let interpretation16 = document.getElementById('interpretation-16');
    let interpretation17 = document.getElementById('interpretation-17');
    let interpretation18 = document.getElementById('interpretation-18');
    let interpretation19 = document.getElementById('interpretation-19');

    let ratio_liquidez_geral = @json($ratio_liquidez_geral);
    let ratio_liquidez_reduzida = @json($ratio_liquidez_reduzida);
    let ratio_autonomia_financeira = @json($ratio_autonomia_financeira);
    let ratio_solvabilidade = @json($ratio_solvabilidade);
    let ratio_cobertura_anc = @json($ratio_cobertura_anc);
    let ratio_pressao_financeira = @json($ratio_pressao_financeira);
    let ratio_rentabilidade_do_ativo = @json($ratio_rentabilidade_do_ativo);
    let ratio_rentabilidade_do_ativo_liquido = @json($ratio_rentabilidade_do_ativo_liquido);
    let ratio_rentabilidade_vendas_operacionais = @json($ratio_rentabilidade_vendas_operacionais);
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
        <p>O conceito de liquidez geral refere-se à capacidade de uma empresa em cumprir suas obrigações de curto prazo utilizando seus ativos de curto prazo, como caixa, contas a receber e estoque. Indica a saúde financeira e a solvência de uma empresa, pois mostra se ela possui recursos suficientes para liquidar suas dívidas de curto prazo. Uma liquidez geral adequada é importante para a estabilidade e continuidade dos negócios.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept2.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Liquidez Reduzida</h4>
        <p>O conceito de liquidez reduzida diz respeito à capacidade de uma empresa em cumprir suas obrigações de curto prazo utilizando apenas seus ativos mais líquidos, como caixa e equivalentes de caixa. É uma medida mais conservadora de liquidez em comparação com a liquidez geral, pois exclui os ativos menos líquidos, como estoque e contas a receber. A liquidez reduzida pode ser utilizada como um indicador mais rigoroso da capacidade imediata de pagamento da empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept3.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Autonomia Financeira</h4>
        <p>O conceito de autonomia financeira refere-se à proporção do capital próprio em relação ao total de recursos utilizados por uma empresa. É uma medida da capacidade da empresa em financiar suas atividades com recursos próprios, sem depender excessivamente de financiamento externo. Uma autonomia financeira elevada indica uma estrutura de capital sólida e uma menor dependência de dívidas e empréstimos. É um indicador importante da estabilidade e solidez financeira de uma empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept4.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Solvabilidade</h4>
        <p>O conceito de solvabilidade refere-se à capacidade de uma empresa em cumprir suas obrigações financeiras, tanto de curto prazo quanto de longo prazo. Indica a saúde financeira e a capacidade da empresa em honrar seus compromissos, incluindo o pagamento de dívidas e juros. A solvabilidade é avaliada considerando-se a relação entre os ativos e passivos da empresa, bem como a sua capacidade de gerar fluxo de caixa suficiente para cumprir suas obrigações.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept5.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Cobertura ANC</h4>
        <p>O conceito de cobertura ANC (Ações Não Correntes) diz respeito à capacidade de uma empresa em utilizar seus ativos não correntes, como imobilizado e investimentos, para cobrir suas dívidas de longo prazo. É uma medida da segurança financeira e da capacidade da empresa em utilizar seus ativos de longo prazo para cumprir suas obrigações de longo prazo. Quanto maior a cobertura ANC, maior é a capacidade da empresa em honrar seus compromissos de longo prazo.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept6.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Cobertura ANC</h4>
        <p>O conceito de cobertura ANC (Ações Não Correntes) diz respeito à capacidade de uma empresa em utilizar seus ativos não correntes, como imobilizado e investimentos, para cobrir suas dívidas de longo prazo. É uma medida da segurança financeira e da capacidade da empresa em utilizar seus ativos de longo prazo para cumprir suas obrigações de longo prazo. Quanto maior a cobertura ANC, maior é a capacidade da empresa em honrar seus compromissos de longo prazo.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept7.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Custos de Financiamento</h4>
        <p>O conceito de custos de financiamento refere-se aos gastos e despesas incorridos por uma empresa ao obter financiamento para suas atividades. Inclui juros, taxas, comissões e outras despesas relacionadas a empréstimos, financiamentos e linhas de crédito. Os custos de financiamento são considerados na avaliação da viabilidade e rentabilidade de um projeto ou investimento, pois afetam o retorno financeiro e a capacidade de pagamento da empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept8.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Pressão Financeira</h4>
        <p>O conceito de pressão financeira refere-se à situação em que uma empresa enfrenta dificuldades para cumprir suas obrigações financeiras devido à falta de recursos disponíveis. Pode ocorrer quando a empresa possui dívidas elevadas, fluxo de caixa insuficiente ou falta de rentabilidade. A pressão financeira pode levar à necessidade de renegociação de dívidas, empréstimos adicionais ou até mesmo à falência. É um indicador de fragilidade financeira e insustentabilidade das operações da empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept9.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Rentabilidade do Ativo</h4>
        <p>O conceito de rentabilidade do ativo refere-se à capacidade de uma empresa em gerar lucro em relação aos seus ativos totais. Indica a eficiência da empresa em utilizar seus recursos para gerar retorno financeiro. A rentabilidade do ativo é calculada dividindo-se o lucro líquido pelo total de ativos da empresa. Quanto maior a rentabilidade do ativo, mais eficiente e lucrativa é a utilização dos recursos pela empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept10.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Rentabilidade do Ativo Líquido</h4>
        <p>O conceito de rentabilidade do ativo líquido refere-se à capacidade de uma empresa em gerar lucro em relação aos seus ativos líquidos, ou seja, seus ativos totais menos seus passivos totais. É uma medida mais específica de rentabilidade, pois considera apenas os recursos próprios da empresa. A rentabilidade do ativo líquido é calculada dividindo-se o lucro líquido pelo ativo líquido. Quanto maior a rentabilidade do ativo líquido, maior é a capacidade da empresa em gerar lucro com seus próprios recursos.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept11.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Rentabilidade das Vendas Operacionais</h4>
        <p>O conceito de rentabilidade das vendas operacionais refere-se à capacidade de uma empresa em gerar lucro a partir de suas atividades operacionais. Indica a eficiência da empresa em gerar retorno financeiro a partir das vendas de seus produtos ou serviços. A rentabilidade das vendas operacionais é calculada dividindo-se o lucro operacional pelo valor das vendas. Quanto maior a rentabilidade das vendas operacionais, mais lucrativas são as operações principais da empresa.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept12.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Rentabilidade das Vendas Líquidas</h4>
        <p>O conceito de rentabilidade das vendas líquidas refere-se à capacidade de uma empresa em gerar lucro em relação às suas vendas líquidas, ou seja, suas vendas totais menos os impostos e descontos concedidos. É uma medida mais precisa de rentabilidade, pois considera apenas o valor efetivo das vendas. A rentabilidade das vendas líquidas é calculada dividindo-se o lucro líquido pelo valor das vendas líquidas. Quanto maior a rentabilidade das vendas líquidas, mais lucrativas são as vendas realizadas pela empresa após considerar os impostos e descontos.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept13.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Prazo Médio de Pagamentos</h4>
        <p>O conceito de prazo médio de pagamentos refere-se ao tempo médio que uma empresa leva para efetuar o pagamento de suas obrigações. Indica a eficiência da empresa em gerenciar seu fluxo de caixa e honrar seus compromissos dentro do prazo estabelecido. O prazo médio de pagamentos é calculado dividindo-se o valor das contas a pagar pelo valor médio das compras a prazo. Quanto menor o prazo médio de pagamentos, mais ágil é a empresa no cumprimento de suas obrigações financeiras.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept14.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Prazo Médio de Recebimentos</h4>
        <p>O conceito de prazo médio de recebimentos refere-se ao tempo médio que uma empresa leva para receber o pagamento de suas vendas. Indica a eficiência da empresa em receber seus valores a receber dentro do prazo estabelecido. O prazo médio de recebimentos é calculado dividindo-se o valor das contas a receber pelo valor médio das vendas a prazo. Quanto menor o prazo médio de recebimentos, mais ágil é a empresa na obtenção dos recursos provenientes de suas vendas.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept15.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Estrutura de Capitais</h4>
        <p>O conceito de estrutura de capitais refere-se à composição e proporção das diferentes fontes de financiamento utilizadas por uma empresa para obter recursos. Inclui a proporção de capital próprio e de capital de terceiros, como empréstimos e financiamentos. A estrutura de capitais afeta a solidez financeira, a rentabilidade e o risco da empresa. Uma estrutura de capitais equilibrada busca maximizar o retorno aos acionistas e minimizar os custos financeiros.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept16.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Ponto de Equilíbrio</h4>
        <p>O conceito de ponto de equilíbrio refere-se ao nível de vendas em que uma empresa não tem lucro nem prejuízo. Indica o volume mínimo de vendas necessário para cobrir todos os custos e despesas operacionais. O ponto de equilíbrio é calculado considerando-se os custos fixos, os custos variáveis e o preço de venda por unidade. Conhecer o ponto de equilíbrio ajuda a empresa a estabelecer metas de vendas e a tomar decisões estratégicas para alcançar a lucratividade.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept17.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Margem de Contribuição</h4>
        <p>O conceito de margem de contribuição refere-se à diferença entre o preço de venda de um produto ou serviço e seus custos e despesas variáveis. Indica a quantidade de recursos disponíveis para cobrir os custos fixos e gerar lucro. A margem de contribuição é calculada dividindo-se a diferença entre o preço de venda e os custos e despesas variáveis pelo preço de venda. Quanto maior a margem de contribuição, maior é a quantidade de recursos disponíveis para cobrir os custos fixos e gerar lucro.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept18.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de Margem Líquida</h4>
        <p>O conceito de margem líquida refere-se à proporção do lucro líquido em relação às vendas totais. Indica a rentabilidade líquida da empresa, ou seja, a porcentagem de lucro obtida em relação às vendas após o pagamento de todas as despesas e impostos. A margem líquida é calculada dividindo-se o lucro líquido pelas vendas totais. Quanto maior a margem líquida, mais rentável é a empresa em relação às suas vendas.</p>`;
    let myModal = new bootstrap.Modal(modal);
    myModal.show();
    });

    concept19.addEventListener('click', i => {
    i.preventDefault();
    let modal = document.getElementById('modal-Conceito');
    modal.querySelector('.modal-body').innerHTML = `
        <h4 class="modal-title">Conceito de EBITDA</h4>
        <p>O conceito de EBITDA (Earnings Before Interest, Taxes, Depreciation and Amortization) refere-se ao lucro operacional de uma empresa antes dos descontos de juros, impostos, depreciação e amortização. É uma medida amplamente utilizada para avaliar o desempenho operacional e a geração de caixa de uma empresa. O EBITDA fornece uma visão mais precisa da capacidade de uma empresa em gerar lucro a partir de suas operações principais, excluindo os efeitos financeiros e contábeis. É especialmente útil para comparar o desempenho de empresas de diferentes setores e com estruturas de capital diferentes.</p>`;
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
            modal.querySelector('.modal-body').innerHTML += `
            <p>Uma liquidez geral superior a 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto prazo. Quanto maior a liquidez geral, maior é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }else if(ratio_liquidez_geral < 100){
            modal.querySelector('.modal-body').innerHTML += `
            <p>Uma liquidez geral inferior a 100% indica que a empresa não possui recursos suficientes para liquidar suas dívidas de curto prazo. Quanto menor a liquidez geral, menor é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML += `
            <p>Uma liquidez geral de 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto prazo. Quanto maior a liquidez geral, maior é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation2.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML += `
        <h4 class="modal-title">Interpretação de Liquidez Reduzida</h4>`
        // em percentagem
        if(ratio_liquidez_reduzida > 100){
            modal.querySelector('.modal-body').innerHTML += `
            <p>Uma liquidez reduzida superior a 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto prazo utilizando apenas seus ativos mais líquidos. Quanto maior a liquidez reduzida, maior é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }else if(ratio_liquidez_reduzida < 100){
            modal.querySelector('.modal-body').innerHTML += `
            <p>Uma liquidez reduzida inferior a 100% indica que a empresa não possui recursos suficientes para liquidar suas dívidas de curto prazo utilizando apenas seus ativos mais líquidos. Quanto menor a liquidez reduzida, menor é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }else{
            modal.querySelector('.modal-body').innerHTML += `
            <p>Uma liquidez reduzida de 100% indica que a empresa possui recursos suficientes para liquidar suas dívidas de curto prazo utilizando apenas seus ativos mais líquidos. Quanto maior a liquidez reduzida, maior é a capacidade da empresa em honrar seus compromissos de curto prazo.</p>`;
        }
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation3.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = 'autonomiafinanceira interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation4.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = 'solvabilidade interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation5.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = 'coberturaanc interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation6.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = 'coberturaanc interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation7.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML =
            'custosfinanciamento interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation8.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML =
            'pressaofinanceira interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation9.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML =
            'rentabilidadeativo interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation10.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML =
            'rentabilidadeativoliquido interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation11.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML =
            'rentabilidadevendasoperacionais interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation12.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML =
            'rentabilidadevendasliquida interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation13.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML =
            'alavancagemfinanceira interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation14.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body').innerHTML = 'rentabilidadecp interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation15.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body')
            .innerHTML = 'prazomediorecebimentos interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation16.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body')
            .innerHTML = 'prazomediopagamentos interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation17.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body')
            .innerHTML = 'prazomediorotacaoinventarios interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation18.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body')
            .innerHTML = 'rotacaodoativo interpretação';
        let myModal = new bootstrap.Modal(modal);
        myModal.show();
    });

    interpretation19.addEventListener('click', i => {
        i.preventDefault();
        let modal = document.getElementById('modal-Interpretação');
        modal.querySelector('.modal-body')
            .innerHTML = 'coeficientevab interpretação';
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