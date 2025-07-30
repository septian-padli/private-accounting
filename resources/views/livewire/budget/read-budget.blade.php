<div class="row g-4">
	@foreach ($monthlyBudgets as $group)
		<div class="col-12">
			<p class="fw-bold fs-5 mb-2">{{ $months[$group['month']] }} {{ $group['year'] }}</p>
			<div class="row g-4">
				@foreach ($group['data'] as $budget)
					<div class="col-12 col-sm-6 d-flex col-md-4">
						<div class="card flex-fill mb-0">
							<div class="card-body px-4 py-4">
								<div class="d-flex align-items-start gap-4">
									<div>
										<div class="stats-icon purple mb-2 p-1">
											<img src="{{ asset('storage/' . $budget->icon) }}" alt="{{ $budget->icon }} Icon" class="img-fluid">
										</div>
									</div>
									<div class="w-100">
										<h6 class="text-muted font-semibold">
											{{ $budget->category->name }}
										</h6>
										<h6 class="mb-0 font-extrabold">
											Rp {{ number_format($budget->amount, 2, ',', '.') }}
											@if (!is_null($budget->percentage_change))
												@if ($budget->percentage_change > 0)
													<span class="text-success ms-2">
														<i class="fa fa-arrow-up"></i>
													</span>
												@elseif($budget->percentage_change < 0)
													<span class="text-danger ms-2">
														<i class="fa fa-arrow-down"></i>
													</span>
												@else
													<span class="text-secondary ms-2">
														0%
													</span>
												@endif
											@endif
										</h6>
									</div>
									<div class="btn-group mb-1">
										<div class="dropdown">
											<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown"
												aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-v"></i>
											</button>
											<div class="dropdown-menu">
												<button type="button" class="dropdown-item" wire:click="openEditModal('{{ $budget->id }}')">
													Edit
												</button>
												<a class="dropdown-item" href="#">Delete</a>
											</div>
										</div>
									</div>
								</div>
								<div class="mt-1">
									@if (!is_null($budget->percentage_change))
										@if ($budget->percentage_change > 0)
											<p class="text-secondary fw-light mb-0">
												<span class="text-success fw-bold me-1">
													+{{ $budget->percentage_change }}%
												</span>
												from last month
											</p>
										@elseif($budget->percentage_change < 0)
											<p class="text-secondary fw-light mb-0">
												<span class="text-danger fw-bold me-1">
													{{ $budget->percentage_change }}%
												</span>
												from last month
											</p>
										@else
											<p class="text-secondary fw-bold mb-0">
												0%
											</p>
										@endif
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	@endforeach

	<div class="modal fade" id="modalEditBudget" tabindex="-1" aria-hidden="true" wire:ignore.self>
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<form wire:submit.prevent="update" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Allocation Budget</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="row gap-y-3">
						<div class="col-md-6 col-12">
							<label for="monthSelect">Month</label>
							<select wire:model.blur="month" class="form-control form-select" id="monthSelect" required disabled>
								<option value="">Select month</option>
								@foreach ($months as $key => $value)
									<option value="{{ $key }}">{{ $value }}</option>
								@endforeach
							</select>
							@error('month')
								<span class="text-danger text-sm">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-md-6 col-12">
							<label for="yearInput">Year</label>
							<div class="form-group mb-0">
								<input wire:model.blur="year" type="number" class="form-control" placeholder="{{ date('Y') }}"
									id="yearInput" required min="1900" max="2100" disabled>
							</div>
							@error('year')
								<span class="text-danger text-sm">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-md-6 col-12">
							<label for="categorySelect">Category</label>
							<select wire:model.blur="category_id" class="form-control form-select" id="categorySelect" required disabled>
								<option value="">Select category</option>
								@foreach ($categories as $cat)
									<option value="{{ $cat->id }}">{{ $cat->name }}</option>
								@endforeach
							</select>
							@error('category_id')
								<span class="text-danger text-sm">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-md-6 col-12">
							<label for="amountInput">Amount</label>
							<div class="form-group position-relative has-icon-left mb-0">
								<input wire:model.blur="amount" type="number" step="0.01" class="form-control"
									placeholder="Input with icon left" id="amountInput" required>
								<div class="form-control-icon">
									<i class="fa-solid fa-rupiah-sign"></i>
								</div>
							</div>
							@error('amount')
								<span class="text-danger text-sm">{{ $message }}</span>
							@enderror
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<p>Budget: {{ $budgetId }}</p>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" @if ($errors->any()) disabled @endif>Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		if (window.Livewire) {
			window.Livewire.on('show-edit-modal', () => {
				let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
					'modalEditBudget'));
				modal.show();
			});
		}
	});
</script>
