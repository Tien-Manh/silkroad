@extends('layout_view.layout_index')
@section('title', __('Forget_link'))

@section('content')
<div class="p-3">
	<h5 class="mb-3">{{ __('Forget_link') }}</h5>
	<hr class="pt-1">
	<div class="account p-2">
		<div class="showErr text-danger">
			@if(session()->has('msg'))
				<div class="alert alert-danger ps-3 pe-3 pt-1 pb-1" role="alert">
				  {!! session('msg') !!}
				</div>
			@else
			@endif
		</div>
	</div>
	<form autocomplete="off" class="mt-3 ps-3 ps-md-5 pe-3 pe-md-5" method="POST" action="{{ route('post-forget-email') }}">
			@csrf
			<div class="row g-3 align-items-center mb-4">
                <div class="col-md-4 text-md-end">
                    <label for="username" class="col-form-label">{{ __('Username') }}</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="username" class="form-control" id="username" placeholder="{{ __('Username') }}">
                </div>
            </div>
			<div class="row g-3 align-items-center mb-4">
                <div class="col-md-4 text-md-end">
                    <label for="account" class="col-form-label">{{ __('Email') }}</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="email" class="form-control" id="account" placeholder="{{ __('Email') }}">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
            	<div class="col-md-4 text-md-end"></div>
            	<div class="col-md-3">
					<button type="submit" class="btn w-100">{{ __('Send') }}</button>
				</div>
				<div class="col-md-3">
					<a href="{{ route('login') }}" class="btn w-100" title="">{{ __('Submit_log') }}</a>
				</div>
            </div>
		</form>
	</div>
@endsection