<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Simple Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body>
    <main class="landing-main">
      <div class="landing-container">
        <div class="text-center">
          <!-- Illustration #1 -->
          <div class="bg-shape bg-shape-1" aria-hidden="true">
            <img
              src="../img/shape.svg"
              alt="Background Shape"
              width="852"
              height="582"
            />
          </div>

          <!-- Illustration #2 -->
          <div class="bg-shape bg-shape-2" aria-hidden="true">
            <img
              src="../img/shape.svg"
              alt="Background Shape"
              width="852"
              height="582"
            />
          </div>

          <!-- Particles animation -->
          <div class="particle-container" aria-hidden="true">
            <canvas class="particle-canvas" data-particle-animation></canvas>
          </div>

          <div style="position: relative; z-index: 2;">
            <h1 class="landing-title">
              Your Web Application
            </h1>
            <div class="landing-description">
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. A rem libero fuga laudantium quas nam, sit officia nisi.
              </p>
            </div>
            <div class="button-group">
              <a href="./register.php" class="btn btn-primary">
                Register Now
                <span class="btn-arrow">→</span>
              </a>
              <a href="./login.php" class="btn btn-secondary">
                Go to Login
              </a>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <script src="../js/particle-animation.js"></script>
  </body>
</html>