

var paginas = 0;
var RegistrosPorPagina = 10;
var PagesxNav = 5;
var PrimeraVezBusqueda = true;
var Guardando = false;

$(function(){

    var idActual ="";
    var dataInputs= [];

    EstablecerBuscador()



    $('.botoneraFormulario').on('click','#BuscarRegistro',function(){
        SetSearchType('Formulario');
        SetSearchTitle('Busqueda Inmuebles');
        PrimeraVezBusqueda = true;
        DeshabilitarBotonera();
        SetUrlBusqueda($('#ControladorActual').text().trim()+"/busqueda");
        Busqueda(1);
        
        setTimeout(function(){
            HabilitarBotonera();
        }, 900);
    })


    $('.botoneraFormulario').on('click','#EditarRegistro',function(){
        GuardarEstadoActualFormulario();
        HabilitarFormulario()
        $('#nombreMarca').focus();
    });

    $('.botoneraFormulario').on('click','#AgregarRegistro',function(){
        GuardarEstadoActualFormulario();
        ClearForm();
        HabilitarFormulario()
        $('#nombreMarca').focus();
    })

    $('.botoneraFormulario').on('click','#CancelarRegistro',function(){
        ClearForm();
        RestablecerEstadoAnteriorFormulario();
        DeshabilitarFormulario();
    })

    $('.botoneraFormulario').on('click','#GuardarRegistro',function(){
        var Valido = true;
        
        $('.formulario-siama form .form-control').each(function(){
            $(this).removeClass('is-invalid');
            if($(this).hasClass('obligatorio') && $(this).val().trim() == ""){

                if(Valido)
                    $(this).focus();
                
                Valido = false;
                $(this).addClass('is-invalid');
            }
        })

        if(Valido){
            
            var parametros = {
                "id"            : $('#IdForm').text().trim(),
                "Titulo"        : $('#Titulo').val().trim(),
                "Descripcion"   : $('#Descripcion').val().trim(),
                "Ubicacion"     : $('#Ubicacion').val().trim(),
                "Estado"        : $('#Estado').val().trim(),
                "Url"           : $('#FormularioActual').attr("action")
            }
            
            if(!Guardando){
                Guardando = true;
                GuardarFormulario(parametros);
            }
        }
        
    });

    function EstablecerBuscador(){
        SetSearchThead(thInmuebles);
    }

    function ClearForm(){
        
        $('#IdForm').text(''); 
        $('#alertaFormularioActual').hide();

        $('.formulario-siama form .form-control').each(function(){
            $(this).removeClass('is-invalid');
            if($(this).hasClass('texto'))
                $(this).val('')
            else if($(this).hasClass('lista'))
                $(this)[0].selectedIndex = 0;
            else if ($(this).hasClass('decimal'))
                $(this).val('0.00')
        })
    }
    
    function GuardarEstadoActualFormulario(){
        dataInputs = [];
        idActual =$('#IdForm').text().trim();
        $('.formulario-siama form .form-control').each(function(){
            dataInputs.push($(this).val().trim());
        })
    }

    function RestablecerEstadoAnteriorFormulario(){
        var parametros = {
            "id"            :   idActual.trim(),
            "Titulo"        :   dataInputs[0].trim(),
            "Descripcion"   :   dataInputs[1].trim(),
            "Ubicacion"     :   dataInputs[2].trim(),
            "Estado"        :   dataInputs[3].trim()
        }
        
        LlenarFormulario(parametros);
    }
    
    function LlenarFormulario(data){
        $('#IdForm').text(data['id']);
        $('#Titulo').val(data['Titulo']);
        $('#Descripcion').val(data['Descripcion']);
        $('#Ubicacion').val(data['Ubicacion']);
        $('#Estado').val(data['Estado']);
    }

    window.InterfazElegirBuscador = function(fila){
        var parametros = {
            "id":           fila.find('td:eq(0)').text().trim(),
            "Titulo":       fila.find('td:eq(1)').text().trim(),
            "Descripcion":  fila.find('td:eq(2)').text().trim(),
            "Ubicacion":  fila.find('td:eq(3)').text().trim(),
            "Estado":  fila.find('td:eq(4)').text().trim(),
        }
        LlenarFormulario(parametros);
        $('#SiamaModalBusqueda').modal('hide');
    }

});