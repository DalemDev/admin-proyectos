<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header("location:login.php");
}
$usuario = $_SESSION['usuario'];
include 'cabecera.php';
include 'coneccion.php';

$objetoConexion = new conexion();
$proyectos = $objetoConexion->consultar("select * from `proyectos` where autor='$usuario'");
?>

<div class="p5 bg-light">
  <div class="container">
    <h1 class="display-3">Bienvenid@ <?php echo $usuario ?> </h1>
    <p class="lead">Empieza a subir tus proyectos</p>
    <hr class="my-2">
  </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
  <?php foreach ($proyectos as $proyecto) { ?>
    <div class="col">
      <div class="card">
        <img src="imagenes/<?php echo $proyecto['imagen'] ?>"  class="card-img-top" alt="imagen">
        <div class="card-body">
          <h5 class="card-title"><?php echo $proyecto['nombre'] ?></h5>
          <p class="card-text"><?php echo $proyecto['descripcion'] ?></p>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php
include 'pie.php';
?>