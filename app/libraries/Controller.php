<?php
    class controller {
        
        public function model($model){//method
            require_once '../app/models/'.$model.'.php';

            //Instentiate the model and pass it to the controller member variable
            return new $model();
        }
        //to load the view
        public function view($view, $data = []){
            if(file_exists('../app/views/'.$view.'.php')){
                require_once'../app/views/'.$view.'.php';
            }
            else{
                die('corresponding does not exists!');
            }

        }
    }

?>