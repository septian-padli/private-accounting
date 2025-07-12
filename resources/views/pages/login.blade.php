@extends('layout.layout')
@section('sub-layout')
	<div id="auth">
		<div class="d-flex justify-content-center align-items-center vh-100">

			<div class="card shadow" style="min-width: 350px;">
				<div class="card-body">
					<h4 class="card-title mb-4 text-center">Login To Accounting</h4>
					<div class="d-grid">
						<a href="{{ route('auth.redirect') }}" class="btn btn-primary">
							<i class="bi bi-google me-2"></i> Login with Google
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
