<?php include('../scripts/register_post.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Here</title>
    <!-- Tailwind -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"
      rel="stylesheet"
    />
    <!-- sweetalert js cdn For alerts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css"
    />
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Font -->
  </head>

  <body class="bg-white font-family-karla h-screen">
    <div class="w-full flex flex-wrap">
      <!-- Register Section -->
      <div class="w-full md:w-1/2 flex flex-col">
        <div
          class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32"
        >
          <p class="text-center text-3xl">Join Us.</p>
          <form
            class="flex flex-col pt-3 md:pt-8"
            method="post"
            action="register.php"
          >
          <?php include('../scripts/errors.php'); ?> 
            <div class="flex flex-col pt-4">
              <label class="text-lg">Email</label>
              <input
                type="email"
                name="col_email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                required
              />
            </div>
            <div class="flex flex-col pt-4">
              <label class="text-lg">Username</label>
              <input
                type="text"
                name="col_username"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                required
              />
            </div>

            <div class="flex flex-col pt-4">
              <label class="text-lg">Password</label>
              <input
                type="text"
                name="col_password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                required
              />
            </div>
            <div class="flex flex-col pt-4">
              <label class="text-lg">Confirm Password</label>
              <input
                type="text"
                name="col_password2"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                required
              />
            </div>

            <input
              type="submit"
              value="Register"
              name="reg_user"
              class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8"
            />
          </form>
          <div class="text-center pt-12 pb-12">
            <p>
              Already have an account?
              <a href="login.php" class="underline font-semibold"
                >Log in here.</a
              >
            </p>
          </div>
        </div>
      </div>
      <!-- Particles animation -->
      <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <canvas data-particle-animation></canvas>
      </div>
      <!-- Image Section -->
      <div class="w-1/2 shadow-2xl">
        <img
          class="object-cover w-full h-screen hidden md:block"
          src="../img/registerbg.png"
          alt="Background"
        />
      </div>
    </div>
  </body>
  <!-- For Particle -->
  <script src="../js/particle-animation.js"></script>
  <!-- For Custom Alert Box -->
  <script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"
  ></script>
</html>
