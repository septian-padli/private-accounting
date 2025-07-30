<div>
	<!-- Modal -->
	<div class="modal fade" id="createBudgetModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<form wire:submit.prevent="save" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Allocation Budget</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="row gap-y-3">
						<div class="col-md-6 col-12">
							<label for="monthSelect">Month</label>
							<select wire:model.blur="month" class="form-control form-select" id="monthSelect" required>
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
									id="yearInput" required min="1900" max="2100">
							</div>
							@error('year')
								<span class="text-danger text-sm">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-md-6 col-12">
							<label for="categorySelect">Category</label>
							<select wire:model.blur="category_id" class="form-control form-select" id="categorySelect" required>
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
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" @if ($errors->any()) disabled @endif>Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
