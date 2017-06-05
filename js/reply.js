//↓ ↓ ↓  JS-reply  ↓ ↓ ↓

$(function(){

  $('.form').hide();
  
  $('.showBtn').on('click', function(){
    $('.form').slideToggle(500);
  });

});