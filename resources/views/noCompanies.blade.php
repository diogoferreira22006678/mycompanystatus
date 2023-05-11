@extends('_layouts.layout', 
['title' => 'Reports'])

@section('body')

<!-- Heading mentioning that u don't have any companies and to add one on My Companies Tab -->
<div class="container-fluid" style="background-color: #f8f9fc;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron shadow-sm" style="background-color: #4e73df; color: white; padding: 50px;">
                    <h1 class="display-4">Please select a company to see its reports!</h1>
                    <p class="lead">Just click in the Go button after selecting a company.</p>
                    <hr class="my-4">
                    <p>If u dont have any companies, please add one on the My Companies tab.</p>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>

let form = document.getElementById('company-form');
    form.addEventListener('submit', i => {
        i.preventDefault();

        $company_id = form.elements['company_id'].value;

        // Redirect the user to Url /{company_id}/reports but always root
        window.location.href = "{{ url('/') }}/" + $company_id + "/reports";
});


</script>

@endsection