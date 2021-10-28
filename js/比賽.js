$(function(){   /* GO TO TOP */
    var $win=$(window);
    var $backToTop=$('.js-back-to-top');
    var $item=$('.item');

    $win.scroll(function(){
      if($win.scrollTop()>100){
        $backToTop.show();
      }else{
        $backToTop.hide();
      }
    });

    /*$win.scroll(function(){
      if($win.scrollTop()>150){
        $item.show(1000);
      }
      else{
        $item.hide();
      }
    });*/
 
    $backToTop.click(function(){
      $('html,body').animate({scrollTop:0},200);
    });
  })