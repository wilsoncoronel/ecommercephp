<?php

include '../includes/config.php';
include '../includes/header.php';


$error = "";
$imagen = "";
$descripcion = "";
$nombre = "";
$precio = "";

if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
    $id = $_SESSION['id'];
    echo $id;
    $stmt = $conn->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos where id = ".$_SESSION['id']);
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($productos as $produc){
        echo $produc['descripcion'];
        $descripcion = $produc['descripcion'];
        $imagen = $produc['imagen'];
        $nombre = $produc['nombre'];
        $precio = $produc['precio'];
    }
}else{
    echo "No existe un id valido!!!";
    header("Location: gestionar_producto.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){

        $descripcion = $_POST['descripcion'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $directorioDestino = "../uploads/productos/";
            $archivoImagen = $directorioDestino . basename($_FILES['imagen']['name']);
        
            // Limitar el tamaño del archivo
            $tamanioMaximo = 5 * 1024 * 1024; // 5 MB
            if ($_FILES['imagen']['size'] > $tamanioMaximo) {
                $error = "El archivo de imagen es demasiado grande. Por favor, elige un archivo más pequeño.";
            } else {
                $tipoArchivo = strtolower(pathinfo($archivoImagen, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        
                if ($check !== false) {
                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivoImagen)) {
        
                    } else {
                        $error = "Hubo un error al subir la imagen.";
                    }
                } else {
                    $error = "El archivo no es una imagen.";
                }
            }
        } else {
            $archivoImagen = "";
        }
        
        echo  $descripcion;
       
       try {
            $consulta ="update productos set nombre = :nombre , descripcion = :descripcion, precio = :precio, imagen = :imagen where id = :id";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':imagen', $archivoImagen);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
        
            header("Location: gestionar_producto.php");
            exit();
            unset($_SESSION['id']);
        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
        }
}

/**/
?>

<div class="container mt-4">
    <h2>Modificar Productos</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="editar_producto.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="number" class="form-control" id="id" name="id" required value="<?php echo $id?>" disabled>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $nombre?>">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea type="text" class="form-control" id="descripcion" name="descripcion" required><?php echo $descripcion?></textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo $precio?>" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del producto: <?php echo "Dirección actual: ".$imagen ?></label>
            <br>
            <label for="imagen" class="form-label">Direccion nueva:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" value="<?php echo $imagen?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Modificar Producto</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>

