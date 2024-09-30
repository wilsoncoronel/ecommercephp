<?php

include '../includes/config.php';
include '../includes/header.php';



try{
    $stmt = $conn->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos");
    $stmt->execute();

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    
    error_log("Error: " . $e->getMessage());
  
    echo "Ocurrió un error. Por favor, inténtalo de nuevo más tarde.";
}
?>

<div class="container mt-4">
    <h2>Productos Disponibles</h2>
    <div class="row">
        <?php foreach ($productos as $producto) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php if ($producto['imagen']) : ?>
                        <img src="../uploads/productos/<?php echo htmlspecialchars(basename($producto['imagen'])); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                        <p class="card-text">$<?php echo htmlspecialchars($producto['precio']); ?></p>
                        <a href="detalle.php?id=<?php echo $producto['id']; ?>" class="btn btn-primary">Ver Detalles</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
 
<?php include '../includes/footer.php'; // Asegúrate de que la ruta sea correcta
?>