<?php


include '../includes/config.php';
include '../includes/header.php';


?>

<!-- Contenido Principal de la Administración -->
<div class="container mt-5">
    <h1 class="text-center">Bienvenido al Panel de Administración</h1>
    <div class="row mt-4">
        <!-- Tarjetas de Resumen o Acciones Rápidas -->
        <div class="col-lg-3 col-md-6 my-2">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <h5 class="card-title">Gestionar Productos</h5>
                    <p class="card-text">Añadir, Editar, y Eliminar productos.</p>
                    <a href="gestionar_producto.php" class="btn btn-light">Ir a Productos</a>
                </div>
            </div>
        </div>
 
        <!-- Repite las tarjetas de arriba para otras secciones como Usuarios, Pedidos, etc. -->
 
    </div>
</div>

<?php include '../includes/footer.php'; ?>