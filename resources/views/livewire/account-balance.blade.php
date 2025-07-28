<div class="d-flex justify-content-between gap-4">
	@foreach ($accounts as $account)
		<div class="w-100">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="d-flex gap-4">
						<div class="">
							<div class="stats-icon purple mb-2 p-1">
								<img src="{{ asset('storage/' . $account->icon) }}" alt="{{ $account->icon }} Icon" class="img-fluid">
							</div>
						</div>
						<div class="w-100">
							<h6 class="text-muted font-semibold">
								{{ $account->name }}
							</h6>
							<h6 class="mb-0 font-extrabold">
								Rp {{ number_format($account->balance, 2, ',', '.') }}
							</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
