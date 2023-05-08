@extends('_layouts.layout', 
['title' => 'Reports'])

@section('body')

<!-- Heading mentioning that u don't have any companies and to add one on My Companies Tab -->
<div class="container-fluid" style="background-color: #f8f9fc;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron shadow-sm" style="background-color: #4e73df; color: white; padding: 50px;">
                    <h1 class="display-4">You don't have any companies!</h1>
                    <p class="lead">Add a company on the My Companies tab.</p>
                    <hr class="my-4">
                    <p>Once you add a company, you will be able to see its financial data and reports.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection