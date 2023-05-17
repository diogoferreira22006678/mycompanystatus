@extends('_layouts.layout', [
    'title' => 'Companies'
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
                        <h2>Your <b>Companies</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a id="addButton" data-bs-target="#addModal" class="btn" data-bs-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Company</span></a>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
            <table id="dt" datatable ajax-url="/api/table/companies/{{ $user->user_id }}" ajax-id="company_id" datatable-hide="-1">
                <thead>
                <tr>
                            <th dt-name="company_id">Id</th>
                            <th dt-name="category_name">Name</th>
                            <th dt-name="sector_id">Sector</th>
                            <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>
            <script id="dt-template" type="text/template">
                <tr option-key="${company_id}">
                    <td>${company_id}</td>
                    <td>${company_name}</td>
                    <td>${sector.sector_name}</td>
                    <td id="optionFilms">
                        <a id="optionEdit" option="edit" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
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
    'title' => 'Create Company',
    'close' => true,
 ])
    <form id="form-create">
        <input type="hidden" name="user_id" value="{{ $user->user_id }}">
        <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="company_name" required>
        </div>
        <div class="form-group">
            <label for="phone" class="col-form-label">Phone:</label>
            <input type="number" class="form-control" name="company_phone" required>
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" class="form-control" name="company_email" required>
        </div>
        <div class="form-group">
            <label for="website" class="col-form-label">Website:</label>
            <input type="text" class="form-control" name="company_website" required>
        </div>
        <div class="form-group">
            <div><label for="sectors_id" class="col-form-label">Sector:</label></div>
        @component('_components.formSelect',[
            'required' => true,
            'class' => '',
            'attributes' => 'ajax-url="/api/select/sectors"',
            'name' => 'sector_id',
            'placeholder' => 'Select the Sector that this Company belongs to',
            'array' => [],
            'key' => 'id',
            'value' => 'title'
            ])
        @endcomponent
        </div>
        <!-- Checkbox to ask if u want to make your company public -->
        <div class="form-group">
            <label for="public" class="col-form-label">Do you want to share your data?</label>
            <!-- checkbox using bootstrap -->
            <div class="form-check .form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="private" value="private" checked>
                <label class="form-check-label" for="private">
                  Private
                </label>
            </div>
            <div class="form-check .form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="public" value="public">
                <label class="form-check-label" for="public">
                  Public
                </label>
            </div>
        </div>
    </form>      
    @slot('footer')
    <input type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" value="Cancel" id="cancelButton">
    <input type="submit" class="btn btn-success text-white" form="form-create" value="Add">
    @endslot
@endComponent    

<!-- Edit Modal HTML -->
@component('_components.cardModal',[
    'id' => 'modalEdit',
    'class' => 'modal-success',
    'title' => 'Edit Company',
    'close' => true,
 ])
    <form id="form-edit">
        <input type="hidden" name="company_id" />
        <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="company_name" required>
        </div>
        <div class="form-group">
            <label for="phone" class="col-form-label">Phone:</label>
            <input type="number" class="form-control" name="company_phone" required>
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" class="form-control" name="company_email" required>
        </div>
        <div class="form-group">
            <label for="website" class="col-form-label">Website:</label>
            <input type="text" class="form-control" name="company_website" required>
        </div>
        <div class="form-group">
            <div><label for="sectors_id" class="col-form-label">Sector:</label></div>
        @component('_components.formSelect',[
            'required' => true,
            'class' => '',
            'attributes' => 'ajax-url="/api/select/sectors" fill=sector:sector_id|sector_name',
            'name' => 'sector_id',
            'placeholder' => 'Select the Sector that this Company belongs to',
            'array' => [],
            'key' => 'id',
            'value' => 'title'
            ])
        @endcomponent
        </div>
        <!-- Checkbox to ask if u want to make your company public -->
        <div class="form-group">
            <label for="public" class="col-form-label">Do you want to share your data?</label>
            <!-- checkbox using bootstrap -->
            <div class="form-check .form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="private" value="private" checked>
                <label class="form-check-label" for="private">
                  Private
                </label>
            </div>
            <div class="form-check .form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="public" value="public">
                <label class="form-check-label" for="public">
                  Public
                </label>
            </div>
        </div>
    </form>      
    @slot('footer')
    <input type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" value="Cancel" id="cancelButton">
    <input type="submit" class="btn btn-success text-white" form="form-edit" value="Add">
    @endslot
@endComponent

<!-- Delete Modal HTML -->
@component('_components.cardModal', [
			'id' => 'modalDelete',
			'class' => 'modal-success',
			'title' => 'Delete Company',
			'close' => true
		])
    <form id="form-delete" >
		<input type="hidden" name="company_id" />
        <div class="modal-body">
            <p>Do you really want to delete this Company?</p>
            <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="company_name" disabled>
            </div>
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
            i.preventDefault();
            $.ajax({
                data : $(formCreate).serialize(),
                url : "{{ route('companies.createCompanies') }}",
                type : "POST",
                success : function(response) {
                    $('#addModal').modal('hide');    
                	dt.refresh();
                    toastr.success('Company Added Successfully!');
                },
                error : function(error) {
                    console.log(error);
                    alert('Error Adding Company!' + error.statusText);
                } 
            });
        });

        let modalEdit = document.getElementById('modalEdit');
	    let $modalEdit = $(modalEdit);
        let formEdit = document.getElementById('form-edit');
        formEdit.addEventListener('submit', i => {
            i.preventDefault();
            $.ajax({
                data : $(formEdit).serialize(),
                url : "{{ route('companies.editCompanies') }}",
                type : "POST",
                success : function(response) {
                    console.log(response);
                    $('#modalEdit').modal('hide');    
		        	dt.refresh();
                    toastr.success('Company Changed Successfully!');
                },
                error : function(error) {
                    console.log(error);
                    alert('Error Changing Company!' + error.statusText);
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
                url : "{{ route('companies.deleteCompanies') }}",
                type : "POST",
                success : function(response) {
                    console.log(response);
                    $('#modalDelete').modal('hide');
                    dt.refresh();
                    toastr.success('Company Deleted Successfully!');
                },
                error : function(error) {
                    console.log(error);
                    alert('Error Deleting Company!' + error.statusText);
                } 
            });
        });
        
        window.addEventListener('option-click', e => {
        let key = e.key;
        let option = e.option;
        let object = dt.ajaxJson.index[key];
        switch(option){
            case 'edit': {
            console.log(object);
            Utils.fill_form(modalEdit, object, true);
            if(object.company_status == 1){
                // fill form modal with public
                modalEdit.querySelector('input[name="status"][value="public"]').checked = true;
            }else{
                // fill form modal with private
                modalEdit.querySelector('input[name="status"][value="private"]').checked = true;
            }
            $modalEdit.modal('show');
            break;
            }
            case 'delete': {
                
            Utils.fill_form(modalDelete, object, true);
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