$(window).on('load', function() {

    var fail = 0;
    var win = 0;

    $('.choice').on('click', function(){
        $(this).parent().find('.choice').removeClass('selected');
        
        var obj = $(this);
        var song = $(this).text();
        $.ajax({
            type: "POST",
            url: 'src/functions.php',
            data: {song: song},
            success: function(data){
                console.log(data);
                if(data == "false"){
                    $(obj).addClass('wrong');
                    fail++;
                    $("#fails").html("Fails: " + fail);
                } else {
                    $(obj).addClass('selected');
                    audio.pause();
                    win++;
                    $("#wins").html("Wins: " + win);

                    if($("#play").hasClass("fa-pause")){
                        $("#play").removeClass("fa-pause");
                        $("#play").addClass("fa-play");
                    }
                    
                    setTimeout(function(){
                        $(obj).removeClass('selected')
                        $("#form .choice").removeClass("wrong");

                        $.ajax({
                            type: "POST",
                            url: 'src/functions.php',
                            data: {next: "next"},
                            dataType: 'json',
                            success: function(data){
                                audio = new Audio(data[3]);
                                
                                $(".choice").each(function(i=0){
                                    $(this).text(data[i]);
                                    i++;
                                });
                            },
                            error: function(xhr, status, error){
                            console.error(xhr);
                            }
                        });
                      }, 500);
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