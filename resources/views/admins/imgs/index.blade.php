@extends('layout_admin.index')
@section('content')
	<div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Storage</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
        	<div class="row">
            <div class="col-3">
              <a href="{{ route('create-add') }}" class="btn btn-primary mb-0 ms-3">Thêm</a>
            </div>
            <div class="col-9 d-flex" style="align-items: center;">
              <span id="coppi-val" class="text-success"></span>
            </div>
          </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Service</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(count($storeImg) > 0)
                	@foreach($storeImg as $key => $val)
                    	<tr>
	                      <td class="text-center">
	                        {{ $val->id }}
	                      </td>
	                      <td class="text-center">
	                        {{ $val->service }}
	                      </td>
                        <td class="text-center">
                          <span id="coppi-{{ $val->id }}">{{ asset('admins/images/storages/' .$val->value) }}</span>
                          <a onclick="coppival({{ $val->id }})" class="btn btn-sm btn-primary float-end">Coppy</a>
                        </td>
                        <td class="text-center">
                          <img width="160" height="auto" src="{{ asset('admins/images/storages/' .$val->value) }}" alt="">
                        </td>
	                      <td class="align-middle text-center">
	                        <a href="{{ route('create-edit',[$val->id])}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
	                          Sửa
	                        </a>
                          <a href="{{ route('create-delete',[$val->id])}}" class="text-secondary font-weight-bold text-xs ms-3" data-toggle="tooltip" data-original-title="Edit user">
                            Xoá
                          </a>
	                      </td>
                    	</tr>
                	@endforeach
                @else
                <h5 class="text-center">Không có dữ liệu</h5>
                @endif
              </tbody>
            </table>
          </div>
          <div class="card-body d-flex justify-content-end">
             {{ $storeImg->links() }}
          </div>
        </div>
      </div>
    </div>
@endsection
@section('js')
  <script>
    coppival = function(id){
      let aText = document.getElementById('coppi-'+id).innerText
      navigator.clipboard.writeText(aText)
      document.getElementById('coppi-val').innerText = 'Coppy : ' +aText
    }
  </script>
@endsection