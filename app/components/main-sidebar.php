<aside class="main-sidebar sidebar-light-primary elevation-4"><!-- sidebar-dark-primary -->
    <!-- Brand Logo -->
    <a href="main.php" class="brand-link">
      <img src="../dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Sugar</b>Care</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["nombre"]?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Buscar">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
                <a href="main.php" class="nav-link <!--active-->">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>
          <li class="nav-item">
            <a href="search.php" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
                <p>Buscador</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
                <p>Buzón</p>
              </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>Calendario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-bell"></i>
              <p>Notificaciones</p>
            </a>
          </li>
          <li class="nav-item">
                <a href="glucoserecord.php" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Registro Glucosa</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="glucohistory.php" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>Diario de Glucosa</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>Registro de comidas</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>Diario de comidas</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Registro Actividad</p>
                </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Diario de Actividad</p>
            </a>
          </li>
          <li class="nav-item">
                <a href="medicalhistory.php" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>Historia Clínica</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Análisis avanzado</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="users.php" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Usuarios</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="groups.php" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Grupos</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="recommendations.php" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Recomendaciones</p>
                </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Retos</p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Galería
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Kanban Board
              </p>
            </a>
          </li>-->
          
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <p>Salir</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>