<!doctype html>
<html>
    <head>
        <title>Music for Life - Mon compte</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <!-- Load header -->
        <?php
        session_start();
        include("header.php")
        ?>
        <div class="padding border border-dark">
            <?php
            $mainJson = json_decode(file_get_contents('json/test.json'));
            $userJson = $mainJson->{$_SESSION["username"]};
            echo "<b>Nom d'utilisateur:</b> " . $_SESSION["username"]
            . "<br><b>E-mail:</b> " . $userJson->{"email"}
            . "<br><b>Pays:</b> " . $userJson->{"country"}
            . "<br><b>Code postal:</b> " . $userJson->{"zip"}
            . "<br><b>Genre préféré:</b> " . $userJson->{"genre"}
            . "<br><b>Instrument joué:</b> " . $userJson->{"instru"};
            ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>