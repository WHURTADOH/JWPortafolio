    <div class="container-fluid">
      <div class="row">
        <?php include_once('views/structure/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="row border-bottom mt-1 mb-3 py-4">
            <div class="col-sm-12 col-md-1">
              <a class="btn btn-info mr-4" href="#" role="button"><i class="fas fa-chalkboard-teacher fa-2x"></i></a>
            </div>
            <div class="col-sm-12 col-md-9">
              <div class="d-inline">
                <h5 class="h4">Derechos de Petición</h5>
                <span class="text-muted">Administración de Peticiones y Solicitudes.</span>
              </div>
            </div>
            <div class="col-sm-12 col-md-2">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newDdep"><i class="fas fa-plus-square"></i> Nuevo DdeP</button>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-12">
              <span class="text-muted mb-3">De Click en el numero para acceder al Detalle.</span>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-12">
              <table id="tbl_ddep" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>No. DdeP</th>
                    <th>Fecha</th>
                    <th>Tercero</th>
                    <th>Nombre</th>
                    <th>Respuesta</th>
                    <th>Fecha</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>

        </main>
      </div>
    </div>
    <div class="modal fade" id="newDdep" tabindex="-1" role="dialog" aria-labelledby="newDdepLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newDdepLabel"><i class="fas fa-plus-square"></i> Nuevo Derecho de Petición</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="new_ddepNum">Radicado de Archivo*</label>
                  <input type="text" class="form-control" id="new_ddepNum">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="new_ddepFecha">Fecha*</label>
                  <input type="date" class="form-control" id="new_ddepFecha">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <label for="new_ddepTercero">Tercero*</label>
                <div class="input-group mb-2">
                  <input id="new_ddepTercero" type="text" class="form-control" aria-describedby="btn_ddepTercero">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="btn_ddepTercero">Buscar</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 pt-4">
                <span id="new_ddepNombre"> <img id="loader" src="images/loader.gif" class="d-none" width="60"> </span>
              </div>
            </div>

            <div class="form-group">
              <label for="new_ddepDir">Dirección de Notificación</label>
              <input type="text" class="form-control" id="new_ddepDir">
            </div>

            <div class="form-group">
              <label for="new_ddepMun">Municipio - Ciudad</label>
              <input type="text" class="form-control" id="new_ddepMun" value="Chigorodó - Antioquia">
            </div>

            <div class="form-group">
              <label for="new_ddepObs">Observaciones*</label>
              <input type="text" class="form-control" id="new_ddepObs">
            </div>

          </div>
          <div class="modal-footer">
            <img id="loader_save" src="images/loader.gif" class="d-none" width="60">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn_ddepNEW" type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="views/libs/js/ddep.js"></script>
