
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Iniciar sesion en portal</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

  </head>
  <?php include('./includes/conn.php'); 
    $mysqli = con_start();

    $smtp = $mysqli->prepare("SELECT count(*) FROM User");
    
    $smtp->execute();
    $smtp->store_result();    
    $smtp->bind_result($count);
    while ($smtp->fetch()) {
         echo $count . " tessttttt ";
    }
    $smtp->free_result();
    $smtp->close();



  ?>  
  <body>

    <div class="container">

      <form class="form-signin" action="signInController.php" method="POST">
        <h2 class="form-signin-heading">Inicia sesion</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Correo electronico" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Contraseña" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recuerdame
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Inicia sesión</button>
      </form>

      <a href="signUp.html"><h3 class="text-center">Nuevo usuario, aqui dale?</h3></a>

    </div> <!-- /container -->

  </body>
</html>
