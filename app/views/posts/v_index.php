<?php require APPROOT. '/views/inc/header.php'; ?>
    <!-- Top Navigation -->
    <?php require APPROOT. '/views/inc/topnavbar.php'; ?>
    <h1>user----><?php echo $_SESSION['user_name']; ?></h1>
    <h1>Posts</h1>

    <a href="<?php echo URLROOT; ?>/posts/create/"><button class="post-control-btn3">CREATE POST</button></a>

    

    <?php foreach($data['posts'] as $post): ?>
    <div class="post-index-container">
        <div class="post-header">
            <div class="post-user-image"><img src="<?php echo URLROOT; ?>/img/profileimg/<?php echo $post->profile_image;?>" alt=""  ></div>
            <div class="post-user-name"><?php echo $post->user_name; ?></div>
            <div class="post-created-at"><?php echo converttimetoreadableformat($post->post_create_at); ?></div>
            <?php if($post->user_id == $_SESSION['user_id']): ?>
            <div class="post-control-btn">
                <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->post_id; ?>"><button class="post-control-btn1">EDIT</button></a>
                <a href="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->post_id; ?>"><button class="post-control-btn2">DELETE</button></a>
            </div>
            <?php endif; ?>
        </div>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->post_id; ?>"  class="post-body-link">
        <div class="post-body">
            <div class="post-title"> <?php echo $post->title; ?></div>
            <div class="post-image">
                <?php if($post->image !=null): ?>
                        <img src="<?php echo URLROOT; ?>/img/postsimg/<?php echo $post->image;?>" alt="image">
                
                    <!-- <img src="" alt=""  id="image-placeholder"  display="none"> -->
                <?php endif; ?>
            </div>
            <br>
            <div class="post-content"><?php echo $post->body; ?></div>
        </div>
        </a>
        <div class="post-footer">
                <?php if($post->interaction =='liked'): ?>
                <div class="inline-items-set post-likes active" id="post-likes-<?php echo $post->post_id; ?>" onclick="addLikes(<?php echo $post->post_id; ?>)">
                <?php else: ?>
                <div class="inline-items-set post-likes" id="post-likes-<?php echo $post->post_id; ?>" onclick="addLikes(<?php echo $post->post_id; ?>)">
                <?php endif; ?>
                    <img src="<?php echo URLROOT ?>/img/components/like.png" alt=""> 
                    <div class="post-likes-count" id="post-likes-count-<?php echo $post->post_id; ?>"><?php echo $post->likes; ?></div>
                </div>
                <?php if($post->interaction =='disliked'): ?>
                <div class="inline-items-set post-dislikes active" id="post-dislikes-<?php echo $post->post_id; ?>" onclick="addDislikes(<?php echo $post->post_id; ?>)">
                <?php else: ?>
                <div class="inline-items-set post-dislikes" id="post-dislikes-<?php echo $post->post_id; ?>" onclick="addDislikes(<?php echo $post->post_id; ?>)">
                <?php endif; ?>
                    <img src="<?php echo URLROOT ?>/img/components/dislike.jpg" alt=""> 
                    <div class="post-dislikes-count" id="post-dislikes-count-<?php echo $post->post_id; ?>"><?php echo $post->dislikes; ?></div>
                
                </div>
                <!-- <div class="inline-items-set">
                    <img src="<?php echo URLROOT ?>/img/eye.png" alt=""> <?php echo $post->views ?>
                </div> -->
            </div>
    </div>
 
<?php endforeach; ?>
<script type="text/JavaScript" src="<?php echo URLROOT; ?>/js/jQuery/jQuery.js"></script>
<script type="text/JavaScript">
    var URLROOT ='<?php echo URLROOT; ?>';
</script>

<script type="text/javascript" src="<?php echo URLROOT; ?>/js/components/postinteraction.js"></script>
<?php require APPROOT. '/views/inc/footer.php'; ?>
            