<?php

class Sucursal extends SucursalModel{
    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->render('login/registrarsucursal',[]);
    }
}

?>