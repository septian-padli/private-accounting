@extends('layout.dashboard-layout')
@section('page-title', 'Monthly Budget Management')
@section('content')
	<div class="page-content">
		<section class="">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body py-4-5 px-4">
							<div class="d-flex flex-column flex-md-row justify-content-between">
								<h4 class="text-capitalize mb-md-0 mb-2">{{ $user->family->name }} Monthly Budget</h4>
								<div>

									<button type="button" class="edit btn btn-primary btn-sm" data-bs-toggle="modal"
										data-bs-target="#createBudgetModal">
										<i class="fa fa-user-plus me-2"></i>
										Add Budget
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@livewire('budget.read-budget')
		</section>
	</div>

	@livewire('budget.create-budget')
@endsection

@section('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
		integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('scripts')

	<script>
		window.addEventListener('close-modal', () => {
			// Ambil modal instance, jika belum ada buat baru
			let modalEl = document.getElementById('createBudgetModal');
			let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
			modal.hide();

			modalEl = document.getElementById('modalEditBudget');
			modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
			modal.hide();

			// Hilangkan backdrop secara paksa jika masih ada
			document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
			document.body.classList.remove('modal-open');
			document.body.style = '';
		});
	</script>
@endsection
