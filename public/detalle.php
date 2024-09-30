<?php

include '../includes/config.php';
include '../includes/header.php';
$id ="";
$descripcion = "";
$imagen = "";
$nombre = "";
$precio = "";
if(isset($_GET['id'])){
    $id= $_GET['id'];
    //echo $id;
    try{
        $stmt = $conn->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos where id = ".$id);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($productos as $produc){
            $descripcion = $produc['descripcion'];
            $imagen = $produc['imagen'];
            $nombre = $produc['nombre'];
            $precio = $produc['precio'];
        }

        //echo $id, $descripcion, $nombre, $imagen;
    } catch (PDOException $e) {
        
        error_log("Error: " . $e->getMessage());
      
        echo "Ocurrió un error. Por favor, inténtalo de nuevo más tarde.";
    }
}


?>
 <div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Imagen del producto -->
            <img src="<?php echo $imagen;?>" style="width: 500px;" alt="<?php echo $nombre;?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <!-- Detalles del producto -->
            <h2><?php echo $nombre;?></h2>
           <label for="descripcion">Descripcion: </label><p><?php echo $descripcion;?></p>
           <label for="precio">Precio: </label><p><?php echo $precio;?></p>
        </div>
    </div>
    
</div>


<?php include '../includes/footer.php'; ?>