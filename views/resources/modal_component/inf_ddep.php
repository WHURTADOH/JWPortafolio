<!-- Modal -->
<div class="modal fade" id="inf_ddep" tabindex="-1" role="dialog" aria-labelledby="inf_ddepLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inf_ddepLabel">Informes para Derechos de Petición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <h5>Informes de Prescripción</h5>
          </div>
          <!-- COLAPSE PRESCRIPCIÓN PREDIAL -->
          <div class="col-sm-12 col-md-3">
            <div class="card text-center p-3 border-primary">
              <span class="card-title">RESOLUCIÓN DE PRESCRIPCIÓN (PREDIAL)</span>
              <a role="button" class="btn btn-primary" href="index.php?nt=load_pres_predial&ddep=<?php echo $ddep[0]->num_ddep ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=700,height=500'); return false;"><i class="fas fa-sign-in-alt"></i></a>
            </div>
          </div>
          <!-- COLAPSE PRESCRIPCIÓN PREDIAL NEGADA -->
          <div class="col-sm-12 col-md-3">
            <div class="card text-center p-3 border-primary">
              <span class="card-title">RESOLUCIÓN NIEGA PRESCRIPCIÓN (PREDIAL)</span>
              <a role="button" class="btn btn-primary" href="index.php?nt=load_pres_predial_neg&ddep=<?php echo $ddep[0]->num_ddep ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=700,height=500'); return false;"><i class="fas fa-sign-in-alt"></i></a>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <h5>Citaciones y Notificaciones</h5>
          </div>
          <!-- COLAPSE CITACIÓN PARA NOTIFICAR DDEP -->
          <div class="col-sm-12 col-md-3">
            <div class="card text-center p-3 border-primary">
              <span class="card-title">CITACIÓN PARA NOTIFICAR (DDEP)</span>
              <a role="button" class="btn btn-primary" href="index.php?nt=load_citacion_ddep&ddep=<?php echo $ddep[0]->num_ddep ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=700,height=500'); return false;"><i class="fas fa-sign-in-alt"></i></a>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <h5>Otros Informes</h5>
          </div>
          <!-- COLAPSE SOBRES -->
          <div class="col-sm-12 col-md-3">
            <div class="card text-center p-3 border-primary">
              <span class="card-title">SOBRES</span>
              <a role="button" class="btn btn-primary" href="index.php?nt=load_sobres_ddep&ddep=<?php echo $ddep[0]->num_ddep ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=700,height=500'); return false;"><i class="fas fa-sign-in-alt"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
