@extends('private.layout.layout')
@section('title','Panel')
@section('content')
	@include('private.includes.navbar')
	<div class="container-fluid">
		<div class="row vhtmp-100">
			<div class="col-lg-1 bg-leftbar border-end px-0 d-sm-none d-md-block d-none d-sm-block d-md-none d-lg-block">
				@include('private.includes.left-navbar')
			</div>
			<div class="col-lg-11 col-md-11 col-sm-12 col-12 div-content">
				<div class="text-content text-center pt-4">
					Seleccione una opción para iniciar
				</div>
			</div>
		</div>
	</div>
@endsection