@extends('layout_view.layout_index')
@section('title', __('Ranking'))
@section('content')
 <div class="p-3">
 	<h5 class="mb-4">{{ __('Ranking') }}</h5>
 <hr class="pt-1">
    <div class="col-md-12 ml-auto col-xl-12 mr-auto rank">
      <!-- Tabs with Background on Card -->
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Top_Asi" role="tab">
              {{ __('Top_asia') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Top_Eu" role="tab">{{ __('Top_eu') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Top_Gold" role="tab">{{ __('Top_gold') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Top_Guild" role="tab">{{ __('Top_guild') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Top_Trade" role="tab">{{ __('Top_trade') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Top_Thief" role="tab">{{ __('Top_thief') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Top_Hunter" role="tab">{{ __('Top_hunter') }}</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content text-center">
            <div class="tab-pane active" id="Top_Asi" role="tabpanel">
            	<div class="table-responsive">
				    <table class="table table-dark table-striped">
				      <thead class="table__head">
				        <tr class="winner__table">
				          <th>STT</th>
				          <th>{{ __('Char') }}</th>
				          <th>{{ __('Level') }}</th>
				          <th>{{ __('Exp') }}</th>
				          <th>{{ __('Sp') }}</th>
				          <th>{{ __('STR') }}</th>
				          <th>{{ __('INT') }}</th>
				        </tr>
				      </thead>
				      <tbody>
				      	@if($charRankAsi)
					      	@foreach($charRankAsi as $key => $charAs)
						        <tr class="winner__table">
						          <td>{{ $key + 1 }}</td>
						          <td>{{ $charAs->CharName16 }}</td>
						          <td>{{ $charAs->CurLevel }}</td>
						          <td>{{ number_format($charAs->ExpOffset,0,0,'.') }}</td>
						          <td>{{ number_format($charAs->SExpOffset,0,0,'.') }}</td>
						          <td>{{ number_format($charAs->Strength,0,0,'.') }}</td>
						          <td>{{ number_format($charAs->Intellect,0,0,'.') }}</td>
						        </tr>
					        @endforeach
				 		@else
				 		<p>{{ __('not_data') }}</p>
				 		@endif
				      </tbody>
				    </table>
			    </div>
            </div>
            <div class="tab-pane" id="Top_Eu" role="tabpanel">
              <div class="table-responsive">
				    <table class="table table-dark table-striped">
				      <thead class="table__head">
				        <tr class="winner__table">
				          <th>STT</th>
				          <th>{{ __('Char') }}</th>
				          <th>{{ __('Level') }}</th>
				          <th>{{ __('Exp') }}</th>
				          <th>{{ __('Sp') }}</th>
				          <th>{{ __('STR') }}</th>
				          <th>{{ __('INT') }}</th>
				        </tr>
				      </thead>
				      <tbody>
				      	@if($charRankEu)
					      	@foreach($charRankEu as $key => $charEu)
						        <tr class="winner__table">
						          <td>{{ $key + 1 }}</td>
						          <td>{{ $charEu->CharName16 }}</td>
						          <td>{{ $charEu->CurLevel }}</td>
						          <td>{{ number_format($charEu->ExpOffset,0,0,'.') }}</td>
						          <td>{{ number_format($charEu->SExpOffset,0,0,'.') }}</td>
						          <td>{{ number_format($charEu->Strength,0,0,'.') }}</td>
						          <td>{{ number_format($charEu->Intellect,0,0,'.') }}</td>
						        </tr>
					        @endforeach
				 		@else
				 		<p>{{ __('not_data') }}</p>
				 		@endif
				      </tbody>
				    </table>
			    </div>
            </div>
            <div class="tab-pane" id="Top_Gold" role="tabpanel">
              <div class="table-responsive">
				    <table class="table table-dark table-striped">
				      <thead class="table__head">
				        <tr class="winner__table">
				          <th>STT</th>
				          <th>{{ __('Char') }}</th>
				          <th>{{ __('Gold') }}</th>
				          <th>{{ __('Storage_Gold') }}</th>
				        </tr>
				      </thead>
				      <tbody>
				      	@if($charGold)
					      	@foreach($charGold as $key => $charG)
						        <tr class="winner__table">
						          <td>{{ $key + 1 }}</td>
						          <td>{{ $charG->CharName16 }}</td>
						          <td>{{ number_format($charG->RemainGold,0,0,'.') }}</td>
						          <td>{{ number_format($charG->Gold,0,0,'.') }}</td>
						        </tr>
					        @endforeach
				 		@else
				 		<p>{{ __('not_data') }}</p>
				 		@endif
				      </tbody>
				    </table>
			    </div>
            </div>
            <div class="tab-pane" id="Top_Guild" role="tabpanel">
               <div class="table-responsive">
				    <table class="table table-dark table-striped">
				      <thead class="table__head">
				        <tr class="winner__table">
				          <th>STT</th>
				          <th>{{ __('Guild') }}</th>
				          <th>{{ __('GuildMaster') }}</th>
				          <th>{{ __('Level') }}</th>
				          <th>{{ __('Gp') }}</th>
				          <th>{{ __('Date_create') }}</th>
				        </tr>
				      </thead>
				      <tbody>
				      	@if($topguid)
					      	@foreach($topguid as $key => $guild)
					      	<?php $getc = DB::connection('sqlsrv2')->table('_GuildMember')
						          ->where('GuildID', $guild->ID)
						          ->where('MemberClass', 0)->where('Permission', -1)
						          ->where('SiegeAuthority', 1)->select('CharName')
						          ->first() ?>
						        <tr class="winner__table">
						          <td>{{ $key + 1 }}</td>
						          <td>{{ $guild->Name }}</td>
						          @if(isset($getc->CharName))
						          <td>{{ $getc->CharName }}</td>
						          @else
						          <td>{{ 'None' }}</td>
						          @endif
						          <td>{{ $guild->Lvl }}</td>
						          <td>{{ number_format($guild->GatheredSP,0,0,'.') }}</td>
						          <td>{{ $guild->FoundationDate }}</td>
						        </tr>
					        @endforeach
				 		@else
				 		<p>{{ __('not_data') }}</p>
				 		@endif
				      </tbody>
				    </table>
			    </div>
            </div>
            <div class="tab-pane" id="Top_Trade" role="tabpanel">
              <div class="table-responsive">
				    <table class="table table-dark table-striped">
				      <thead class="table__head">
				        <tr class="winner__table">
				          <th>STT</th>
				          <th>{{ __('Char') }}</th>
				          <th>{{ __('Job_name') }}</th>
				          <th>{{ __('Job_level') }}</th>
				          <th>{{ __('Job_exp') }}</th>
				        </tr>
				      </thead>
				      <tbody>
				      	@if($toptrade)
					      	@foreach($toptrade as $key => $trade)
						        <tr class="winner__table">
						          <td>{{ $key + 1 }}</td>
						          <td>{{ $trade->CharName16 }}</td>
						          <td>{{ $trade->NickName16 }}</td>
						          <td>{{ $trade->Level }}</td>
						          <td>{{ number_format($trade->Exp,0,0,'.') }}</td>
						        </tr>
					        @endforeach
				 		@else
				 		<p>{{ __('not_data') }}</p>
				 		@endif
				      </tbody>
				    </table>
			    </div>
            </div>
            <div class="tab-pane" id="Top_Thief" role="tabpanel">
              <div class="table-responsive">
				    <table class="table table-dark table-striped">
				      <thead class="table__head">
				        <tr class="winner__table">
				          <th>STT</th>
				          <th>{{ __('Char') }}</th>
				          <th>{{ __('Job_name') }}</th>
				          <th>{{ __('Job_level') }}</th>
				          <th>{{ __('Job_exp') }}</th>
				        </tr>
				      </thead>
				      <tbody>
				      	@if($topthief)
					      	@foreach($topthief as $key => $thief)
						        <tr class="winner__table">
						          <td>{{ $key + 1 }}</td>
											<td>{{ $thief->CharName16 }}</td>
						          <td>{{ $thief->NickName16 }}</td>
						          <td>{{ $thief->Level }}</td>
						          <td>{{ number_format($thief->Exp,0,0,'.') }}</td>
						        </tr>
					        @endforeach
				 		@else
				 		<p>{{ __('not_data') }}</p>
				 		@endif
				      </tbody>
				    </table>
			    </div>
            </div>
             <div class="tab-pane" id="Top_Hunter" role="tabpanel">
               <div class="table-responsive">
				    <table class="table table-dark table-striped">
				      <thead class="table__head">
				        <tr class="winner__table">
				          <th>STT</th>
				          <th>{{ __('Char') }}</th>
				          <th>{{ __('Job_name') }}</th>
				          <th>{{ __('Job_level') }}</th>
				          <th>{{ __('Job_exp') }}</th>
				        </tr>
				      </thead>
				      <tbody>
				      	@if($tophunter)
					      	@foreach($tophunter as $key => $hunter)
						        <tr class="winner__table">
						          <td>{{ $key + 1 }}</td>
											<td>{{ $hunter->CharName16 }}</td>
						          <td>{{ $hunter->NickName16 }}</td>
						          <td>{{ $hunter->Level }}</td>
						          <td>{{ number_format($hunter->Exp,0,0,'.') }}</td>
						        </tr>
					        @endforeach
				 		@else
				 		<p>{{ __('not_data') }}</p>
				 		@endif
				      </tbody>
				    </table>
			    </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Tabs on plain Card -->
    </div>

 </div>
@endsection

@section('js')
	<script type="text/javascript" src="{{ asset("custom/js/bootstrap.min.js") }}"></script>
@endsection