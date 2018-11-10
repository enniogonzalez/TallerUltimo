<?php

    class Inmuebles extends CI_Controller{

        private $Inmuebles = array();

        public function __construct(){
            parent::__construct();
            $this->Inmuebles = array(
                "Ultimo" => 4,
                "Registros"=> array(
                    array(
                        "id"=>1,
                        "Titulo"=>"Inmueble 1",
                        "Descripcion"=> "Este inmueble se encuentra actualmente alquilado",
                        "Ubicacion" => "Venezuela",
                        "Estado" => "Alquilado"
                    ),
                    array(
                        "id"=>2,
                        "Titulo"=>"Inmueble 2",
                        "Descripcion"=> "Este inmueble se encuentra actualmente vendido",
                        "Ubicacion" => "Colombia",
                        "Estado" => "Vendido"
                    ),
                    array(
                        "id"=>3,
                        "Titulo"=>"Inmueble 3",
                        "Descripcion"=> "Este inmueble se encuentra actualmente en alquiler",
                        "Ubicacion" => "Colombia",
                        "Estado" => "En alquiler"
                    ),
                    array(
                        "id"=>4,
                        "Titulo"=>"Inmueble 4",
                        "Descripcion"=> "Este inmueble se encuentra actualmente en venta",
                        "Ubicacion" => "Colombia",
                        "Estado" => "En venta"
                    )
                )
            );

            if($this->session->userdata('Inmuebles') == ""){
                $this->session->set_userdata('Inmuebles', $this->Inmuebles);
            }
        }
        
        public function view(){

            $InmueblesActual = $this->session->userdata('Inmuebles');
            $data = $InmueblesActual["Registros"][0];

            $JsFile = "<script src=\"". base_url() . "assets/js/Inmuebles.js\"></script>";
            
            $datafile['JsFile'] = $JsFile ;

            $dataLD['OrdenarBusqueda'] = "";

            $dataAlerta['cantAlertas'] = "";

            $this->load->view('plantillas/1-header', $datafile);
            $this->load->view('plantillas/2-barranavegacion',$dataAlerta);
            $this->load->view('plantillas/2-modales',$dataLD);
            $this->load->view('plantillas/3-iniciomain');
            $this->load->view('plantillas/4-barramenu');
            $this->load->view('plantillas/5-iniciopagina');
            $this->load->view('paginas/inmuebles',$data);
            $this->load->view('plantillas/7-footer');


        }

        public function guardar(){


            $InmueblesActual = $this->session->userdata('Inmuebles');
            if($this->input->post("id") == ""){
                $InmueblesActual["Ultimo"]++;
                $nuevo = array(
                    "id"            => $InmueblesActual["Ultimo"],
                    "Titulo"        => $this->input->post("Titulo"),
                    "Descripcion"   => $this->input->post("Descripcion"),
                    "Ubicacion"     => $this->input->post("Ubicacion"),
                    "Estado"        => trim($this->input->post("Estado"))
                );
                array_push($InmueblesActual["Registros"], $nuevo);
            }else{
                $nuevo = array(
                    "id"            => $this->input->post("id"),
                    "Titulo"        => $this->input->post("Titulo"),
                    "Descripcion"   => $this->input->post("Descripcion"),
                    "Ubicacion"     => $this->input->post("Ubicacion"),
                    "Estado"        => trim($this->input->post("Estado"))
                );

                $iterador = 0;
                $encontrado = false;
                $cantidad = count($InmueblesActual["Registros"]);

                while($iterador < $cantidad &&  !$encontrado){
                    if($InmueblesActual["Registros"][$iterador]['id'] == $nuevo['id']){
                        
                        $InmueblesActual["Registros"][$iterador] = $nuevo;
                        $encontrado = true;
                    }
                    $iterador++;
                }

            }
            
            $this->session->set_userdata('Inmuebles', $InmueblesActual);
            echo json_encode(array("isValid"=>true));
        }

        public function busqueda(){

            $pagina = (int) $this->input->post("Pagina") ;
            $regXpag = (int) $this->input->post("RegistrosPorPagina") ;

            $InmueblesActual = $this->session->userdata('Inmuebles');
            $inicio = $regXpag*($pagina-1);
            $fin = $regXpag*$pagina-1;

            $cantidad = count($InmueblesActual["Registros"]);
            $InmueblesActual = $InmueblesActual["Registros"];
            $htmlListas = "";
            while($inicio <=$fin && $inicio < $cantidad){

                $htmlListas = $htmlListas
                ."<tr>"
                .   "<td style='display:none;'>" . $InmueblesActual[$inicio]['id'] . "</td>"
                .   "<td>" . $InmueblesActual[$inicio]['Titulo'] . "</td>"
                .   "<td style='display:none;'>" . $InmueblesActual[$inicio]['Descripcion'] . "</td>"
                .   "<td style='display:none;'>" . $InmueblesActual[$inicio]['Ubicacion'] . "</td>"
                .   "<td>" . $InmueblesActual[$inicio]['Estado'] . "</td>"
                ."</tr>";

                $inicio++;
            }

            $data['Listas'] = $htmlListas;
            $data['Registros'] = $cantidad;
            echo json_encode(array("isValid"=>true,"Datos"=>$data));
        }

        public function busquedaDisponibles(){

            $pagina = (int) $this->input->post("Pagina") ;
            $regXpag = (int) $this->input->post("RegistrosPorPagina") ;

            $InmueblesActual = $this->session->userdata('Inmuebles');
            $inicio = $regXpag*($pagina-1);
            $fin = $regXpag*$pagina-1;

            $cantidad = count($InmueblesActual["Registros"]);
            $InmueblesActual = $InmueblesActual["Registros"];
            $htmlListas = "";
            $cantidadDisponibles = 0;
            while($inicio <=$fin && $inicio < $cantidad){

                if($InmueblesActual[$inicio]['Estado'] != "Alquilado" && $InmueblesActual[$inicio]['Estado'] != "Vendido"){

                    $htmlListas = $htmlListas
                    ."<tr>"
                    .   "<td style='display:none;'>" . $InmueblesActual[$inicio]['id'] . "</td>"
                    .   "<td>" . $InmueblesActual[$inicio]['Titulo'] . "</td>"
                    .   "<td style='display:none;'>" . $InmueblesActual[$inicio]['Descripcion'] . "</td>"
                    .   "<td style='display:none;'>" . $InmueblesActual[$inicio]['Ubicacion'] . "</td>"
                    .   "<td>" . $InmueblesActual[$inicio]['Estado'] . "</td>"
                    ."</tr>";
                    $cantidadDisponibles++;
                }

                $inicio++;
            }

            $data['Listas'] = $htmlListas;
            $data['Registros'] = $cantidadDisponibles;
            echo json_encode(array("isValid"=>true,"Datos"=>$data));
        }

    }


?>