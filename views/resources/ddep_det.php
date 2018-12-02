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
                  <h5 class="card-title">Datos de la Petición</h5>
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
                      <div class="form-group">
                        <label for="ddep_tercero">Es Prescripción:</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                          <label class="btn btn-success">
                            <input type="radio" name="options" id="option2" autocomplete="off" value='true'> SI
                          </label>
                          <label class="btn btn-secondary">
                            <input type="radio" name="options" id="option3" autocomplete="off" value='false' checked> NO
                          </label>
                        </div>
                      </div>
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
                        <input type="text" class="form-control" id="ddep_mun" value="<?php echo $ddep[0]->nombre ?>" readonly>
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
                  <div class="row">
                    <div class="col-sm-12 col-md-3">
                      <div class="form-group">
                        <label for="ddep_pres_yini">Año Inicial</label>
                        <input type="text" class="form-control" id="ddep_pres_yini" value="<?php echo $ddep[0]->y_ini ?>">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
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
                  </div>
                  <div class="row">
                    <form id="frm_vigencias" action="?nt=prueba" method="post" enctype="multipart/form-data">
                    <div class="col-sm-12">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="ddep_pres_file" name="archivo" value="Buscar">
                        <label class="custom-file-label" for="ddep_pres_file">Vigencias (Archivo TXT)</label>
                      </div>
                      <button type="submit" name="button" value="Enviar"></button>
                    </form>
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
                            <input type="date" class="form-control" id="ddep_noti_fecha" value="<?php echo $resp[0]->fecha_noti ?>" readonly>
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
                      <h5 class="card-title">Predios Relacionados</h5>
                      <hr>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </main>
      </div>
    </div>
