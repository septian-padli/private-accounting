@extends('layout.dashboard-layout')
@section('content')
	<div class="page-content">
		<section class="row">
			<div class="col-12 col-lg-9">
				<div class="row">
					<div class="col-6 col-lg-3 col-md-6">
						<div class="card">
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
										<div class="stats-icon purple mb-2">
											<i class="iconly-boldShow"></i>
										</div>
									</div>
									<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
										<h6 class="text-muted font-semibold">
											Profile Views
										</h6>
										<h6 class="mb-0 font-extrabold">112.000</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3 col-md-6">
						<div class="card">
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
										<div class="stats-icon blue mb-2">
											<i class="iconly-boldProfile"></i>
										</div>
									</div>
									<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
										<h6 class="text-muted font-semibold">Followers</h6>
										<h6 class="mb-0 font-extrabold">183.000</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3 col-md-6">
						<div class="card">
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
										<div class="stats-icon green mb-2">
											<i class="iconly-boldAdd-User"></i>
										</div>
									</div>
									<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
										<h6 class="text-muted font-semibold">Following</h6>
										<h6 class="mb-0 font-extrabold">80.000</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3 col-md-6">
						<div class="card">
							<div class="card-body py-4-5 px-4">
								<div class="row">
									<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
										<div class="stats-icon red mb-2">
											<i class="iconly-boldBookmark"></i>
										</div>
									</div>
									<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
										<h6 class="text-muted font-semibold">Saved Post</h6>
										<h6 class="mb-0 font-extrabold">112</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4>Profile Visit</h4>
							</div>
							<div class="card-body">
								<div id="chart-profile-visit"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-xl-4">
						<div class="card">
							<div class="card-header">
								<h4>Profile Visit</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-7">
										<div class="d-flex align-items-center">
											<svg class="bi text-primary" width="32" height="32" fill="blue" style="width: 10px">
												<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
											</svg>
											<h5 class="mb-0 ms-3">Europe</h5>
										</div>
									</div>
									<div class="col-5">
										<h5 class="mb-0 text-end">862</h5>
									</div>
									<div class="col-12">
										<div id="chart-europe"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-7">
										<div class="d-flex align-items-center">
											<svg class="bi text-success" width="32" height="32" fill="blue" style="width: 10px">
												<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
											</svg>
											<h5 class="mb-0 ms-3">America</h5>
										</div>
									</div>
									<div class="col-5">
										<h5 class="mb-0 text-end">375</h5>
									</div>
									<div class="col-12">
										<div id="chart-america"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-7">
										<div class="d-flex align-items-center">
											<svg class="bi text-success" width="32" height="32" fill="blue" style="width: 10px">
												<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
											</svg>
											<h5 class="mb-0 ms-3">India</h5>
										</div>
									</div>
									<div class="col-5">
										<h5 class="mb-0 text-end">625</h5>
									</div>
									<div class="col-12">
										<div id="chart-india"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-7">
										<div class="d-flex align-items-center">
											<svg class="bi text-danger" width="32" height="32" fill="blue" style="width: 10px">
												<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
											</svg>
											<h5 class="mb-0 ms-3">Indonesia</h5>
										</div>
									</div>
									<div class="col-5">
										<h5 class="mb-0 text-end">1025</h5>
									</div>
									<div class="col-12">
										<div id="chart-indonesia"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4>Latest Comments</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table-hover table-lg table">
										<thead>
											<tr>
												<th>Name</th>
												<th>Comment</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="col-3">
													<div class="d-flex align-items-center">
														<div class="avatar avatar-md">
															<img src="{{ asset('assets/mazer/compiled/jpg/5.jpg') }}" />
														</div>
														<p class="mb-0 ms-3 font-bold">Si Cantik</p>
													</div>
												</td>
												<td class="col-auto">
													<p class="mb-0">
														Congratulations on your graduation!
													</p>
												</td>
											</tr>
											<tr>
												<td class="col-3">
													<div class="d-flex align-items-center">
														<div class="avatar avatar-md">
															<img src="{{ asset('assets/mazer/compiled/jpg/2.jpg') }}" />
														</div>
														<p class="mb-0 ms-3 font-bold">Si Ganteng</p>
													</div>
												</td>
												<td class="col-auto">
													<p class="mb-0">
														Wow amazing design! Can you make another
														tutorial for this design?
													</p>
												</td>
											</tr>
											<tr>
												<td class="col-3">
													<div class="d-flex align-items-center">
														<div class="avatar avatar-md">
															<img src="{{ asset('assets/mazer/compiled/jpg/8.jpg') }}" />
														</div>
														<p class="mb-0 ms-3 font-bold">
															Singh Eknoor
														</p>
													</div>
												</td>
												<td class="col-auto">
													<p class="mb-0">
														What a stunning design! You are so talented
														and creative!
													</p>
												</td>
											</tr>
											<tr>
												<td class="col-3">
													<div class="d-flex align-items-center">
														<div class="avatar avatar-md">
															<img src="{{ asset('assets/mazer/compiled/jpg/3.jpg') }}" />
														</div>
														<p class="mb-0 ms-3 font-bold">Rani Jhadav</p>
													</div>
												</td>
												<td class="col-auto">
													<p class="mb-0">
														I love your design! It’s so beautiful and
														unique! How did you learn to do this?
													</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3">
				<div class="card">
					<div class="card-body px-4 py-4">
						<div class="d-flex align-items-center">
							<div class="avatar avatar-xl">
								<img src="{{ asset('assets/mazer/compiled/jpg/1.jpg') }}" alt="Face 1" />
							</div>
							<div class="name ms-3">
								<h5 class="font-bold">{{ Auth::user()->name }}</h5>
								<h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6>
							</div>
						</div>
						{{-- button logout --}}
						@auth
							<form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
								@csrf
								<button type="submit" class="btn btn-danger">Logout</button>
							</form>
						@endauth
						@guest
							<a href="{{ route('auth.redirect') }}" class="btn btn-primary">Login with Google</a>
						@endguest
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4>Recent Messages</h4>
					</div>
					<div class="card-content pb-4">
						<div class="recent-message d-flex px-4 py-3">
							<div class="avatar avatar-lg">
								<img src="{{ asset('assets/mazer/compiled/jpg/4.jpg') }}" />
							</div>
							<div class="name ms-4">
								<h5 class="mb-1">Hank Schrader</h5>
								<h6 class="text-muted mb-0">@johnducky</h6>
							</div>
						</div>
						<div class="recent-message d-flex px-4 py-3">
							<div class="avatar avatar-lg">
								<img src="{{ asset('assets/mazer/compiled/jpg/5.jpg') }}" />
							</div>
							<div class="name ms-4">
								<h5 class="mb-1">Dean Winchester</h5>
								<h6 class="text-muted mb-0">@imdean</h6>
							</div>
						</div>
						<div class="recent-message d-flex px-4 py-3">
							<div class="avatar avatar-lg">
								<img src="{{ asset('assets/mazer/compiled/jpg/1.jpg') }}" />
							</div>
							<div class="name ms-4">
								<h5 class="mb-1">John Dodol</h5>
								<h6 class="text-muted mb-0">@dodoljohn</h6>
							</div>
						</div>
						<div class="px-4">
							<button class="btn btn-block btn-xl btn-outline-primary mt-3 font-bold">
								Start Conversation
							</button>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4>Visitors Profile</h4>
					</div>
					<div class="card-body">
						<div id="chart-visitors-profile"></div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
