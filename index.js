$(window).on('load', function() {

    $("#next").on("click", function () {
        console.log('test');
        $.ajax({
            url:"index.php",    //the page containing php script
            type: "post",    //request type,
            dataType: 'json',
            data: {function: "next"},
            success:function(result){
                console.log(result);
            }
        });
    });

    var fail = 0;

    $('.choice').on('click', function(){
        $(this).parent().find('.choice').removeClass('selected');
        
        var obj = $(this);
        var song = $(this).text();
        $.ajax({
            type: "POST",
            url: 'functions.php',
            data: {song: song},
            success: function(data){
                console.log(data);
                if(data == "false"){
                    $(obj).addClass('wrong');
                    fail++;
                    console.log(fail);
                } else {
                    $(obj).addClass('selected');
                }
            },
            error: function(xhr, status, error){
            console.error(xhr);
            }
        });
    });

    // var myAudio = new Audio();
    // myAudio.play();
});