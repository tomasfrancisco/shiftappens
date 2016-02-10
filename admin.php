<?php
session_start();

if(!isset($_SESSION['logged'])) {
    if(isset($_POST['password'])) {
        if(strcmp($_POST['password'], 'bubadeira') == 0) {
            $_SESSION['logged'] = 'true';
            header("Refresh:0");
        }
    } else {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>ShiftAdmin</title>
            <link rel="stylesheet" type="text/css" href="assets/css/admin.css"/>
        </head>
        <body>
            <form action="admin.php" method="POST" accept-charset="utf-8">
                <input type="password" name="password" />
                <input type="submit" value="Entrar"/>
            </form>
        </body>
        </html>
        <?php
    }
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ShiftAdmin</title>
    </head>
    <body>
        
    </body>
    </html>
    <?php
}

?>