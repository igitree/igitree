@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert">
      <strong>Error!</strong> {{ session('error') }}.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fixed-top" role="alert">
      <strong>Success!</strong> {{ session('success') }}.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif  