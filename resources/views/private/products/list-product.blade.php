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
							<p class="h3">Lista de productos</p>
							<div id="wrapper"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@section('script')
		<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
		<script>
			new gridjs.Grid({
			  columns: ["Name", "Email", "Phone Number"],
			  data: [
			    ["John", "john@example.com", "(353) 01 222 3333"],
			    ["Mark", "mark@gmail.com", "(01) 22 888 4444"],
			    ["Eoin", "eoin@gmail.com", "0097 22 654 00033"],
			    ["Sarah", "sarahcdd@gmail.com", "+322 876 1233"],
			    ["Afshin", "afshin@mail.com", "(353) 22 87 8356"]
			  ]
			}).render(document.getElementById("wrapper"));
		</script>	
	@endsection
@endsection