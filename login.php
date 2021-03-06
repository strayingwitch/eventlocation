<?php
session_start();
$_SESSION['status'] = "You are logged in!";
// Session starten bei Login

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Crystal Lake Events. Concerts, Festivals, Weddings and other Events. Book now!">

    <!-- Favicons -->

    <link rel="apple-touch-icon" sizes="57x57" href="images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="images/favicons//android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicons/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Materialize CSS Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Other Stylesheets -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@800&family=Poppins&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <!-- Title -->
    <title>Crystal Lake Events Login</title>

</head>

<body>

    <!-- Navbar -->

    <?php include "includes/navbar.html"?>


    <!-- Registration -->

    <?php

    //DB Verbindung
    include_once('includes/config.inc.php');
    
    // Variablen erstellen
    $errorMessage = "";
    $go = true;

    // Funktion um alle Sonderzeichen, Leerschläge und Tags entfernen
    function killGerms($str){
        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str); 
        return $str;
    }

    // Funktion um Länge der Eingabe zu validieren
    function stringLaenge ($str, $feld, $min, $max) {
        global $errorMessage;
        global $go;

        // Anzahl der Zeichen checken
        $laengeZeichen = strlen($str);
        if ( $laengeZeichen < $min ) {
            $errorMessage .= "Input in ".$feld." too short! Must at least be ".$min." characters.<br>";
            $go = false;
        } elseif ( $laengeZeichen > $max ) {
            $errorMessage .= "Input in ".$feld." too long! Must be maximum ".$max." characters.<br>";
            $go = false;
        } elseif ( empty($_POST['agb']) ) {
            // AGB Checkbox wurde nicht angeklickt
            $errorMessage .= "You did not accept the terms and conditions.<br>";
            $go = false;
        } elseif ( empty($_POST['email']) ) {
            // Email wurde nicht eingegeben
            $errorMessage .= "You did not enter an email address.<br>";
            $go = false;
        }
    }


    // Wurde Submit Button gedrückt?
    if ( isset($_POST['submit']) ) {

        // "Desinfektion" der Eingaben
        $usernameValue = killGerms($_POST['username'], FILTER_SANITIZE_STRING);
        $emailValue = killGerms($_POST['email'], FILTER_SANITIZE_EMAIL);
        $passwordValue = killGerms($_POST['password'], FILTER_SANITIZE_STRING);
        

        // Länge der Eingabe validieren
        stringLaenge($usernameValue, "Username", 2, 50);
        stringLaenge($passwordValue, "Password", 2, 50);


        // Passwort verschlüsseln
        $hashPass = password_hash($passwordValue, PASSWORD_DEFAULT);

        // Variable für Geschlecht
        $gender = $_POST['group3'];
        // var_dump($gender);

       
        // Sind die Eingaben richtig?
        if ( $go && isset($_POST['agb']) ) {
            // Eingabe richtig!

            // In DB speichern
            $sql = "INSERT INTO `users` (`gender`, `user`, `mail`, `password`) VALUES ('$gender', '$usernameValue', '$emailValue', '$hashPass')";
            $result = mysqli_query($conn, $sql);

            // Registration wurde gemacht!
            echo "<div class=\"new\">";
            echo "New registration is done!";
            echo "</div>\n";
        } 
        else {
            // Angaben falsch
            echo "<div class=\"redError\">";
            echo $errorMessage;
            echo "</div>\n";
        }

    }
    
    else {
        // Falls noch nichts eingegeben wurde, alles auf leer setzen
        $usernameValue = "";
        $emailValue = "";
        $passwordValue = "";
    }

    ?>

    <section id="loginSection">

            <!-- Registration -->

                <form action="login.php" id="registerForm" method="POST" class="logForm">

                        <h2>Register</h2>
                        <p class="regInfo">and get discounts and goodies for upcoming events!</p>

                            <!-- Radiobuttons -->
                            <div class="radiobtn">
                                
                            <!-- Radiobutton Female -->
                                <p>
                                    <label>
                                    <input class="with-gap" name="group3" value="female" type="radio" checked />
                                    <span>Female</span>
                                    </label>
                                </p>

                            <!-- Radiobutton Male -->
                                <p>
                                    <label>
                                    <input class="with-gap" name="group3" value="male" type="radio" />
                                    <span>Male</span>
                                    </label>
                                </p>

                            <!-- Radiobutton Other -->
                                <p>
                                    <label>
                                    <input class="with-gap" name="group3" value="other" type="radio" />
                                    <span>Other</span>
                                    </label>
                                </p>

                            </div>

                            <!-- Eingabefelder -->
                            <label for="username">Username<input type="text" name="username" value="<?=$usernameValue?>"></label>

                            <label for="email">E-Mail<input type="email" name="email" value="<?=$emailValue?>"></label>

                            <label for="password">Password<input type="password" name="password" value="<?=$passwordValue?>"></label>

                            <!-- Terms and Conditions -->
                            <p>
                                <label>
                                    <input type="checkbox" class="filled" name="agb" />
                                    <span>Accept terms and conditions</span>
                                </label>
                            </p>

                            <!-- Submit -->
                            <input type="submit" class="subBtn" name="submit" value="Register"></input>

                            <!-- Change to Login Form or Register Form -->
                            <p class="logMessage">Already registered? <a class="toggleBtn">Sign in</a></p>

                    </form>

    <!-- Login -->
    
    <?php

    // Notices ausschalten
    error_reporting(E_ALL ^  E_NOTICE);

    // Wurde Login Button gedrückt?
    if ( isset($_POST['login']) ) {

        // "Desinfektion" der Eingaben
        $user = killGerms($_POST['userName'], FILTER_SANITIZE_STRING);
        $pass = killGerms($_POST['pass'], FILTER_SANITIZE_STRING);

        // Ist Username vorhanden in DB?
        $sql = "SELECT * FROM users WHERE user = '$user' ";
        $rs = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($rs);
        // var_dump($numRows);

        // Ist Passwort korrekt?
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($rs);
            // var_dump($row['password']);
            if (password_verify($pass, $row['password'])) {
                // Eingabe richtig!

                 // prepared-statement erstellen
                 // user input mit datenbank infos vergleichen
                $query = "SELECT * FROM `users` WHERE `user`=? and `password`=?";
                // Statement bereitet die verbindung mit query und DB vor
                $statement = mysqli_prepare($conn, $query);
                // Bind Parameter bindet Statement
                mysqli_stmt_bind_param($statement, 'ss', $user, $pass);
                // execute führt das statement aus
                mysqli_stmt_execute($statement);
                $resultat = mysqli_stmt_get_result($statement);
                
                // Admin oder User?
                if($row['user'] == 'admin') {
                    // Falls es Admin ist, dann weiterleiten auf Dashboard
                    header('Location: dashboard.php');
                } else {
                    // Falls es ein User ist, dann weiterleiten auf Login
                    header('Location: login.php');
                }
               
            }
            else {
            // Falsches Passwort
            echo "<div class=\"redError\">";
            echo "Wrong password!";
            echo "</div>\n";
            }
        } 
        else {
            // Kein User gefunden
            echo "<div class=\"redError\">";
            echo "No user found!";
            echo "</div>\n";
        }
    } else {
        // Falls noch nichts eingegeben wurde, alles auf leer setzen
        $user = "";
        $pass = "";
    }


    ?>

            <!-- Login Form -->

                <form action="login.php" class="logForm" method="POST">

                        <h2>Login</h2>
                        <p class="regInfo">and continue exploring</p>

                        <label for="userName">Username<input type="text" name="userName" value="<?=$user?>"></label>

                        <label for="pass">Password<input type="password" name="pass" value="<?=$pass?>"></label>
                        
                        <input type="submit" class="subBtn" name="login" value="Log me in"></input>
                        
                        <p class="logMessage">Not registered yet? <a class="toggleBtn">Register here</a></p>

                 </form>

    </section>            



    <!-- Footer -->

    <?php include "includes/footer.html"?>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- JS Scripts -->
    <script src="js/code.js"></script>
 
    
</body>
</html>