<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../dist/output.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <title>Allah</title>
</head>

<body class="bg-success p-2 text-white bg-opacity-75">

  <!-- registeration -->
  <div class="container mt-5 bg-dark text-light rounded-3">
    <h1 class="text-primary">Hi dear friend</h1>
    <h2>Please fill below items for your registeration </h2>

    <!-- Form -->
    <form action="../Back/register.php" method="post">
      <div class="form-floating mb-3">
        <input type="text" class="form-control  " id="floatingInput" placeholder="hossein" name="name">
        <label class="text-primary" for="floatingInput">Your Name</label>
        <?php
        if (isset($_COOKIE["name_error"])) {
        ?>
          <p  class="font-bold m-0"><?php echo $_COOKIE["name_error"]  ?></p>
        <?php
        }
        ?>
        <?php
        if (isset($_COOKIE["pname_error"])) {
        ?>
          <p class="font-bold m-0" ><?php echo $_COOKIE["pname_error"]  ?></p>
        <?php
        }
        ?>
      </div>

      <div class="form-floating mb-3">
        <input type="email" class="form-control  " id="floatingInput" placeholder="momeni" name="email">
        <label class="text-primary" for="floatingInput">Email</label>
        <?php
        if (isset($_COOKIE["pemail_error"])) {
        ?>
          <p  class="font-bold m-0"><?php echo $_COOKIE["pemail_error"]  ?></p>
        <?php
        }
        ?>
        <?php
        if (isset($_COOKIE["email_error"])) {
        ?>
          <p class="font-bold m-0" ><?php echo $_COOKIE["email_error"]  ?></p>
        <?php
        }
        ?>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control  " id="floatingInput" placeholder="hossein" name="username">
        <label class="text-primary" for="floatingInput">User Name</label>
        <?php
        if (isset($_COOKIE["user_error"])) {
        ?>
          <p  class="font-bold m-0"><?php echo $_COOKIE["user_error"]  ?></p>
        <?php
        }
        ?>
        <?php
        if (isset($_COOKIE["puser_error"])) {
        ?>
          <p class="font-bold m-0" ><?php echo $_COOKIE["puser_error"]  ?></p>
        <?php
        }
        ?>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="momeni" name="password">
        <label class="text-primary" for="floatingPassword">Password</label>
        <?php
        if (isset($_COOKIE["pass_error"])) {
        ?>
          <p  class="font-bold m-0"><?php echo $_COOKIE["pass_error"]  ?></p>
        <?php
        }
        ?>
      </div>
      <input class="btn btn-primary mt-3 mb-3" type="submit" value="Sign up" name="submit-btn">
    </form>
  </div>
</body>

</html>