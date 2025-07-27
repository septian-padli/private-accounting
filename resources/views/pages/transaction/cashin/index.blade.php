@extends('layout.dashboard-layout')
@section('page-title', 'Transaction Management')
@section('content')
	<div class="page-content">
		<section class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body py-4-5 px-4">
						<div class="d-flex flex-column flex-md-row justify-content-between mb-4">
							<h4 class="text-capitalize mb-md-0 mb-2">{{ $user->family->name }} Transactions</h4>
							<div>
								<button type="button" class="edit btn btn-primary btn-sm" data-bs-toggle="modal"
									data-bs-target="#createTransactionModal">
									<i class="fa fa-user-plus me-2"></i>
									Add Transaction
								</button>
							</div>
						</div>
						<table class="data-table w-100 table">
							<thead>
								<tr>
									<th>Date</th>
									<th>User</th>
									<th>Category</th>
									<th>Account</th>
									<th>Amount</th>
									<th>Note</th>
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

	{{-- panggil livewire nya --}}
	@livewire('transaction.create-transaction', ['today' => $today, 'typeTransaction' => $typeTransaction])
@endsection

@section('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
		integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet"
		href="{{ asset('assets/mazer/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" />
	<link rel="stylesheet" crossorigin href="{{ asset('assets/mazer/compiled/css/table-datatable-jquery.css') }}" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
	<style>
		@media (max-width: 767.98px) {

			.dataTables_length,
			.dataTables_filter {
				text-align: left !important;
				justify-content: flex-start !important;
				display: flex !important;
				margin-bottom: 1rem !important;
			}

			.dataTables_filter label,
			.dataTables_length label {
				width: 100%;
			}
		}
	</style>
@endsection
@section('scripts')
	<script src="{{ asset('assets/mazer/extensions/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/mazer/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/mazer/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script type="text/javascript">
		$(function() {
			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('cashin.index') }}",
				scrollX: true,
				responsive: true,
				lengthMenu: [30, 50, 100],
				columns: [{
						data: 'transaction_date',
						name: 'transaction_date',
						render: function(data, type, row) {
							return convertDate(data, type, row);
						}
					},
					{
						data: 'user',
						name: 'user',
					},
					{
						data: 'category',
						name: 'category'
					},
					{
						data: 'account',
						name: 'account'
					},
					{
						data: 'amount',
						name: 'amount',
						render: function(data, type, row) {
							return 'Rp ' + parseInt(data).toLocaleString('id-ID');
						}
					},
					{
						data: 'note',
						name: 'note'
					},
					{
						data: 'action',
						name: 'action',
						orderable: false,
						searchable: false
					},
				]
			});

			window.addEventListener('transactionCreated', function() {
				table.ajax.reload(null, false);
			});
		});

		document.addEventListener('DOMContentLoaded', function() {
			document.querySelectorAll('.dataTables_paginate .pagination').forEach(dt => {
				dt.classList.add('pagination-primary')
			});
		});
	</script>

	<script>
		window.addEventListener('close-modal', () => {
			let modalEl = document.getElementById('createTransactionModal');
			let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
			modal.hide();

			document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
			document.body.classList.remove('modal-open');
			document.body.style = '';
		});
	</script>
@endsection
