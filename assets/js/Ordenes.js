

var paginas = 0;
var RegistrosPorPagina = 10;
var PagesxNav = 5;
var PrimeraVezBusqueda = true;
var Guardando = false;

$(function(){

    const Inmuebles    = "Inmuebles";

    var idActual ="";
    var idInmueble="";
    var dataInputs= [];
    var idBuscadorActual = "";
    var nombreBuscadorActual = "";

    EstablecerBuscador()

    /************************************/
    /*      Inicio Buscadores           */
    /************************************/
    /************************************/
    /*      Manejo Inmuebles            */
    /************************************/
    
    $('.BuscarInmueble').on('click',function(){
        BuscarInmueble();
    });

    $('.BorrarInmueble').on('click',function(){
        $('#idInmueble').text("");
        $('#Inmueble').val("");
    });
  
    /************************************/
    /*          Fin Buscadores          */
    /************************************/

    $('.botoneraFormulario').on('click','#BuscarRegistro',function(){
        SetSearchType('Formulario');
        SetSearchThead(thOrdenes);
        SetSearchTitle('Busqueda Ordenes');
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

        $('#Documento').attr("disabled", "disabled");
        $('#Documento').attr("readonly", "readonly");


        $('#nombreMarca').focus();
    });

    $('.botoneraFormulario').on('click','#AgregarRegistro',function(){

        GuardarEstadoActualFormulario();
        ClearForm();
        

        HabilitarFormulario()
        $('#Documento').attr("disabled", "disabled");
        $('#Documento').attr("readonly", "readonly");
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
                "idInmueble"    : $('#idInmueble').val().trim(),
                "Documento"     : $('#Documento').val().trim(),
                "Inmueble"      : $('#Inmueble').val().trim(),
                "Inicio"        : $('#Inicio').val().trim(),
                "Fin"           : $('#Fin').val().trim(),
                "Observacion"   : $('#Observacion').val().trim(),
                "Url"           : $('#FormularioActual').attr("action")
            }
            
            if(!Guardando){
                Guardando = true;
                GuardarFormulario(parametros);
            }
        }
        
    });

    function EstablecerBuscador(){
        SetSearchThead(thOrdenes);
    }

    function BuscarInmueble(){

        SetSearchThead(thInmuebles);
        parametros = {
            "Lista": "",
            "Tipo": Inmuebles,
        }

        idBuscadorActual = $('#idInmueble').text().trim();
        nombreBuscadorActual = $('#Inmueble').val().trim();
        SetSearchModal(parametros)

    }

    function ClearForm(){
        
        $('#IdForm').text(''); 
        $('#idInmueble').text(''); 
        $('#alertaFormularioActual').hide();

        $('.formulario-siama form .form-control').each(function(){
            $(this).removeClass('is-invalid');
            if($(this).hasClass('texto') || $(this).hasClass('fecha') )
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
        idInmueble =$('#idInmueble').text().trim();
        $('.formulario-siama form .form-control').each(function(){
            dataInputs.push($(this).val().trim());
        })
    }

    function RestablecerEstadoAnteriorFormulario(){
        var parametros = {
            "id"            :   idActual.trim(),
            "idInmueble"    :   idInmueble.trim(),
            "Documento"     :   dataInputs[0].trim(),
            "Inmueble"      :   dataInputs[1].trim(),
            "Inicio"        :   dataInputs[2].trim(),
            "Fin"           :   dataInputs[3].trim(),
            "Observacion"   :   dataInputs[4].trim()
        }
        
        LlenarFormulario(parametros);
    }
    
    function LlenarFormulario(data){
        $('#IdForm').text(data['id']);
        $('#idInmueble').text(data['idInmueble']);
        $('#Documento').val(data['Documento']);
        $('#Inmueble').val(data['Inmueble']);
        $('#Inicio').val(data['Inicio']);
        $('#Fin').val(data['Fin']);
        $('#Observacion').val(data['Observacion']);
    }

    function SetSearchModal(data,buscar =true,condiciones = {}){
        SetSearchType(data['Tipo']);
        
        switch(data['Tipo']){
            case Inmuebles:
                controlador = "Inmuebles";
            break;
        }

        SetModalEtqContador(controlador)
        SetSearchCOB(data['Lista']);


        SetSearchTitle('Busqueda ' + controlador);
        PrimeraVezBusqueda = true;
        SetUrlBusqueda(GetUrlBusquedaOpcion(data['Tipo']));

        if(buscar)
            Busqueda(1,false,condiciones);
    }
    
    function GetUrlBusquedaOpcion(opcion){
        switch(opcion){
            case Inmuebles:
                controlador = "inmuebles/busquedaDisponibles";
            break;
        }

        return $('#UrlBase').text() + "/" + controlador
    }
    
    window.AccionGuardar = function(data){
        LlenarFormulario(data['Datos']);
    }
    window.InterfazElegirBuscador = function(fila){;
        
        switch(GetSearchType()){
            case "Formulario":
                var parametros = {
                    "id"            : fila.find('td:eq(0)').text().trim(),
                    "idInmueble"    : fila.find('td:eq(1)').text().trim(),
                    "Documento"     : fila.find('td:eq(2)').text().trim(),
                    "Inmueble"      : fila.find('td:eq(3)').text().trim(),
                    "Inicio"        : fila.find('td:eq(4)').text().trim(),
                    "Fin"           : fila.find('td:eq(5)').text().trim(),
                    "Observacion"   : fila.find('td:eq(6)').text().trim(),
                }
                LlenarFormulario(parametros)
            break;
            case Inmuebles:
                $('#idInmueble').text(fila.find("td:eq(0)").text().trim());
                $('#Inmueble').val(fila.find("td:eq(1)").text().trim());
            break;

        }

        $('#SiamaModalBusqueda').modal('hide');
    }

});