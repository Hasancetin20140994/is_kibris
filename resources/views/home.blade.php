@include('layouts.header')

@include('layouts.slider')
<?php //die(var_dump($jobs)); ?>

			<?php foreach($jobs as $job) { ?>

			<div class="col-md-4">
				<div class="job_item">
					<div class="company_logo">
						<img src="{{url('/tempassets/'.$job->company->logo)}}">
					</div>
					<div class="job_text">
						<div class="job_desc"><a href="#">{{$job->name}}</a></div>
						<div class="company_name">{{$job->company->name}}</div>
					</div>
				</div>
			</div>

			<?php
				
				}
			?>

			</div>
		</div>


@include('layouts.footer')
