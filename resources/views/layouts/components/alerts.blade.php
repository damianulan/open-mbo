<div class="container-fluid" id="alert-container">
@if (session('success'))
<div class="row justify-content-center my-2">
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
</div>
@endif
@if (session('error'))
<div class="row justify-content-center my-2">
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! session('error') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
</div>
@endif
@if (session('warning'))
<div class="row justify-content-center my-2">
    <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {!! session('warning') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
</div>
@endif
@if (session('info'))
<div class="row justify-content-center my-2">
    <div class="col-md-12">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {!! session('info') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
</div>
@endif
@if (session('alert-primary'))
<div class="row justify-content-center my-2">
    <div class="col-md-12">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {!! session('alert-primary') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
</div>
@endif
@if (session('alert-other'))
<div class="row justify-content-center my-2">
    <div class="col-md-12">
        <div class="alert alert-other alert-dismissible fade show" role="alert">
            {!! session('alert-other') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
</div>
@endif
</div>
