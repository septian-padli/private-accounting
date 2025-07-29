<div class="row g-4">
	@foreach ($accounts as $account)
		<div class="col-12 col-sm-6 d-flex {{ $isDashboard ? 'col-lg-4' : 'col-md-4 col-lg-3' }}">
			<div class="card flex-fill mb-0">
				<div class="card-body px-4 py-4">
					<div class="d-flex gap-4">
						<div>
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
