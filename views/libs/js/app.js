$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip()
  $('#kardex').DataTable( {
    "ajax": 'index.php?nt=get_kardex_ALL',
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    }
  });
  $('#tbl_ddep').DataTable( {
    "ajax": 'index.php?nt=get_ddep_ACT',
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    }
  });
  $('#kdConcepto').val($('#kdConcepto').data('id'))
  $('#btn_kdEdit').on('click',function(){
    let estado = $('#kdEstado').data('id');
    if (estado == 'ACT') {
      $('#btn_kdEdit').addClass('d-none');
      $('#btn_kdUndo').removeClass('d-none');
      $('#btn_kdSave').removeClass('d-none');
      $('#kdConcepto').removeAttr('disabled');
      $('#kdReso').removeAttr('readonly');
      $('#kdFecha').removeAttr('readonly');
      $('#kdValor').removeAttr('readonly');
      $('#kdObs').removeAttr('disabled');
    }else{
      bootbox.alert('El proceso se encuentra inactivo, no es posible editarlo.');
    }
  })
  $('#btn_kdUndo').on('click',function(){
    $('#btn_kdEdit').removeClass('d-none');
    $('#btn_kdUndo').addClass('d-none');
    $('#btn_kdSave').addClass('d-none');
    $('#kdConcepto').attr('disabled','true');
    $('#kdReso').attr('readonly','true');
    $('#kdFecha').attr('readonly','true');
    $('#kdValor').attr('readonly','true');
    $('#kdObs').attr('disabled','true');
  })
  $('#btn_kdSave').on('click',function(){
    let form_data = new FormData();
    form_data.append('radicado', $('#kdRadicado').val())
    form_data.append('concepto', $('#kdConcepto').val())
    form_data.append('titulo', $('#kdReso').val())
    form_data.append('fecha', $('#kdFecha').val())
    form_data.append('valor', $('#kdValor').val())
    form_data.append('obs', $('#kdObs').val())
    $.ajax({
      url: 'index.php?nt=set_kardex_EDIT',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        if (php_response.status == "SUCCESS") {
          location.reload();
        }else {
          bootbox.alert(php_response.err_mns);
        }
      },
      error: function(){
        bootbox.alert("Error en la comunicación con el servidor");
      }
    })
  })
  $('#btn_kdDel').on('click',function(){
    let estado = $('#kdEstado').data('id');
    if (estado == 'ACT') {
      bootbox.confirm({
        size: "small",
        message: "Esta seguro de Inactivar este proceso?",
        buttons: {
          confirm: { label: 'Si', className: 'btn-success' },
          cancel: { label: 'No', className: 'btn-danger' }
        },
        callback: function (result) {
          if (result) {
            let form_data = new FormData();
            form_data.append('radicado', $('#kdRadicado').val())
            $.ajax({
              url: 'index.php?nt=set_kardex_INC',
              dataType: "json",
              cache: false,
              processData: false,
              contentType: false,
              data: form_data,
              type: 'POST',
              success: function(php_response){
                if (php_response.status == "SUCCESS") {
                  location.reload();
                }else {
                  bootbox.alert(php_response.err_mns);
                }
              },
              error: function(){
                bootbox.alert("Error en la comunicación con el servidor");
              }
            })
          }
        }
      });
    }else{
      bootbox.alert('El proceso se encuentra inactivo, no es posible editarlo.');
    }
  })
  $('#new_kdActuaciones').on('click',function(){
    let estado = $('#kdEstado').data('id');
    if (estado == 'ACT') {
      $('#md_kdActuaciones').modal('show');
    }else{
      bootbox.alert('El proceso se encuentra inactivo, no es posible editarlo.');
    }
  })
  $('#btn_actSave').on('click',function(){
    if (valid_select('#new_actActividad') && valid_input('#new_actObs') && valid_input('#new_actFecha')) {
      $('.loader').removeClass('d-none');
      let form_data = new FormData();
      form_data.append('radicado', $('#kdRadicado').val())
      form_data.append('fk_tActividades', $('#new_actActividad').val())
      form_data.append('obs', $('#new_actObs').val())
      form_data.append('fecha', $('#new_actFecha').val())
      $.ajax({
        url: 'index.php?nt=set_actuaciones_NEW',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            location.reload();
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert("Todos los campos son obligatorios.")
    }
  })
  $('#btn_ActEdit').on('click',function(){
    let estado = $('#kdEstado').data('id');
    if (estado == 'ACT') {
      $(this).addClass('d-none');
      $('.num').addClass('d-none');
      $('#btn_ActDel').removeClass('d-none');
      $('#btn_ActUndo').removeClass('d-none');
      $('.form-check').removeClass('d-none');
    }else{
      bootbox.alert('El proceso se encuentra inactivo, no es posible editarlo.');
    }
  })
  $('#btn_ActUndo').on('click',function(){
    $('#btn_ActEdit').removeClass('d-none');
    $('.num').removeClass('d-none');
    $('#btn_ActDel').addClass('d-none');
    $('#btn_ActUndo').addClass('d-none');
    $('.form-check').addClass('d-none');
  })
  $('#btn_ActDel').on('click',function(){
    if (valid_radio('input:radio[name=ActId]:checked')) {
      bootbox.confirm({
        size: "small",
        message: "Esta seguro de eliminar esta actuación Administrativa?",
        buttons: {
          confirm: { label: 'Si', className: 'btn-success' },
          cancel: { label: 'No', className: 'btn-danger' }
        },
        callback: function (result) {
          if (result) {
            let form_data = new FormData();
            form_data.append('id', $('input:radio[name=actId]:checked').val())
            $.ajax({
              url: 'index.php?nt=set_actuaciones_INC',
              dataType: "json",
              cache: false,
              processData: false,
              contentType: false,
              data: form_data,
              type: 'POST',
              success: function(php_response){
                if (php_response.status == "SUCCESS") {
                  location.reload();
                }else {
                  bootbox.alert(php_response.err_mns);
                }
              },
              error: function(){
                bootbox.alert("Error en la comunicación con el servidor");
              }
            })
          }
        }
      });
    }else{
      bootbox.alert("Debe seleccionar un registro para editar.")
    }
  })
  $('#new_kdEmbargos').on('click',function(){
    let estado = $('#kdEstado').data('id');
    if (estado == 'ACT') {
      $('#md_kdEmbargos').modal('show');
    }else{
      bootbox.alert('El proceso se encuentra inactivo, no es posible editarlo.');
    }
  })
  $('#btn_embSave').on('click',function(){
    if (valid_select('#new_embObjeto') && valid_input('#new_embIdent') && valid_input('#new_embFecha')) {
      $('.loader').removeClass('d-none');
      let form_data = new FormData();
      form_data.append('radicado', $('#kdRadicado').val())
      form_data.append('fk_tObjetos', $('#new_embObjeto').val())
      form_data.append('identificador', $('#new_embIdent').val())
      form_data.append('fecha', $('#new_embFecha').val())
      $.ajax({
        url: 'index.php?nt=set_embargos_NEW',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            location.reload();
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert("Todos los campos son obligatorios.")
    }
  })
  $('#btn_embEdit').on('click',function(){
    let estado = $('#kdEstado').data('id');
    if (estado == 'ACT') {
      $(this).addClass('d-none');
      $('.num').addClass('d-none');
      $('#btn_embDel').removeClass('d-none');
      $('#btn_embUndo').removeClass('d-none');
      $('#btn_embPos').removeClass('d-none');
      $('#btn_embNeg').removeClass('d-none');
      $('#btn_embDes').removeClass('d-none');
      $('.form-check').removeClass('d-none');
    }else{
      bootbox.alert('El proceso se encuentra inactivo, no es posible editarlo.');
    }
  })
  $('#btn_embUndo').on('click',function(){
    $(this).addClass('d-none');
    $('.num').removeClass('d-none');
    $('#btn_embDel').addClass('d-none');
    $('#btn_embEdit').removeClass('d-none');
    $('#btn_embPos').addClass('d-none');
    $('#btn_embNeg').addClass('d-none');
    $('#btn_embDes').addClass('d-none');
    $('.form-check').addClass('d-none');
  })
  $('#btn_embDel').on('click',function(){
    if (valid_radio('input:radio[name=embId]:checked')) {
      bootbox.confirm({
        size: "small",
        message: "Esta seguro de eliminar esta Medida Cautelar?",
        buttons: {
          confirm: { label: 'Si', className: 'btn-success' },
          cancel: { label: 'No', className: 'btn-danger' }
        },
        callback: function (result) {
          if (result) {
            let form_data = new FormData();
            form_data.append('id', $('input:radio[name=embId]:checked').val())
            $.ajax({
              url: 'index.php?nt=set_embargos_INC',
              dataType: "json",
              cache: false,
              processData: false,
              contentType: false,
              data: form_data,
              type: 'POST',
              success: function(php_response){
                if (php_response.status == "SUCCESS") {
                  location.reload();
                }else {
                  bootbox.alert(php_response.err_mns);
                }
              },
              error: function(){
                bootbox.alert("Error en la comunicación con el servidor");
              }
            })
          }
        }
      });
    }else{
      bootbox.alert("Debe seleccionar un registro para editar.")
    }
  })
  $('#btn_embPos').on('click',function(){
    if (valid_radio('input:radio[name=embId]:checked')) {
      let form_data = new FormData();
      form_data.append('id', $('input:radio[name=embId]:checked').val())
      form_data.append('value', '1')
      $.ajax({
        url: 'index.php?nt=set_embargos_STATUS',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            location.reload();
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert("Debe seleccionar un registro para editar.")
    }
  })
  $('#btn_embNeg').on('click',function(){
    if (valid_radio('input:radio[name=embId]:checked')) {
      let form_data = new FormData();
      form_data.append('id', $('input:radio[name=embId]:checked').val())
      form_data.append('value', '2')
      $.ajax({
        url: 'index.php?nt=set_embargos_STATUS',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            location.reload();
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert("Debe seleccionar un registro para editar.")
    }
  })
  $('#btn_embDes').on('click',function(){
    if (valid_radio('input:radio[name=embId]:checked')) {
      let form_data = new FormData();
      form_data.append('id', $('input:radio[name=embId]:checked').val())
      form_data.append('value', '3')
      $.ajax({
        url: 'index.php?nt=set_embargos_STATUS',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            location.reload();
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert("Debe seleccionar un registro para editar.")
    }
  })
  $('#btn_ddepTercero').on('click',function(){
    if (valid_input('#new_ddepTercero')) {
      let form_data = new FormData();
      form_data.append('id', $('#new_ddepTercero').val())
      $.ajax({
        url: 'index.php?nt=get_terceros_ID',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            $('#new_ddepNombre').html(php_response.tercero)
          }else if(php_response.status == "NOEXIST") {
            bootbox.confirm({
              size: "small",
              message: php_response.err_mns,
              buttons: {
                confirm: { label: 'Si', className: 'btn-success' },
                cancel: { label: 'No', className: 'btn-danger' }
              },
              callback: function (result) {
                if (result) {
                  bootbox.prompt("Ingrese el Nombre del Tercero", function(result){
                    if(result != null){
                      let form_data = new FormData();
                      form_data.append('id', $('#new_ddepTercero').val())
                      form_data.append('nombre', result)
                      $.ajax({
                        url: 'index.php?nt=set_terceros_NEW',
                        dataType: "json",
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: form_data,
                        type: 'POST',
                        success: function(php_response){
                          if (php_response.status == "SUCCESS") {
                            $('#new_ddepNombre').html(php_response.tercero)
                          }else{
                            bootbox.alert(php_response.err_mns)
                          }
                        },
                        error: function(){
                          bootbox.alert("Error en la comunicación con el servidor");
                        }
                      })
                    }
                  });
                }
              }
            });
          }else{
            bootbox.alert(php_response.err_mns)
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert("Debe ingresar un numero de identificación")
    }
  })
  $('#btn_ddepNEW').on('click',function(){
    if (valid_input('#new_ddepNum') && valid_input('#new_ddepFecha') && valid_input('#new_ddepTercero') && valid_input('#new_ddepObs')) {
      let form_data = new FormData();
      form_data.append('num_ddep', $('#new_ddepNum').val())
      form_data.append('fecha_ddep', $('#new_ddepFecha').val())
      form_data.append('fk_mTerceros', $('#new_ddepTercero').val())
      form_data.append('direccion', $('#new_ddepDir').val())
      form_data.append('obs', $('#new_ddepObs').val())
      form_data.append('ciudad', $('#new_ddepMun').val())
      $.ajax({
        url: 'index.php?nt=set_DdeP_NEW',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            location.href ="?nt=ddep_det&id=" + php_response.ddep;
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert('Los campos marcados con * son obligatorios!')
    }
  })
  $('#btn_res_edit').on('click',function(){
    $(this).addClass('d-none');
    $('#btn_res_undo').removeClass('d-none');
    $('#btn_res_save').removeClass('d-none');
    $('#ddep_res_reso').removeAttr('readonly');
    $('#ddep_res_fecha').removeAttr('readonly');
    $('#ddep_noti').removeAttr('readonly');
    $('#ddep_noti_fecha').removeAttr('readonly');
  })
  $('#btn_res_undo').on('click',function(){
    $(this).addClass('d-none');
    $('#btn_res_edit').removeClass('d-none');
    $('#btn_res_save').addClass('d-none');
    $('#ddep_res_reso').prop('readonly', 'true');
    $('#ddep_res_fecha').prop('readonly', 'true');
    $('#ddep_noti').prop('readonly', 'true');
    $('#ddep_noti_fecha').prop('readonly', 'true');
  })
  $('#new_res_ddep').on('click',function(){
    let form_data = new FormData();
    form_data.append('id', $('#ddep_num').data('id'))
    $.ajax({
      url: 'index.php?nt=set_respuesta_NEW',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        if (php_response.status == "SUCCESS") {
          location.reload();
        }else {
          bootbox.alert(php_response.err_mns);
        }
      },
      error: function(){
        bootbox.alert("Error en la comunicación con el servidor");
      }
    })
  })
  $('#btn_res_save').on('click',function(){
    let form_data = new FormData();
    form_data.append('fk_mDdep', $('#ddep_num').data('id'))
    form_data.append('reso_res', $('#ddep_res_reso').val())
    form_data.append('fecha_res', $('#ddep_res_fecha').val())
    form_data.append('notificacion', $('#ddep_noti').val())
    form_data.append('fecha_noti', $('#ddep_noti_fecha').val())
    $.ajax({
      url: 'index.php?nt=set_respuesta_EDIT',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        if (php_response.status == "SUCCESS") {
          location.reload();
        }else {
          bootbox.alert(php_response.err_mns);
        }
      },
      error: function(){
        bootbox.alert("Error en la comunicación con el servidor");
      }
    })
  })
  $('#ddep_pres_filed').on('change',function(){
    if (valid_input('#ddep_pres_file')) {
      let file2 = $('#ddep_pres_file');   //Ya que utilizas jquery aprovechalo...
      let archivo = file2[0].files;
      console.log(archivo)
      let form_data = new FormData($('#frm_vigencias')[0]);
      form_data.append('fk_mDdep', $('#ddep_num').data('id'))
      $.ajax({
        url: 'index.php?nt=prueba',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            location.reload();
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert('No ha seleccionado ningun archivo.')
    }
  })





  $('input:radio[name=options]').on('change',function(){
    let pres = $('input:radio[name=options]:checked').val();
    if (pres == 'true') {
      alert("SI")
      console.log(pres)
    }else{
      alert("NO")

    }
  })

})
function valid_input(nodo){
  let valid = $(nodo).val() == "" ? false : true;
  return valid;
}
function valid_select(nodo){
  let valid = $(nodo).val() == null ? false : true;
  return valid;
}
function valid_radio(nodo){
  let valid = $(nodo).val() == undefined ? false : true;
  return valid;
}
