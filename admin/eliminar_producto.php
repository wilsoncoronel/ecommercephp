<?php
include '../includes/config.php';
include '../includes/header.php';


try{
    $id="";
    $nombre="";
    if(isset($_GET['id']) && isset($_GET['producto'])){
        $id = $_GET['id'];
        $nombre = $_GET['producto'];
        //echo "ID: $id, Nombre: $nombre";
    }
   
   $stmt = $conn->prepare("Delete  FROM productos where id = ".$id);
    $stmt->execute();

    if(file_exists($nombre)){
        if(unlink($nombre)){
            echo "El producto fue borrado exitosamente!!!!";
        }
    }else{
        echo "No existe la imagen del producto!!";
    }

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header("Location: gestionar_producto.php");
} catch (PDOException $e) {
    
    error_log("Error: " . $e->getMessage());
  
    echo "Ocurrió un error. Por favor, inténtalo de nuevo más tarde.";
}
?>