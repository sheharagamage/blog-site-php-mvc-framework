<?php require APPROOT. '/views/inc/header.php'; ?>
    <!-- Top Navigation -->
    <?php require APPROOT. '/views/inc/topnavbar.php'; ?>
    

    <div class="form-container">
        <div class="form-header">
            <center><h1>user singn up</h1></center>
            <br>
            <p>please fill the form to register</p>
        </div>
        <form action="<?php echo URLROOT; ?>/users/register" method="post"  enctype="multipart/form-data">
            <!-- profile picture -->
            <div class="form-drag-area">
                <div class="icon">
                    <img src="<?php echo URLROOT; ?>/img/components/placeholder.png" alt="placeholder"  width="90px" height="90px"  id="profile_image_placeholder">
                </div>
                <div class="right-content">
                    <div class="description">Drag & Drop to Upload File</div>
                    <div class="form-upload">
                        <input type="file" name="profile_image" id="profile_image"  style="display:none">
                        <!-- type is file -->
                        Browse file
                    </div>
                </div>
                <div class="form-validation">
                    <div class="profile-image-validation">
                        <img src="<?php echo URLROOT; ?>/img/components/tick.png" alt="tick" width="15px" height="15px">
                        select a profile picture
                    </div>
                </div>
            </div>
            <span class="form-invalid"><?php echo $data['profile_image_err']; ?></span>
            <!-- Name -->
            <div class="form-input-title">Name</div>
            <input type="text" name="name" id="name" class="name"  value="<?php echo $data['name']; ?>">
            <span class="form-invalid"><?php echo $data['name_err']; ?></span>

            <!-- email -->
            <div class="form-input-title">Email</div>
            <input type="text" name="email" id="email" class="email" value="<?php echo $data['email']; ?>">
            <span class="form-invalid"><?php echo $data['email_err']; ?></span>

            <!-- Password -->
            <div class="form-input-title">Password</div>
            <input type="password" name="password" id="password" class="password" value="<?php echo $data['password']; ?>">
            <span class="form-invalid"><?php echo $data['password_err']; ?></span>

            <!--Confirm Password -->
            <div class="form-input-title">Confirm Password</div>
            <input type="password" name="confirm_password" id="confirm_password" class="confirm_password" value="<?php echo $data['confirm_password']; ?>" >
            <span class="form-invalid"><?php echo $data['confirm_password_err']; ?></span>
            <br>
           <input type="submit" value="Register" class="form-btn">
        </form>

    </div>

    <script type="text/javascript" src="<?php echo URLROOT; ?>/js/components/image.js"></script>
    
<?php require APPROOT. '/views/inc/footer.php'; ?>
            