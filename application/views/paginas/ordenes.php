<div class="container">
    <div class="row">
        <div class="col-lg-9" style="padding: 0px;">
            <h2><span class="fa fa-first-order"></span> Ordenes</h2> 
        </div>
    </div>
</div>


<div class="container">
    <div class="formulario-siama">
        <form class ="formulario-desactivado" id="FormularioActual" method="POST" action = "<?=site_url('/ordenes/guardar')?>">

            <div style="margin: 10px 15px;display:none;" id="alertaFormularioActual" class="alert alert-danger text-center">
            </div>
            <div style="display:none;" id = "IdForm">
                <?=$id?> 
            </div>

            <div class="form-group row">
                <label for="Documento" class="col-lg-2 col-form-label">Documento:</label>
                <div class="col-lg-10">
                    <input maxlength="100" readonly disabled type="text" 
                    class="form-control texto" id="Documento" value="<?=$Documento?>">
                    <div class="invalid-feedback">Campo Obligatorio</div>
                </div>
            </div>

            <div class="form-group row">
                <label for="Inmueble" class="col-lg-2 col-form-label">Inmueble:</label>
                <div class="col-lg-10">
                    <div style="width:86%;float:left;">
                        <div style="display:none;" id="idInmueble"><?=$idInmueble?></div>
                        <input readonly  type="text"
                            class="form-control texto obligatorio buscador" id="Inmueble" value="<?=$Inmueble?>">
                    <div class="invalid-feedback">Campo Obligatorio</div>
                    </div>
                    <div style="width:14%;float:right;padding:10px 5px;">
                        <span title="Buscar Usuario" class="fa fa-search BuscarInmueble" style="cursor: pointer;float:left;"></span>
                        <div style="width:6px;float:left;"></div>
                        <span title="Borrar Usuario" class="fa fa-trash-o BorrarInmueble" style="cursor: pointer;float:left;"></span>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="Inicio" class="col-lg-2 col-form-label">Inicio:</label>
                <div class="col-lg-4">
                    <input maxlength="100"   type="date"  readonly disabled
                    class="form-control obligatorio fecha" id="Inicio" value="<?=$Inicio?>">
                    <div class="invalid-feedback">Campo Obligatorio</div>
                </div>
                <label for="Fin" class="col-lg-2 col-form-label">Fin:</label>
                <div class="col-lg-4">
                    <input maxlength="100"   type="date"  readonly disabled
                    class="form-control obligatorio fecha" id="Fin" value="<?=$Fin?>">
                    <div class="invalid-feedback">Campo Obligatorio</div>
                </div>
            </div>

            <div class="form-group row">
                <label for="Observacion" class="col-lg-2 col-form-label">Observaci&oacute;n:</label>
                <div class="col-lg-10">
                    <textarea  readonly disabled class="form-control texto obligatorio" rows="3"
                    style = "resize:vertical;" id="Observacion"><?=$Observacion?></textarea>
                    <div class="invalid-feedback">Campo Obligatorio</div>
                </div>
            </div>

        </form>
        <div style="display:none;" id ="ControladorActual"><?=site_url('/ordenes')?></div>
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
