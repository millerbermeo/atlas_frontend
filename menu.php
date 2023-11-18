
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-city"></i>
        </div>
        <div class="sidebar-brand-text mx-3">COBRANZA <sup>1.0</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="Dash.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Cartera
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php if ($type_u == "admin"): ?>
      <li class="nav-item">
          <a class="nav-link" href="cargar_cobro.php">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Cargar cobros</span></a>
      </li>
    <?php endif; ?>

    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Clientes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Componentes:</h6>
                <a class="collapse-item" href="clientes.php">Historial</a>
                <a class="collapse-item" href="#">Archivos de acuerdo</a>
            </div>
        </div>
    </li> -->

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Cobros pendientes</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Componentes:</h6>
                <a class="collapse-item" href="cobro_dia.php">Cobro por Rango</a>
                <a class="collapse-item" href="cobros_totales.php">Todos los Cobros</a>
            </div>
        </div>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" href="cobro.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Cobros</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Otros
    </div>

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="informes.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Informes</span></a>
    </li> -->
    <?php if ($type_u == "admin"): ?>
      <li class="nav-item">
       <a class="nav-link" href="informes.php">
             <i class="fas fa-fw fa-chart-area"></i>
             <span>Informes</span></a>
     </li>
      <li class="nav-item">
          <a class="nav-link" href="iea.php">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>IEA</span></a>
      </li>
    <?php endif; ?>


    <li class="nav-item">
        <a class="nav-link" href="empresas.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Empresas</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-table"></i>
            <span>Recibos de caja</span></a>
    </li> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Agentes y Admin:</h6>
                <a class="collapse-item" href="usuarios.php">Listar Usuarios plataforma</a>
                <?php if ($type_u == "admin"): ?>
                  <a class="collapse-item" href="create_user.php">Crear Administrador</a>
                  <a class="collapse-item" href="create_user_a.php">Crear Agente</a>
                <?php endif; ?>



                <!-- <div class="collapse-divider"></div>
                <h6 class="collapse-header">Clientes:</h6>
                <a class="collapse-item" href="#">Listar Clientes</a>
                <a class="collapse-item" href="#">Listar Empresas</a>
                <a class="collapse-item" href="#">Crear Cliente</a>
                <a class="collapse-item" href="#">Crear Empresa</a> -->
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="ayuda.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Ayuda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
