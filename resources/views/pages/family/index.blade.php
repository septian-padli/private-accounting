@extends('layout.dashboard-layout')
@section('page-title', 'Family Management')
@section('content')
	<div class="page-content">
		<section class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body py-4-5 px-4">
						<div class="d-flex justify-content-between">
							<h4 class="text-capitalize mb-4">{{ $family->name }} Members</h4>
							<div>
								<a href="" class="edit btn btn-primary btn-sm">
									<i class="fa fa-user-plus me-2"></i>
									Add Member</a>
							</div>
						</div>
						<table class="data-table table">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>Email</th>
									<th>Status</th>
									<th width="100px">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</section>
	</div>
@endsection

@section('styles')
	<link rel="stylesheet"
		href="{{ asset('assets/mazer/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" />
	<link rel="stylesheet" crossorigin href="{{ asset('assets/mazer/compiled/css/table-datatable-jquery.css') }}" />
@endsection
@section('scripts')
	<script src="{{ asset('assets/mazer/extensions/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/mazer/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/mazer/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('assets/mazer/static/js/pages/datatables.js') }}"></script>

	<script type="text/javascript">
		$(function() {

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('family.index') }}",
				columns: [{
						data: 'DT_RowIndex',
						name: 'no',
						orderable: false,
						searchable: false
					},
					{
						data: 'name',
						name: 'name'
					},
					{
						data: 'email',
						name: 'email'
					},
					{
						data: 'status',
						name: 'status',
						searchable: false,
						render: function(data, type, row) {
							return data
								.split(' ')
								.map(word => word.charAt(0).toUpperCase() + word.slice(1)
									.toLowerCase())
								.join(' ');
						}
					},
					{
						data: 'action',
						name: 'action',
						orderable: false,
						searchable: false
					},
				]
			});

		});
	</script>
@endsection
