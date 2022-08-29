@extends('private.layout.layout')
@section('title','Productos')
@section('css')
	<link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
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
							<p class="h3">Bandeja de productos</p>
							<div id="wrapper"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@section('script')
		<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
		<script src="{{ secure_asset('js/private/ListProductsScript.js') }}"></script>
	@endsection
@endsection