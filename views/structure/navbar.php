    <nav class="navbar navbar-dark fixed-top bg-primary flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
        <img src="images/logo.svg" width="30" height="30" alt="">
        Cobro Coactivo
      </a>
      <div class="dropdown mr-2">
        <button class="btn btn-primary dropdown-toggle" type="button" id="navbar-perfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
          <?php echo $_SESSION['cc-ident']; ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-perfil">
          <h6 class="dropdown-header"><?php echo $_SESSION['cc-nombre']; ?></h6>
          <a class="dropdown-item" href="?nt=change_pass">Cambiar Contraseña</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="?nt=login_end">Cerrar Sesion</a>
        </div>
      </div>
    </nav>
