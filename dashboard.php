<?php
session_start();

if (isset($_SESSION['status']) && $_SESSION['status'] == "You are logged in!") {
    $output = "<p>Status: ".$_SESSION['status']."</p>\n";
}
else {
    // Umleitung zurück auf Login, da Session nicht gelesen werden konnte
    header ('Location: login.php');
}

//DB Verbindung
include_once('includes/config.inc.php');

// Dashboard PHP Code
include_once('includes/dashboard.inc.php');


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
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="ckeditor/ckeditor.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@800&family=Poppins&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <!-- Title -->
    <title>Crystal Lake Events DASHBOARD</title>

</head>

<body>

    <!-- Navbar -->

    <nav>
    <div class="nav-wrapper grey darken-2">
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">dehaze</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
  </ul>

<!-- Überschrift -->

<h3>Welcome back!</h3>
<p>Edit Landing Page and Contact</p>

<!-- Status of Session -->
<!-- <?=$output?> -->

<!-- CKEditors und Speichern Button -->

<section class="editText">

        <!-- Erster Abschnitt: About this location -->
        <h5>Home content</h5>
        <form action="dashboard.php" method="POST">

            <!-- Titel -->
            <label for="title">Title</label>
            <input type="text" name="title" value="<?=$title?>">
            <!-- Textfeld -->
            <textarea name="inhalt" id="inhalt"><?=$inhalt?></textarea>
            
            <!-- Submit Button -->
            <button type="submit" class="subBtn" name="save">Save Text</button>

        </form>

        <!-- Zweiter Abschnitt: Explore and enjoy -->
        <form action="dashboard.php" method="POST">

            <!-- Titel -->
            <label for="title">Title</label>
            <input type="text" name="title2" value="<?=$secondTitle?>">
            <!-- Textfeld -->
            <textarea name="inhalt2" id="inhalt2"><?=$secondInhalt?></textarea>
            
            <!-- Submit Button -->
            <button type="submit" class="subBtn" name="save2">Save Text</button>

        </form>

        <!-- Dritter Abschnitt: Contact Text bearbeiten -->
        <h5>Contact content</h5>
        <form action="dashboard.php" method="POST">

            <!-- Titel -->
            <label for="title">Title</label>
            <input type="text" name="title3" value="<?=$thirdTitle?>">
            <!-- Textfeld -->
            <textarea name="inhalt3" id="inhalt3"><?=$thirdInhalt?></textarea>
            
            <!-- Submit Button -->
            <button type="submit" class="subBtn" name="save3">Save Text</button>

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
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script type="text/javascript">

        // CKEditor einfügen anstelle der Textareas
        CKEDITOR.replace( 'inhalt');
        CKEDITOR.replace( 'inhalt2');
        CKEDITOR.replace( 'inhalt3');

    </script>

</body>
</html>