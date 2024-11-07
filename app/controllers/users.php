<?php
    class users extends controller {
        public function __construct(){
            $this->usersModel = $this->model('M_users');
        }

        public function register() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Form is submitting - validate the data
                $_post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                // Input data
                $data = [
                    'profile_image' => $_FILES['profile_image'],
                    'profile_image_name' => time() . '_' . $_FILES['profile_image']['name'],
                    'name' => trim($_post['name']),
                    'email' => trim($_post['email']),
                    'password' => trim($_post['password']),
                    'confirm_password' => trim($_post['confirm_password']),
        
                    'profile_image_err' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];
        
                // Validate profile image and upload
                if (uploadImage($data['profile_image']['tmp_name'], $data['profile_image_name'], '/img/profileimg/')) {
                    
                }

                else{
                    $data['profile_image_err'] = 'Please upload an image';
                }
        
                // Validate name
                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter your name';
                }
        
                // Validate email
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter your email';
                } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['email_err'] = 'Please enter a valid email address';
                } elseif ($this->usersModel->finduserbyemail($data['email'])) {
                    $data['email_err'] = 'Email is already registered';
                }
        
                // Validate password
                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter your password';
                }
        
                // Validate confirm password
                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please enter your confirm password';
                } elseif ($data['password'] !== $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
        
                // If no errors, register user
                if (empty($data['name_err']) &&
                    empty($data['email_err']) &&
                    empty($data['password_err']) &&
                    empty($data['confirm_password_err']) &&
                    empty($data['profile_image_err'])) {
        
                    // Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
                    // Register the user
                    if ($this->usersModel->register($data)) {
                        // Create a flash message
                        flash('reg_flash', 'You are successfully registered');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('users/v_register', $data);
                }
            } else {
                // Initialize the data for GET request
                $data = [
                    'profile_image' => '',
                    'profile_image_name' => '',
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
        
                    'profile_image_err' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
        
                // Load view
                $this->view('users/v_register', $data);
            }
        }
                public function login(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //form is submitting
                //validate the data
                $_post= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //input data
                $data=[
                    'email' =>trim($_post['email']),
                    'password' =>trim($_post['password']),

                    'email_err'=>'',
                    'password_err'=>''
                ];
                //validate the email
                if(empty($data['email'])){
                    $data['email_err']='please enter the email';
                }
                else{
                    if($this->usersModel->finduserbyemail($data['email'])){
                        //user is found
                    }
                    else{
                        $data['email_err'] ="user not found";
                    }
                }


                //validate password empty or not

                if(empty($data['password'])){
                    $data['password_err']='please enter the password';
                }

                //If no error found the login the user

                if(empty($data['email_err']) && empty($data['password_err'])){
                    //log the user

                    $loggeduser=$this->usersModel->login($data['email'],$data['password']);

                    if($loggeduser){
                        //user the authenticated
                        //create user sessions
                        $this->createusersession($loggeduser);
                    }

                    else{
                        $data['password_err']='please incorrect';

                        //load view
                        $this->view('users/v_login', $data);
                    }
                }
                else{
                    //load view with errors
                    $this->view('users/v_login', $data);
                }


            }   
            else{
                //initialise the data   
                $data=[
                    'email' =>'',
                    'password' =>'',
                    'email_err'=>'',
                    'password_err'=>''
                ];
            

            $this->view('users/v_login', $data);
                
        }
        }
        public function createusersession($user){
            $_SESSION['user_id']=$user->id;
            $_SESSION['user_profile_image']=$user->profile_image;
            $_SESSION['user_email']=$user->email;
            $_SESSION['user_name']=$user->name;

            redirect('pages/index');
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_profile_image']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }

        public function isloggedin(){
            if(isset($_SESSION['user_id'])){
                return true;
            }
            else{
                return false;
            }
        }

} 

?>