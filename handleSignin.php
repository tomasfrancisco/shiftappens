<?php

require_once("class.phpmailer.php");
require_once("class.smtp.php");

if (count($_POST)==0) {
    header("location:index.html");
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>Shift APPens</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="assets/img/favicon.ico"/>

        <link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font.css"/>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <meta property="og:url" content="http://shiftappens.com/">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Shift APPens" />
        <meta property="og:site_name" content="Shift APPens"/>
        <meta property="og:description" content="Shift APPens | O hackathon mais louco do país!" />
        <meta property="og:locale" content="pt_PT" />
        <meta property="og:image" content="http://shiftappens.com/assets/img/logo-mobile.png" />
    </head>
    <body>

<?php

$link = mysql_connect('localhost', 'shiftappens', 'ianchLansn_*a1?zJHAmaxvy');

if($link) {
    $db = mysql_select_db('shiftappens2016', $link);

    $name = mysql_real_escape_string(htmlentities($_POST['name']));
    $email = mysql_real_escape_string(htmlentities($_POST['email']));
    $phone = mysql_real_escape_string(htmlentities($_POST['phone']));
    $age = mysql_real_escape_string(htmlentities($_POST['age']));
    $username = mysql_real_escape_string(htmlentities($_POST['username']));
    $occupation = mysql_real_escape_string(htmlentities($_POST['occupation']));
    $workplace = "";
    if($occupation == "student") {
        $workplace = mysql_real_escape_string(htmlentities($_POST['faculty']));
    } else {
        $workplace = mysql_real_escape_string(htmlentities($_POST['workplace']));
    }
    $twitter = mysql_real_escape_string(htmlentities($_POST['twitter']));
    $linkedin = mysql_real_escape_string(htmlentities($_POST['linkedin']));
    $website = mysql_real_escape_string(htmlentities($_POST['website']));
    $repository = mysql_real_escape_string(htmlentities($_POST['repository']));
    $about = mysql_real_escape_string(htmlentities($_POST['about']));
    $why = mysql_real_escape_string(htmlentities($_POST['why']));
    $idea = mysql_real_escape_string(htmlentities($_POST['idea']));
    $pastEditions = mysql_real_escape_string(htmlentities($_POST['pastEditions']));
    $hackathons = mysql_real_escape_string(htmlentities($_POST['hackathons']));
    $team = mysql_real_escape_string(htmlentities($_POST['team']));
    $areas = $_POST['areas'];
    $skills = $_POST['skills'];
    $otherSkills = mysql_real_escape_string(htmlentities($_POST['otherSkills']));
    $framework = mysql_real_escape_string(htmlentities($_POST['framework']));
    $hash = "";

    if($_POST['action'] == "create") {
        mysql_query("INSERT INTO entries (name,email,phone,age,username,occupation,workplace,twitter,linkedin,website,repository,about,why,idea,pastEditions,hackathons,team)
                    VALUES ('{$name}','{$email}','{$phone}','{$age}','{$username}','{$occupation}','{$workplace}','{$twitter}','{$linkedin}','{$website}','{$repository}','{$about}','{$why}','{$idea}','{$pastEditions}','{$hackathons}','{$team}')");
    } else {
        mysql_query("UPDATE entries SET name='{$name}',phone='{$phone}',age='{$age}',username='{$username}',occupation='{$occupation}',workplace='{$workplace}',twitter='{$twitter}',linkedin='{$linkedin}',website='{$website}',repository='{$repository}',about='{$about}',why='{$why}',idea='{$idea}',pastEditions='{$pastEditions}',hackathons='{$hackathons}',team='{$team}' WHERE email='{$email}'");
        $result = mysql_query("SELECT * FROM hashcodes WHERE email = '{$email}';");
        $row = mysql_fetch_array($result);
        $hash = $row['hash'];
    }

    if(mysql_errno() == 1062){
        $msg = mysql_error();
        $title = "";
        if($_POST['action'] == "create"){
            $title = "Erro a inscrever";
        } else {
            $title = "Erro a guardar alteracoes";
        }
        $error = "";
        if(strpos($msg,'PRIMARY') !== false) {
            $error = "Já existe um user com esse email";
        } elseif(strpos($msg,'phone') !== false) {
            $error = "Já existe um user com esse número de telefone";
        } elseif(strpos($msg,'username') !== false) {
            $error = "Já existe um user com esse username";
        } else {
            $error = "Houve um erro a guardar as alterações";
        }

        print("

        <section id=\"error\">
            <section class=\"error-container\">
                <header>
                    <h1>Erro a inscrever</h1>
                </header>
                <article>
                    <p>{$error}</p>
                    <form action=\"javascript:history.go(-1)\" method=\"POST\">
                        <div class=\"form-group\" id=\"submit\">
                            <input class=\"button\" type=\"submit\" value=\"Voltar atrás\"/>
                        </div>
                    </form>
                </article>
            </section>
        </section>
            ");
        
        
    } else {
        if($_POST['action'] == "create") {
            $hash = md5("bubadeira".$email);
            mysql_query("INSERT INTO hashcodes (email,hash) VALUES ('{$email}','{$hash}')");
        } else {
            mysql_query("DELETE FROM areas WHERE email = '{$email}'");
            mysql_query("DELETE FROM skills WHERE email = '{$email}'");
            mysql_query("DELETE FROM otherSkills WHERE email = '{$email}'");
            mysql_query("DELETE FROM frameworks WHERE email = '{$email}'");
        }

        foreach ($areas as $area) {
            mysql_query("INSERT INTO areas (email,area) VALUES ('{$email}','{$area}')");
        }
        foreach ($skills as $skill) {
            mysql_query("INSERT INTO skills (email,skill) VALUES ('{$email}','{$skill}')");
        }
        if(strlen($otherSkills) > 0) {
            mysql_query("INSERT INTO otherSkills (email,skill) VALUES ('{$email}','{$otherSkills}')");
        }
        if(strlen($framework) > 0) {
            mysql_query("INSERT INTO frameworks (email,framework) VALUES ('{$email}','{$framework}')");
        }

        if($_POST['action'] == "edit") {
            print("

        <section id=\"success\">
            <section class=\"success-container\">
                <header>
                    <h1>Alterações guardadas com sucesso</h1>
                </header>
                <article>
                    <p>Em breve sairá a lista de participantes selecionados. Mantém-te atento!</p>
                    <p>Podes alterar os teus dados em <a href=\"http://www.shiftappens.com/shift-me-up.php?id={$hash}\">http://www.shiftappens.com/shift-me-up.php?id={$hash}</a></p>
                    <form action=\"index.html\" method=\"POST\">
                        <div class=\"form-group\" id=\"submit\">
                            <input class=\"button\" type=\"submit\" value=\"Voltar à página principal\"/>
                        </div>
                    </form>
                </article>
            </section>
        </section>
            ");
        } else {
            print("

        <section id=\"success\">
            <section class=\"success-container\">
                <header>
                    <h1>Utilizador inscrito com sucesso</h1>
                </header>
                <article>
                    <p>Em breve sairá a lista de participantes selecionados. Mantém-te atento!</p>
                    <p>Podes alterar os teus dados em <a href=\"http://www.shiftappens.com/shift-me-up.php?id={$hash}\">http://www.shiftappens.com/shift-me-up.php?id={$hash}</a></p>
                    <form action=\"index.html\" method=\"POST\">
                        <div class=\"form-group\" id=\"submit\">
                            <input class=\"button\" type=\"submit\" value=\"Voltar à página principal\"/>
                        </div>
                    </form>
                </article>
            </section>
        </section>
            ");

            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.zoho.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'geral@shiftappens.com';
            $mail->Password = 'secret';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('geram@shiftappens.com', 'Shift APPens');
            $mail->addAddress($email, $name);
            $mail->addReplyTo('info@shiftappens.com', 'Shift APPens');

            $mail->isHTML(true);

            $mail->Subject = 'Shift APPens - candidatura recebida';
            $mail->Body    = 'Viva Shifter wannabe,

A tua candidatura ao Shift APPens 2016 foi aceite.
No dia 12 de fevereiro irás descobrir se foste escolhido para participar neste evento épico.

Podes alterar a tua candidatura em <a href=\"http://www.shiftappens.com/shift-me-up.php?id={$hash}\">http://www.shiftappens.com/shift-me-up.php?id={$hash}</a>.

Lorem Ipsum,
A equipa do Shift APPens
';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
        }
    }
} else {
        print("

        <section id=\"error\">
            <section class=\"error-container\">
                <header>
                    <h1>Erro de ligação</h1>
                </header>
                <article>
                    <p>Infelizmente, ocorreu um erro interno</p>
                    <form action=\"javascript:history.go(-1)\" method=\"POST\">
                        <div class=\"form-group\" id=\"submit\">
                            <input class=\"button\" type=\"submit\" value=\"Voltar atrás\"/>
                        </div>
                    </form>
                </article>
            </section>
        </section>
            ");
}


?>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/animatescroll.min.js"></script>
        <script src="assets/js/functions.js"></script>
        <script src="assets/js/signin.js"></script>
    </body>
</html>