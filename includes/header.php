<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A Radiohead fan website with albums, vinyls and band history">
        <meta name="keywords" content="Radiohead, Thom Yorke, Vinyl, Albums, Music">
        <title><?php echo isset($pageTitle) ? $pageTitle : "Radiohead Archive"; ?></title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <header>
            <nav>
                <a href="index.php"><h1>RADIOHEAD</h1></a>
                <ul id="nav-bar-elements">
                    <li class="nav-bar-element"><a href="index.php">Home</a></li>
                    <li class="nav-bar-element"><a href="discography.php">Discography</a></li>
                    <li class="nav-bar-element"><a href="band.php">Band</a></li>
                    <li class="nav-bar-element"><a href="order.php">Order Vinyl</a></li>
                    <?php
                    if(isset($_SESSION['role']))
                    {
                        if($_SESSION['role'] == 'admin')
                        {
                            echo '<li class="nav-bar-element"><a href="dashboard.php">Dashboard</a></li>';
                        } 
                        echo '<li class="nav-bar-element"><a href="logout.php">Logout</a></li>';
                    }
                    else
                    {
                        echo '<li class="nav-bar-element"><a href="auth.php">Login/Register</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </header>