@extends('private.layout.layout')
@section('title','Productos')
@section('css')
	
@endsection
@section('content')
	@include('private.includes.navbar')
	<div class="container-fluid">
		<div class="row vhtmp-100">
			<div class="col-lg-1 bg-leftbar border-end px-0 d-sm-none d-md-block d-none d-sm-block d-md-none d-lg-block">
				@include('private.includes.left-navbar')
			</div>
			<div class="col-lg-11 col-md-11 col-sm-12 col-12">
				<div class="container">
					<div class="row py-4 ps-4">
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<p class="h3">
								@if(Auth::guard('usrInventario')->user()->idPerfil == 1)
								<a href="{{ route('lista-productos') }}"><i class="fa-solid fa-arrow-left"></i></a>&nbsp;
								@endif
								Registro de productos
							</p>
							<form id="form_register">
								@include('private.products.includes._form-product')
								<div class="col-12 text-center">
									<button type="submit" class="btn btn-success btn-md float-right" form="form_register">Registrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@section('script')
		<script src="{{ secure_asset('js/private/productsScript.js') }}"></script>
	@endsection
@endsection