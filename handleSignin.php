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

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('mysqlitedb.db');
    }
}

if($db = new MyDB()) {
    $name = $db->escapeString($_POST['name']);
    $email = $db->escapeString($_POST['email']);
    $phone = $db->escapeString($_POST['phone']);
    $username = $db->escapeString($_POST['username']);
    $occupation = $db->escapeString($_POST['occupation']);
    $workplace = "";
    if($occupation == "student") {
        $workplace = $db->escapeString($_POST['faculty']);
    } else {
        $workplace = $db->escapeString($_POST['workplace']);
    }
    $twitter = $db->escapeString($_POST['twitter']);
    $linkedin = $db->escapeString($_POST['linkedin']);
    $website = $db->escapeString($_POST['website']);
    $repository = $db->escapeString($_POST['repository']);
    $about = $db->escapeString($_POST['about']);
    $why = $db->escapeString($_POST['why']);
    $idea = $db->escapeString($_POST['idea']);
    $pastEditions = $db->escapeString($_POST['pastEditions']);
    $hackathons = $db->escapeString($_POST['hackathons']);
    $team = $db->escapeString($_POST['team']);
    $areas = $_POST['areas'];
    $skills = $_POST['skills'];
    $otherSkill = $db->escapeString($_POST['otherSkills']);
    $framework = $db->escapeString($_POST['framework']);
    $hash = "";

    $db->exec('CREATE TABLE IF NOT EXISTS entries(
        name TEXT NOT NULL,
        email TEXT PRIMARY KEY UNIQUE NOT NULL,
        phone INT UNIQUE NOT NULL,
        username TEXT UNIQUE NOT NULL,
        occupation TEXT NOT NULL,
        workplace TEXT,
        twitter TEXT,
        linkedin TEXT,
        website TEXT,
        repository TEXT,
        about TEXT NOT NULL,
        why TEXT NOT NULL,
        idea TEXT NOT NULL,
        pastEditions TEXT NOT NULL,
        hackathons TEXT NOT NULL,
        team TEXT)');

    $db->exec('CREATE TABLE IF NOT EXISTS areas(
        email TEXT REFERENCES entries (email) ON DELETE CASCADE,
        area TEXT NOT NULL)');

    $db->exec('CREATE TABLE IF NOT EXISTS skills(
        email TEXT REFERENCES entries (email) ON DELETE CASCADE,
        skill TEXT NOT NULL)');

    $db->exec('CREATE TABLE IF NOT EXISTS otherSkills(
        email TEXT REFERENCES entries (email) ON DELETE CASCADE,
        skill TEXT NOT NULL)');

    $db->exec('CREATE TABLE IF NOT EXISTS frameworks(
        email TEXT REFERENCES entries (email) ON DELETE CASCADE,
        framework TEXT NOT NULL)');

    $db->exec('CREATE TABLE IF NOT EXISTS hashcodes(
        email TEXT REFERENCES entries (email) ON DELETE CASCADE,
        hash TEXT NOT NULL)');

    if($_POST['action'] == "create") {
        $db->exec("INSERT OR ROLLBACK INTO entries (name,email,phone,username,occupation,workplace,twitter,linkedin,website,repository,about,why,idea,pastEditions,hackathons,team)
                    VALUES ('{$name}','{$email}','{$phone}','{$username}','{$occupation}','{$workplace}','{$twitter}','{$linkedin}','{$website}','{$repository}','{$about}','{$why}','{$idea}','{$pastEditions}','{$hackathons}','{$team}')");
        $hash = md5("bubadeira".$email);
        $db->exec("INSERT OR ROLLBACK INTO hashcodes (email,hash) VALUES ('{$email}','{$hash}')");
    } else {
        $db->exec("UPDATE OR ROLLBACK entries SET name='{$name}',phone='{$phone}',username='{$username}',occupation='{$occupation}',workplace='{$workplace}',twitter='{$twitter}',linkedin='{$linkedin}',website='{$website}',repository='{$repository}',about='{$about}',why='{$why}',idea='{$idea}',pastEditions='{$pastEditions}',hackathons='{$hackathons}',team='{$team}' WHERE email='{$email}'");
        $query = $db->prepare("SELECT * FROM hashcodes WHERE email = :email;");
        $query->bindValue(":email",$email);
        $result = $query->execute();
        $row = $result->fetchArray();
        $hash = $row['hash'];
    }

    if($db->lastErrorCode() == 19){
        $msg = $db->lastErrorMsg();
        $error = "";
        if(strpos($msg,'email') !== false) {
            $error = "Já existe um user com esse email";
        } elseif(strpos($msg,'phone') !== false) {
            $error = "Já existe um user com esse contacto";
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
                            <input type=\"submit\" value=\"Voltar atrás\"/>
                        </div>
                    </form>
                </article>
            </section>
        </section>
            ");
        
        
    } else {
        if($_POST['action'] == "edit") {
            $db->exec("DELETE FROM areas WHERE email = '{$email}'");
            $db->exec("DELETE FROM skills WHERE email = '{$email}'");
            $db->exec("DELETE FROM otherSkills WHERE email = '{$email}'");
            $db->exec("DELETE FROM frameworks WHERE email = '{$email}'");
        }

        foreach ($areas as $area) {
            $db->exec("INSERT OR ROLLBACK INTO areas (email,area) VALUES ('{$email}','{$area}')");
        }
        foreach ($skills as $skill) {
            $db->exec("INSERT OR ROLLBACK INTO skills (email,skill) VALUES ('{$email}','{$skill}')");
        }
        if(strlen($otherSkill) > 0) {
            $db->exec("INSERT OR ROLLBACK INTO otherSkills (email,skill) VALUES ('{$email}','{$otherSkills}')");
        }
        if(strlen($framework) > 0) {
            $db->exec("INSERT OR ROLLBACK INTO frameworks (email,framework) VALUES ('{$email}','{$framework}')");
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
                    <p>Podes alterar os teus dados em <a href=\"http://www.shiftappens.com/signin.php?id={$hash}\">\"http://www.shiftappens.com/signin.php?id={$hash}\"</a></p>
                    <form action=\"index.php\" method=\"POST\">
                        <div class=\"form-group\" id=\"submit\">
                            <input type=\"submit\" value=\"Voltar à página principal\"/>
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
                    <p>Podes alterar os teus dados em <a href=\"http://www.shiftappens.com/signin.php?id={$hash}\">\"http://www.shiftappens.com/signin.php?id={$hash}\"</a></p>
                    <form action=\"index.php\" method=\"POST\">
                        <div class=\"form-group\" id=\"submit\">
                            <input type=\"submit\" value=\"Voltar à página principal\"/>
                        </div>
                    </form>
                </article>
            </section>
        </section>
            ");
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
                            <input type=\"submit\" value=\"Voltar atrás\"/>
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