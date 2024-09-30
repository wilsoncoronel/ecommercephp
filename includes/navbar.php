<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/crud/public/index.php">Mini-Ecommerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/crud/public/index.php">Inicio</a>
        </li>

      
    <li class="nav-item">
        <a class="nav-link" href="/crud/admin/gestionar_producto.php">Administrar Productos</a>
    </li>
  

<!-- Puedes agregar más elementos de navegación aquí -->
</ul>
<ul class="navbar-nav ms-auto">
    <!-- El enlace a continuación es para la función de inicio/cierre de sesión que puede cambiar dependiendo del estado de la sesión -->
    <li class="nav-item">
        <?php if(isset($_SESSION['usuario_admin'])) : ?>
            <a class="nav-link" href="/crud/admin/logout.php">Cerrar Sesión</a>
        
            <a class="nav-link" href="/crud/admin/login.php">Iniciar Sesión</a>
        <?php endif; ?>
    </li>        
</ul>
</div>
</div>

</nav>

