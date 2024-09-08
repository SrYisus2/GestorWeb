<body id="page-top">
  <!-- body Head -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-warning sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand shadow-lg d-flex align-items-center justify-content-center" href="dashboard.php">
        <img class="rounded-circle" src="img/icono2.jpg" alt="Logo">
        <div class="sidebar-brand-text mx-3">DASHBOARD</div>
      </a>

      <!-- Division - Linea blanca -->
      <hr class="sidebar-divider">

      <!-- MAQUINARIA-->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaquinaria"
          aria-expanded="true" aria-controls="collapseMaquinaria">
          <i class="fas fa-truck-pickup"></i>
          <span>Maquinaria</span>
        </a>
        <div id="collapseMaquinaria" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="maquinaria_registro.php">Registro de Maquinaria</a>
          </div>
        </div>
      </li>

      <!-- COMBUSTIBLE -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCombustible"
          aria-expanded="true" aria-controls="collapseCombustible">
          <i class="fas fa-gas-pump"></i>
          <span>Combustible</span>
        </a>
        <div id="collapseCombustible" class="collapse" aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="combustible_despachadores.php">Despachadores</a>
            <a class="collapse-item" href="combustible_ingreso.php">Ingresos</a>
            <a class="collapse-item" href="combustible_insumo.php">Insumos</a>
            <a class="collapse-item" href="combustible_reportes.php">Reportes</a>
          </div>
        </div>
      </li> 

      <!-- BODEGA REPUESTOS Y MATERIALES -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBodega" aria-expanded="true"
          aria-controls="collapseBodega">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Repuestos</span>
        </a>
        <div id="collapseBodega" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="repuestos_solicitud.php">Solicitud de Repuestos</a>
            <a class="collapse-item" href="repuestos_versolicitudes.php">Ver Solicitudes</a>
            <a class="collapse-item" href="repuestos_ingresos.php">Registro de Repuestos</a>
            <a class="collapse-item" href="repuestos_salidas.php">Salida de Repuestos</a>
            <a class="collapse-item" href="repuestos_reportes.php">Reportes</a>
          </div>
        </div>
      </li>

      <!-- Division - Linea blanca -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler OCULTA EL MENU -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- LADO DERECHO -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- CONTENIDO PRINCIPAL -->
      <div id="content">
        <!--BARRA SUPERIOR -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar)  OCULTAR MENU, APARECE ACORDE AL ANCHO DE LA PANTALLA-->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- BARRA ARRIBA -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- INFORMACION DE USUARIO -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $Uname ?> - <?php echo $Urol ?> </span>
                <img class="img-profile rounded-circle"
                  src="./img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> 
                <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
            </li>
          </ul>
          <!-- FIN BARRA ARRIBA -->
        </nav>
        <!-- FIN BARRA SUPERIOR -->
        