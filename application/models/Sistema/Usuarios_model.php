
<?php
    class Usuarios_model extends CI_Model{
        
        private $Usuarios = array();
    
        function __construct(){
            parent::__construct();
            $this->Usuarios = array( array("Username" => "enniogonca","Clave"=>"e11170b8cbd2d74102651cb967fa28e5"));
        }

        public function logger($usuario, $clave){

            $encontrado = false;

            foreach($this->Usuarios as $u){
                if($u['Username'] == $usuario && $u['Clave'] == $clave){
                    $encontrado = true;
                    break;
                }
            }

            if($encontrado){
                return $u;
            }else{
                return false;
            }
        }

    }

?>