@extends('layout_view.layout_index')

@if(Auth::user())
	@section('title', __('Account'))
@else
	@section('title', __('Login'))
@endif

@section('content')
<div class="p-3">
	@if(Auth::user())
	<h5 class="mb-3">{{ __('Account') }}</h5>
	@else
	<h5 class="mb-3">{{ __('Login') }}</h5>
	@endif
	<hr class="pt-1">
	<div class="account p-2">
	<div class="showErr text-danger">
		@if(session()->has('msg'))
		<div class="alert alert-danger ps-3 pe-3 pt-1 pb-1" role="alert">
		  {{ session('msg') }}
		</div>
		@else
		@endif
	</div>
	@if(Auth::user())
		<p>{{ __('welcome') }}: <b> {{ Auth::user()->StrUserID }}</b></p>
		<div class="row infomt">
			<div class="col-md-6">
					<ul class="list-group">
					  <li class="list-group-item mt-1 shadow">Silk: 
					  	<span> 
					  		@if($silks)
					  		<b>{{ number_format($silks->silk_own,0,0,'.') }}</b>
					  		@else
					  		{{ 0 }}
					  		@endif
					  	   <i class="fas fa-coins"></i>
					  	</span>
					  </li>
					   <li class="list-group-item mt-1 shadow">Silk gift: 
					  	<span> 
					  		@if($silks)
					  		<b>{{ number_format($silks->silk_gift,0,0,'.') }}</b>
					  		@else
					  		{{ 0 }}
					  		@endif
					  	   <i class="fas fa-coins"></i>
					  	</span>
					  </li>
					  </li>
					   <li class="list-group-item mt-1 shadow">Silk point: 
					  	<span> 
					  		@if($silks)
					  		<b>{{ number_format($silks->silk_point,0,0,'.') }}</b>
					  		@else
					  		{{ 0 }}
					  		@endif
					  	   <i class="fas fa-coins"></i>
					  	</span>
					  </li>
					  @if($charNames)
						  <li class="list-group-item mt-1 shadow">{{ __('chars') }}
						  	<ul class="list-group">
						  		@foreach($charNames as $char)
						  			<li class="list-group-item mt-1 shadow">
						  				{{ __('name') }}: <b>{{ $char->CharName16 }}</b>
						  				<span>{{ __('Level') }}: <b>{{ $char->CurLevel }}</b></span>
						  				<div class="mt-1">{{ __('Gold') }}: 
						  					<span><b>{{ number_format($char->RemainGold, 0, 0, '.') }}</b></span>
						  				</div>
						  			</li>
						  		@endforeach
						  	</ul>
						  </li>
					  @endif
					</ul>
				<div class="col-md-3 mt-3 mb-2 float-end">
					<a href="{{ route('logout') }}" class="btn">{{ __('Logout') }}</a>
				</div>
			</div>
			<div class="col-md-6 prop">
				<ul class="list-group">
					<li class="list-group-item mt-1 shadow">
						<a href="{{ route('change-pass') }}">{{ __('change_pass') }}</a>
					</li>
					<li class="list-group-item mt-1 shadow">
						<a href="{{ route('change-phone') }}">{{ __('change_phone') }}</a>
					</li>
					<li class="list-group-item mt-1 shadow">
						<a href="{{ route('change-email') }}">{{ __('change_email') }}</a>
					</li>
				{{-- 	<li class="list-group-item mt-1 shadow">
						<a href="#">{{ __('account_protection') }}</a>
					</li> --}}
					<li class="list-group-item mt-1 shadow">
						<a href="{{ route('stuck-char') }}">{{ __('account_stuck') }}</a>
					</li>
				</ul>
			</div>
		</div>
	@else
		<form autocomplete="off" class="mt-3 ps-3 ps-md-5 pe-3 pe-md-5" method="POST" action="{{ route('post-login') }}">
			@csrf
			<div class="row g-3 align-items-center mb-4">
                <div class="col-md-4 text-md-end">
                    <label for="account" class="col-form-label">{{ __('Username') }}</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="StrUserID" class="form-control" id="account" placeholder="{{ __('Username') }}">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-4">
                <div class="col-md-4 text-md-end">
                    <label for="inputPassword" class="col-form-label">{{ __('Password') }}</label>
                </div>
                <div class="col-md-6">
                     <input type="password" name="password" class="form-control" id="inputPassword" placeholder="*******">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
            	<div class="col-md-4 text-md-end"></div>
            	<div class="col-md-3">
					<button type="submit" class="btn w-100">{{ __('Submit_log') }}</button>
				</div>
				<div class="col-md-3">
					<a href="{{ route('register') }}" class="btn w-100" title="">{{ __('Register') }}</a>
				</div>
            </div>
			<div class="row align-items-center">
				<div class="col-md-6 offset-md-4">
					<p class="pb-1"><a href="{{ route('forget') }}">{{ __('Forget_pass') }}</a> </p>
				</div>
			</div>
		</form>
	@endif
</div>
</div>
@endsection