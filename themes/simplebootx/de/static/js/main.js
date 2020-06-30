$(function(){
  initializePage();
  $('.carousel').bind('move', function(event){
    if(Math.abs(event.deltaX)<10){
      return;
    }
    if(event.deltaX>0){
      $(this).carousel('prev');
    }
    if(event.deltaX<0){
      $(this).carousel('next');
    }
  });

  $('.cbox').click(function(event) {
    $(this).toggleClass('on');
    return false;
  });
  $('.numb a').click(function(event) {
    $('.numb a').removeClass('on');
    $(this).addClass('on');
    return false;
  });
  $('.ui-openlist table tr').mouseenter(function(event) {
    $('.ui-openlist table tr').removeClass('on');
    $(this).addClass('on');
  });
  $('.ui-select >.hd .tb a').click(function(event) {
    $('.ui-select >.hd .tb a').removeClass('on');
    $(this).addClass('on');
    return false;
  });
  $('.rbox').click(function(event) {
    $(this).parents('table').find('.rbox').removeClass('on');
    $(this).addClass('on');
    return false;
  });
  
});

/*---------------method---------------*/
//