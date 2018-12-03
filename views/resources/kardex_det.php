    <div class="container-fluid">
      <div class="row">
        <?php include_once('views/structure/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <!-- ENCABEZADO DE LA PAGINA -->
          <div class="row border-bottom mt-1 mb-3 py-4">
            <div class="col-sm-12 col-md-1">
              <a class="btn btn-info mr-4" href="#" role="button"><i class="fas fa-file-alt fa-2x"></i></a>
            </div>
            <div class="col-sm-12 col-md-7">
              <div class="d-inline">
                <h5 class="h4">Detalle del Proceso</h5>
                <span class="text-muted">Datos Generales, Relación de Actuaciones Administrativas y Medidas Cautelares.</span>
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
            </div>
          </div>
          <!-- KARDEX DE PROCESOS -->
          <div class="row mb-3 no-gutters">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Datos Generales del Proceso</h5>
                  <hr>
                  <div class="row">
                    <div class="col-sm-11">
                      <!-- RADICADO - CONCEPTO -->
                      <div class="row">
                        <div class="col-sm-12 col-md-4">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="lbl_kdRadicado">Radicado:</span>
                            </div>
                            <input id="kdRadicado" type="text" class="form-control" aria-describedby="lbl_kdRadicado" readonly value="<?php echo $proceso[0]->radicado ?>">
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="kdConcepto">Concepto:</label>
                            </div>
                            <select data-id="<?php echo $proceso[0]->fk_mConceptos ?>" class="custom-select" id="kdConcepto" disabled>
                              <option selected>Seleccione...</option>
                              <?php
                              for ($i=0; $i < count($conceptos); $i++) {
                              ?>
                              <option value="<?php echo $conceptos[$i]->id ?>"><?php echo $conceptos[$i]->concepto ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- IDENTIFICACIÓN Y NOMBRE -->
                      <div class="row">
                        <div class="col-sm-12 col-md-4">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="lbl_kdIdent">Deudor:</span>
                            </div>
                            <input id="kdIdent" type="text" class="form-control" aria-describedby="lbl-kdIdent" readonly value="<?php echo $proceso[0]->fk_mTerceros ?>">
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="lbl_kdNombre">Nombre:</span>
                            </div>
                            <input id="kdNombre" type="text" class="form-control" aria-describedby="lbl-kdNombre" readonly value="<?php echo $proceso[0]->nombre ?>">
                          </div>
                        </div>
                      </div>
                      <!-- RESOLUCIÓN - FECHA - VALOR -->
                      <div class="row">
                        <div class="col-sm-12 col-md-4">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="lbl_kdReso">Resolución:</span>
                            </div>
                            <input id="kdReso" type="text" class="form-control" aria-describedby="lbl-kdReso" readonly value="<?php echo $proceso[0]->titulo ?>">
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="lbl_kdFecha">Fecha:</span>
                            </div>
                            <input id="kdFecha" type="date" class="form-control" aria-describedby="lbl-kdFecha" readonly value="<?php echo $proceso[0]->fecha_titulo ?>">
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="lbl_kdValor">Valor:</span>
                            </div>
                            <input id="kdValor" type="text" class="form-control" aria-describedby="lbl-kdValor" readonly value="<?php echo $proceso[0]->valor ?>" data-toggle="tooltip" data-placement="top" title="<?php echo "$".number_format($proceso[0]->valor,0,',','.')?>">
                          </div>
                        </div>
                      </div>
                      <!-- OBSERVACIONES -->
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Observaciones:</span>
                            </div>
                            <textarea id="kdObs" class="form-control" aria-label="With textarea" disabled><?php echo $proceso[0]->observaciones ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- BOTONES DE INTERACCIÓN -->
                    <div class="col-sm-1 text-center">
                      <img id="kdEstado" class="mb-3" data-id="<?php echo $proceso[0]->estado ?>" src="images/<?php echo $proceso[0]->estado ?>.gif" alt="">
                      <button id="btn_kdEdit" type="button" class="btn btn-primary mb-1" data-toggle="tooltip" data-placement="left" title="Editar Proceso"><i class="fas fa-edit"></i></button>
                      <button id="btn_kdSave" type="button" class="btn btn-success mb-1 d-none" data-toggle="tooltip" data-placement="left" title="Guardar Cambios"><i class="fas fa-save"></i></button>
                      <button id="btn_kdDel" type="button" class="btn btn-danger mb-1" data-toggle="tooltip" data-placement="left" title="Inactivar Proceso"><i class="fas fa-trash"></i></button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- KARDEX DE PROCESOS -->
          <div class="row mb-5">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Actuaciones del Proceso</h5><hr>
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="actuaciones-tab" data-toggle="tab" href="#actuaciones" role="tab" aria-controls="actuaciones" aria-selected="true">
                        Actuaciones Administrativas
                        <button id="new_kdActuaciones" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i></button>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="embargos-tab" data-toggle="tab" href="#embargos" role="tab" aria-controls="embargos" aria-selected="false">
                        Medidas Cautelares
                        <button id="new_kdEmbargos" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i></button></a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="actuaciones" role="tabpanel" aria-labelledby="actuaciones-tab">
                      <table id="tbl_act" class="table table-hover table-striped table-sm">
                        <thead>
                          <tr>
                            <th class="text-center" scope="col">No.</th>
                            <th scope="col">Actividad</th>
                            <th scope="col">Observación</th>
                            <th scope="col">Fecha</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          for ($i=0; $i < count($actuaciones); $i++) {
                          ?>
                          <tr>
                            <th class="text-center" scope="row">
                              <div class="form-check d-none"><input class="form-check-input ck-lg" type="radio" name="ActId" value="<?php echo $actuaciones[$i]->id ?>"></div>
                              <span class="num"><?php echo $i + 1 ?></span>
                            </th>
                            <td><?php echo $actuaciones[$i]->actividad ?></td>
                            <td><?php echo $actuaciones[$i]->obs ?></td>
                            <td><?php echo $actuaciones[$i]->fecha ?></td>
                          </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                      <button id="btn_ActEdit" type="button" class="btn btn-primary mb-1 btn-sm"><i class="fas fa-trash"></i> Editar</button>
                      <button id="btn_ActDel" type="button" class="btn btn-danger mb-1 btn-sm d-none"><i class="fas fa-trash"></i> Borrar</button>
                      <button id="btn_ActUndo" type="button" class="btn btn-warning mb-1 btn-sm d-none"><i class="fas fa-undo"></i> Cancelar</button>
                    </div>

                    <div class="tab-pane fade" id="embargos" role="tabpanel" aria-labelledby="embargos-tab">
                      <table class="table table-hover tanle-striped">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Objeto</th>
                            <th scope="col">Ident</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Status</th>
                            <th scope="col">Fecha</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          for ($i=0; $i < count($embargos); $i++) {
                          ?>
                          <tr>
                            <th class="text-center" scope="row">
                              <div class="form-check d-none"><input class="form-check-input ck-lg" type="radio" name="embId" value="<?php echo $embargos[$i]->id ?>"></div>
                              <span class="num"><?php echo $i + 1 ?></span>
                            </th>
                            <td><?php echo $embargos[$i]->objeto ?></td>
                            <td><?php echo $embargos[$i]->identificador ?></td>
                            <td><?php echo $embargos[$i]->fecha_emb ?></td>
                            <td><?php echo $embargos[$i]->status ?></td>
                            <td><?php echo $embargos[$i]->fecha_estatus ?></td>
                          </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                      <button id="btn_embEdit" type="button" class="btn btn-primary mb-1 btn-sm"><i class="fas fa-trash"></i> Editar</button>
                      <button id="btn_embPos" type="button" class="btn btn-success mb-1 btn-sm d-none"><i class="fas fa-check"></i> Admitido</button>
                      <button id="btn_embNeg" type="button" class="btn btn-danger mb-1 btn-sm d-none"><i class="fas fa-times"></i> Inadmitido</button>
                      <button id="btn_embDes" type="button" class="btn btn-info mb-1 btn-sm d-none"><i class="fas fa-backspace"></i> Desembargado</button>
                      <button id="btn_embDel" type="button" class="btn btn-danger mb-1 btn-sm d-none"><i class="fas fa-trash"></i> Borrar</button>
                      <button id="btn_embUndo" type="button" class="btn btn-warning mb-1 btn-sm d-none"><i class="fas fa-undo"></i> Cancelar</button>
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
    <div class="modal fade" id="md_kdActuaciones" tabindex="-1" role="dialog" aria-labelledby="md_kdActuacionesLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="md_kdActuacionesLabel"><i class="fas fa-plus-circle"></i> Nueva Actuación Administrativa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="new_actActividad">Actividad</label>
              <select class="custom-select" id="new_actActividad">
                <option value="0" selected disabled>Seleccione</option>
                <?php
                for ($i=0; $i < count($actividades); $i++) {
                ?>
                <option value="<?php echo $actividades[$i]->id ?>"><?php echo $actividades[$i]->nombre ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="new_actObs">Observaciones</label>
              <input type="text" class="form-control" id="new_actObs">
            </div>
            <div class="form-group">
              <label for="new_actFecha">Fecha</label>
              <input type="date" class="form-control" id="new_actFecha" value="<?php echo date("Y-m-d") ?>">
            </div>
          </div>
          <div class="modal-footer">
            <img src="images/loader.gif" width="50px" class="loader d-none">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn_actSave" type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="md_kdEmbargos" tabindex="-1" role="dialog" aria-labelledby="md_kdEmbargosLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="md_kdEmbargosLabel"><i class="fas fa-plus-circle"></i> Nueva Medida Cautelar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="new_embObjeto">Objeto</label>
              <select class="custom-select" id="new_embObjeto">
                <option value="0" selected disabled>Seleccione</option>
                <?php
                for ($i=0; $i < count($objetos); $i++) {
                ?>
                <option value="<?php echo $objetos[$i]->id ?>"><?php echo $objetos[$i]->objeto ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="new_embIdent">Identificador</label>
              <input type="text" class="form-control" id="new_embIdent">
            </div>
            <div class="form-group">
              <label for="new_embFecha">Fecha</label>
              <input type="date" class="form-control" id="new_embFecha" value="<?php echo date("Y-m-d") ?>">
            </div>
          </div>
          <div class="modal-footer">
            <img src="images/loader.gif" width="50px" class="loader d-none">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn_embSave" type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="views/libs/js/kardex.js"></script>
