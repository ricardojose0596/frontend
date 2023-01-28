<?php

class Medicina extends MedicinaModel{
    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->render('login/registrarmedicina',[]);
    }
}

?>