$(document).ready(function(){
  $('#btn-search-kardex').on('click',function(){
    if (valid_input('#txt-search-kardex')) {
      let radicado = $('#txt-search-kardex').val()
      let form_data = new FormData();
      form_data.append('radicado', radicado)
      $.ajax({
        url: 'index.php?nt=get_kardex_COUNT',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            url = '?nt=kardex_det&radicado=' + radicado
            location.href = url
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert('Debe indicar un radicado valido.')
    }
  })
  $('#btn-search-ddep').on('click',function(){
    if (valid_input('#txt-search-ddep')) {
      let ddep = $('#txt-search-ddep').val()
      let form_data = new FormData();
      form_data.append('ddep', ddep)
      $.ajax({
        url: 'index.php?nt=get_ddep_COUNT',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: function(php_response){
          if (php_response.status == "SUCCESS") {
            url = '?nt=ddep_det&id=' + php_response.ddep
            location.href = url
          }else {
            bootbox.alert(php_response.err_mns);
          }
        },
        error: function(){
          bootbox.alert("Error en la comunicación con el servidor");
        }
      })
    }else{
      bootbox.alert('Debe indicar un radicado valido.')
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
