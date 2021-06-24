<?php include 'src/app.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    
    <div id="container">
        <div id="wins" class="score">Wins: 0</div>
        <div id="fails" class="score">Fails: 0</div>
        <h1>Spotify Song guesser</h1>
        <i id="play" class="fas fa-play"></i>
        <div id="form">
            <p>Which is the name of the song?</p>
            <div class="choice"><?= $answers[0]; ?></div>
            <div class="choice"><?= $answers[1]; ?></div>
            <div class="choice"><?= $answers[2]; ?></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script>
        var audio = new Audio("<?= $tracksPreview[$_SESSION['awnser_num']]->preview_url ?>");
        $('#play').click(function() {
            if($(this).hasClass("fa-play")){
                audio.play();
                $(this).removeClass("fa-play");
                $(this).addClass("fa-pause");
            } else {
                audio.pause();
                $(this).removeClass("fa-pause");
                $(this).addClass("fa-play");
            }
        });
    </script>
</body>
</html>