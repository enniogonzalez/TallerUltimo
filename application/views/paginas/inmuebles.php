<div class="container">
    <div class="row">
        <div class="col-lg-9" style="padding: 0px;">
            <h2><span class="fa fa-product-hunt "></span> Inmuebles</h2> 
        </div>
    </div>
</div>

<div class="container">
    <div class="formulario-siama">
        <form class ="formulario-desactivado" id="FormularioActual" method="POST" action = "<?=site_url('/inmuebles/guardar')?>">

            <div style="margin: 10px 15px;display:none;" id="alertaFormularioActual" class="alert alert-danger text-center">
            </div>
            <div style="display:none;" id = "IdForm">
                <?=$id?> 
            </div>

            <div class="form-group row">
                <label for="Titulo" class="col-md-3 col-form-label">Titulo:</label>
                <div class="col-md-9">
                    <input maxlength="100" readonly disabled type="text" 
                    class="form-control obligatorio texto" id="Titulo" value="<?=$Titulo?> ">
                    <div class="invalid-feedback">Campo Obligatorio</div>
                </div>
            </div>

            <div class="form-group row">
                <label for="Descripcion" class="col-md-3 col-form-label">Descripci&oacute;n:</label>
                <div class="col-md-9">
                    <textarea  readonly disabled class="form-control texto obligatorio" rows="3"
                    style = "resize:vertical;" id="Descripcion"><?=$Descripcion?></textarea>
                    <div class="invalid-feedback">Campo Obligatorio</div>
                </div>
            </div>

            <div class="form-group row">
                <label for="Ubicacion" class="col-md-3 col-form-label">Ubicaci&oacute;n:</label>
                <div class="col-md-9">
                    <textarea  readonly disabled class="form-control texto obligatorio" rows="3"
                    style = "resize:vertical;" id="Ubicacion"><?=$Ubicacion?></textarea>
                    <div class="invalid-feedback">Campo Obligatorio</div>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="Estado" class="col-md-3 col-form-label">Estado:</label>
                <div class="col-md-9">
                    <select readonly disabled class="form-control obligatorio lista" id="Estado">
                        <option <?=($Estado == "En venta" ? "Selected":"")?> value="En venta">En venta</option>
                        <option <?=($Estado == "Vendido" ? "Selected":"")?> value="Vendido">Vendido</option>
                        <option <?=($Estado == "En alquiler" ? "Selected":"")?> value="En alquiler">En alquiler</option>
                        <option <?=($Estado == "Alquilado" ? "Selected":"")?> value="Alquilado">Alquilado</option>
                    </select>
                </div>
            </div>


        </form>
        <div style="display:none;" id ="ControladorActual"><?=site_url('/inmuebles')?></div>
        <div style="background-color: #95a5a6; padding: 10px;">

            <div class="form-group row botoneraFormulario" >

                <button  type="button"  class="btn btn-primary-siama" id="BuscarRegistro">
                    <span class="fa fa-search"></span>
                    Buscar
                </button>

                <button type="button"  class="btn btn-primary-siama" id="EditarRegistro">
                    <span class="fa fa-pencil-square-o"></span>
                    Editar
                </button>

                <button type="button"  class="btn btn-primary-siama" id="AgregarRegistro">
                    <span class="fa fa-plus"></span>
                    Agregar
                </button>

            </div>
        </div>
    </div>
</div>