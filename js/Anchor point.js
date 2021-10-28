$(function(){
    $('.scroll').on('click',function(){//繫結點選事件
        let tops = $(this).attr('href');//獲取物件
        $('html,body').animate({scrollTop:tops.offset().top},800);//動畫出爐
    })
})