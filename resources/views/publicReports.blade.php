@extends('_layouts.layout', [
    'title' => 'Public Reports'
])

@section('head')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('body')

<div class="container mt-3">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Public Reports</b></h2>
                </div>
            </div>
        </div>


        <div class="table-responsive">
        <table id="dt" datatable ajax-url="/api/table/public/reports" ajax-id="report_id" datatable-hide="-1">
            <thead>
            <tr>
                        <th dt-name="report_id">Id</th>
                        <th dt-name="report_year">Year</th>
                        <th>Actions</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
        </div>
        <script id="dt-template" type="text/template">
            <tr option-key="${report_id}">
                <td>${report_id}</td>
                <td>${report_year}</td>
                <td id="optionFilms">
                    <a id="optionView" href="{{ url('/') }}/dashboard/${company_id}/reports/${report_year}" option="view" class="view" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="View">&#xE417;</i></a>
                </td>
            </tr>
    </script>
    </div>
</div>

@endsection
