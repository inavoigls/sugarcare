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
        <?php if(!isset($_SESSION["medicalview"])) {?>
          <a href="editusers.php?user=<?php echo $_SESSION["nombre"]?>" class="d-block"><?php echo $_SESSION["nombre"]?></a>
        <?php } else {?>
          <a href="#" class="d-block"><?php echo $_SESSION["nombre"]?></a>
        <?php } ?>
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
          <?php if(!isset($_SESSION["medicalview"])) {?>
          <li class="nav-item">
            <a href="search.php" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
                <p>Buscador</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="calendar.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>Calendario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="notifications.php" class="nav-link">
              <i class="nav-icon far fa-bell"></i>
              <p>Notificaciones</p>
            </a>
          </li><?php }?>
          <?php if($_SESSION["idgrupo"]=="2") {?>
          <?php if(!isset($_SESSION["medicalview"])) {?>
          <li class="nav-item">
            <a href="glicemia-record.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Registro Glicemia</p>
            </a>
          </li><?php }?>
          <li class="nav-item">
            <a href="glicemia-history.php" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Diario de Glicemia</p>
            </a>
          </li>
          <?php if(!isset($_SESSION["medicalview"])) {?>
          <li class="nav-item">
            <a href="weight-record.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Registro Peso</p>
            </a>
          </li><?php }?>
          <li class="nav-item">
            <a href="weight-history.php" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Diario de Peso</p>
            </a>
          </li>
          <?php if(!isset($_SESSION["medicalview"])) {?>
          <li class="nav-item">
            <a href="food-record.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Registro de comidas</p>
            </a>
          </li><?php }?>
          <li class="nav-item">
                <a href="food-history.php" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>Diario de comidas</p>
                </a>
          </li>
          <?php if(!isset($_SESSION["medicalview"])) {?>
          <li class="nav-item">
                <a href="activity-record.php" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>Registro Actividad</p>
                </a>
          </li><?php }?>
          <li class="nav-item">
            <a href="activity-history.php" class="nav-link">
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
          <?php if(!isset($_SESSION["medicalview"])) {?>
          <li class="nav-item">
                <a href="recommendations.php" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Recomendaciones</p>
                </a>
          </li><?php }?>
          <li class="nav-item">
                <a href="advance-analysis.php" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Análisis avanzado</p>
                </a>
          </li>
          <?php } if($_SESSION["idgrupo"]=="3"){?>
          <li class="nav-item">
                <a href="patients.php" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Pacientes</p>
                </a>
          </li>
          <?php } if($_SESSION["idgrupo"]=="1"){?>
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
          </li><?php }?>
          <?php if(isset($_SESSION["medicalview"]) && isset($_SESSION["prevuser"])){ ?>
          <li class="nav-item">
            <a href="sso.php?medicalview=false" class="nav-link">
              <p>Volver</p>
            </a>
          </li>
          <?php }  else { ?>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <p>Salir</p>
            </a>
          </li><?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>