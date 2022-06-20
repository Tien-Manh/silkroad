@extends('layout_view.layout_index')
@section('title', __('fix_char'))
@section('content')
	<div class="p-3">
		<h5 class="mb-4">{{ __('fix_char') }}</h5>
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
		<form class="mt-0 mt-md-1 ps-3 ps-md-5 pe-3" action="{{ route('post-stuck') }}" method="post" accept-charset="utf-8">
			@csrf
		    <div class="mb-3 row">
		    	<label for="phone" class="col-sm-3 col-form-label text-md-end">{{ __('select_char') }}</label>
			    <div class="col-sm-6">
				    <select class="form-select" aria-label="Default select example" name="name_char">
				    	@if(count($charNames) > 0)
					    	@foreach($charNames as $charName)
					    		<option value="{{ $charName->CharName16 }}">{{ $charName->CharName16 }}</option>
					    	@endforeach
				    	@else
				    		<option value="0">{{ __('not_char') }}</option>
				    	@endif
					</select>
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