<?php

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

$db = new mysqli('localhost', 'shiftappens', 'ianchLansn_*a1?zJHAmaxvy', 'shiftappens2016');

if(mysqli_connect_errno() == 0) {
    $name = $db->real_escape_string($_POST['name']);
    $email = $db->real_escape_string($_POST['email']);
    $phone = $db->real_escape_string($_POST['phone']);
    $age = $db->real_escape_string($_POST['age']);
    $username = $db->real_escape_string($_POST['username']);
    $occupation = $db->real_escape_string($_POST['occupation']);
    $workplace = "";
    if($occupation == "student") {
        $workplace = $db->real_escape_string($_POST['faculty']);
    } else {
        $workplace = $db->real_escape_string($_POST['workplace']);
    }
    $twitter = $db->real_escape_string($_POST['twitter']);
    $linkedin = $db->real_escape_string($_POST['linkedin']);
    $website = $db->real_escape_string($_POST['website']);
    $repository = $db->real_escape_string($_POST['repository']);
    $about = $db->real_escape_string($_POST['about']);
    $why = $db->real_escape_string($_POST['why']);
    $idea = $db->real_escape_string($_POST['idea']);
    $pastEditions = $db->real_escape_string($_POST['pastEditions']);
    $hackathons = $db->real_escape_string($_POST['hackathons']);
    $team = $db->real_escape_string($_POST['team']);
    $areas = $_POST['areas'];
    $skills = $_POST['skills'];
    $otherSkill = $db->real_escape_string($_POST['otherSkills']);
    $framework = $db->real_escape_string($_POST['framework']);
    $hash = "";

    if($_POST['action'] == "create") {
        $db->query("INSERT INTO entries (name,email,phone,age,username,occupation,workplace,twitter,linkedin,website,repository,about,why,idea,pastEditions,hackathons,team)
                    VALUES ('{$name}','{$email}','{$phone}','{$age}','{$username}','{$occupation}','{$workplace}','{$twitter}','{$linkedin}','{$website}','{$repository}','{$about}','{$why}','{$idea}','{$pastEditions}','{$hackathons}','{$team}')");
    } else {
        $db->query("UPDATE entries SET name='{$name}',phone='{$phone}',age='{$age}',username='{$username}',occupation='{$occupation}',workplace='{$workplace}',twitter='{$twitter}',linkedin='{$linkedin}',website='{$website}',repository='{$repository}',about='{$about}',why='{$why}',idea='{$idea}',pastEditions='{$pastEditions}',hackathons='{$hackathons}',team='{$team}' WHERE email='{$email}'");
        $query = $db->prepare("SELECT * FROM hashcodes WHERE email = :?;");
        $query->bindParam($email);
        $result = $query->execute();
        $row = $result->fetchArray();
        $query->close();
        $hash = $row['hash'];
    }

    if($db->errno == 1062){
        $msg = $db->error;
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
            $db->query("INSERT INTO hashcodes (email,hash) VALUES ('{$email}','{$hash}')");
        } else {
            $db->query("DELETE FROM areas WHERE email = '{$email}'");
            $db->query("DELETE FROM skills WHERE email = '{$email}'");
            $db->query("DELETE FROM otherSkills WHERE email = '{$email}'");
            $db->query("DELETE FROM frameworks WHERE email = '{$email}'");
        }

        foreach ($areas as $area) {
            $db->query("INSERT OR ROLLBACK INTO areas (email,area) VALUES ('{$email}','{$area}')");
        }
        foreach ($skills as $skill) {
            $db->query("INSERT OR ROLLBACK INTO skills (email,skill) VALUES ('{$email}','{$skill}')");
        }
        if(strlen($otherSkill) > 0) {
            $db->query("INSERT OR ROLLBACK INTO otherSkills (email,skill) VALUES ('{$email}','{$otherSkills}')");
        }
        if(strlen($framework) > 0) {
            $db->query("INSERT OR ROLLBACK INTO frameworks (email,framework) VALUES ('{$email}','{$framework}')");
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
                    <form action=\"index.php\" method=\"POST\">
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
                    <form action=\"index.php\" method=\"POST\">
                        <div class=\"form-group\" id=\"submit\">
                            <input class=\"button\" type=\"submit\" value=\"Voltar à página principal\"/>
                        </div>
                    </form>
                </article>
            </section>
        </section>
            ");
        }
    }
    $db->close();
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