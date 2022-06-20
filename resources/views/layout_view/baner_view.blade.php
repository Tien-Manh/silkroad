<div class="row m-0">
	<div class="banner p-0">
		<div class="top-img">
			<img src="{{ asset('custom/img/bg.png') }}" alt="">
		</div>
		@if(count(@$baner) > 0)
		<div style="height: 500px;">
			@foreach(@$baner as $key => $ban)
				<div class="fix-baner" id="im-{{ $key }}">
					<img src="{{ asset('admins/images/baners/'.$ban->img) }}">
					@if($ban->content != '')
						<div class="text-imge">
							<div class="row mt-1">
								<div class="col-12 mt-md-3 mt-0 m-auto">
									{!! $ban->content !!}
								</div>
							</div>
						</div>
					@endif
				</div>
			@endforeach
		</div>
		@else
		<div style="height: 500px;">
			
		</div>
		@endif
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		let start = 0
		let countIm = "<?= count($baner) -1 ?>"
		dataIm = function(){
			$('#im-'+start).slideUp("slow")
			$('#im-'+start + ' .text-imge').removeClass("kshow")
			if(++start > countIm){
				start = 0
			}
			$('#im-'+start).slideDown("slow")
			$('#im-'+start + ' .text-imge').addClass("kshow")
			
		}
		let interval;
        let timer = function(){
	    	interval = setInterval(function(){
	    		dataIm()
	    	},10000)
        }
        timer();
	})
</script>