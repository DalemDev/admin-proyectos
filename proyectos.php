<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header("location:login.php");
}
include 'cabecera.php';
include 'coneccion.php';
if($_POST){
  $nombre=$_POST['nombreProyecto'];
  $descripcion=$_POST['descripcionProyecto'];
  
  $fecha=new DateTime();
  
  $imagen = $fecha->getTimestamp()."_".$_FILES['imagenProyecto']['name'];
  $imagenTemporal=$_FILES['imagenProyecto']['tmp_name'];
  
  move_uploaded_file($imagenTemporal, "imagenes/".$imagen);
  
  $objetoConexion=new conexion();
  $sql="insert into `proyectos` (id, nombre, imagen, descripcion) values (NULL, '$nombre', '$imagen', '$descripcion')";
  $objetoConexion->ejecutar($sql);

  header('location:portafolio.php');

}

if($_GET){
  $id=$_GET['borrar'];
  $objetoConexion = new conexion();

  $imagen=$objetoConexion->consultar("select imagen from `proyectos` where id=".$id);
  
  unlink("imagenes/".$imagen[0]['imagen']);

  $sql = "delete from `proyectos` where `proyectos`.`id`=".$id;
  $objetoConexion->ejecutar($sql);
  
  header('location:portafolio.php');

}

$objetoConexion=new conexion();
$proyectos=$objetoConexion->consultar("select * from `proyectos`");
?>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Datos del proyecto
        </div>
        <div class="card-body">
          <form action="portafolio.php" method="post" enctype="multipart/form-data">
            Nombre del proyecto: <input required
             class="form-control" type="text" name="nombreProyecto">
            <br>
            Imagen del proyecto: <input required class="form-control" type="file" name="imagenProyecto">
            <br>
            Descripcion del proyecto:
            <textarea required class="form-control" name="descripcionProyecto" cols="30" rows="5" style="resize: none;"></textarea>
            <br>
            <input class="btn btn-success" type="submit" value="Guardar Proyecto">
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Descripcion</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($proyectos as $proyecto) {?>
          <tr>
            <td><?php echo $proyecto['id']; ?></td>
            <td><?php echo $proyecto['nombre']; ?></td>
            <td>
              <img width="100" src="imagenes/<?php echo $proyecto['imagen'] ?>" alt="imagen">
            </td>
            <td><?php echo $proyecto['descripcion']; ?></td>
            <td> <a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id']; ?>" role="button">Eliminar</a> </td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<?php
include 'pie.php';
?>