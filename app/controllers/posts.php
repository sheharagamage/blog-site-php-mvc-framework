<?php
    class posts  extends Controller{
        public function __construct(){
            $this->postsModel =$this->model('M_posts');
        }

        public function show($id){
            $posts = $this->postsModel->getpostbyid($id);
            $data =[
                'post' => $posts
             ]; 

             $this->view('posts/v_show', $data);
        }

        public function index(){

            $posts = $this->postsModel->getPosts();
             $data =[
                'posts' => $posts
             ];

             $this->view('posts/v_index', $data);
        }

        public function create(){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    $data=[
                        
                        'image'=> $_FILES['image'],
                        'image_name'=>time().'_'.$_FILES['image']['name'],
                        'title' => trim($_POST['title']),
                        'body' => trim($_POST['body']), 

                        'image_err' =>'',
                        'title_err' => '',
                        'body_err' => ''
                    ];

                    //validation
                    if($data['image']['size']>0){
                        if(uploadImage($data['image']['tmp_name'], $data['image_name'], '/img/postsimg/')){
                                //done
                        }
                        else{
                            $data['image_err'] = 'unsuccessfull image uploading';
                            
                        }

                    }
                    else{
                       $data['image_name'] =null;
                    }


                    if(empty($data['title'])){
                        $data['title_err'] = 'Please enter title';

                    }
                    if(empty($data['body'])){
                        $data['body_err'] = 'Please enter body';
                    }

                    if(empty($data['title_err']) && empty($data['body_err']) && empty($data['image_err'] )){
                        if($this->postsModel->create($data)){

                            //grt post  id
                            $postId = $this->postsModel->getpostidbycontent($data);
                            $userId = $_SESSION['user_id'];
                            $this->postsModel->addpostinteraction($postId, $userId, 'new');

                            flash('post-msg','post is published');
                            redirect('posts/index');

                        }
                        else{
                            die('something went wrong');
                        }

                    }
                    else{
                        //loading view with errors
                        $this->view('posts/v_create', $data);
                    }
            }
            else{
                $data =[
                    'image'=> '',
                    'image-name'=>'',
                    'title' => '',
                    'body' => '',

                    'image_err' =>'',
                    'title_err' => '',
                    'body_err' => ''
                ];
                $this->view('posts/v_create', $data);
            }

           
        }
        public function edit($postId){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    $data=[
                        'image'=> $_FILES['image'],
                        'image_name'=>time().'_'.$_FILES['image']['name'],
                        'post_id' => $postId,
                        'title' => trim($_POST['title']),
                        'body' => trim($_POST['body']),
                        
                        'image_err' =>'',
                        'title_err' => '',
                        'body_err' => ''
                    ];

                    //validation
                    $post=$this->postsModel->getpostbyid($postId);
                    $oldImage= PUBROOT.'/img/postsimg/'.$post->image;

                    //photouploaded

                    //user havent change the existing  photo
                    if($_POST['intentionally_removed']=='removed'){
                        deleteImage($oldImage);
                        $data['image_name'] = '';       
                    }
                    else{
                    if($_FILES['image']['size']==''){
                        $data['image_name'] = $post->image;
                       
                    }
                    else{
                       updateImage($oldImage , $data['image']['tmp_name'] , $data['image_name'] , '/img/postsimg/');
                        
                   }   
                }
                    


                    if(empty($data['title'])){
                        $data['title_err'] = 'Please enter title';

                    }
                    if(empty($data['body'])){
                        $data['body_err'] = 'Please enter body';
                    }

                    if(empty($data['title_err']) && empty($data['body_err'])){
                        if($this->postsModel->edit($data)){
                            flash('post-msg','post is updated');
                            redirect('posts/v_edit');

                        }
                        else{
                            die('something went wrong');
                        }

                    }
                    else{
                        //loading view with errors
                        $this->view('posts/v_edit', $data);
                    }
            }
            else{
                $post=$this->postsModel->getpostbyid($postId);

                //check the owner
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts/v_index');
                }
                $data =[
                    'image'=> '',
                    'image_name'=>$post->image,
                    'post_id' => $postId,
                    'title' => $post->title,
                    'body' => $post->body,

                    'image_err' =>'',
                    'title_err' => '',
                    'body_err' => ''
                ];
                $this->view('posts/v_edit', $data);
            }

           
        }
        public function delete($postId){
            
                $post=$this->postsModel->getpostbyid($postId);

                //check owner
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts/v_index');
                }
                else{
                
                $post=$this->postsModel->getpostbyid($postId);
                $oldImage= PUBROOT.'/img/postsimg/'.$post->image;
                deleteImage($oldImage);

                if($this->postsModel->delete($postId)){
                    flash('post-msg','post is deleted');
                    redirect('posts/v_index');

                }
                else{
                    die('Something went wrong');
                }
                } 
        }
        
        
       public function incpostslikes($postId) {
            $likes=$this->postsModel->incLikes($postId);

            $userId=$_SESSION['user_id'];

            if($this->postsModel->ispostinteractionExist($postId, $userId)){
                $res=$this->postsModel->setpostinteraction($postId, $userId, 'liked');
            }

            else{
                $res=$this->postsModel->addpostinteraction($postId, $userId, 'liked');
            
            }

            if($likes != false && $res != false){
               echo $likes->likes; 
            }
       }

       public function decpostsLikes($postId) {
        $likes=$this->postsModel->decLikes($postId);

        $userId=$_SESSION['user_id'];

        $res=$this->postsModel->setpostinteraction($postId, $userId, 'liked removed');

        if($likes != false && $res != false){
            echo $likes->likes; 
         }

       }

       //dislikes 
       public function incpostsdislikes($postId) {
            $dislikes=$this->postsModel->incdisLikes($postId);

            $userId=$_SESSION['user_id'];

            if($this->postsModel->ispostinteractionExist($postId, $userId)){
                $res=$this->postsModel->setpostinteraction($postId, $userId, 'disliked');
            }

            else{
                $res=$this->postsModel->addpostinteraction($postId, $userId, 'disliked');
            
            }

            if($dislikes != false && $res != false){
            echo $dislikes->dislikes; 
            }
        }

        public function decpostsdisLikes($postId) {
            $dislikes=$this->postsModel->decdisLikes($postId);

            $userId=$_SESSION['user_id'];

            $res=$this->postsModel->setpostinteraction($postId, $userId, 'disliked removed');

            if($dislikes != false && $res != false){
                echo $dislikes->dislikes; 
            }

        }
    
        
}
    

?>