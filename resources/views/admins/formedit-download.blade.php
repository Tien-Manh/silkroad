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
        <form role="form" method="post" action="{{ route('editsave-download') }}" class="text-start">
          @csrf
          <input type="hidden" name="id" value="{{ $download->id }}">
          <div class="input-group input-group-outline my-3 focused is-focused">
            <label class="form-label">Link</label>
            <input type="text" value="{{ $download->link }}" class="form-control" name="link" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Name</label>
            <input type="text" value="{{ $download->name }}" class="form-control" name="name" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Local name</label>
            <input type="text" value="{{ $download->local }}" class="form-control" name="local" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Icon</label>
            <select style="font-family: FontAwesome; sans-serif;font-size: 20px;" class="form-control" name="icon">
              <option value="fab fa-google-drive" @if($download->icon == 'fab fa-google-drive')selected @endif>&#xf3aa;</option>
              <option value="far fa-hdd" @if($download->icon == 'far fa-hdd')selected @endif>&#xf0a0;</option>
              <option value="fas fa-hdd" @if($download->icon == 'fas fa-hdd')selected @endif>&#xf0a0;</option>
              <option value="fab fa-red-river" @if($download->icon == 'fab fa-red-river')selected @endif>&#xf3e3;</option>
              <option value="fab fa-firefox-browser" @if($download->icon == 'fab fa-firefox-browser')selected @endif>&#xe007;</option>
              <option value="fab fa-edge" @if($download->icon == 'fab fa-edge')selected @endif>&#xf282;</option>
              <option value="fab fa-chrome" @if($download->icon == 'fab fa-chrome')selected @endif>&#xf268;</option>
              <option value="fas fa-cloud-download-alt" @if($download->icon == 'fas fa-cloud-download-alt')selected @endif>&#xf381;</option>
              <option value="fab fa-cloudscale" @if($download->icon == 'fab fa-cloudscale')selected @endif>&#xf383;</option>
              <option value="fas fa-file-contract" @if($download->icon == 'fas fa-file-contract')selected @endif>&#xf56c;</option>
              <option value="fas fa-folder-minus" @if($download->icon == 'fas fa-folder-minus')selected @endif>&#xf65d;</option>
              <option value="fas fa-dice-d6" @if($download->icon == 'fas fa-dice-d6')selected @endif>&#xf6d1;</option>
              <option value="fas fa-file-download" @if($download->icon == 'fas fa-file-download')selected @endif>&#xf56d;</option>
            </select>
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Type</label>
            <select class="form-control" name="type">
              <option @if($download->type == 0)selected @endif selected value="0">File Game</option>
              <option @if($download->type == 1)selected @endif value="1">File Bot</option>
              <option @if($download->type == 2)selected @endif value="2">File Khac</option>
            </select>
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Service</label>
            <select class="form-control" name="service">
              <option @if($download->service == 1)selected @endif value="1">Enable</option>
              <option @if($download->service == 0)selected @endif value="0">Disable</option>
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sửa</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection