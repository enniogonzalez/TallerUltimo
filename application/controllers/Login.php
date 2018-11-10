
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    public function view($page = 'login'){


        if(!file_exists(APPPATH.'views/paginas/login.php')){
            show_404();
        }

        if($page != 'login'){
            redirect(site_url(''));
        }
        
        $JsFile = "<script src=\"". base_url() . "assets/js/Siama/login.js\"></script>";
            
        $datafile['JsFile'] = $JsFile ;
        $dataLD['OrdenarBusqueda'] = "";

        $this->load->view('plantillas/1-header-login', $datafile);
        $this->load->view('plantillas/2-modales',$dataLD);
        $this->load->view('paginas/login');
        $this->load->view('plantillas/7-footer-login');


        if($this->session->userdata("nombre")){
            redirect(site_url('home'));
        }

    }

    public function validar(){
        if($this->input->post("inputPassword") == ""){
            redirect(site_url(''));
        }
        $clave = $this->input->post("inputPassword");
        $usuario = $this->input->post("inputUsuario");


        $this->load->model('Sistema/usuarios_model' , 'usuarios_model');
        $resp = $this->usuarios_model->logger($usuario,$clave);

        if($resp){
            $data = [
                "Username"      => $resp['Username']
            ];
            $this->session->set_userdata($data);
            echo json_encode(array("isValid"=>true,"Mensaje"=>"Ingreso Satisfactorio","url" => site_url('home')));
        }else{
            echo json_encode(array("isValid"=>false,"Mensaje"=>"Usuario y contraseña no coinciden"));
        }
    }

    public function cerrarConexion(){
        $this->session->sess_destroy();
        redirect(site_url(''));
    }
}

?>