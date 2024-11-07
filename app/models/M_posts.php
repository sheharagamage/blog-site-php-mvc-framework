<?php
    class M_posts{
        private  $db;

        public function __construct(){
            $this->db = new Database();
        }
        public function getPosts(){
            $this->db->query('SELECT * FROM v_posts INNER JOIN postinteractions ON v_posts.user_id = postinteractions.user_id  AND v_posts.post_id = postinteractions.post_id');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getpostidbycontent($data){
            $this->db->query('SELECT * FROM v_posts WHERE user_id = :user_id  AND image = :image AND title = :title AND body = :body');
            $this->db->bind(':user_id', $_SESSION['user_id']);
           $this->db->bind(':image', $data['image_name']);
           $this->db->bind(':title', $data['title']);
           $this->db->bind(':body', $data['body']);
            $row = $this->db->single();
            return $row->post_id;
        }
        public function getpostbyid($postId){
            $this->db->query('SELECT * FROM v_posts INNER JOIN postinteractions ON v_posts.user_id = postinteractions.user_id  AND v_posts.post_id = postinteractions.post_id WHERE v_posts.post_id = :id');
            $this->db->bind(':id', $postId);
            $row = $this->db->single();
            return $row;
        }
       public function create($data){
           $this->db->query('INSERT INTO posts (user_id, image , title, body) VALUES (:user_id,:image,:title, :body)');
           $this->db->bind(':user_id', $_SESSION['user_id']);
           $this->db->bind(':image', $data['image_name']);
           $this->db->bind(':title', $data['title']);
           $this->db->bind(':body', $data['body']);

           //execute
           if($this->db->execute()){
               return true;
           }else{               
               return false;
           }
       }

       
       public function edit($data){
            $this->db->query('UPDATE posts SET image= :image,  title = :title, body = :body WHERE id = :id');
            $this->db->bind(':image', $data['image_name']);
            $this->db->bind(':id', $data['post_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);

            //execute
            if($this->db->execute()){
                return true;
            }else{               
                return false;
            }
        }
    

        
        public function delete($postId){
            $this->db->query('DELETE FROM Posts WHERE id=:id');
            $this->db->bind(':id',$postId );
            
 
            //execute
            if($this->db->execute()){
                return true;
            }else{               
                return false;
            }
        }
 
        
        

        public function incLikes($postId){
            $this->db->query('UPDATE posts SET likes = likes + 1 WHERE id = :post_id') ;
            $this->db->bind(':post_id', $postId);
           

            //execute
            if($this->db->execute()){
                return $this->getLikes($postId);
            }else{               
                return false;
            }
        }
        public function decLikes($postId){
            $this->db->query('UPDATE posts SET likes = likes - 1 WHERE id = :post_id') ;
            $this->db->bind(':post_id', $postId);
           

            //execute
            if($this->db->execute()){
                return $this->getLikes($postId);
            }else{               
                return false;
            }
        }
    
        public function getLikes($postId){
            $this->db->query('SELECT likes FROM v_posts WHERE post_id = :id');
            $this->db->bind(':id', $postId);
            $row = $this->db->single();
            return $row;
        }
        
        public function incdisLikes($postId){
            $this->db->query('UPDATE posts SET dislikes = dislikes + 1 WHERE id = :post_id') ;
            $this->db->bind(':post_id', $postId);
           

            //execute
            if($this->db->execute()){
                return $this->getdisLikes($postId);
            }else{               
                return false;
            }
        }
        public function decdisLikes($postId){
            $this->db->query('UPDATE posts SET dislikes = dislikes - 1 WHERE id = :post_id') ;
            $this->db->bind(':post_id', $postId);
           

            //execute
            if($this->db->execute()){
                return $this->getdisLikes($postId);
            }else{               
                return false;
            }
        }
    
        public function getdisLikes($postId){
            $this->db->query('SELECT dislikes FROM v_posts WHERE post_id = :id');
            $this->db->bind(':id', $postId);
            $row = $this->db->single();
            return $row;
        }

        //posts likes dislikes interaction
        public function  addpostinteraction($postId, $userId, $interaction){
            $this->db->query('INSERT INTO postinteractions (post_id, user_id , interaction) VALUES (:post_id, :user_id  ,:interaction)');

            $this->db->bind(":post_id", $postId);
            $this->db->bind(":user_id", $userId);
            $this->db->bind(":interaction", $interaction);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function  setpostinteraction($postId, $userId, $interaction){
            $this->db->query('UPDATE postinteractions SET interaction = :interaction WHERE post_id = :post_id AND user_id = :user_id');

            $this->db->bind(":post_id", $postId);
            $this->db->bind(":user_id", $userId);
            $this->db->bind(":interaction", $interaction);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function  getpostinteraction($postId, $userId){
            $this->db->query('SELECT * FROM postinteractions WHERE post_id = :post_id AND user_id = :user_id');

            $this->db->bind(":post_id", $postId);
            $this->db->bind(":user_id", $userId);
            $row = $this->db->single();
            return $row;
            
        }

        public function  ispostinteractionExist($postId, $userId){
            $this->db->query('SELECT * FROM postinteractions WHERE post_id = :post_id AND user_id = :user_id');

            $this->db->bind(":post_id", $postId);
            $this->db->bind(":user_id", $userId);
            $results =$this->db->single();
            $results =$this->db->rowCount();

            if($results > 0){
                return true;    
            }
            else{
                return false;
            }
            
        }

    }


?>