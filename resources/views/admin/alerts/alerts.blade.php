@if ($errors->any())
<div class="alert alert-warning">
    @foreach ($errors->all() as $error)
    <span class="d-block"><b>{{$error}}</b></span>
    @endforeach
</div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info">
        {{session('info')}}
    </div>
@endif