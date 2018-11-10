

        <header class="header-siama">
            <div class="container text-center">
                <h1>Bienvenido a SiamaFACYT</h1>
            </div>
        </header>
        <div class="container container-login-siama">

            <form id="loginform" class="form-signin login-siama" method="POST" action = "<?=site_url('/login/validar')?>">
                <h2 class="font-weight-normal text-center">Iniciar Sesi&oacute;n</h2>

                <div style="display:none;" id="alertaLogin" class="alert alert-danger text-center">
                    Usuario o Contraseña inv&aacute;lida
                </div>
                <hr>

                <div class="form-group row">
                    <label for="inputUsuario" class="col-lg-2 col-form-label">Usuario:</label>
                    <div class="col-lg-10">
                        <input type="text" name ="inputUsuario" id="inputUsuario" class="form-control" required placeholder="Ingresar Usuario"  autofocus>
                        <div id="invalidUser" class="invalid-feedback">Campo Obligatorio</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-lg-2 col-form-label">Contraseña:</label>
                    <div class="col-lg-10">
                        <input type="password" maxlength="10" name="inputPassword" id="inputPassword" class="form-control" required placeholder="Ingresar Contraseña" >
                        <div id="invalidPassword" class="invalid-feedback">Campo Obligatorio</div>
                    </div>
                </div>
                
                <button class="btn btn-lg btn-primary-siama btn-block" id="loginbutton" type="submit"><span class="fa fa-sign-in " style="margin-right:5px;"></span>Ingresar</button>
            </form>
        </div>