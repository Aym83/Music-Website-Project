<!DOCTYPE html>

<?php
/* If all the fields are filled */
if (isset($_POST["username"]) && !empty($_POST["username"]) 
        && !empty($_POST["email"]) && !empty($_POST["country"]) 
        && !empty($_POST["zip"]) && !empty($_POST["genre"]) 
        && !empty($_POST["instru"]) && !empty($_POST["password"])) {
    /* Link between the fields and the database */
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);
    $country = htmlspecialchars($_POST["country"]);
    $zip = htmlspecialchars($_POST["zip"]);
    $genre = htmlspecialchars($_POST["genre"]);
    $instru = htmlspecialchars($_POST["instru"]);
    $file = 'json/test.json';
    $mainJson = json_decode(file_get_contents($file));
    if (array_key_exists($username, $mainJson)) {
        $message = "Utilisateur déjà existant";
    } else {
        $userJson = json_decode("{}");
        $userJson->{"password"} = $password;
        $userJson->{"email"} = $email;
        $userJson->{"country"} = $country;
        $userJson->{"zip"} = $zip;
        $userJson->{"genre"} = $genre;
        $userJson->{"instru"} = $instru;
        $mainJson->{$username} = $userJson;
        file_put_contents($file, json_encode($mainJson));
        session_start();
        $_SESSION["username"] = $username;
        header('Location: redirect.php');
    }
}
?>

<html>
    <head>
        <title>Music for Life - Enregistrement</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script src="js/script.js"></script>
    </head>

    <body>
        <!-- Load header -->
<?php
include("header.php");
?>
        <div id="grid" class="padding border border-dark">
            <form name="signup-form">

                <!-- Bouton permettant de chercher une photo dans ses dossiers -->
                <h3>Photo </h3>
                <input type="file" name="avatar">

                <h3>Pseudo: </h3>
                <input type="text" name="pseudo" placeholder="LPDrummer"><br>

                <h3>Mot de passe:</h3>
                <input type="password" name="password"><br>

                <h3>Mail: </h3>
                <input type="text" name="email" placeholder="cooperdrummer@music.com"><br>

                <h3>Pays: </h3>
                <input type="radio" name="country" value="FR">France<br>
                <input type="radio" name="country" value="US">USA<br>
                <input type="radio" name="country" value="CA">Canada<br>
                <input type="radio" name="country" value="Other">Autre<br>

                <h3>Code postal: </h3>
                <input type="text" name="zip" placeholder="83000"><br>

                <h3>Genre préféré: </h3>
                <div><input type="radio" name="music_genre" value="classic">Classique, Jazz<br>
                    <input type="radio" name="music_genre" value="electro">Electro, pop, dance<br>
                    <input type="radio" name="music_genre" value="RAP">Hip-Hop, RAP, RnB, Soul<br>
                    <input type="radio" name="music_genre" value="rock">Rock, Metal<br>
                    <input type="radio" name="music_genre" value="reggae">Reggae<br>
                    <input type="radio" name="music_genre" value="other">Autre</div>                

                <h3>Instrument principal joué: </h3>
                <div><input type="radio" name="played_instru" value="drums">Instruments à percussion<br>
                    <input type="radio" name="played_instru" value="guitars">Instruments à corde<br>
                    <input type="radio" name="played_instru" value="wind_instruments">Instruments à vent<br>
                    <input type="radio" name="played_instru" value="piano">Piano<br>
                    <input type="radio" name="played_instru" value="other">Autres</div>
                <br>

                <button type="button" onclick="post()">S'enregistrer</button>
                <input type="reset" value="Reset">
            </form>

        </div>

        <script>
            function post() {
                if (!createProfile()) {
                    return;
                }
                var form = document.forms["signup-form"];
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        document.documentElement.innerHTML = this.responseText;
                    }
                };
                xhttp.open("POST", "signup.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("username=" + form["pseudo"].value
                        + "&email=" + form["email"].value
                        + "&country=" + form["country"].value
                        + "&zip=" + form["zip"].value
                        + "&genre=" + form["music_genre"].value
                        + "&instru=" + form["played_instru"].value
                        + "&password=" + form["password"].value);
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>