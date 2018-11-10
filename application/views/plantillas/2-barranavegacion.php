
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark header-siama" style="background-color:#2C3E50 !important;">
                
                <a class="navbar-brand" href="<?=site_url('home')?>"><h1>Inmuebles 4K</h1></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" style="color: #fff;cursor:pointer;" href="<?=site_url('alertas')?>">
                            <?php
                                $style = "";

                                if($cantAlertas == 0 ){
                                    $style = "style=\"display:none;\"";
                                }
                            ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #fff;cursor:pointer;" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->session->userdata("Username")?></a>
                        <div style="right:0;" class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="<?=site_url('login/cerrarConexion')?>"><span class="fa-sign-out fa fa-lg"></span> Salir</a>
                        </div>
                    </li>
                    </ul>
                </div>
            </nav>
        </header>