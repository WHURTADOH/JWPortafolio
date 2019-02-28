$(document).ready(function(){
  $('#openInfSobres').on('click',function(){
    if (valid_input('#sobresNumDdep')) {
      let ddep = $('#sobresNumDdep').val();
      URL = '?nt=load_sobres&ddep=' + ddep;
      window.open(URL, 'Sobres', 'width=700,height=500');
    }else{
      bootbox.alert('Debe indicar el Radicado del derecho de petición')
    }
  })
  $('#openInfCitacion').on('click',function(){
    if (valid_input('#citacionNumDdep')) {
      let ddep = $('#citacionNumDdep').val();
      URL = '?nt=load_citacion&ddep=' + ddep;
      window.open(URL, 'Citaciones', 'width=700,height=500');
    }else{
      bootbox.alert('Debe indicar el Radicado del derecho de petición')
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
