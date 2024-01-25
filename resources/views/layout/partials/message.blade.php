@if ($message = Session::get('success'))
<div class="alert alert-success  alert-sm">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger  alert-sm">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning  alert-sm">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info  alert-sm">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
  <div class="alert alert-danger alert-sm">
    <ul class="">
      @foreach ($errors->all() as $error)
        <li class="">{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif