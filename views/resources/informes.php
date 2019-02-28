    <div class="container-fluid">
      <div class="row">
        <?php include_once('views/structure/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <a class="btn btn-info mr-4" href="#" role="button"><i class="fas fa-copy"></i></a>
            <div class="d-inline">
              <h5 class="h4">Informes</h5>
              <span class="text-muted">Informes, reportes y plantillas del Sistema.</span>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-12">
              <div class="accordion" id="acd_informes">

                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-angle-right"></i> Prescripción de la Acción de Cobro
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#acd_informes">
                    <div class="card-body">
                      <div class="row">
                        <!-- COLAPSE PRESCRIPCIÓN PREDIAL -->
                        <div class="col-sm-12 col-md-2">
                          <div class="card text-center p-3 border-primary">
                            <span class="card-title">PRESCRIPCIÓN PREDIAL</span>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdlPresPredial"><i class="fas fa-sign-in-alt"></i></button>
                          </div>
                          <div class="modal fade" id="mdlPresPredial" tabindex="-1" role="dialog" aria-labelledby="mdlPresPredialLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="mdlPresPredialLabel">Prescripción Predial</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="presPredNumDdep">Radicado DdeP</label>
                                    <input type="text" class="form-control" id="presPredNumDdep">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  <button type="button" class="btn btn-primary">Abrir</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- COLAPSE PRESCRIPCIÓN INDUSTRIA -->
                        <div class="col-sm-12 col-md-2">
                          <div class="card text-center p-3 border-primary">
                            <span class="card-title">PRESCRIPCIÓN INDUSTRIA</span>
                            <button type="button" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fas fa-angle-right"></i> Sobres, Citaciones, Notificaciones
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#acd_informes">
                    <div class="card-body">
                      <div class="card-body">
                        <div class="row">
                          <!-- COLAPSE SOBRES -->
                          <div class="col-sm-12 col-md-2">
                            <div class="card text-center p-3 border-primary">
                              <span class="card-title">SOBRES</span>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdlSobres"><i class="fas fa-sign-in-alt"></i></button>
                            </div>
                            <div class="modal fade" id="mdlSobres" tabindex="-1" role="dialog" aria-labelledby="mdlSobresLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="mdlSobresLabel">Sobres para Correspondencia</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="sobresNumDdep">Radicado DdeP</label>
                                      <input type="text" class="form-control" id="sobresNumDdep">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button id="openInfSobres" type="button" class="btn btn-primary">Abrir</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-2">
                            <div class="card text-center p-3 border-primary">
                              <span class="card-title">CITACIÓN</span>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdlSobres"><i class="fas fa-sign-in-alt"></i></button>
                            </div>
                            <div class="modal fade" id="mdlCitacion" tabindex="-1" role="dialog" aria-labelledby="mdlCitacionLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="mdlCitacionLabel">Citacion para Notificar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="citacionNumDdep">Radicado DdeP</label>
                                      <input type="text" class="form-control" id="citacionNumDdep">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button id="openInfCitacion" type="button" class="btn btn-primary">Abrir</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>


        </main>
      </div>
    </div>
    <script type="text/javascript" src="views/libs/js/informes.js"></script>
