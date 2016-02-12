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
    <?php
    $link = mysql_connect('localhost', 'shiftappens', 'ianchLansn_*a1?zJHAmaxvy');
    $db = mysql_select_db('shiftappens2016',$link);
    $emails_query = mysql_query("SELECT email FROM entries ORDER BY name;");
    while($emails_result = mysql_fetch_array($emails_query)) {
        $email = $emails_result['email'];
        $entries_query = mysql_query("SELECT * FROM entries WHERE email='{$email}';");
        $entry = mysql_fetch_array($entries_query);
        print("
        <div class=\"participant\">
            <p>{$entry['name']}</p>
        </div>
        ");
    }
    ?>
    </body>
    </html>
    <?php
}

?>