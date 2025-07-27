<?php 
include('../scripts/login_post.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Here</title>
    <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body>
    <div class="form-container">
      <!-- Login Section -->
      <div class="form-section">
        <div class="form-content">
          <p class="form-title">Welcome.</p>
          <form class="form" method="post" action="login.php">
            <?php include('../scripts/errors.php'); ?>
            
            <!-- Alert for creating account -->
            <?php if(isset($_SESSION['status'])){ ?>
            <div class="alert alert-success" role="alert">
              Account Created Successfully!
            </div>
            <?php unset($_SESSION['status']);}?>
            
            <div class="form-group">
              <label class="form-label">Username</label>
              <input
                type="text"
                id="Username"
                name="username"
                class="form-input"
                required
              />
            </div>

            <div class="form-group">
              <label class="form-label">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-input"
                required
              />
            </div>

            <input
              type="submit"
              value="Log In"
              name="login_user"
              class="form-submit"
            />
          </form>
          
          <div class="form-footer">
            <p>
              Don't have an account?
              <a href="register.php" class="form-link">Register here.</a>
            </p>
          </div>
        </div>
      </div>
      
      <!-- Particles animation -->
      <div class="particle-container" aria-hidden="true">
        <canvas class="particle-canvas" data-particle-animation></canvas>
      </div>
      
      <!-- Image Section -->
      <div class="image-section">
        <img
          class="form-image"
          src="../img/loginbg.png"
          alt="Login Background"
        />
      </div>
    </div>
    
    <script src="../js/particle-animation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>
  </body>
</html>