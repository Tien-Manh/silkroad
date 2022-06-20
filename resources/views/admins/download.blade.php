@extends('layout_admin.index')
@section('content')
	<div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Download</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
        	<a href="{{ route('add-download') }}" class="btn btn-primary mb-0 ms-3">Thêm</a>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Service</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Local Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Icon</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(count($download) > 0)
                	@foreach($download as $val)
                    	<tr>
	                      <td class="text-center">
	                        {{ $val->id }}
	                      </td>
	                      <td class="text-center">
	                        {{ $val->service }}
	                      </td>
                        <td class="text-center">
                          @if($val->type == 0)
                          File Game
                          @elseif($val->type == 1)
                          File Bot
                          @else
                          File hỗ trợ
                          @endif
                        </td>
	                      <td class="align-middle text-center text-sm">
	                         {{ $val->link }}
	                      </td>
	                      <td class="align-middle text-center">
	                        {{ $val->name }}
	                      </td>
                        <td class="align-middle text-center">
                          {{ $val->local }}
                        </td>
	                      <td class="align-middle text-center">
                          <i class="{{ $val->icon }}"></i>
	                      </td>
	                      <td class="align-middle text-center">
	                        <a href="{{ route('edit-download',[$val->id])}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
	                          Sửa
	                        </a>
                          <a href="{{ route('delete-download',[$val->id])}}" class="text-secondary font-weight-bold text-xs ms-3" data-toggle="tooltip" data-original-title="Edit user">
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
             {{ $download->links() }}
          </div>
        </div>
      </div>
    </div>
@endsection