<nav class="navbar navbar-expand-lg bg-light py-0 border-bottom">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
            <i class="fa-solid fa-bars" style="color: #4F46E5;"></i>
        </button>
        <a class="navbar-brand mx-auto py-0" href="#">
            <div class="col-12 py-0 px-2 d-flex py-2">
                <span>
                    <i class="fa-solid fa-cart-flatbed fa-2x"></i>
                </span>
                <span class="align-middle py-1 px-3 title-page">
                    Sistema de <br>Inventario
                </span>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              	<a class="nav-link active" aria-current="page" href="#">Inicio</a>
            </li>
          </ul>
          <div class="d-flex border-start ps-2">
        	<div class="dropdown d-inline-block">
              	<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                	<img class="rounded-full usrImg" src="https://lineone.piniastudio.com/images/avatar/avatar-12.jpg" alt="User Avatar">&nbsp;
                    {{ Auth::guard('usrInventario')->user()->nombre.' '.substr(Auth::guard('usrInventario')->user()->apPaterno, 0, 1).'. '.substr(Auth::guard('usrInventario')->user()->apMaterno, 0, 1).'.' }}
              	</a>
                <div class="dropdown-menu" data-popper-placement="bottom-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="mdi mdi-lock font-size-16 align-middle me-1"></i>&nbsp;Salir
                    </a>
                </div>
            </div>
          </div>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
            {{-- Backdrop with scrolling --}}
            <br>
            <br>
            <br>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="fill: white;"></button>
    </div>
    <div class="offcanvas-body px-0 py-0">
        <ul class="mb-0 ps-0">
            <li class="list-group-item border-bottom">
                <span class="d-block ps-4 py-3 list-group-item">
                    <i class="fa-solid fa-circle-user"></i>&nbsp;
                    {{ Auth::guard('usrInventario')->user()->nombre.' '.Auth::guard('usrInventario')->user()->apPaterno.' '.Auth::guard('usrInventario')->user()->apMaterno }}
                </span>
            </li>
            <li class="list-group-item item-offcanvas">
                <a href="{{ route('dashboard') }}" class="d-block ps-4 py-3 list-group-item">
                    <i class="fa-solid fa-house"></i>&nbsp;Inicio
                </a>
            </li>
            <li class="list-group-item item-offcanvas">
                <a href="{{ route('lista-productos') }}" class="d-block ps-4 py-3 list-group-item">
                    <i class="fa-solid fa-inbox"></i>&nbsp;Bandeja de productos
                </a>
            </li>
            <li class="list-group-item item-offcanvas">
                <a href="{{ route('registro-productos') }}" class="d-block ps-4 py-3 list-group-item">
                    <i class="fa-solid fa-cubes"></i>&nbsp;Registrar productos
                </a>
            </li>
            <li class="list-group-item item-offcanvas">
                <a href="{{ route('logout') }}" class="d-block ps-4 py-3 list-group-item">
                    <i class="fa-solid fa-right-from-bracket"></i>&nbsp;Salir
                </a>
            </li>
        </ul>
    </div>
</div>