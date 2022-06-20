<div class="left_bar p-3">
	<h5 class="mb-4">{{ __('Server_status') }}</h5>
	<hr class="pt-1">
	<div class="mt-2 ps-3 pe-3">
		<div class="status row p-1">
			<div class="col-12 p-0 top">
				<p><i class="fas fa-server"></i> {{ __('Server') }}: 
					<span class="fw-bold"><i style="font-size: 14px" class="fas fa-circle @if($data['status'] == 'Online')status-on @else status-of @endif"></i>
						{{ $data['status'] }}
					</span>
				</p>
				<p><i class="fas fa-desktop"></i> {{ __('Play_online') }}: <span class="fw-bold">{{ $data['userCount'] }} /1000</span></p>
				<p>
					<i class="fas fa-database"></i> {{ __('Level') }}: 
					<span class="fw-bold">{{ @$configs['level'] }}</span>
				</p>
				<p>
					<i class="fas fa-database"></i> {{ __('Degree') }}:
					<span class="fw-bold">{{ @$configs['degree'] }}</span>
				</p>
				<p>
					<i class="fas fa-user"></i> {{ __('Exp_sp') }}: 
					<span class="fw-bold">{{ @$configs['exp'] }}</span>
				</p>
				<p>
					<i class="fas fa-users"></i> {{ __('Exp_sp_party') }}: 
					<span class="fw-bold">{{ @$configs['exp-paty'] }}</span>
				</p>
				<p>
					<i class="fas fa-sun"></i> {{ __('Drop_gold') }}: 
					<span class="fw-bold">{{ @$configs['drop-gold'] }}</span>
				</p>
				<p>
					<i class="fas fa-feather-alt"></i> {{ __('Drop_rate') }}: 
					<span>{{ @$configs['drop-rate'] }}</span>
				</p>
				<p>
					<i class="fas fa-sun"></i> {{ __('silk_hour') }}: 
					<span class="fw-bold">{{ @$configs['silk-online'] }}</span>
				</p>
				<p>
					<i class="fas fa-desktop"></i> {{ __('pc_limit') }}: 
					<span class="fw-bold">{{ @$configs['pc-limit'] }}</span>
				</p>
				<p>
					<i class="fas fa-feather-alt"></i> {{ __('max_plus') }}: 
					<span class="fw-bold">+{{ @$configs['plus'] }}</span>
				</p>
			</div>
			<hr>
			<div class="col-12 p-0 mt-2">
				@if(count(@$atm) > 0)
					@foreach(@$atm as $val)
						<div class="atm border p-2 mt-3 mt-md-0">
							<p>{{ @$val->title }}</p>
							<p>ATM : {{ @$val->atm }} </p>
							<p>{{ __('bank') }} : {{ @$val->bank }}</p>
							<p>{{ __('name') }} : {{ @$val->name }}</p>
							<p>{{ __('content') }} : {{ @$val->content }}</p>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>