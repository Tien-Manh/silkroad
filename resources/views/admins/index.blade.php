@extends('layout_admin.index')
@section('content')
	<div class="col-6 d-lg-flex h-100 my-auto mt-5 mt-md-0 pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
		<div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url({{ asset('admin/assets/img/illustrations/illustration-signup.jpg') }}); background-size: cover;">
		</div>
	</div>
	<div class="col-6 d-lg-flex h-100 mt-5 mt-md-0 my-auto pe-0 position-absolute top-0 end-1 text-center justify-content-center flex-column">
		<div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url({{ asset('admin/assets/img/illustrations/illustration-signup.jpg') }}); background-size: cover;">
		</div>
	</div>
@endsection