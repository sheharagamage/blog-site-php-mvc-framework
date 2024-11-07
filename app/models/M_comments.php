<?php
    class M_comments{
        private  $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function addcomment($data){
            $this->db->query('INSERT INTO comments (post_id, user_id, content, likes, dislikes) VALUES (:post_id, :user_id, :content, :likes, :dislikes)');
            $this->db->bind(':post_id', $data['post_id']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':content', $data['content']);
            $this->db->bind(':likes', $data['likes']);
            $this->db->bind(':dislikes', $data['dislikes']);
 
            //execute
            if($this->db->execute()){
                return true;
            }else{               
                return false;
            }
        }
        public function getcomments($id){
            $this->db->query('SELECT * FROM  v_comments   WHERE post_id = :post_id ');

            $this->db->bind(':post_id', $id);

            return $this->db->resultset();
        }

        public function deletecomment($commentId){
            $this->db->query('DELETE FROM comments WHERE comment_id=:id');
            $this->db->bind(':id',$commentId );
            
 
            //execute
            if($this->db->execute()){
                return true;
            }else{               
                return false;
            }
        }

        //comment interaction
        public function incLikes($commentId){
            $this->db->query('UPDATE comments SET likes = likes + 1 WHERE comment_id = :comment_id') ;
            $this->db->bind(':comment_id', $commentId);
           

            //execute
            if($this->db->execute()){
                return $this->getLikes($commentId);
            }else{               
                return false;
            }
        }
        public function decLikes($commentId){
            $this->db->query('UPDATE comments SET likes = likes - 1 WHERE comment_id = :comment_id') ;
            $this->db->bind(':comment_id', $commentId);
           

            //execute
            if($this->db->execute()){
                return $this->getLikes($commentId);
            }else{               
                return false;
            }
        }
    
        public function getLikes($commentId){
            $this->db->query('SELECT likes FROM v_comments WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id', $commentId);
            $row = $this->db->single();
            return $row;
        }
        
        public function incdisLikes($commentId){
            $this->db->query('UPDATE comments SET dislikes = dislikes + 1 WHERE comment_id = :comment_id') ;
            $this->db->bind(':comment_id', $commentId);
           

            //execute
            if($this->db->execute()){
                return $this->getdisLikes($commentId);
            }else{               
                return false;
            }
        }
        public function decdisLikes($commentId){
            $this->db->query('UPDATE comments SET dislikes = dislikes - 1 WHERE comment_id = :comment_id') ;
            $this->db->bind(':comment_id', $commentId);
           

            //execute
            if($this->db->execute()){
                return $this->getdisLikes($commentId);
            }else{               
                return false;
            }
        }
    
        public function getdisLikes($commentId){
            $this->db->query('SELECT dislikes FROM v_comments WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id', $commentId);
            $row = $this->db->single();
            return $row;
        }

        //posts likes dislikes interaction
        public function  addcommentinteraction($commentId, $userId, $interaction){
            $this->db->query('INSERT INTO commentinteractions (comment_id, user_id , interaction) VALUES (:comment_id, :user_id  ,:interaction)');

            $this->db->bind(":comment_id", $commentId);
            $this->db->bind(":user_id", $userId);
            $this->db->bind(":interaction", $interaction);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function  setcommentinteraction($commentId, $userId, $interaction){
            $this->db->query('UPDATE commentinteractions SET interaction = :interaction WHERE comment_id = :comment_id AND user_id = :user_id');

            $this->db->bind(":comment_id", $commentId);
            $this->db->bind(":user_id", $userId);
            $this->db->bind(":interaction", $interaction);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function  getcommentinteraction($commentId, $userId){
            $this->db->query('SELECT * FROM commentinteractions WHERE comment_id = :comment_id AND user_id = :user_id');

            $this->db->bind(":comment_id", $commentId);
            $this->db->bind(":user_id", $userId);
            $row = $this->db->single();
            return $row;
            
        }

        public function  iscommentinteractionExist($commentId, $userId){
            $this->db->query('SELECT * FROM commentinteractions WHERE comment_id = :comment_id AND user_id = :user_id');

            $this->db->bind(":comment_id", $commentId);
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