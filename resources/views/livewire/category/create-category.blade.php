<div>
	<!-- Modal -->
	<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<form wire:submit.prevent="save" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Category</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="row gap-y-3">
						<div class="col-md-6 col-12">
							<label for="categoryName">Name</label>
							<input wire:model="name" type="text" class="form-control" id="categoryName" placeholder="Enter category name"
								autofocus required>
							@error('name')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-md-6 col-12">
							<label for="categoryType">Type</label>
							<select wire:model="type" class="form-control form-select" id="categoryType" required>
								<option value="">Select type</option>
								<option value="INCOME">Income</option>
								<option value="EXPENSE">Expense</option>
							</select>
							@error('type')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="col-12">
							<label for="categoryIcon">Icon</label>
							<input class="form-control" type="file" id="categoryIcon" wire:model="icon" accept="image/*">
							@error('icon')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
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
