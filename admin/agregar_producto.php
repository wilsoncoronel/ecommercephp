<?php

include '../includes/config.php';
include '../includes/header.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion']; // Corregido el error de tipeo
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

    try {
        $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $descripcion, $precio, $archivoImagen]);

        header("Location: gestionar_producto.php");
        exit();
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
    }
}
?>

<div class="container mt-4">
    <h2>Agregar Productos</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="agregar_producto.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea type="text" class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del producto</label>
            <input type="file" class="form-control" id="imagen" name="imagen" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
