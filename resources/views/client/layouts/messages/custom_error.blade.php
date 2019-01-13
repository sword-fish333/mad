@if(session()->has('error'))
    <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        {{session()->get('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif