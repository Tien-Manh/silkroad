@extends('layout_view.layout_index')
@section('title', __('Change_phone'))
@section('content')
	<div class="p-3">
		<h5 class="mb-4">{{ __('Change_phone') }}</h5>
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
		<form class="mt-0 mt-md-1 ps-3 ps-md-5 pe-3" action="{{ route('post-phone') }}" method="post" accept-charset="utf-8">
			@csrf
		    <div class="mb-3 row align-items-center">
		    	<label for="phone" class="col-sm-3 col-form-label text-md-end">{{ __('new_phone') }}</label>
			    <div class="col-sm-6">
			      <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="{{ __('new_phone') }}">
			    </div>
			</div>
		    <div class="mb-3 row align-items-center">
			    <label for="inputPassword" class="col-sm-3 col-form-label text-md-end">{{ __('Password') }}</label>
			    <div class="col-sm-6">
			      <input type="password" name="password" class="form-control" id="inputPassword_sam" placeholder="*******">
			   </div>
			</div>
		    <div class="mb-3 row align-items-center">
			    <label for="gmail" class="col-sm-3 col-form-label text-md-end">{{ __('gmail') }}</label>
			    <div class="col-sm-6">
			      <input type="text" name="gmail" value="{{ old('gmail') }}" class="form-control" id="gmail" placeholder="{{ __('gmail') }}">
			    </div>
			</div>
			<div class="row">
				<div class="col-md-3 mt-1 offset-md-3 text-start">
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