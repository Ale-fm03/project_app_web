<?php

    class Usuario{
        // Atributos
        private $rolCode;      
        private $rolNombre;      
        private $UsuarioCode;
        private $UsuarioNombres;      
        private $UsuarioApellidos;      
        private $UsuarioIdentificacion;      
        private $UsuarioEmail;      
        private $UsuarioPass;      
        private $UsuarioEstado;

        // Métodos
        public function setRolCode($rolCode){
            $this->rolCode = $rolCode;
        }
        public function getRolCode(){
            return $this->rolCode;
        }
        
    }

?>