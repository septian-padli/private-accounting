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
	<div class="row g-4">
		@foreach ($monthlyBudgets as $group)
			<div class="col-12">
				<p class="fw-bold fs-5 mb-2">{{ $months[$group['month']] }} {{ $group['year'] }}</p>
				<div class="row g-4">
					@foreach ($group['data'] as $budget)
						<div class="col-12 col-sm-6 d-flex col-md-4 col-lg-3">
							<div class="card flex-fill mb-0">
								<div class="card-body px-4 py-4">
									<div class="d-flex align-items-center gap-4">
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
												Rp {{ number_format($budget->amount, 0, ',', '.') }}
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
	</div>

</section>
