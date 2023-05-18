@extends('_layouts.layout', [
    'title' => 'Reports'
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
                    <h2>Your <b>{{ $company->company_name }} Reports</b></h2>
                </div>
                <div class="col-sm-6">
                    <a id="addButton" data-bs-target="#addModal" class="btn" data-bs-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Report</span></a>
                </div>
            </div>
        </div>


        <div class="table-responsive">
        <table id="dt" datatable ajax-url="/api/table/reports/{{ $company->company_id }}" ajax-id="report_id" datatable-hide="-1">
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
                    <a id="optionView" href="{{ url('/') }}/dashboard/{{ $company->company_id }}/reports/${report_year}" option="view" class="view" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="View">&#xE417;</i></a>
                    <a id="optionDelete" option="delete" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
    </script>
    </div>
</div>

 <!-- Create Modal HTML -->
 @component('_components.cardModal',[
    'id' => 'addModal',
    'class' => 'modal-success',
    'title' => 'Create Report',
    'close' => true,
 ])
    <form id="form-create">
        <input type="hidden" name="company_id" value="{{ $company->company_id }}"/>
        <div class="form-group">
            <label for="year" class="col-form-label">Year:</label>
            <input type="number" class="form-control" name="report_year" required>
        </div>
        <div class="form-group">
            <label>Excel</label>
            <input type="file" name="file" class="form-control" />
        </div>
    </form>      
    @slot('footer')
    <input type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" value="Cancel" id="cancelButton">
    <input type="submit" class="btn btn-success text-white" form="form-create" value="Add">
    @endslot
@endComponent    

<!-- Delete Modal HTML -->
@component('_components.cardModal', [
			'id' => 'modalDelete',
			'class' => 'modal-success',
			'title' => 'Delete Report',
			'close' => true
		])
    <form id="form-delete" >
		<input type="hidden" name="company_id" />
        <input type="hidden" name="report_id" />
        <div class="modal-body">
            <p>Do you really want to delete this Report?</p>
            <div class="form-group">
                <label>Company:</label>
                <input type="text" class="form-control" name="company_name" disabled>
            </div>
            <div class="form-group">
                <label>Year:</label>
                <input type="text" class="form-control" name="report_year" disabled>
            </div>
            <br>
                <p class="text-danger"><small>This action cannot be undone.</small></p>
        </div>
	</form>
    @slot('footer')
        <input type="button" class="btn btn" data-bs-dismiss="modal" value="Cancel" id="cancelButton">
        <input type="submit" class="btn btn-danger" form="form-delete" value="Delete">
    @endslot
@endComponent

@endsection

@section('scripts')
    <script>

        let modalCreate = document.getElementById('modalCreate');
        let $modalCreate = $(modalCreate);
        let formCreate = document.getElementById('form-create');

        formCreate.addEventListener('submit', i => {

            let file = formCreate.elements['file'].files[0];

            i.preventDefault();
            $.ajax({
                // add the file but also the company_id and report_year
                data : new FormData(formCreate),
                processData: false,
                contentType: false,
                url : "{{ route('reports.createReports') }}",
                type : "POST",
                success : function(response) {
                    $('#addModal').modal('hide');    
                	dt.refresh();
                    toastr.success('Report Added Successfully!');
                    // Clear form fields
                    $('#addModal').find('input').val('');
                },
                error : function(error) {
                    console.log(error);
                    alert('Error Adding Report!' + error.statusText);
                } 
            });
        });

        let modalDelete = document.getElementById('modalDelete');
        let $modalDelete = $(modalDelete);
        let formDelete = modalDelete.querySelector('form');
        formDelete.addEventListener('submit', i => {
            i.preventDefault();
            $.ajax({
                data : $(formDelete).serialize(),
                url : "{{ route('reports.deleteReports') }}",
                type : "POST",
                success : function(response) {
                    console.log(response);
                    $('#modalDelete').modal('hide');
                    dt.refresh();
                    toastr.success('Report Deleted Successfully!');
                },
                error : function(error) {
                    $('#modalDelete').modal('hide');
                    dt.refresh();
                    toastr.success('Report Deleted Successfully!');
                } 
            });
        });
        
        window.addEventListener('option-click', e => {
        let key = e.key;
        let option = e.option;
        let object = dt.ajaxJson.index[key];
        switch(option){
            case 'delete': {
                
            Utils.fill_form(modalDelete, object, true);
            modalDelete.querySelector('[name="company_name"]').value = object.company.company_name;
            $modalDelete.modal('show');
            break;
            }
        }
        });

        let form = document.getElementById('company-form');
        form.addEventListener('submit', i => {
            i.preventDefault();

            $company_id = form.elements['company_id'].value;

            // Redirect the user to Url /{company_id}/reports but always root
            window.location.href = "{{ url('/') }}/" + $company_id + "/reports";
        }); 

    </script>
@endsection