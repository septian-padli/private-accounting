@extends('layout.layout')
@section('styles')
	@yield('styles')
@endsection
@section('sub-layout')
	<div id="app">
		@include('components.sidebar')
		<div id="main">
			<header class="mb-3">
				<a href="#" class="burger-btn d-block d-xl-none">
					<i class="bi bi-justify fs-3"></i>
				</a>
			</header>

			<div class="page-heading">
				<h3>@yield('page-title')</h3>
			</div>
			@yield('content')
			<footer>
				<div class="footer clearfix text-muted mb-0">
					<div class="float-start">
						<p>2023 &copy; Mazer</p>
					</div>
					<div class="float-end">
						<p>
							Crafted with
							<span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
							by <a href="https://saugi.me">Saugi</a>
						</p>
					</div>
				</div>
			</footer>
		</div>
	</div>
@endsection
@section('scripts')
	@yield('scripts')
@endsection
