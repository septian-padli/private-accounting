<div>
	<!-- Modal -->
	<div class="modal fade" id="createTransactionModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<form wire:submit.prevent="save" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Transaction</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="row gap-y-3">
						<div class="col-md-6 col-12">
							<label for="transactionDate">Date</label>
							<input wire:model="transaction_date" type="date" class="form-control" id="transactionDate" required
								value="{{ $today }}">
							@error('transaction_date')
								<span class="text-danger text-sm">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-md-6 col-12">
							<label for="categorySelect">Category</label>
							<select wire:model="category_id" class="form-control form-select" id="categorySelect" required>
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
							<label for="accountSelect">Account</label>
							<select wire:model.live="account_id" class="form-control form-select" id="accountSelect" required>
								<option value="">Select account</option>
								@foreach ($accounts as $acc)
									<option value="{{ $acc->id }}">{{ $acc->name }}</option>
								@endforeach
							</select>
							<p class="text-sm">Account id: {{ $account_id }}</p>
							@error('account_id')
								<span class="text-danger text-sm">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-md-6 col-12">
							<label for="amountInput">Amount</label>
							<div class="form-group position-relative has-icon-left mb-0">
								<input wire:model.blur="amount" type="number" class="form-control" placeholder="Input with icon left"
									id="amountInput" required>
								<div class="form-control-icon">
									<i class="fa-solid fa-rupiah-sign"></i>
								</div>
							</div>
							@error('amount')
								<span class="text-danger text-sm">{{ $message }}</span>
							@enderror
						</div>

						<div class="col-12">
							<label for="noteInput">Note</label>
							<input wire:model="note" type="text" class="form-control" id="noteInput" placeholder="Note (optional)">
							@error('note')
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
