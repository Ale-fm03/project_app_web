<?php
    require_once "models/Usuario.php";
    class Usuarios{
        public function main(){}
        
        public function crearRol(){
            if ($_SERVER['REQUEST_METHOD'] == 'GET'){
                require_once "views/modulos/usuarios/crear_rol.view.php";
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rol = new Usuario;
                $rol->setRolCode(null);
                $rol->setRolNombre($_POST['rol_nombre']);
                $rol->rolCrear();
                header("Location:?c=Usuarios&a=consultarRoles");
            }
        }
        public function consultarRoles(){
            $roles = new Usuario;
            $roles = $roles->rolesConsultar();
            require_once "views/modulos/usuarios/consultar_rol.view.php";
        }        
        public function actualizarRol(){
            if ($_SERVER['REQUEST_METHOD'] == 'GET'){
                $rolUpd = new Usuario;
                $rolUpd = $rolUpd->getRolById($_GET['idRol']);
                require_once "views/modulos/usuarios/actualizar_rol.view.php";                
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rol = new Usuario;
                $rol->setRolCode($_POST['rol_code']);
                $rol->setRolNombre($_POST['rol_nombre']);
                $rol->rolActualizar();
                header("Location:?c=Usuarios&a=consultarRoles");
            }
        }        
        public function eliminarRol(){
            $rol = new Usuario;
            $rol->rolEliminar($_GET['idRol']);
            header("Location:?c=Usuarios&a=consultarRoles");            
        }
    }
?>