
@extends('_layouts.layout', 
['title' => 'Profile'])

@section('body')
<div class="container-fluid">
    <h3 class="text-dark mb-4">Profile</h3>
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">User Photo</p>
                </div>
                <div class="card-body text-center shadow"><img id=profile-photo class="rounded-circle mb-3 mt-4" src="assets/img/dogs/image2.jpeg" width="160" height="160">
                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modal-photo">Change Photo</button></div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">       
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">User Settings</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="email"><strong>Email Address</strong></label><input class="form-control" type="email" id="email" placeholder="user@example.com" name="email"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" id="first_name" placeholder="John" name="first_name"></div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" id="last_name" placeholder="Doe" name="last_name"></div>
                                    </div>
                                </div>
                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for the photo upload  -->
@component('_components.cardModal' , [
    'id' => 'modal-photo',
    'class' => 'modal-success',
    'title' => 'Change Photo',
    'close' => true,
 ])
    <form id="form-photo" >
		<input type="hidden" name="user_id" />
		<div class="modal-body">
            <div class="form-group">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control" />
            </div>
		</div>
	</form>
    @slot('footer')
    <div class="mb-3"><button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modal-photo">Cancel</button></div>
    <div class="mb-3"><button type="submit" form="form-photo" class="btn btn-success btn-sm" style="color:white" type="button" data-bs-toggle="modal" data-bs-target="#modal-photo">Submit</button></div>
    @endslot
@endComponent
@endsection

@section('scripts')
<script>

    let modalPhoto = document.getElementById('modal-photo');
    let $modalPhoto = $(modalPhoto);
    let formPhoto = document.getElementById('form-photo');
    formPhoto.addEventListener('submit', i=>{
        i.preventDefault();
        console.log(formPhoto)
        $.ajax({
            type: 'POST',
            data: new FormData(formPhoto),
            url: '{{ route('users.alterPhoto') }}',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data){
                    $modalPhoto.modal('hide');
                    toastr.success(data.message);
            },
            error: function (data){
                $modalPhoto.modal('hide');
                toastr.error(data.message);
            }
        })
    });

    

    // get user looged in
    let user = @json($user);
    
    // get user_id
    let user_id = user.user_id;


    // ajax request to get user data
    $.ajax({
        type: 'GET',
        data: {user_id: user_id},
        url: '{{ route('users.getPhoto') }}',
        success: function (data){
            console.log(data);
            let photo = data.photo;

            // Get element profile-photo
            let profilePhoto = document.getElementById('profile-photo');

            // Set the src attribute of the image to the photo on storage/app/public/profile-photos/$photo
            profilePhoto.innerHTML = `<img class="rounded-circle mb-3 mt-4" src="storage/app/public/profile-photos/${photo}" width="160" height="160">`;

        },
        error: function (data){
            console.log(data);
        }
    })
</script>
@endsection