@extends('layout_view.layout_index')
@section('title', __('Download'))
@section('content')
 <div class="p-3">
 	<h5 class="mb-4">{{ __('Download') }}</h5>
 <hr class="pt-1">
    <div class="download status ps-4 pt-3 pe-4 pb-3 m-auto" style="overflow: hidden; word-break: break-all; letter-spacing: 0.1rem;">
      <!-- Tabs with Background on Card -->
       @if($download)
      		<h5>{{ __('Link_d_game') }}</h5>
      		<hr style="width: 150px;">
      		<div class="row">
	       		@foreach($download as $game)
	       			@if($game->type == 0)
	       				<div class="col-12 col-md-6">
	       					<span> {{ ucfirst($game->local) }}</span>
	       					<p><a target="_blank" href="{{ $game->link }}"><i class="{{ $game->icon }}"> </i> {{ __('Download') }} {{ $game->name }}</a></p>
	       				</div>
	       			@endif
	       		@endforeach
	       	</div>
	       	<hr class="mb-4">
	       	<h5>{{ __('Link_d_bot') }}</h5>
	       	<hr style="width: 150px;">
	       	<div class="row">
	       		@foreach($download as $game)
	       			@if($game->type == 1)
	       				<div class="col-12 col-md-6">
	       					<span> {{ ucfirst($game->local) }}</span>
	       					<p><a target="_blank" href="{{ $game->link }}"><i class="{{ $game->icon }}"> </i> {{ __('Download') }} {{ $game->name }}</a></p>
	       				</div>
	       			@endif
	       		@endforeach
	       	</div>
	       	<hr class="mb-4">
	       	<h5>{{ __('Link_sup') }}</h5>
	       	<hr style="width: 150px;">
	       	<div class="row">
	       		@foreach($download as $game)
	       			@if($game->type == 2)
	       				<div class="col-12 col-md-6">
	       					<span> {{ ucfirst($game->local) }}</span>
	       					<p><a target="_blank" href="{{ $game->link }}"><i class="{{ $game->icon }}"> </i> {{ __('Download') }} {{ $game->name }}</a></p>
	       				</div>
	       			@endif
	       		@endforeach
	       	</div>
	       	<hr class="mb-4">
       @endif
      <!-- End Tabs on plain Card -->
    </div>
 </div>

@endsection

@section('js')
	<script type="text/javascript" src="{{ asset("custom/js/bootstrap.min.js") }}"></script>
@endsection