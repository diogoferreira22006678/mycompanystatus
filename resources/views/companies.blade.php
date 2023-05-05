@extends('_layouts.layout',
 ['title' => 'Companies'])

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
                    <a id="addButton" data-bs-target="#addModal" class="btn" data-bs-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar Nova Categoria</span></a>
                </div>
            </div>
        </div>


        <div class="table-responsive">
        <table id="dt" datatable ajax-url="/api/table/companies/{{ $user->user_id }}" ajax-id="company_id" datatable-hide="-1">
            <thead>
            <tr>
                    <th dt-name="company_id">Id</th>
                    <th dt-name="category_name">Name</th>
                    <th>Ações</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
        </div>
        <script id="dt-template" type="text/template">
            <tr option-key="${company_id}">
                <td>${company_id}</td>
                <td>${category_name}</td>
                <td id="optionFilms">
                    <a id="optionEdit" option="edit" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a id="optionDelete" option="delete" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
    </script>
    </div>
</div>

<!-- Add Modal HTML -->
@component('_components.cardModal',[
    'id' => 'addModal',
    'class' => 'modal-success',
    'title' => 'Add Company',
    'close' => true,
])
    <form id="form-create">
        <input type="hidden" name="user_id" value="{{ $user->user_id }}">
        <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="adress" class="col-form-label">Adress:</label>
            <input type="text" class="form-control" name="adress" required>
        </div>
        <div class="form-group">
            <label for="phone" class="col-form-label">Phone:</label>
            <input type="number" class="form-control" name="phone" required>
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="website" class="col-form-label">Website:</label>
            <input type="text" class="form-control" name="website" required>
        </div>

    </form>
    @slot('footer')
    <input type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" value="Cancelar" id="cancelButton">
    <input type="submit" class="btn btn-success text-white" form="form-create" value="Adicionar">
    @endslot
    
@endcomponent

 @endsection