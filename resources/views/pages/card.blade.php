@extends('layout_view.layout_index')

@if(Auth::user())
	@section('title', __('Card'))
@else
	@section('title', __('Login'))
@endif

@section('content')
<div class="p-3">
	@if(Auth::user())
	<h5 class="mb-3">{{ __('Card') }}</h5>
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
			<div class="showErr text-danger pb-1">
				@if(session()->has('msg'))
					<div class="alert alert-danger ps-3 pe-3 pt-1 pb-1" role="alert">
					  {!! session('msg') !!}
					</div>
				@else
				@endif
			</div>
			@if($textDate != '')
			<h6 class="ps-5 pe-5 pt-1 pb-1">{!! $textDate !!}</h6>
			@endif
			<h6 class="ps-5 text-danger pe-5 pt-1 pb-1">{{ __('Attention') }}</h6>
			<form autocomplete="off" class="mt-3 ps-3 ps-md-5 pe-3 pe-md-5" action="{{ route('post-card') }}" method="post" accept-charset="utf-8">
				@csrf
				<div class="mb-3 row">
					<label for="phone" class="col-sm-3 col-form-label">{{ __('card_type') }}</label>
					<div class="col-sm-9">
						<select class="form-select" name="type_card">
						  <option selected disabled>{{ __('selected_card') }}</option>
						  <option @if(old('type_card') == 1) selected @endif value="1">Viettel</option>
						  <option @if(old('type_card') == 2) selected @endif value="2">Mobifone</option>
						  <option @if(old('type_card') == 3) selected @endif value="3">Vinaphone</option>
						</select>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="phone" class="col-sm-3 col-form-label">{{ __('amount_type') }}</label>
					<div class="col-sm-9">
						<select class="form-select" name="amount">
						  <option selected disabled="">{{ __('selected_amonut') }}</option>
						  <option @if(old('amount') == 10000) selected @endif value="10000">10.000</option>
						  <option @if(old('amount') == 20000) selected @endif value="20000">20.000</option>
						  <option @if(old('amount') == 30000) selected @endif value="30000">30.000</option>
						  <option @if(old('amount') == 50000) selected @endif value="50000">50.000</option>
						  <option @if(old('amount') == 100000) selected @endif value="100000">100.000</option>
						  <option @if(old('amount') == 200000) selected @endif value="200000">200.000</option>
						  <option @if(old('amount') == 300000) selected @endif value="300000">300.000</option>
						  <option @if(old('amount') == 500000) selected @endif value="500000">500.000</option>
						  <option @if(old('amount') == 1000000) selected @endif value="1000000">1000.000</option>
						</select>
					</div>
				</div>
			    <div class="mb-3 row">
			    	<label for="card_code" class="col-sm-3 col-form-label">{{ __('card_code') }}</label>
				    <div class="col-sm-9">
				      <input type="number" name="card_code" value="{{ old('card_code') }}" class="form-control" id="card_code" placeholder="{{ __('card_code') }}">
				    </div>
				</div>
			 	<div class="mb-3 row">
			    	<label for="seri_number" class="col-sm-3 col-form-label">{{ __('seri_number') }}</label>
				    <div class="col-sm-9">
				      <input type="number" name="seri_number" value="{{ old('seri_number') }}" class="form-control" id="seri_number" placeholder="{{ __('seri_number') }}">
				    </div>
				</div>
				<div class="row">
					<div class="col-md-9 mt-3 offset-md-3 text-end">
						<button type="submit" class="btn w-100">{{ __('up_card') }}</button>
					</div>
				</div>
			</form>
			<hr>
			@if($rescar)
				<div class="rank mt-4">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-responsive table-bordered table-striped table-inverse">
								<thead>
									<tr>
										<th>{{ __('amount_type') }}</th>
										<th>{{ __('Silk') }}</th>
										<th>{{ __('Silk X2') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($rescar as $card)
										<tr>
											<td>{{ number_format($card->typeAmout,0,0,'.') }} VNĐ</td>
											<td>{{ number_format($card->silk,0,0,'.') }} Silk</td>
											<td>{{ number_format($card->silk * 2,0,0,'.') }} Silk</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			@endif
		@else
			<form autocomplete="off" class="mt-2 ps-3 ps-md-5 pe-3 pe-md-5" method="POST" action="{{ route('post-login') }}">
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
				</div>
			</form>
		@endif
	</div>
</div>
@endsection