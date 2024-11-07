<?php require APPROOT. '/views/inc/header.php'; ?>
    <!-- Top Navigation -->
    <?php require APPROOT. '/views/inc/topnavbar.php'; ?>
    

    <div class="form-container">
        <div class="form-header">
            <center><h1>user Login</h1></center>
            <br>
            <p>please fill the correct credentials to login</p>
        </div>
        <form action="" method="post">
        

            <!-- email -->
            <div class="form-input-title">Email</div>
            <input type="text" name="email" id="email" class="email" value="<?php echo $data['email']; ?>">
            <span class="form-invalid"><?php echo $data['email_err']; ?></span>

            <!-- Password -->
            <div class="form-input-title">Password</div>
            <input type="password" name="password" id="password" class="password" value="<?php echo $data['password']; ?>">
            <span class="form-invalid"><?php echo $data['password_err']; ?></span>

      
            <br>
           <input type="submit" value="login" class="form-btn">
        </form>
        <?php 
        flash('reg_flash');
        ?>
    </div>
    
<?php require APPROOT. '/views/inc/footer.php'; ?>
            