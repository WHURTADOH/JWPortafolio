<nav class="col-md-2 d-none d-md-block bg-dark text-white sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?php if($_GET['nt'] == 'home'){ echo 'active';}else{ echo 'text-white';} ?>" href="?nt=home">
          <i class="fas fa-home"></i>
          Dashboard <span class="sr-only">(current)</span>
        </a>
        <li class="nav-item">
          <a class="nav-link <?php if($_GET['nt'] == 'kardex' || $_GET['nt'] == 'kardex_det'){ echo 'active';}else{ echo 'text-white';} ?>" href="?nt=kardex">
            <i class="fas fa-folder-open"></i>
            Kardex de Procesos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_GET['nt'] == 'ddep' || $_GET['nt'] == 'ddep_det'){ echo 'active';}else{ echo 'text-white';} ?>" href="?nt=ddep">
            <i class="fas fa-chalkboard-teacher"></i>
            Derechos de Petición
          </a>
        </li>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Administración</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <i class="fas fa-cogs"></i>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link <?php if($_GET['nt'] == 'admin_conceptos'){ echo 'active';}else{echo 'text-white';} ?>" href="?nt=admin_conceptos">
          <i class="fas fa-cog"></i>
          Conceptos
        </a>
      </li>
    </ul>
  </div>
</nav>
