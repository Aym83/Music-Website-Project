<!DOCTYPE html>

<?php
session_start();
if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $file = 'json/test.json';
    $mainJson = json_decode(file_get_contents($file));
    if (array_key_exists($username, $mainJson)) {
        if ($mainJson->{$username}->{"password"} == $password) {
            $bool = TRUE;
            $_SESSION["username"] = $username;
            header('Location: redirect.php');
        } else {
            $message = "<b>Mot de passe invalide</b><br>";
            $bool = FALSE;
        }
    } else {
        $message = "<b>Utilisateur inexistant</b><br>";
        $bool = FALSE;
    }
}
?>

<html>
    <head>
        <title>Music for Life - Connexion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <!-- Load header -->
        <?php
        include("header.php")
        ?>
        <div id="grid" class="padding border border-dark">
            <form name="connection-form">
                Pseudo: <input type="text" name="pseudo" autofocus required>
                <br>
                Mot de passe: <input type="password" name="password" required>
                <br>
                <button type="button" onclick="post()">Se connecter</button>
            </form>

            <?php
            if (isset($message)) {
                if (!$bool) {
                    echo '<font color="red">' . $message . '</font>';
                } else {
                    echo $message;
                }
            }
            ?>

        </div>

        <script>
            function post() {
                var form = document.forms["connection-form"];
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        document.documentElement.innerHTML = this.responseText;
                    }
                };
                xhttp.open("POST", "signin.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("username=" + form["pseudo"].value
                        + "&password=" + form["password"].value);
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>