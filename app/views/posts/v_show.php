<?php require APPROOT. '/views/inc/header.php'; ?>
    <!-- Top Navigation -->
    <?php require APPROOT. '/views/inc/topnavbar.php'; ?>
    


   
   
    <a href="<?php echo URLROOT; ?>/posts/index/"><button class="post-control-btn3">BACK</button></a>
    
    <div class="post-index-container show">
        <div class="post-header">
            <div class="post-user-image"><img src="<?php echo URLROOT; ?>/img/profileimg/<?php echo $data['post']->profile_image;?>" alt=""  ></div>
            <div class="post-user-name"><?php echo $data['post']->user_name; ?></div>
            <div class="post-created-at"><?php echo converttimetoreadableformat($data['post']->post_create_at); ?></div>
            <?php if($data['post']->user_id == $_SESSION['user_id']): ?>
            <div class="post-control-btn">
                <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->post_id; ?>"><button class="post-control-btn1">EDIT</button></a>
                <a href="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->post_id; ?>"><button class="post-control-btn2">DELETE</button></a>
            </div>
            <?php endif; ?>
        </div>
       
        <div class="post-body">
            <div class="post-title"> <?php echo $data['post']->title; ?></div>
            <div class="post-image show">
                <?php if($data['post']->image !=null): ?>
                        <img src="<?php echo URLROOT; ?>/img/postsimg/<?php echo $data['post']->image;?>" alt="image">
                
                    <!-- <img src="" alt=""  id="image-placeholder"  display="none"> -->
                <?php endif; ?>
            </div>
            <br>
            <div class="post-content"><?php echo $data['post']->body; ?></div>
        </div>
        <form method="post">
        <div class="post-footer">
                <?php if($data['post']->interaction =='liked'): ?>
                <div class="inline-items-set post-likes active" id="post-likes-<?php echo $data['post']->post_id; ?>" onclick="addLikes(<?php echo $data['post']->post_id; ?>)">
                <?php else: ?>
                <div class="inline-items-set post-likes" id="post-likes-<?php echo $data['post']->post_id; ?>" onclick="addLikes(<?php echo $data['post']->post_id; ?>)">
                <?php endif; ?>
                    <img src="<?php echo URLROOT ?>/img/components/like.png" alt=""> 
                    <div class="post-likes-count" id="post-likes-count-<?php echo $data['post']->post_id; ?>"><?php echo $data['post']->likes; ?></div>
                </div>
                <?php if($data['post']->interaction =='disliked'): ?>
                <div class="inline-items-set post-dislikes active" id="post-dislikes-<?php echo $data['post']->post_id; ?>" onclick="addDislikes(<?php echo $data['post']->post_id; ?>)">
                <?php else: ?>
                <div class="inline-items-set post-dislikes" id="post-dislikes-<?php echo $data['post']->post_id; ?>" onclick="addDislikes(<?php echo $data['post']->post_id; ?>)">
                <?php endif; ?>
                    <img src="<?php echo URLROOT ?>/img/components/dislike.jpg" alt=""> 
                    <div class="post-dislikes-count" id="post-dislikes-count-<?php echo $data['post']->post_id; ?>"><?php echo $data['post']->dislikes; ?></div>
                
                </div>
                <!-- <div class="inline-items-set">
                    <img src="<?php echo URLROOT ?>/img/eye.png" alt=""> <?php echo $post->views ?>
                </div> -->
                <input type="text" name="post-comment" id="post-comment" placehloder="Add a comment....">
                <div class="post-footer-commentbtn" id="post-footer-commentbtn">
                <img src="<?php echo URLROOT ?>/img/components/comment.png" alt=""> 
                </div>
            </div>
            </form>
    </div>
    
                    <br><br>

    <!-- comment section -->
    
    <div class="comment-section-container">
        <div class="comment-section-header">
            <h1>comments</h1>
        </div>
        <?php flash('comment_msg'); ?>
    <!-- testing purpose only -->
     <!-- <div id="msg"></div> -->

     <!-- comment thread -->
      <div id="results"></div>
    </div>
    <!-- comment -->
    <div class="comment-container">
        <div class="comment-left">
            <img src="<?php echo URLROOT; ?>/img/profileimg/<?php echo $data['post']->profile_image;?>" alt=""  >
        </div>
        <div class="comment-right">
            <div class="comment-right-header">
                <div class="comment-user-name">Sheahra gamge</div>
                <div class="comment-posted-at">Just now</div>
            </div>
            <div class="comment-right-body">
               Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae consequuntur placeat reiciendis fugit aspernatur, esse, suscipit cum quod mollitia nobis, quas totam recusandae. Doloribus repudiandae impedit eos suscipit laborum modi? 
            </div>
            <div class="comment-right-footer">
               <div class="comment-likes active">
                    <img src="<?php echo URLROOT ?>/img/components/like.png" alt=""> 
                    <div class="comment-count-like">0</div>
               </div> 
               <div class="comment-dislikes">
                    <img src="<?php echo URLROOT ?>/img/components/dislike.jpg" alt=""> 
                    <div class="comment-count-dislike">0</div>
               </div>
            </div>

        </div>
    </div>

<script type="text/JavaScript" src="<?php echo URLROOT; ?>/js/jQuery/jQuery.js"></script>
<script type="text/JavaScript">
    var URLROOT ='<?php echo URLROOT; ?>';
    var CURRENT_POST='<?php echo $data['post']->post_id; ?>';
</script>
<!-- post -->
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/components/postinteraction.js"></script>

<!-- comment -->
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/comments/comment.js"></script>
<!-- comment interaction -->
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/comments/commentinteraction.js"></script>
<?php require APPROOT. '/views/inc/footer.php'; ?>
            