@extends('layout.layout')
@section('sub-layout')
	<div id="auth">
		<div class="d-flex justify-content-center align-items-center vh-100">

			<div class="card w-lg-50 shadow">
				<div class="card-body">
					<h4 class="card-title text-capitalize text-center">Buat keluarga baru</h4>
					<p class="mb-4 text-center">Buat keluarga baru dan tambahkan keluarga anda</p>

					<form action="{{ route('createFamily') }}" method="POST" class="w-100">
						@csrf
						<div class="form-group">
							<label for="name" class="mb-1">Nama Keluarga</label>
							<input type="text" name="name" id="name" class="form-control round" placeholder="Nama Keluarga">
						</div>
						<div class="d-flex w-100 flex-row-reverse gap-2">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-user-plus me-2"></i>
								Buat Keluarga</button>
							<button type="reset" class="btn btn-secondary">
								Reset</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
