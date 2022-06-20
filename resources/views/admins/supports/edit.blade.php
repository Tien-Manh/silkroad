@extends('layout_admin.index')
@section('content')
	<div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3"><a href="{{ route('support-cp') }}" class="text-white me-2">Quay lại</a><i class="fas fa-undo"></i></h6>
        </div>
      </div>
      <div class="card-body w-md-75 w-95 m-auto">
        @if(session()->has('msg'))
          <div class="alert alert-primary alert-dismissible text-white" role="alert">
                {!! session('msg') !!}
              <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
           </div>
        @else
        @endif
        <form role="form" method="post" action="{{ route('editsave-support') }}" class="text-start">
          @csrf
          <input type="hidden" name="id" value="{{ $support->id }}">
           <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Code</label>
            <input type="text" value="{{ $support->code }}" class="form-control" name="code" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <div class="input-group input-group-outline my-3 focused is-focused">
            <label class="form-label">Tiêu đề</label>
            <input type="text" value="{{ $support->title }}" class="form-control" name="title" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <label class="form-label">Nội dung</label>
           <textarea rows="18" class="form-control" name="content">{{$support->content}}</textarea>
          <div class="input-group input-group-outline mb-3"></div>
           <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Service</label>
            <select class="form-control" name="service">
              <option @if($support->service == 1)selected @endif value="1">Enable</option>
              <option @if($support->service == 0)selected @endif value="0">Disable</option>
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
@section('js')
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak media',
      toolbar_mode: 'floating',
       media_live_embeds: true
    });
  </script>
@endsection