@extends('layout_view.layout_index')
@section('title', __('Support_member'))
@section('content')
 <div class="p-3">
   <h5 class="mb-4">{{ __('Support_member') }}</h5>
 <hr class="pt-1">
    <div class="account ps-4 pe-4 pt-3 pb-3 ms-auto me-auto" style="overflow: hidden; word-break: break-all; letter-spacing: 0.1rem;">
      <!-- Tabs with Background on Card -->
       @if($supmem)
        {!! $supmem->content !!}
       @endif
      <!-- End Tabs on plain Card -->
    </div>
 </div>

@endsection

@section('js')
	<script type="text/javascript" src="{{ asset("custom/js/bootstrap.min.js") }}"></script>
@endsection