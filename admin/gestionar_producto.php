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
    <h2>Gestión de productos</h2>
    <a href="agregar_producto.php" class="btn btn-primary mb-4">Agregar Producto</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
    <?php foreach ($productos as $producto) : ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['id']); ?></td>
            <td>
                <?php if (isset($producto['imagen']) && $producto['imagen']) : ?>
                    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" style="width: 100px; height: auto;">
                    
                <?php else: ?>
                    <p>Sin imagen</p> 
                <?php endif; ?>
            </td>

            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($producto['precio']); ?></td>

            <td>
                <a href="editar_producto.php?id=<?php echo $producto['id'];?>&descripcion=<?php echo $producto['descripcion'];?>&nombre=<?php echo $producto['nombre'];?>&precio=<?php echo $producto['precio'];?>" class="btn btn-secondary btn-sm">Editar</a>
                <a href="eliminar_producto.php?id=<?php echo $producto['id'];?>&producto=<?php echo $producto['imagen']?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
        </tr>   
    <?php endforeach; ?>
</tbody>

    </table>
</div>

<?php include '../includes/footer.php'; ?>
