<?php

    class Ordenes extends CI_Controller{

        private $Ordenes = array();

        public function __construct(){
            parent::__construct();
            $this->Ordenes = array(
                "Ultimo" => 4,
                "Registros"=> array(
                    array(
                        "id"=>1,
                        "Documento"=>"0000001",
                        "idInmueble"=>1,
                        "Inmueble"=>"Inmueble 1",
                        "Inicio"=> "2018-01-01",
                        "Fin" => "2018-12-01",
                        "Observacion" => "Observacion"
                    ),
                    array(
                        "id"=>2,
                        "Documento"=>"0000002",
                        "idInmueble"=>2,
                        "Inmueble"=>"Inmueble 2",
                        "Inicio"=> "2019-01-01",
                        "Fin" => "2019-12-01",
                        "Observacion" => "Observacion 2"
                    ),
                    array(
                        "id"=>3,
                        "Documento"=>"0000003",
                        "idInmueble"=>3,
                        "Inmueble"=>"Inmueble 3",
                        "Inicio"=> "2017-01-01",
                        "Fin" => "2017-12-01",
                        "Observacion" => "Observacion 3"
                    ),
                    array(
                        "id"=>4,
                        "Documento"=>"0000004",
                        "idInmueble"=>4,
                        "Inmueble"=>"Inmueble 4",
                        "Inicio"=> "2016-01-01",
                        "Fin" => "2016-12-01",
                        "Observacion" => "Observacion 4"
                    )
                )
            );

            if($this->session->userdata('Ordenes') == ""){
                $this->session->set_userdata('Ordenes', $this->Ordenes);
            }
        }

        public function view(){

            $OrdenesActual = $this->session->userdata('Ordenes');
            
            $data = $OrdenesActual["Registros"][0];

            $JsFile = "<script src=\"". base_url() . "assets/js/Ordenes.js\"></script>";
            
            $datafile['JsFile'] = $JsFile ;

            $dataLD['OrdenarBusqueda'] = "";

            $dataAlerta['cantAlertas'] = "";

            $this->load->view('plantillas/1-header', $datafile);
            $this->load->view('plantillas/2-barranavegacion',$dataAlerta);
            $this->load->view('plantillas/2-modales',$dataLD);
            $this->load->view('plantillas/3-iniciomain');
            $this->load->view('plantillas/4-barramenu');
            $this->load->view('plantillas/5-iniciopagina');
            $this->load->view('paginas/ordenes',$data);
            $this->load->view('plantillas/7-footer');


        }

        public function guardar(){

            
            $OrdenesActual = $this->session->userdata('Ordenes');
            if($this->input->post("id") == ""){
                $OrdenesActual["Ultimo"]++;
                $nuevo = array(
                    "id"            => $OrdenesActual["Ultimo"],
                    "Documento"     => substr("0000000000" . trim($OrdenesActual["Ultimo"]),-7) ,
                    "idInmueble"    => $this->input->post("idInmueble"),
                    "Inmueble"      => $this->input->post("Inmueble"),
                    "Inicio"        => $this->input->post("Inicio"),
                    "Fin"           => $this->input->post("Fin"),
                    "Observacion"   => trim($this->input->post("Observacion"))
                );
                array_push($OrdenesActual["Registros"], $nuevo);
            }else{
                $nuevo = array(
                    "id"            => $this->input->post("id"),
                    "Documento"     => $this->input->post("Documento"),
                    "idInmueble"    => $this->input->post("idInmueble"),
                    "Inmueble"      => $this->input->post("Inmueble"),
                    "Inicio"        => $this->input->post("Inicio"),
                    "Fin"           => $this->input->post("Fin"),
                    "Observacion"   => trim($this->input->post("Observacion"))
                );

                $iterador = 0;
                $encontrado = false;
                $cantidad = count($OrdenesActual["Registros"]);

                while($iterador < $cantidad &&  !$encontrado){
                    if($OrdenesActual["Registros"][$iterador]['id'] == $nuevo['id']){
                        
                        $OrdenesActual["Registros"][$iterador] = $nuevo;
                        $encontrado = true;
                    }
                    $iterador++;
                }

            }
            
            $this->session->set_userdata('Ordenes', $OrdenesActual);
            echo json_encode(array("isValid"=>true,"Datos"=>$nuevo));
        }

        public function busqueda(){

            $pagina = (int) $this->input->post("Pagina") ;
            $regXpag = (int) $this->input->post("RegistrosPorPagina") ;

            $OrdenesActual = $this->session->userdata('Ordenes');
            $inicio = $regXpag*($pagina-1);
            $fin = $regXpag*$pagina-1;

            $cantidad = count($OrdenesActual["Registros"]);
            $OrdenesActual = $OrdenesActual["Registros"];
            $htmlListas = "";
            
            while($inicio <=$fin && $inicio < $cantidad){

                $htmlListas = $htmlListas
                ."<tr>"
                .   "<td style='display:none;'>" . $OrdenesActual[$inicio]['id'] . "</td>"
                .   "<td style='display:none;'>" . $OrdenesActual[$inicio]['idInmueble'] . "</td>"
                .   "<td>" . $OrdenesActual[$inicio]['Documento'] . "</td>"
                .   "<td>" . $OrdenesActual[$inicio]['Inmueble'] . "</td>"
                .   "<td>" . $OrdenesActual[$inicio]['Inicio'] . "</td>"
                .   "<td>" . $OrdenesActual[$inicio]['Fin'] . "</td>"
                .   "<td style='display:none;'>" . $OrdenesActual[$inicio]['Observacion'] . "</td>"
                ."</tr>";

                $inicio++;
            }

            $data['Listas'] = $htmlListas;
            $data['Registros'] = $cantidad;
            echo json_encode(array("isValid"=>true,"Datos"=>$data));
        }

    }


?>