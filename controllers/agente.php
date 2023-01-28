
<?php

class Agente extends SessionController{

    function __construct(){
        parent::__construct();
    }

    function render(){
        
        $this->view->render('agente/index');
    }

}
?>