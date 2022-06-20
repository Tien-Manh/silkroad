@extends('layout_view.layout_index')
@section('title', __('Register'))
@section('content')
	<div class="p-3">
		<h5 class="mb-2">{{ __('Register') }}</h5>
	<hr class="pt-1">
	<div class="account p-2">
		<div class="showErr text-danger pb-1">
			@if(session()->has('msg'))
				<div class="alert alert-danger ps-3 pe-3 pt-1 pb-1" role="alert">
				  {!! session('msg') !!}
				</div>
			@else
			@endif
		</div>
		<form class="mt-1 ps-3 ps-md-5 pe-3 pe-md-5" method="POST" autocomplete="off" action="{{ route('post-register') }}">
			@csrf
		    <div class="mb-2 row">
			    <label for="account" class="col-sm-4 col-form-label text-md-end">{{ __('Username') }}</label>
			    <div class="col-sm-6">
			      <input type="text" name="username" class="form-control" value="{{ old('username') }}" id="account" placeholder="{{ __('Username') }}">
			      <span id="passwordHelpInline" class="form-text">{{ __('Must_characters_long') }}</span>
			    </div>
			</div>
			<div class="mb-2 row">
			    <label for="inputPassword" class="col-sm-4 col-form-label text-md-end">{{ __('Password') }}</label>
			    <div class="col-sm-6">
			      <input type="password" name="password" class="form-control" id="inputPassword" placeholder="*******">
			      <span id="passwordHelpInline" class="form-text">{{ __('Must_pass_long') }}</span>
			   </div>
			</div>
			<div class="mb-2 row">
			    <label for="inputPassword_sam" class="col-sm-4 col-form-label text-md-end">{{ __('Re_password') }}</label>
			    <div class="col-sm-6">
			      <input type="password" name="password_sam" class="form-control" id="inputPassword_sam" placeholder="*******">
			      <span id="passwordHelpInline" class="form-text">{{ __('Enterpassword') }}</span>
			   </div>
			</div>
			<div class="mb-2 row">
			    <label for="phone" class="col-sm-4 col-form-label text-md-end">{{ __('phone') }}</label>
			    <div class="col-sm-6">
			      <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="{{ __('phone') }}">
			    <span id="passwordHelpInline" class="form-text">{{ __('Optional') }}</span>
			    </div>
			</div>
			<div class="mb-2 row">
			    <label for="gmail" class="col-sm-4 col-form-label text-md-end">{{ __('gmail') }}</label>
			    <div class="col-sm-6">
			      <input type="text" name="gmail" value="{{ old('gmail') }}" class="form-control" id="gmail" placeholder="{{ __('gmail') }}">
			      <span id="passwordHelpInline" class="form-text">{{ __('Email_op') }}</span>
			    </div>
			</div>
			<div class="row">
				<div class="col-md-3 offset-md-4 mt-1">
					<button type="submit" class="btn w-100">{{ __('Register') }}</button>
				</div>
				<div class="col-md-3 mt-1 text-md-start">
					<a href="{{ route('login') }}" class="btn w-100" title="">{{ __('Login') }}</a>
				</div>
			</div>
		</form>
	</div>
	</div>
@endsection