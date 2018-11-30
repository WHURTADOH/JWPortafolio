    <div class="container mt-5">
      <div class="row mt-5">
        <div class="col-sm-12 col-md-4 offset-md-4">
          <form class="form-signin" autocomplete="off" method="post" action="?nt=login">
            <div class="text-center mb-4">
              <img class="mb-1" src="images/logo.svg" alt="" width="50%">
            </div>

            <div class="form-label-group">
              <label for="user">Usuario</label>
              <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" required autofocus>
            </div>

            <div class="form-label-group mt-3">
              <label for="pass">Contraseña</label>
              <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Ingresar</button>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-4 offset-md-4">
          <?php
            if(isset($_GET['mns_t'])){
          ?>
          <div class="alert alert-<?php echo base64_decode($_GET['mns_t']); ?> mt-3 text-center" role="alert">
            <?php echo base64_decode($_GET['mns_m']); ?>
          </div>
          <?php
            }
          ?>
          <p class="mt-3 mb-3 text-muted text-center">&copy; 2017-2018</p>
        </div>
      </div>
    </div>
