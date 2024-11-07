<?php require APPROOT. '/views/inc/header.php'; ?>
    <!-- Top Navigation -->
    <?php require APPROOT. '/views/inc/topnavbar.php'; ?>
    
    <h1>Posts Create</h1>
    
    <div class="post-container">
        <center><h1>Create a Post</h1></center>
        <form action="<?php echo URLROOT; ?>/posts/create" method="post" enctype="multipart/form-data">
            <div class="post-image">
                <img src="" alt=""  id="image-placeholder" style="display:none">
            </div>
            <div class="upper">
                <div class="left">
                    <input type="text" name="title" id="title" placeholder="title" value="<?php echo $data['title']; ?>" >
                    <span class="form-invalid"><?php echo $data['title_err']; ?></span>
                    <span class="form-invalid"><?php echo $data['image_err']; ?></span>
                </div>
                <div class="right">
                    <img src="<?php echo URLROOT; ?>/img/components/browse.png" alt="" id="addImagebtn" onclick="toggleBrowse()">
                    <img src="<?php echo URLROOT; ?>/img/components/tick.png" alt="" id="removeImagebtn"  onclick="removeImage()" style="display:none">
                    <input type="file" name="image" id="image" style="display:none">
                    
                </div>
           
            </div>
            
            <textarea name="body" id="body" placeholder="content" rows="10" cols="70" value="<?php echo $data['body']; ?>" ></textarea>
            <span class="form-invalid"><?php echo $data['body_err']; ?></span>
            <br>
            <input type="submit" value="post" class="post-btn">
        </form>
    </div>

    </div>
 <script type="text/javascript" src="<?php echo URLROOT; ?>/js/components/posts.js"></script>   
<?php require APPROOT. '/views/inc/footer.php'; ?>
            