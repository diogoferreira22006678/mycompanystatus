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
    <div class="col-md-6 col-xl-3 mb-4"></div>
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
    
{{--     
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-info py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Tasks</span></div>
                        <div class="row g-0 align-items-center">
                            <div class="col-auto">
                                <div class="text-dark fw-bold h5 mb-0 me-3"><span>50%</span></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="visually-hidden">50%</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-warning py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Pending Requests</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span>18</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
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
                        <i class="fas fa-circle text-primary"></i> &nbsp;Capital Próprio
                    </span>
                    <span class="me-2">
                        <i class="fas fa-circle text-success"></i> &nbsp;Capital Alheio
                    </span>
                </div>                        
            </div>
        </div>
    </div>

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
                        <i class="fas fa-circle text-primary"></i> &nbsp;Capital Próprio
                    </span>
                    <span class="me-2">
                        <i class="fas fa-circle text-success"></i> &nbsp;Capital Alheio
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
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Liquidez Reduzida</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_liquidez_reduzida}}</span></div>
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
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Liquidez Reduzida</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ $ratio_liquidez_reduzida}}</span></div>
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
    <div class="col-lg-7 col-xl-8">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary fw-bold m-0">Earnings Overview</h6>
                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area"><canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;padding&quot;:20}}]}}}"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary fw-bold m-0">Revenue Sources</h6>
                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area"><canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Direct&quot;,&quot;Social&quot;,&quot;Referral&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;50&quot;,&quot;30&quot;,&quot;15&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}"></canvas></div>
                <div class="text-center small mt-4"><span class="me-2"><i class="fas fa-circle text-primary"></i>&nbsp;Direct</span><span class="me-2"><i class="fas fa-circle text-success"></i>&nbsp;Social</span><span class="me-2"><i class="fas fa-circle text-info"></i>&nbsp;Refferal</span></div>
            </div>
        </div>
    </div>
</div>
<hr>
<h6 class="text-primary fw-bold m-0">Rácios de actividade ou de gestão</h6>
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