@extends('layout_admin.index')
@section('content')
	<div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Card</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loại thẻ</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Seri</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Silk</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(count($cardlog) > 0)
                	@foreach($cardlog as $val)
                    	<tr>
	                      <td class="text-center">
	                        {{ $val->id }}
	                      </td>
	                      <td class="text-center">
	                        {{ $val->typeCar }}
	                      </td>
	                      <td class="text-center">
	                         {{ $val->seri }}
	                      </td>
	                      <td class="align-middle text-center text-sm">
	                         {{ number_format($val->amount, 0, 0, '.') }}
	                      </td>
	                      <td class="align-middle text-center text-sm">
	                         {{ number_format($val->silk, 0, 0, '.') }}
	                      </td>
	                      <td class="text-center">
	                         {{ $val->status }}
	                      </td>
	                      <td class="align-middle text-center">
	                          <a href="{{ route('deletecard-log-cp',[$val->id])}}" class="text-secondary font-weight-bold text-xs ms-3" data-toggle="tooltip" data-original-title="Edit user">
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
        </div>
      </div>
    </div>
@endsection