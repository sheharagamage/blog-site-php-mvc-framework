<?php
    class pages extends controller/* inherit from controller.php*/ {
        public function __construct(){
           $this->pagesModel =$this->model('M_pages');
        }

        public function index(){//method
            $data =[];
           $this->view('pages/v_index', $data);
        }

        public function about(){
            $users = $this->pagesModel->getUsers();
            $data =[
                'users' => $users
            ];
           $this->view('v_about', $data);

        }
    }

?> 