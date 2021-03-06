    <div class="container-fluid">
      <div class="row">
        <?php include_once('views/structure/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <a class="btn btn-info mr-4" href="#" role="button"><i class="fas fa-home fa-2x"></i></a>
            <div class="d-inline">
              <h5 class="h4">Derechos de Petición</h5>
              <span class="text-muted">Administración de Peticiones y Solicitudes.</span>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-12 col-md-7 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    Datos de la Petición
                    <button type="button" class="btn btn-primary float-right mb-1" data-toggle="modal" data-target="#inf_ddep">
                      Informes
                    </button>
                  </h5>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label for="ddep_num">Radicado DdeP:</label>
                        <input data-id="<?php echo $ddep[0]->id ?>" type="text" class="form-control" id="ddep_num" value="<?php echo $ddep[0]->num_ddep ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label for="ddep_fecha">Fecha DdeP:</label>
                        <input type="text" class="form-control" id="ddep_fecha" value="<?php echo $ddep[0]->fecha_ddep ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                      <label for="frm_respuesta">Respuesta DdeP:</label>
                      <form id="frm_respuesta" enctype="multipart/form-data">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="ddep_res_file" name="archivo">
                            <label class="custom-file-label" for="ddep_res_file">Archivo</label>
                          </div>
                      </form>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label for="ddep_tercero">Identificación:</label>
                        <input type="text" class="form-control" id="ddep_tercero" value="<?php echo $ddep[0]->fk_mTerceros ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                      <div class="form-group">
                        <label for="ddep_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="ddep_nombre" value="<?php echo $ddep[0]->nombre ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="ddep_dir">Dirección:</label>
                        <input type="text" class="form-control" id="ddep_dir" value="<?php echo $ddep[0]->direccion ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="ddep_mun">Ciudad:</label>
                        <input type="text" class="form-control" id="ddep_mun" value="<?php echo $ddep[0]->ciudad ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="ddep_obs">Observaciones:</label>
                        <textarea class="form-control" id="ddep_obs" rows="3" readonly><?php echo utf8_encode($ddep[0]->obs) ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="card-body">
                  <h5 class="card-title">Datos de Prescripción</h5>
                  <hr>
                  <div class="row mb-3 no-gutters">
                    <div class="col-sm-12 col-md-2">
                      <div class="form-group">
                        <label for="ddep_pres_yini">Año Inicial</label>
                        <input type="text" class="form-control" id="ddep_pres_yini" value="<?php echo $ddep[0]->y_ini ?>">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <div class="form-group">
                        <label for="ddep_pres_yfin">Año Final</label>
                        <input type="text" class="form-control" id="ddep_pres_yfin" value="<?php echo $ddep[0]->y_fin ?>">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <div class="form-group">
                        <label for="ddep_pres_vini">Valor Inicial</label>
                        <input type="text" class="form-control" id="ddep_pres_vini" value="<?php echo $ddep[0]->v_ini ?>">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <div class="form-group">
                        <label for="ddep_pres_vfin">Valor Final</label>
                        <input type="text" class="form-control" id="ddep_pres_vfin" value="<?php echo $ddep[0]->v_fin ?>">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <div class="form-group">
                        <label for="ddep_pres_vfin">Trimestre</label>
                        <input type="text" class="form-control" id="ddep_pres_trim" value="<?php echo $ddep[0]->trimestre ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-12 col-md-12">
                      <form id="frm_vigencias" enctype="multipart/form-data">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="ddep_pres_file" name="archivo">
                          <label class="custom-file-label" for="ddep_pres_file">Vigencias (Archivo TXT)</label>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-12">
                      <button id="btn_new_predios" type="button" class="btn btn-primary">Relacionar Predios</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-5 mb-3">
              <div class="row mb-3">
                <div class="col-sm-12">
                  <div class="card">
                    <?php
                    if (count($resp) == 0) {
                    ?>
                    <div class="card-body">
                      <div class="jumbotron">
                        <h5 class="display-5">No hay Respuesta Generada!</h5>
                        <p class="lead">Este Derecho de Petición no tiene Respuesta, desea crear una?</p>
                        <hr class="my-4">
                        <button id="new_res_ddep" class="btn btn-primary btn-lg" type="button"><i class="fas fa-plus-square"></i> Nueva Respuesta</button>
                        <img id="loader_res" src="images/loader.gif" class="d-none" width="60">
                      </div>
                    </div>
                    <?php
                    }else{
                    ?>
                    <div class="card-body">
                      <h5 class="card-title">Respuesta Derecho de Petición</h5>
                      <hr>
                      <button id="btn_res_edit" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Respuesta"><i class="fas fa-edit"></i></button>
                      <button id="btn_res_undo" type="button" class="btn btn-warning btn-sm d-none" data-toggle="tooltip" data-placement="bottom" title="Cancelar Edición"><i class="fas fa-undo"></i></button>
                      <button id="btn_res_save" type="button" class="btn btn-success btn-sm d-none" data-toggle="tooltip" data-placement="bottom" title="Guardar Cambios"><i class="fas fa-save"></i></button>
                      <img id="loader_add_res" src="images/loader.gif" class="d-none" width="50">
                      <hr>
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                            <label for="ddep_res_reso">Respuesta:</label>
                            <input type="text" class="form-control" id="ddep_res_reso" value="<?php echo $resp[0]->reso_res ?>" readonly>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                            <label for="ddep_res_fecha">Fecha:</label>
                            <input type="date" class="form-control" id="ddep_res_fecha" value="<?php echo $resp[0]->fecha_res ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                            <label for="ddep_noti">Notifiación:</label>
                            <input type="text" class="form-control" id="ddep_noti" value="<?php echo $resp[0]->notificacion ?>" readonly>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                            <label for="ddep_noti_fecha">Fecha:</label>
                            <input type="date" class="form-control" id="ddep_noti_fecha" value="<?php echo $resp[0]->fecha_noti == "" ? "1999-01-01" : $resp[0]->fecha_noti ?>" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">
                        <button type="button" class="btn btn-primary btn-sm" onclick="directorio()"><i id="icn_dir" class="fas fa-sync-alt"></i></button>
                        Archivos en el Directorio</h5>
                      <hr>
                      <ul id="ddep_directorio" class="list-group">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </main>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="d_predios" tabindex="-1" role="dialog" aria-labelledby="d_prediosLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="d_prediosLabel">Predios Relacionados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul id="lst_predios" class="list-group">

            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button id="gen_predios" type="button" class="btn btn-primary">Generar Archivo</button>
          </div>
        </div>
      </div>
    </div>
    <?php include_once('views/resources/modal_component/inf_ddep.php') ?>
    <script type="text/javascript" src="views/libs/js/ddep.js"></script>
    <script type="text/javascript">
      directorio()
    </script>
