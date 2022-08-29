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
								<a href="{{ route('lista-productos') }}"><i class="fa-solid fa-arrow-left"></i></a>&nbsp;Actualizar producto
							</p>
							<form id="form_update">
								@include('private.products.includes._form-product')
								<div class="col-12 text-center">
									<button type="submit" class="btn btn-success btn-md float-right" form="form_update">Actualizar</button>
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