<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema de Inventario</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        {{-- Fontawesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css" integrity="sha512-R+xPS2VPCAFvLRy+I4PgbwkWjw1z5B5gNDYgJN5LfzV4gGNeRQyVrY7Uk59rX+c8tzz63j8DeZPLqmXvBxj8pA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        {{-- Estilos propios --}}
        <link rel="stylesheet" href="{{ secure_asset('css/gral_styles.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/global_styles.css') }}">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7" id="fondo">
                    {{-- <div class="fondo-izq"></div> --}}
                    {{-- <img src="https://sirefi.morelos.gob.mx/images/sirefi_bn.png" class="img-fluid"> --}}
                    <div class="col-12 py-3 px-4 d-flex">
                        <span>
                            <i class="fa-solid fa-cart-flatbed fa-4x"></i>
                        </span>
                        <span class="align-middle py-1 px-4 title-page">
                            Sistema de <br>Inventario
                        </span>
                    </div>
                    <div class="col-12 text-center d-sm-none d-md-block d-none d-sm-block">
                        <img src="{{ secure_asset('img/inventario.svg') }}" alt="imagen inventario" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-5 h-100">
                    <div class="login_wrapper">
                        <div class="animate form login_form">
                            <section class="login_content">
                                <form method="POST" id="form_acceso">
                                    <div class="col-12 mb-5">
                                        <p class="h2">Bienvenido</p>
                                        <p class="h6 text-muted text-register">Por favor inicie sesión para acceder</p>
                                    </div>
                                    <div>
                                        <div class="form-group mb-3">
                                            <input name="nomUsuario" id="nomUsuario" type="text" placeholder="&#xF4D7;&nbsp;Nombre de usuario" class="form-control" required="true" style="font-family: 'Poppins','bootstrap-icons';">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" name="contrasenia" id="contrasenia" placeholder="&#xF538;&nbsp;Contraseña" class="form-control" required="true" style="font-family: 'Poppins', 'bootstrap-icons';">
                                        </div>
                                        <div id="msgLogin" class="my-3"></div>
                                        <div class="form-group">
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-block btn-primary" id="btn_submit">Acceder</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="separator" align="center">
                                            <p class="change_link">¿No tienes una cuenta?<p>
                                            <a href="javascript:void();" id="btnCreateAccount">Crear cuenta</a>
                                        </div>                                    
                                    </div>
                                </form>
                                <form method="POST" id="form_registro" style="display: none;">
                                    <div class="col-12 mb-5">
                                        <p class="h2">Bienvenido</p>
                                        <p class="h6 text-muted text-register">Por favor registre sus datos para empezar</p>
                                    </div>
                                    <div>
                                        <div class="form-group mb-3">
                                            <input name="nombre" id="nombre" type="text" placeholder="&#xF4D7;&nbsp;Nombre(s)" class="form-control" required="true" style="font-family: 'Poppins','bootstrap-icons';">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input name="apPaterno" id="apPaterno" type="text" placeholder="&#xF4D7;&nbsp;Apellido paterno" class="form-control" required="true" style="font-family: 'Poppins','bootstrap-icons';">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input name="apMaterno" id="apMaterno" type="text" placeholder="&#xF4D7;&nbsp;Apellido materno" class="form-control" required="true" style="font-family: 'Poppins','bootstrap-icons';">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input name="nomUsuario" id="nomUsuario" type="text" placeholder="&#xF4D7;&nbsp;Nombre de usuario" class="form-control" required="true" style="font-family: 'Poppins','bootstrap-icons';">
                                        </div>
                                        <div class="form-group mb-3">
                                            <select class="form-select" placeholder="&#xF4D7;&nbsp;Permisos" required="true" style="font-family: 'Poppins','bootstrap-icons';">
                                                <option disabled selected>&#xF4D7;&nbsp;Permisos</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" name="contrasenia" id="contrasenia" placeholder="&#xF538;&nbsp;Contraseña" class="form-control" required="true" style="font-family: 'Poppins', 'bootstrap-icons';">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" name="confimaContrasenia" id="confimaContrasenia" placeholder="&#xF538;&nbsp;Confirmar contraseña" class="form-control" required="true" style="font-family: 'Poppins', 'bootstrap-icons';">
                                        </div>
                                        <div id="msgLogin" class="my-3"></div>
                                        <div class="form-group">
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-block btn-primary" id="btn_submit">Registrarse</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="separator" align="center">
                                            <p class="change_link">¿Ya tienes una cuenta?<p>
                                            <a href="javascript:void();" id="btnLoginAccount">Iniciar sesión</a>
                                        </div>                                    
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                    <div class="col-12">
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
        @include('public.includes.footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src={{ secure_asset('js/index.js') }}></script>
    </body>
</html>
