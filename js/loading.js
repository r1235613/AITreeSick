$(window).load(function() { // 確認整個頁面讀取完畢再將這三個div隱藏起來
    //$("#status").hide();
    //$("#status").fadeIn(1000);
    //$("#status").delay(2500).fadeOut(2000);
    //$("#preloader").delay(4000).fadeOut(3000);

    $("#status").hide();
    $("#status").fadeIn(0);
    $("#status").fadeOut(0);
    $("#preloader").fadeOut(0);
})