<div class="container-fluid ps-0">
	<div class="row">
		<input type="hidden" name="isUpdate" value="{{ (isset($isUpdate) && $isUpdate)?1:0 }}">
		<input type="hidden" name="idProducto" value="{{ (isset($producto))?$producto->id:'' }}">
		<div class="form-group col-lg-4 col-md-4 col-sm-12 mb-3">
			<label for="nombre_producto">Nombre del producto</label>
			<input type="text" id="nombre_producto" name="nombre_producto" class="form-control" maxlength="30" required {{ (isset($isUpdate) && $isUpdate)?'disabled':'' }}>
		</div>
		<div class="form-group col-lg-4 col-md-4 col-sm-12 mb-3">
			<label for="precio">Precio</label>
			<div class="input-group">
				<span class="input-group-text">$</span>
				<input type="text" id="precio" name="precio" class="form-control" maxlength="5" required {{ (isset($isUpdate) && $isUpdate)?'disabled':'' }}>
			</div>
		</div>
		<div class="form-group col-lg-4 col-md-4 col-sm-12 mb-3">
			<label for="fecha_compra">Fecha de compra</label>
			<input type="date" id="fecha_compra" name="fecha_compra" class="form-control" required {{ (isset($isUpdate) && $isUpdate)?'disabled':'' }}>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-lg-4 col-md-4 col-sm-12 mb-3 {{ (isset($isUpdate) && $isUpdate)?'':'offset-md-2' }}">
			<label for="categoria">Categoría</label>
			<select class="form-select" id="categoria" name="categoria" required {{ (isset($isUpdate) && $isUpdate)?'disabled':'' }}>
				<option value="" selected disabled>Seleccionar una categoría</option>
			</select>
		</div>
		<div class="form-group col-lg-4 col-md-4 col-sm-12 mb-3">
			<label for="sucursal">Sucursal</label>
			<select class="form-select" id="sucursal" name="sucursal" required {{ (isset($isUpdate) && $isUpdate)?'disabled':'' }}>
				<option value="" selected disabled>Seleccionar una sucursal</option>
			</select>
		</div>
		@if(isset($isUpdate) && $isUpdate)
		<div class="form-group col-lg-4 col-md-4 col-sm-12 mb-3">
			<label for="estado">Estado</label>
			<select class="form-select" id="estado" name="estado" required>
				<option value="" selected disabled>Seleccionar estado de producto</option>
			</select>
		</div>
		<div class="form-group col-lg-12 col-md-12 col-sm-12 mb-3">
			<label for="comentarios">Comentarios</label>
			<textarea name="comentarios" id="comentarios" maxlength="100" rows="5" class="form-control" required></textarea>
		</div>
		@endif
	</div>
	<div class="row">
		<div class="form-group col-lg-12 col-md-12 col-sm-12 mb-3">
			<label for="descripcion">Descripción</label>
			<textarea class="form-control" id="descripcion" name="descripcion" maxlength="100" rows="5" required {{ (isset($isUpdate) && $isUpdate)?'disabled':'' }}></textarea>
		</div>
	</div>
</div>