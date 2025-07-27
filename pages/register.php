<?php include('../scripts/register_post.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Here</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css" />
  </head>

  <body>
    <div class="form-container">
      <!-- Register Section -->
      <div class="form-section">
        <div class="form-content">
          <p class="form-title">Join Us.</p>
          <form class="form" method="post" action="register.php">
            <?php include('../scripts/errors.php'); ?>
            
            <div class="form-group">
              <label class="form-label">Email</label>
              <input
                type="email"
                name="email"
                class="form-input"
                required
              />
            </div>
            
            <div class="form-group">
              <label class="form-label">Username</label>
              <input
                type="text"
                name="username"
                class="form-input"
                required
              />
            </div>

            <div class="form-group">
              <label class="form-label">Password</label>
              <input
                type="password"
                name="password"
                class="form-input"
                required
              />
            </div>
            
            <div class="form-group">
              <label class="form-label">Confirm Password</label>
              <input
                type="password"
                name="confirm_password"
                class="form-input"
                required
              />
            </div>

            <input
              type="submit"
              value="Register"
              name="reg_user"
              class="form-submit"
            />
          </form>
          
          <div class="form-footer">
            <p>
              Already have an account?
              <a href="login.php" class="form-link">Log in here.</a>
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
          src="../img/registerbg.png"
          alt="Register Background"
        />
      </div>
    </div>
    
    <script src="../js/particle-animation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>
  </body>
</html>