<!DOCTYPE html>
<html>
    <head>
        <!-- Poppins Google font -->
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark sticky-top text-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Music for Life</a>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <?php
                    if (!isset($_SESSION["username"])) {
                        echo "<li class=\"nav-item\">"
                        . "<a class=\"nav-link\" href=\"signup.php\">S'enregistrer</a>"
                        . "</li>"
                        . "<li class=\"nav-item\">"
                        . "<a class=\"nav-link\" href=\"signin.php\">Se connecter</a>"
                        . "</li>";
                    } else {
                        echo "<li class=\"nav-item\">"
                        . "<a class=\"nav-link\" href=\"logout.php\">Se déconnecter</a>"
                        . "</li>"
                        . "<li class=\"nav-item\">"
                        . "<a class=\"nav-link\" href=\"account.php\">Mon compte</a>"
                        . "</li>";
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </body>
</html>
