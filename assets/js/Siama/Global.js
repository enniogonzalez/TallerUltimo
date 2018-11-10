function validateEmail(email) {
    var re = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
    return re.test(email);
  }

$(function(){
    $(window).scrollTop(0);
    
    $('.buscador').on('keypress',function(){
        return false;
    })
    
    $('#SeccionImprimir').on('click',"#Imprimir",function(){
        window.open($('#ControladorActual').text().trim() + "/imprimir/" + $('#IdForm').text().trim(), '_blank');
    })

    window.SetAlertaFormulario = function (Mensaje){
        $('#alertaFormularioActual').children().remove();
        $('#alertaFormularioActual').text('');
        $('#alertaFormularioActual').append(Mensaje);
        $('#alertaFormularioActual').show();
        document.getElementsByClassName("informationPage")[0].scrollIntoView();
    }

    window.GuardarFormulario = function(parametros){

        DeshabilitarFormulario(false);
        DeshabilitarBotonera();
        MostrarEstatus(1); 

        $.ajax({
            url: parametros['Url'],
            type: 'POST',
            data: parametros,
            dataType: 'json'
        }).done(function(data){
            Guardando = false;

            HabilitarBotonera();
            if(data['isValid']){

                $('#alertaFormularioActual').hide();
                
                $('#IdForm').text(data['id']);
                AgregarBotoneraPrimaria()
                AccionGuardar(data);
                MostrarEstatus(2,true); 
                setTimeout(function(){
                    CerrarEstatus();
                }, 6000);
            }else{
                CerrarEstatus();
                SetAlertaFormulario(data['Mensaje']);
                HabilitarFormulario(false);
            }
        }).fail(function(data){
            Guardando = false;
            HabilitarFormulario(false);
            failAjaxRequest(data);
        });
    }

    //Funcion a sobre escribir
    window.AccionGuardar = function(data){}

    window.HabilitarFormulario = function(cambiarBotonera = true){

        $('#FormularioActual').removeClass('formulario-desactivado');

        $('.formulario-siama form .form-control').each(function(){
            if(!$(this).hasClass('estatus')){
                $(this).removeAttr("disabled"); 
                $(this).removeAttr("readonly");
            }
        })

        $('.formulario-siama table').each(function(){
            $(this).removeClass('tabla-siama-desactivada')
        })

        if(cambiarBotonera)
            AgregarBotoneraSecundaria();
    }

    window.DeshabilitarFormulario = function(cambiarBotonera = true){

        $('.tr-activa-siama').removeClass('tr-activa-siama');
        $('#FormularioActual').addClass('formulario-desactivado');

        $('.formulario-siama form .form-control').each(function(){
            $(this).attr("disabled", "disabled");
            $(this).attr("readonly", "readonly");
        })
        
        $('.formulario-siama table').each(function(){
            $(this).addClass('tabla-siama-desactivada')
        })
        
        if(cambiarBotonera){
            if($('#IdForm').text().trim()=="")
                AgregarBotoneraPrimariaNULL();
            else
                AgregarBotoneraPrimaria();
        }
    }

    window.AgregarBotoneraPrimaria = function(){
        
        $('#SeccionImprimir').children().remove();
        $('.botoneraFormulario').children().remove();

        $('#SeccionImprimir').append(`
            <button type="button"  class="btn btn-primary-siama" id="Imprimir">
                <span class="fa fa-print fa-lg"></span>
                Imprimir
            </button>
        `);

        $('.botoneraFormulario').append(`
            <button  title="Buscar" type="button"  class="btn btn-primary-siama" id="BuscarRegistro">
                <span class="fa fa-search"></span>
                Buscar
            </button>

            <button title="Editar" type="button"  class="btn btn-primary-siama" id="EditarRegistro">
                <span class="fa fa-pencil-square-o"></span>
                Editar
            </button>

            <button title="Agregar" type="button"  class="btn btn-primary-siama" id="AgregarRegistro">
                <span class="fa fa-plus"></span>
                Agregar
            </button>
        `);
    }

    window.AgregarBotoneraPrimariaNULL = function(){
        
        $('#SeccionImprimir').children().remove();
        $('.botoneraFormulario').children().remove();
        $('.botoneraFormulario').append(`
            <button title="Agregar" type="button"  class="btn btn-primary-siama" id="AgregarRegistro">
                <span class="fa fa-plus"></span>
                Agregar
            </button>
        `);
    }

    window.AgregarBotoneraSecundaria = function(){


        $('#SeccionImprimir').children().remove();
        $('.botoneraFormulario').children().remove();


        $('.botoneraFormulario').append(`
            <button title="Guardar" type="button" class="btn  btn-success" id="GuardarRegistro">
                <span class="fa fa-floppy-o"></span>
                Guardar
            </button>
            <button  title="Cancelar" type="button" class="btn  btn-danger" id="CancelarRegistro">
                <span class="fa fa-ban "></span>
                Cancelar
            </button>
        `);

    }

    window.DeshabilitarBotonera = function(){
        $('.botoneraFormulario').addClass('botoneraDeshabilitada');
        $('.botoneraFormulario').find('button').each(function(){
            $(this).attr("disabled","disabled")
        })
    }

    window.HabilitarBotonera = function(){
        $('.botoneraFormulario').removeClass('botoneraDeshabilitada');
        $('.botoneraFormulario').find('button').each(function(){
            $(this).removeAttr("disabled")
        })
    }

});