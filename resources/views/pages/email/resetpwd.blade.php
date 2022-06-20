@extends('layout_view.layout_index')

@section('title', __('Forget_link'))

@section('content')
	<div class="p-3">
	<h5 class="mb-4">{{ __('forget-mess') }}</h5>
	<hr class="pt-1">
	<div class="account p-3">
		<div class="showErr text-danger pb-1">
			@if(session()->has('msg'))
				<div class="alert alert-danger ps-3 pe-3 pt-1 pb-1" role="alert">
				  {!! session('msg') !!}
				</div>
			@else
			@endif
		</div>
		<form class="mt-0 mt-md-1 ps-3 ps-md-5 pe-3" action="{{ route('reset-save-pass') }}" method="post" accept-charset="utf-8">
			@csrf
			<input type="hidden" name="token" value="{{ $token }}">
			<input type="hidden" name="name" value="{{ $name }}">
			<div class="mb-3 row align-items-center">
			   <label for="password" class="col-sm-4 col-form-label text-md-end">{{ __('New_password') }}</label>
			    <div class="col-sm-6">
			      <input type="password" name="password" class="form-control" id="password" placeholder="*******">
			   </div>
			</div>
			<div class="mb-3 row align-items-center">
			   <label for="password_sam" class="col-sm-4 col-form-label text-md-end">{{ __('Re_passwordnew') }}</label>
			    <div class="col-sm-6">
			      <input type="password" name="password_sam" class="form-control" id="password_sam" placeholder="*******">
			   </div>
			</div>
			<div class="row">
				<div class="col-md-3 mt-1 offset-md-4">
					<button type="submit" class="btn w-100">{{ __('Change') }}</button>
				</div>
				<div class="col-md-3 mt-1 text-start">
					<a href="{{ route('login') }}" class="btn w-100">{{ __('Back') }}</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection