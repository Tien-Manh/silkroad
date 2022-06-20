@extends('layout_admin.index')
@section('content')
	<div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3"><a href="{{ route('card-cp') }}" class="text-white me-2">Quay lại</a><i class="fas fa-undo"></i></h6>
        </div>
      </div>
      <div class="card-body w-95 w-md-50 m-auto">
        @if(session()->has('msg'))
          <div class="alert alert-primary alert-dismissible text-white" role="alert">
                {!! session('msg') !!}
              <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
           </div>
        @else
        @endif
        <form role="form" method="post" action="{{ route('save-card') }}" class="text-start">
          @csrf
          <div class="input-group input-group-outline my-3 @if(old('typeAmount'))focused is-focused @endif">
            <label class="form-label">Mệnh giá</label>
            <input value="{{ old('typeAmount') }}" type="number" class="form-control" name="typeAmount" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <div class="input-group input-group-outline mb-3 @if(old('silk'))focused is-focused @endif">
            <label class="form-label">silk</label>
            <input value="{{ old('silk') }}" type="number" class="form-control" name="silk" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
        
          <div class="text-center">
            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Thêm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection