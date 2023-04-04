<?php
  include 'coneccion.php';
  session_start();

  if(isset($_SESSION['usuario'])){
    header("location:index.php");
  }

  if($_POST){
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $objconexion = new conexion();
    $resultado = $objconexion->consultar("select user, password from `usuarios` where user= '$usuario' and password = '$contrasenia'");
    if(isset($resultado)){
      $_SESSION['usuario']=$usuario;
      header("location:index.php");
    }else{
      echo "<script>alert('Usuario o contraseña incorrectas');</script>";
    }
  }  
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Login</title>
</head>

<body>
  <div class="container">

    <div class="row">
      <div class="col-md-4">

      </div>
      <div class="col-md-4">
        <br>
        <div class="card">
          <div class="card-header">
            Iniciar Sesión
          </div>
          <div class="card-body">
          <form action="login.php" method="post">
          Usuario: <input class="form-control" type="text" name="usuario" />
          <br />
          Contraseña: <input class="form-control" type="password" name="contrasenia" />
          <br />
          <input class="btn btn-success" type="submit" value="Entrar al portafolio" />
        </form>
          </div>
        </div>      
      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>