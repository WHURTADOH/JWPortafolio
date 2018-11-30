    <div class="container-fluid">
      <div class="row">
        <?php include_once('views/structure/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <!-- ENCABEZADO DE LA PAGINA -->
          <div class="row border-bottom mt-1 mb-3 py-4">
            <div class="col-sm-12 col-md-1">
              <a class="btn btn-info mr-4" href="#" role="button"><i class="fas fa-folder-open fa-2x"></i></a>
            </div>
            <div class="col-sm-12 col-md-7">
              <div class="d-inline">
                <h5 class="h4">Kardex de Procesos</h5>
                <span class="text-muted">Administración del Kardex de Procesos.</span>
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
            </div>
          </div>

          <!-- KARDEX DE PROCESOS -->
          <div class="row mb-3">
            <div class="col-sm-12">
              <span class="text-muted mb-3">De Click en el radicado para acceder al Detalle.</span>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-12">
              <table id="kardex" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>Radicado</th>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Concepto</th>
                    <th>Valor</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </main>
      </div>
    </div>
