    <div class="container">
      <div class="row justify-content-md-center mt-5">
        <div class="col-sm-12 col-md-4">
          <h4 class="text-center">Cambie su Contraseña</h4>
          <small class="text-muted">Recuerde que no puede utilizar su número de identificación como contraseña.</small>
          <form class="mt-2" action="?nt=edit_password" method="post">
            <div class="form-group">
              <label for="pass_1">Antigua Contraseña</label>
              <input type="password" class="form-control" id="pass_0" name="pass_0" placeholder="Ingrese su contraseña actual" required>
            </div>
            <div class="form-group">
              <label for="pass_1">Nueva Contraseña</label>
              <input type="password" class="form-control" id="pass_1" name="pass_1" placeholder="Ingrese su nueva contraseña" required>
            </div>
            <div class="form-group">
              <label for="pass_2">Repita la Nueva Contraseña</label>
              <input type="password" class="form-control" id="pass_2" name="pass_2" placeholder="Ingrese nuevamente su nueva contraseña" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Cambiar Contraseña</button>
            <a href="javascript:history.back(1)" class="btn btn-lg btn-success btn-block mt-3" role="button">Volver</a>
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
        </div>
      </div>
    </div>
