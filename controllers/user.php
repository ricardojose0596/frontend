
<?php

class User extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("user " . $this->user->getName());
    }

    function render(){
        $this->view->render('user/index', [
            "user" => $this->user
        ]);
    }

    

    function updateName(){
        if(!$this->existPOST('name')){
            $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATENAME]);
            return;
        }

        $name = $this->getPost('name');

        if(empty($name)){
            $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATENAME]);
            return;
        }
        
        $this->user->setName($name);
        if($this->user->update()){
            $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATENAME]);
        }else{
            //error
        }
    }

    function updatePassword(){
        if(!$this->existPOST(['current_password', 'new_password'])){
            $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD]);
            return;
        }

        $current = $this->getPost('current_password');
        $new     = $this->getPost('new_password');

        if(empty($current) || empty($new)){
            $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD_EMPTY]);
            return;
        }

        if($current === $new){
            $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME]);
            return;
        }

        //validar que el current es el mismo que el guardado
        $newHash = $this->model->comparePasswords($current, $this->user->getId());
     
     
        if($newHash != NULL){
            //si lo es actualizar con el nuevo
            $this->user->setPassword($new, true);
            
            if($this->user->update()){
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEPASSWORD]);
            }else{
                //error
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD]);
            }
        }else{
            $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD]);
            return;
        }
    }

   
}

?>