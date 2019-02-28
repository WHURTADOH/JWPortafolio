$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip()
  $('#tbl_ddep').DataTable( {
    "ajax": 'index.php?nt=get_ddep_ACT',
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    }
  });
  $('#btn_ddepTercero').on('click',function(){
    $('#loader').removeClass('d-none')
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
            $('#loader').addClass('d-none')
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
                            $('#loader').addClass('d-none')
                          }else{
                            bootbox.alert(php_response.err_mns)
                          }
                        },
                        error: function(){
                          bootbox.alert("Error en la comunicación con el servidor");
                          $('#loader').addClass('d-none')
                        }
                      })
                    }
                  });
                }
              }
            });
          }else{
            bootbox.alert(php_response.err_mns)
            $('#loader').addClass('d-none')
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
          $('loader').addClass('d-none')
        }
      })
    }else{
      bootbox.alert("Debe ingresar un numero de identificación")
      $('loader').addClass('d-none')
    }
  })
  $('#btn_ddepNEW').on('click',function(){
    $('#loader_save').removeClass('d-none')
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
            location.href ="?nt=ddep_det&id=" + php_response.ddep
          }else {
            bootbox.alert(php_response.err_mns)
            $('#loader_save').addClass('d-none')
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor")
          $('#loader_save').addClass('d-none')
        }
      })
    }else{
      bootbox.alert('Los campos marcados con * son obligatorios!')
      $('#loader_save').addClass('d-none')
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
    $('#loader_res').removeClass('d-none')
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
          $('#loader_res').addClass('d-none')
          bootbox.alert(php_response.err_mns);
        }
      },
      error: function(){
        $('#loader_res').addClass('d-none')
        bootbox.alert("Error en la comunicación con el servidor");
      }
    })
  })
  $('#btn_res_save').on('click',function(){
    $('#loader_add_res').removeClass('d-none')
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
          $('#loader_add_res').addClass('d-none')
          bootbox.alert(php_response.err_mns);
        }
      },
      error: function(){
        $('#loader_add_res').addClass('d-none')
        bootbox.alert("Error en la comunicación con el servidor");
      }
    })
  })
  $('#ddep_pres_file').on('change',function(){
    if (valid_input('#ddep_pres_file')) {
      subir_archivos('#frm_vigencias','vigencias.txt');
    }else{
      bootbox.alert('No ha seleccionado ningun archivo.')
    }
  })
  $('#ddep_res_file').on('change',function(){
    if (valid_input('#ddep_res_file')) {
      subir_archivos('#frm_respuesta','');
    }else{
      bootbox.alert('No ha seleccionado ningun archivo.')
    }
  })
  $('#btn_new_predios').on('click',function(){
    $('#d_predios').modal('show');
    let tercero = $('#ddep_tercero').val();
    let form_data = new FormData();
    form_data.append('ident', tercero)
    $.ajax({
      url: 'index.php?nt=get_predios',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        if (php_response.status == "SUCCESS") {
          let predios = php_response.predios
          $('#lst_predios').empty()
          for (var i = 0; i < predios.length; i++) {
            let id = predios[i].id
            let codigo = predios[i].codigo
            let dir = predios[i].dir
            let avaluo = predios[i].avaluo
            let label = codigo + ',' + dir + ',' + avaluo

            $('#lst_predios').append('<li class="list-group-item"><div class="form-check"><input name="predios[]" class="form-check-input predios" type="checkbox" value="' + id + '" id="predio'+ id +'"><label class="form-check-label" for="predio'+ id +'">' + label + '</label></div></li>')

          }
        }
      },
      error: function(){
        bootbox.alert("Error en la comunicación con el servidor");
      }
    })
  })
  $('#gen_predios').on('click',function(){
    let form_data = new FormData();
    form_data.append('num_ddep', $('#ddep_num').val())
    form_data.append('predios', JSON.stringify($('[name="predios[]"]').serializeArray()))
    $.ajax({
      url: 'index.php?nt=set_predios_TXT',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        if (php_response.status == "SUCCESS") {
          directorio();
          $('#d_predios').modal('hide');
        }else {
          bootbox.alert(php_response.err_mns);
        }
      },
      error: function(){
        bootbox.alert("Error en la comunicación con el servidor");
      }
    })
  })
  $('#ddep_pres_yini').on('change',function(){
    let val = $(this).val()
    prescripcion('y_ini',val);
  })
  $('#ddep_pres_yfin').on('change',function(){
    let val = $(this).val()
    prescripcion('y_fin',val);
  })
  $('#ddep_pres_vini').on('change',function(){
    let val = $(this).val()
    prescripcion('v_ini',val);
  })
  $('#ddep_pres_vfin').on('change',function(){
    let val = $(this).val()
    prescripcion('v_fin',val);
  })
  $('#ddep_pres_trim').on('change',function(){
    let val = $(this).val()
    prescripcion('trimestre',val);
  })
  $('#ddep_dir').on('dblclick',function(){ $(this).removeAttr('readonly'); }).focusout(function(){ $(this).attr('readonly','true'); }).on('change',function(){
    if (valid_input('#ddep_dir')) {
      ddep_edit('direccion',$('#ddep_dir').val())
      $(this).attr('readonly','true');
    }
  })
  $('#ddep_mun').on('dblclick',function(){ $(this).removeAttr('readonly'); }).focusout(function(){ $(this).attr('readonly','true'); }).on('change',function(){
    if (valid_input('#ddep_mun')) {
      ddep_edit('ciudad',$('#ddep_mun').val())
      $(this).attr('readonly','true');
    }
  })
  $('#ddep_nombre').on('dblclick',function(){ $(this).removeAttr('readonly'); }).focusout(function(){ $(this).attr('readonly','true'); }).on('change',function(){
    if (valid_input('#ddep_nombre')) {
      tercero_edit($('#ddep_nombre').val())
      $(this).attr('readonly','true');
    }
  })
  $('#ddep_tercero').on('dblclick',function(){ $(this).removeAttr('readonly'); }).focusout(function(){ $(this).attr('readonly','true'); }).on('change',function(){
    if (valid_input('#ddep_tercero')) {
      let form_data = new FormData();
      form_data.append('id', $('#ddep_tercero').val())
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
            ddep_edit('fk_mTerceros',$('#ddep_tercero').val())
            $('#ddep_nombre').val(php_response.tercero)
            $('#ddep_tercero').attr('readonly','true');
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
                      form_data.append('id', $('#ddep_tercero').val())
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
                            ddep_edit('fk_mTerceros',$('#ddep_tercero').val())
                            $('#ddep_nombre').val(php_response.tercero)
                            $('#ddep_tercero').attr('readonly','true');
                          }else{
                            bootbox.alert(php_response.err_mns)
                            $('#ddep_tercero').attr('readonly','true');
                          }
                        },
                        error: function(){
                          bootbox.alert("Error en la comunicación con el servidor");
                          $('#ddep_tercero').attr('readonly','true');
                        }
                      })
                    }
                  });
                }
              }
            });
          }else{
            bootbox.alert(php_response.err_mns)
            $('#ddep_tercero').attr('readonly','true');
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
          $(this).attr('readonly','true');
        }
      })
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
function subir_archivos(formulario,file_name){
  let form_data = new FormData($(formulario)[0]);
  form_data.append('fk_mDdep', $('#ddep_num').val())
  form_data.append('file', file_name)
  $.ajax({
    url: 'index.php?nt=set_DdeP_ANX',
    dataType: "json",
    cache: false,
    processData: false,
    contentType: false,
    data: form_data,
    type: 'POST',
    success: function(php_response){
      if (php_response.status == "SUCCESS") {
        bootbox.alert('El archivo se subio con exito.');
        directorio()
      }else {
        bootbox.alert(php_response.err_mns);
      }
    },
    error: function(){
      bootbox.alert("Error en la comunicación con el servidor");
    }
  })
}
function directorio(){
  $('#icn_dir').addClass('fa-spin')
  let ddep = $('#ddep_num').val();
  let form_data = new FormData();
  form_data.append('ddep', ddep)
  $.ajax({
    url: 'index.php?nt=get_directorio',
    dataType: "json",
    cache: false,
    processData: false,
    contentType: false,
    data: form_data,
    type: 'POST',
    success: function(php_response){
      if (php_response.status == "SUCCESS") {
        $('#ddep_directorio').empty();
        for (var i = 0; i < php_response.dir.length; i++) {
          let archivo = php_response.dir[i]
          let ddep = php_response.ddep
          let ruta = "views/public/" + ddep + "/" + archivo
          $('#ddep_directorio').append('<li class="list-group-item d-flex justify-content-between align-items-center"><a href="' + ruta + '" target="_blank"><i class="fas fa-arrow-circle-right"></i> ' + archivo + '</a><button data-file="' + ruta + '" type="button" class="btn btn-danger btn-sm dir_file"><i class="fas fa-trash"></i></button></li>')
        }
        $('#icn_dir').removeClass('fa-spin')
        $('.dir_file').on('click',function(){
          let url = $(this).data('file');
          let form_data = new FormData();
          form_data.append('url', url)
          $.ajax({
            url: 'index.php?nt=del_directorio',
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            data: form_data,
            type: 'POST',
            success: function(php_response){
              if (php_response.status == "SUCCESS") {
                directorio();
              }else {
                bootbox.alert(php_response.err_mns);
              }
            },
            error: function(){
              bootbox.alert("Error en la comunicación con el servidor");
            }
          })
        })
      }else{
        $('#icn_dir').removeClass('fa-spin')
      }
    },
    error: function(){
      bootbox.alert("Error en la comunicación con el servidor")
      $('#icn_dir').removeClass('fa-spin')
    }
  })
}
function prescripcion(column,value){
  let form_data = new FormData();
  form_data.append('id', $('#ddep_num').data('id'))
  form_data.append('column', column)
  form_data.append('value', value)
  $.ajax({
    url: 'index.php?nt=set_prescripcion',
    dataType: "json",
    cache: false,
    processData: false,
    contentType: false,
    data: form_data,
    type: 'POST',
    success: function(php_response){
      if (php_response.status == "ERROR") {
        bootbox.alert(php_response.err_mns);
      }
    },
    error: function(){
      bootbox.alert("Error en la comunicación con el servidor");
    }
  })
}
function ddep_edit(column,value){
  let form_data = new FormData();
  form_data.append('id', $('#ddep_num').data('id'))
  form_data.append('column', column)
  form_data.append('value', value)
  $.ajax({
    url: 'index.php?nt=set_DdeP_EDIT',
    dataType: "json",
    cache: false,
    processData: false,
    contentType: false,
    data: form_data,
    type: 'POST',
    success: function(php_response){
      if (php_response.status == "ERROR") {
        bootbox.alert(php_response.err_mns);
      }
    },
    error: function(){
      bootbox.alert("Error en la comunicación con el servidor");
    }
  })
}
function tercero_edit(nombre){
  let form_data = new FormData();
  form_data.append('id', $('#ddep_tercero').val())
  form_data.append('nombre', nombre)
  $.ajax({
    url: 'index.php?nt=set_terceros_EDIT',
    dataType: "json",
    cache: false,
    processData: false,
    contentType: false,
    data: form_data,
    type: 'POST',
    success: function(php_response){
      if (php_response.status == "ERROR") {
        bootbox.alert(php_response.err_mns);
      }
    },
    error: function(){
      bootbox.alert("Error en la comunicación con el servidor");
    }
  })
}
