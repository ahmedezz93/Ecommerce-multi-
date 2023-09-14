@if (session()->has('created'))
<div class="alert alert-success">
    {{ session('created') }}
</div>
@endif

@if (session()->has('updated'))
<div class="alert alert-info">
    {{ session('updated') }}
</div>
@endif

@if (session()->has('deleted'))
<div class="alert alert-danger">
    {{ session('deleted') }}
</div>
@endif

@if (session()->has('wrong'))
<div class="alert alert-warning">
    {{ session('wrong') }}
</div>
@endif
