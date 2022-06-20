@extends('layout_admin.index')
@section('content')
	<div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3"><a href="{{ route('download-cp') }}" class="text-white me-2">Quay lại</a><i class="fas fa-undo"></i></h6>
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
        <form role="form" method="post" action="{{ route('save-download') }}" class="text-start">
          @csrf
          <div class="input-group input-group-outline my-3 @if(old('link'))focused is-focused @endif">
            <label class="form-label">Link</label>
            <input value="{{ old('link') }}" type="text" class="form-control" name="link" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <div class="input-group input-group-outline mb-3 @if(old('name'))focused is-focused @endif">
            <label class="form-label">Name</label>
            <input value="{{ old('name') }}" type="text" class="form-control" name="name" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
           <div class="input-group input-group-outline mb-3 @if(old('local'))focused is-focused @endif">
            <label class="form-label">Local name</label>
            <input value="{{ old('local') }}" type="text" class="form-control" name="local" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Icon</label>
            <select value="{{ old('icon') }}" style="font-family: FontAwesome; sans-serif;font-size: 20px;" class="form-control" name="icon">
              <option value="fab fa-google-drive">&#xf3aa;</option>
              <option value="far fa-hdd">&#xf0a0;</option>
              <option value="fas fa-hdd">&#xf0a0;</option>
              <option value="fab fa-red-river">&#xf3e3;</option>
              <option value="fab fa-firefox-browser">&#xe007;</option>
              <option value="fab fa-edge">&#xf282;</option>
              <option value="fab fa-chrome">&#xf268;</option>
              <option value="fas fa-cloud-download-alt">&#xf381;</option>
              <option value="fab fa-cloudscale">&#xf383;</option>
              <option value="fas fa-file-contract">&#xf56c;</option>
              <option value="fas fa-folder-minus">&#xf65d;</option>
              <option value="fas fa-dice-d6">&#xf6d1;</option>
              <option value="fas fa-file-download">&#xf56d;</option>
            </select>
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Type</label>
            <select value="{{ old('type') }}" class="form-control" name="type">
              <option selected value="0">File Game</option>
              <option value="1">File Bot</option>
              <option value="2">File Khac</option>
            </select>
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Service</label>
            <select value="{{ old('service') }}" class="form-control" name="service">
              <option selected value="1">Enable</option>
              <option value="0">Disable</option>
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Thêm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection