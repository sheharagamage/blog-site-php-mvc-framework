<?php
    class comments extends controller/* inherit from controller.php*/ {
        public function __construct(){
           $this->commentsModel =$this->model('M_comments');
        }

        //create 
        public function comment($id){
            $userId =$_SESSION['user_id'];
            $postId = $id;
            $commentcontent =$_POST['post-comment'];

            echo 'user:  '.$userId.' post'.$postId. ' comment'.$commentcontent;

            $data=[
                'user_id'=>$userId,
                'post_id'=>$postId,
                'content'=>$commentcontent,
                'likes'=>'',
                'dislikes'=>'',
                
            ];

            if($this->commentsModel->addcomment($data)){
                flash('comment_msg','comment added');
            }
            else{
                die('something went wrong');
            }
        }

        public function showcomments($id){
            $comments=$this->commentsModel->getcomments($id);
            $userId=$_SESSION['user_id'];
        
            //Render HTML element using php
            foreach($comments as $comment){
                if($this->commentsModel->iscommentinteractionExist($comment->comment_id, $userId )){
                    $selfinteraction=$this->commentsModel->getcommentinteraction($comment->comment_id, $userId);
                    $selfinteraction=$selfinteraction->interaction;
                    
                }

                else{
                    $selfinteraction='';
                }
                echo '<div class="comment-container">';
                echo    '<div class="comment-left">';
                echo         '<img src=" '.URLROOT.'/img/profileimg/'.$comment->profile_image.'" alt=""  >';
                echo     '</div>';
                echo     '<div class="comment-right">';
                echo         '<div class="comment-right-header">';
                echo              '<div class="comment-right-subheader">';
                echo             '<div class="comment-user-name">'.$comment->user_name.'</div>';
                echo              '<span class="comment-delete-btn active"> <img src=" '.URLROOT.'/img/components/deletecomment.png" alt="" onclick="deletecomment('.$comment->comment_id.') " ></span>';
                echo             '</div>';
                echo             '<div class="comment-posted-at">'.converttimetoreadableformat($comment->comment_create_at).'</div>';
                echo         '</div>';
                echo         '<div class="comment-right-body">';
                echo             $comment->content;
                echo         '</div>';
                echo         '<div class="comment-right-footer">';
                if($selfinteraction == 'liked'){
                    echo             '<div class="comment-likes active " id="comment-likes-'.$comment->comment_id.'"  onclick="addcommentLikes('.$comment->comment_id.')">';   
                }
                else{
                echo             '<div class="comment-likes " id="comment-likes-'.$comment->comment_id.'"  onclick="addcommentLikes('.$comment->comment_id.')">';
                }
                echo                     '<img src="'.URLROOT.'/img/components/like.png" alt="">';
                echo                     '<div class="comment-count-like" id="comment-count-like-'.$comment->comment_id.'">'.$comment->likes.'</div>';
                echo             '</div>'; 
                if($selfinteraction == 'liked'){
                    echo             '<div class="comment-dislikes active" id="comment-dislikes-'.$comment->comment_id.'"  onclick="addcommentDislikes('.$comment->comment_id.')">';
                }
                else{
                echo             '<div class="comment-dislikes" id="comment-dislikes-'.$comment->comment_id.'"  onclick="addcommentDislikes('.$comment->comment_id.')">';
                }
                echo                 '<img src="'.URLROOT.'/img/components/dislike.jpg" alt="">'; 
                echo                 '<div class="comment-count-dislike"  id="comment-count-dislike-'.$comment->comment_id.'">'.$comment->dislikes.'</div>';
                echo             '</div>';
                echo         '</div>';
                echo     '</div>';

                echo '</div>';
            }
        }

        public function deletecomment($commentid){
            if($this->commentsModel->deletecomment($commentid)){
                flash('comment_msg','your comment removed.');
            }
            else{
                die('something went wrong');
            }
        }

        //comment interaction


        public function  inccommentslikes($commentid) {
            $likes=$this->commentsModel->incLikes($commentid);

            $userId=$_SESSION['user_id'];

            if($this->commentsModel->iscommentinteractionExist($commentid, $userId)){
                $res=$this->commentsModel->setcommentinteraction($commentid, $userId, 'liked');
            }

            else{
                $res=$this->commentsModel->addcommentinteraction($commentid, $userId, 'liked');
            
            }

            if($likes != false && $res != false){
               echo $likes->likes; 
            }
       }

       public function deccommentsLikes($commentid) {
        $likes=$this->commentsModel->decLikes($commentid);

        $userId=$_SESSION['user_id'];

        $res=$this->commentsModel->setcommentinteraction($commentid, $userId, 'liked removed');

        if($likes != false && $res != false){
            echo $likes->likes; 
         }

       }
        public function inccommentsdislikes($commentid) {
            $dislikes=$this->commentsModel->incdisLikes($commentid);

            $userId=$_SESSION['user_id'];

            if($this->commentsModel->iscommentinteractionExist($commentid, $userId)){
                $res=$this->commentsModel->setcommentinteraction($commentid, $userId, 'disliked');
            }

            else{
                $res=$this->commentsModel->addcommentinteraction($commentid, $userId, 'disliked');
            
            }

            if($dislikes != false && $res != false){
            echo $dislikes->dislikes; 
            }
        }

        public function deccommentsdisLikes($commentid) {
            $dislikes=$this->commentsModel->decdisLikes($commentid);

            $userId=$_SESSION['user_id'];

            $res=$this->commentsModel->setcommentinteraction($commentid, $userId, 'disliked removed');

            if($dislikes != false && $res != false){
                echo $dislikes->dislikes; 
            }

        }
    }

?> 