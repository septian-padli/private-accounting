@extends('layout.dashboard-layout')
@section('page-title', 'Family Management')
@section('content')
	<div class="page-content">
		<section class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body py-4-5 px-4">
						<h4>{{ $family->name }} Members</h4>

					</div>
				</div>

			</div>
		</section>
	</div>
@endsection
