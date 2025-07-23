<div>
	<!-- Modal -->
	<div class="modal fade" id="createAccountModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<form wire:submit.prevent="save" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Account</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label for="accountName">Name</label>
						<input wire:model="name" type="text" class="form-control" id="accountName" placeholder="Enter account name"
							autofocus required>
						@error('name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<label for="accountNumber">Account Number</label>
						<input wire:model="number" type="text" class="form-control" id="accountNumber"
							placeholder="Enter account number" required>
						@error('number')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<label for="accountBalance">Balance</label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1">Rp.</span>
							<input wire:model="balance" type="number" class="form-control" id="accountBalance" placeholder="Enter balance"
								aria-label="Balance" aria-describedby="basic-addon1" required>
						</div>
						@error('balance')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
