<?php

    class Usuario{
        // Atributos
        private $rolCode;      
        private $rolNombre;      
        private $usuarioCodigo;
        private $usuarioNombres;      
        private $usuarioApellidos;      
        private $usuarioIdentificacion;      
        private $usuarioEmail;      
        private $usuarioPass;      
        private $usuarioEstado;
        private $dbh;
        
        // Sobrecarga de Constructores
        public function __construct(){
            try {
                $this->dbh = DataBase::connection();                
                $a = func_get_args();
                $i = func_num_args();
                if (method_exists($this, $f = '__construct' . $i)) {
                    call_user_func_array(array($this, $f), $a);
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        
        # Constructor de 0 parámetros
        public function __construct0(){}

        # Constructor de 9 parámetros
        public function __construct9($rolCode,$rolNombre,$usuarioCodigo,$usuarioNombres,$usuarioApellidos,$usuarioIdentificacion,$usuarioEmail,$usuarioPass,$usuarioEstado){
            $this->rolCode = $rolCode;      
            $this->rolNombre = $rolNombre;      
            $this->usuarioCodigo = $usuarioCodigo;
            $this->usuarioNombres = $usuarioNombres;      
            $this->usuarioApellidos = $usuarioApellidos;      
            $this->usuarioIdentificacion = $usuarioIdentificacion;      
            $this->usuarioEmail = $usuarioEmail;      
            $this->usuarioPass = $usuarioPass;      
            $this->usuarioEstado = $usuarioEstado;
        }
        # Constructor de 8 parámetros
        public function __construct8($rolCode,$usuarioCodigo,$usuarioNombres,$usuarioApellidos,$usuarioIdentificacion,$usuarioEmail,$usuarioPass,$usuarioEstado){
            $this->rolCode = $rolCode;            
            $this->usuarioCodigo = $usuarioCodigo;
            $this->usuarioNombres = $usuarioNombres;      
            $this->usuarioApellidos = $usuarioApellidos;      
            $this->usuarioIdentificacion = $usuarioIdentificacion;      
            $this->usuarioEmail = $usuarioEmail;      
            $this->usuarioPass = $usuarioPass;      
            $this->usuarioEstado = $usuarioEstado;
        }
        # Constructor de 2 parámetros
        public function __construct2($usuarioEmail,$usuarioPass){
            $this->usuarioEmail = $usuarioEmail;      
            $this->usuarioPass = $usuarioPass;                  
        }

        // Métodos setter y getter
        
        # Rol Code
        public function setRolCode($rolCode){
            $this->rolCode = $rolCode;
        }
        public function getRolCode(){
            return $this->rolCode;
        }
        # Rol Nombre
        public function setRolNombre($rolNombre){
            $this->rolNombre = $rolNombre;
        }
        public function getRolNombre(){
            return $this->rolNombre;
        }
        # Usuario Código
        public function setUsuarioCodigo($usuarioCodigo){
            $this->usuarioCodigo = $usuarioCodigo;
        }
        public function getUsuarioCodigo(){
            return $this->usuarioCodigo;
        }
        # Usuario Nombres
        public function setUsuarioNombres($usuarioNombres){
            $this->UsuarioNombres = $usuarioNombres;
        }
        public function getUsuarioNombres(){
            return $this->UsuarioNombres;
        }
        # Usuario Apellidos
        public function setUsuarioApellidos($usuarioApellidos){
            $this->UsuarioApellidos = $usuarioApellidos;
        }
        public function getUsuarioApellidos(){
            return $this->UsuarioApellidos;
        }
        # Usuario Identificación
        public function setUsuarioIdentificacion($usuarioIdentificacion){
            $this->UsuarioIdentificacion = $usuarioIdentificacion;
        }
        public function getUsuarioIdentificacion(){
            return $this->UsuarioIdentificacion;
        }
        # Usuario Email
        public function setUsuarioEmail($usuarioEmail){
            $this->UsuarioEmail = $usuarioEmail;
        }
        public function getUsuarioEmail(){
            return $this->usuarioEmail;
        }
        # Usuario Password
        public function setUsuarioPass($usuarioPass){
            $this->UsuarioPass = $usuarioPass;
        }
        public function getUsuarioPass(){
            return $this->usuarioPass;
        }
        # Usuario Estado
        public function setUsuarioEstado($usuarioEstado){
            $this->UsuarioEstado = $usuarioEstado;
        }
        public function getUsuarioEstado(){
            return $this->UsuarioEstado;
        }


        // Persistencia a la base de datos
        
        # CU01 - Iniciar Sesión
        public function login(){
            try {
                $sql = 'SELECT * FROM USUARIOS
                        WHERE usuario_email = :usuarioEmail AND usuario_pass = :usuarioPass';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue('usuarioEmail', $this->getUsuarioEmail());
                $stmt->bindValue('usuarioPass', sha1($this->getUsuarioPass()));
                $stmt->execute();
                $userDb = $stmt->fetch();
                if ($userDb) {
                    $user = new Usuario(
                        $userDb['rol_codigo'],                    
                        $userDb['usuario_codigo'],
                        $userDb['usuario_nombres'],
                        $userDb['usuario_apellidos'],
                        $userDb['usuario_identificador'],  
                        $userDb['usuario_email'],
                        $userDb['usuario_pass'],
                        $userDb['usuario_estado']
                    );                    
                    return $user;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        # CU04 - Registrar Rol
        public function rolCrear(){
            try {
                $sql = 'INSERT INTO ROLES VALUES (:rolCodigo,:rolNombre)';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue('rolCodigo', $this->getRolCode());
                $stmt->bindValue('rolNombre', $this->getRolNombre());
                $stmt->execute();
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        # CU04 - Consultar Roles
        public function rolesConsultar(){
            try {
                $rolList = [];
                $sql = 'SELECT * FROM ROLES';
                $stmt = $this->dbh->query($sql);
                foreach ($stmt->fetchAll() as $rol) {
                    $rolObj = new Usuario;
                    $rolObj->setRolCode($rol['rol_codigo']);
                    $rolObj->setRolNombre($rol['rol_nombre']);
                    array_push($rolList, $rolObj);
                }
                return $rolList;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        # CU12 - Obtener el Rol por el código
        public function getRolById($rolCode) {
            try {
                $sql = "SELECT * FROM ROLES WHERE rol_codigo=:rolCodigo";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue('rolCodigo', $rolCode);
                $stmt->execute();
                $rolDb = $stmt->fetch();
                $rol = new Usuario;
                $rol->setRolCode($rolDb['rol_codigo']);
                $rol->setRolNombre($rolDb['rol_nombre']);
                return $rol;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        # CU05 - Actualizar Rol
        public function rolActualizar(){
            try {
                $sql = 'UPDATE ROLES SET
                                rol_codigo = :rolCodigo,
                                rol_nombre = :rolNombre
                            WHERE rol_codigo = :rolCodigo';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue('rolCodigo', $this->getRolCode());
                $stmt->bindValue('rolNombre', $this->getRolNombre());
                $stmt->execute();
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        

         # CU06 - Eliminar Rol
        public function rolEliminar($rolCode){
            try {
                $sql = 'DELETE FROM ROLES WHERE rol_codigo = :rolCodigo';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue('rolCodigo', $rolCode);
                $stmt->execute();
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }

?>