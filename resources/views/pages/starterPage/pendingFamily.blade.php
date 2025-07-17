@extends('layout.layout')
@section('sub-layout')
	<div id="auth">
		<div class="d-flex justify-content-center align-items-center vh-100">

			<div class="card w-50 shadow">
				<div class="card-body">
					<h4 class="card-title text-capitalize text-center">Anda belum memiliki keuarga</h4>
					<p class="mb-4 text-center">Tunggu hingga anda dimasukkan kedalam keluarga. Hubungi kepala keluarga anda.</p>

					<div class="d-flex justify-content-center gap-2">
						<form action="{{ route('auth.logout') }}" method="POST" class="w-50">
							@csrf
							<button type="submit" class="btn btn-danger w-100">
								<i class="fa fa-sign-out-alt me-2"></i>
								Logout</button>
						</form>
						<a href="{{ route('startFamily') }}" class="btn btn-primary w-50">
							<i class="fa fa-user-plus me-2"></i>
							Buat keluarga baru
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
