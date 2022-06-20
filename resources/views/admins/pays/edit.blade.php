@extends('layout_admin.index')
@section('content')
	<div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3"><a href="{{ route('pay-cp') }}" class="text-white me-2">Quay lại</a><i class="fas fa-undo"></i></h6>
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
        <form role="form" method="post" action="{{ route('editsave-pay') }}" class="text-start">
          @csrf
          <input type="hidden" name="id" value="{{ $pay->id }}">
          <div class="input-group input-group-outline my-3 focused is-focused">
            <label class="form-label">Tiêu đề</label>
            <input type="text" value="{{ $pay->title }}" class="form-control" name="title" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
          <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Số tài khoản</label>
            <input type="text" value="{{ $pay->atm }}" class="form-control" name="atm" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
           <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Tên ngân hàng</label>
            <input type="text" value="{{ $pay->bank }}" class="form-control" name="bank" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
           <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Tên chủ tài khoản</label>
            <input type="text" value="{{ $pay->name }}" class="form-control" name="name" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
           <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Nội dung</label>
            <input type="text" value="{{ $pay->atm }}" class="form-control" name="content" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
           <div class="input-group input-group-outline mb-3 focused is-focused">
            <label class="form-label">Service</label>
            <select class="form-control" name="service">
              <option @if($pay->service == 1)selected @endif value="1">Enable</option>
              <option @if($pay->service == 0)selected @endif value="0">Disable</option>
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