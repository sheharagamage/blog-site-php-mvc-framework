<div class="topnav">
  
  
  <div>
  <a class="active" href="#home">Home</a>
  <?php if(!isset($_SESSION['user_id'])): ?>
  <a href="<?php echo URLROOT; ?>/users/login">Login</a>
  <a href="<?php echo URLROOT; ?>/users/register">Register</a>
  <?php else: ?>
  <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
  <?php endif; ?>
  <!-- <a href="#about">Logout</a> -->
  </div>
  <?php if(isset($_SESSION['user_id'])): ?>
  <div class="profile">
    <div class="pic">
      <img src="<?php echo URLROOT; ?>/img/profileimg/<?php echo $_SESSION['user_profile_image']; ?>" >
    </div>
    <div class="user-name">
      <p><?php echo $_SESSION['user_name']; ?></p>
    </div>
  </div>
  <?php endif; ?>
</div>
