<div class="container">
    <div class="row">
        @if(Auth::guard('usrInventario')->user()->idPerfil == 1)
        <div class="col-12 text-center py-4">
            <a href="{{ route('lista-productos') }}" class="list-group-item icon-menu">
                <i class="fa-solid fa-inbox fa-3x"></i><br>
                Bandeja productos
            </a>
        </div>
        @endif
        @if(Auth::guard('usrInventario')->user()->idPerfil == 2)
        <div class="col-12 text-center py-4">
            <a href="{{ route('registro-productos') }}" class="list-group-item icon-menu">
                <i class="fa-solid fa-cubes fa-3x"></i><br>
                Registro productos
            </a>
        </div>
        @endif
    </div>
</div>