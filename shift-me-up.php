<?php
$edit = false;
$entries = NULL;
$areas = array();
$skills = array();
$otherSkill = "";
$frameworks = "";

if(isset($_GET) and isset($_GET['id'])) {
    $hash = $_GET['id'];

    $link = mysql_connect('localhost', 'shiftappens', 'ianchLansn_*a1?zJHAmaxvy');
    if($link) {
        $db = mysql_select_db('shiftappens2016', $link);

        $result = mysql_query("SELECT * FROM hashcodes WHERE hash = '{$hash}';");
        if(mysql_num_rows($result) != 0) {
            $edit = true;

            $row = mysql_fetch_array($result);
            $email = $row['email'];

            $result = mysql_query("SELECT * FROM entries WHERE email = '{$email}';");
            $entries = mysql_fetch_array($result);

            $result = mysql_query("SELECT * FROM areas WHERE email = '{$email}';");
            while($row = mysql_fetch_array($result)) {
                $areas[] = $row["area"];
            }

            $result = mysql_query("SELECT * FROM skills WHERE email = '{$email}';");
            while($row = mysql_fetch_array($result)) {
                $skills[] = $row["skill"];
            }

            $result = mysql_query("SELECT * FROM otherSkills WHERE email = '{$email}';");
            $otherSkills = mysql_fetch_array($result);

            $result = mysql_query("SELECT * FROM frameworks WHERE email = '{$email}';");
            $frameworks = mysql_fetch_array($result);
        } else {
            $edit = false;
        }
    } else {
        $edit = false;
    }
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
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
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
        <section id="sign-in">
            <section class="sign-in-container">
                <header>
                    <h1>Inscricoes</h1>
                </header>
                <div class="sign-in-content">
                    <form method="POST" action="handleSignin.php">
                        <p>Dados Pessoais</p>
                        <div class="form-group">
                            <label for="nameInput" class="control-label">Nome completo</label>
                            <input type="text" name="name" class="form-control" id="nameInput" placeholder="Nome completo" <?php if($edit){echo "value=\"".$entries['name']."\"";} ?> required/>
                        </div>
                        <div class="form-group">
                            <label for="emailInput" class="control-label">Email</label>
                            <input type="email" name="email" class="form-control" id="emailInput" placeholder="Email" <?php if($edit){echo "readonly value=\"".$entries['email']."\"";} ?> required/>
                        </div>
                        <div class="form-group">
                            <label for="phoneInput" class="control-label">Telefone</label>
                            <input type="tel" name="phone" class="form-control" id="phoneInput" placeholder="Telefone" <?php if($edit){echo "value=\"".$entries['phone']."\"";} ?> required/>
                        </div>
                        <div class="form-group">
                            <label for="ageInput" class="control-label">Idade</label>
                            <input type="number" name="age" class="form-control" id="ageInput" placeholder="Idade" <?php if($edit){echo "value=\"".$entries['age']."\"";} ?> required/>
                        </div>
                        <div class="form-group">
                            <label for="userNameInput" class="control-label">Username</label>
                            <input type="text" name="username" class="form-control" id="userNameInput" placeholder="Como queres ser conhecido no slack e nas credenciais" <?php if($edit){echo "value=\"".$entries['username']."\"";} ?> required/>
                        </div>
                        <div class="form-group radio-group">
                            <p>Profissão</p>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="occupation" id="worker" value="worker" <?php if($edit and $entries['occupation']=='worker'){echo "checked";} ?> required/>
                                    Trabalhador
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="occupation" id="student" value="student" <?php if($edit and $entries['occupation']=='student'){echo "checked";} ?> required/>
                                    Estudante
                                </label>
                            </div>
                        </div>
                        <div class="form-group collapse" id="faculty">
                            <label for="facultyInput" class="control-label">Faculdade e curso</label>
                            <input type="text" name="faculty" class="form-control" id="facultyInput" placeholder="Faculdade e curso" <?php if($edit and $entries['occupation']=='student'){echo "value=\"".$entries['workplace']."\"";} ?>/>
                        </div>
                        <div class="form-group collapse" id="workplace">
                            <label for="workplaceInput" class="control-label">Local de Trabalho</label>
                            <input type="text" name="workplace" class="form-control" id="workplaceInput" placeholder="Local de Trabalho" <?php if($edit and $entries['occupation']=='worker'){echo "value=\"".$entries['workplace']."\"";} ?>/>
                        </div>


                        <p>Web Presence</p>
                        <div class="form-group">
                            <label for="twitterInput" class="control-label">Twitter</label>
                            <input type="url" class="form-control" name="twitter" id="twitterInput" placeholder="Twitter" <?php if($edit){echo "value=\"".$entries['twitter']."\"";} ?>/>
                        </div>
                        <div class="form-group">
                            <label for="linkedinInput" class="control-label">Linkedin</label>
                            <input type="url" class="form-control" name="linkedin" id="linkedinInput" placeholder="Linkedin" <?php if($edit){echo "value=\"".$entries['linkedin']."\"";} ?>/>
                        </div>
                        <div class="form-group">
                            <label for="websiteInput" class="control-label">Website ou Blog</label>
                            <input type="url" class="form-control" name="website" id="websiteInput" placeholder="Website ou Blog" <?php if($edit){echo "value=\"".$entries['website']."\"";} ?>/>
                        </div>
                        <div class="form-group">
                            <label for="repositoryInput" class="control-label">Repositório</label>
                            <input type="url" class="form-control" name="repository" id="repositoryInput" placeholder="Repositório (github, bitbucket, gitlab)" <?php if($edit){echo "value=\"".$entries['repository']."\"";} ?>/>
                        </div>

                        <p>Preparação</p>
                        <div class="form-group">
                            <label for="ideaInput" class="control-label">Tens alguma ideia para desenvolver no ShiftAPPens?</label>
                            <textarea name="idea" class="form-control" id="ideaInput" rows="5" placeholder="Se sim, descreve." required><?php if($edit){echo $entries['idea'];} ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="teamInput" class="control-label">Já tens equipa em mente? Indica os nomes dos teus colegas.</label>
                            <input type="text" name="team" class="form-control" id="teamInput" placeholder="Isto pode ajudar-nos a associar as pessoas a uma equipa" <?php if($edit){echo "value=\"".$entries['team']."\"";} ?>/>
                        </div>

                        <p>Experiência</p>
                        <div class="form-group radio-group">
                            <p>Já participaste em alguma das edições passadas do ShiftAPPens?</p>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="pastEditions" value="yes" <?php if($edit and $entries['pastEditions']=='yes'){echo "checked";} ?> required/>
                                    Sim
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="pastEditions" value="no" <?php if($edit and $entries['pastEditions']=='no'){echo "checked";} ?> required/>
                                    Não
                                </label>
                            </div>
                        </div>
                        <div class="form-group radio-group">
                            <p>E noutros hackathons?</p>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="hackathons" value="yes" <?php if($edit and $entries['hackathons']=='yes'){echo "checked";} ?> required/>
                                    Sim
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="hackathons" value="no" <?php if($edit and $entries['hackathons']=='no'){echo "checked";} ?> required/>
                                    Não
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p>Top Skills</p>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="PHP" <?php if($edit and in_array("PHP", $skills)){echo "checked";} ?>/>
                                            PHP
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Java" <?php if($edit and in_array("Java", $skills)){echo "checked";} ?>/>
                                            Java
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="JavaScript" <?php if($edit and in_array("JavaScript", $skills)){echo "checked";} ?>/>
                                            JavaScript
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Ruby" <?php if($edit and in_array("Ruby", $skills)){echo "checked";} ?>/>
                                            Ruby
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="HTML5+CSS3" <?php if($edit and in_array("HTML5+CSS3", $skills)){echo "checked";} ?>/>
                                            HTML5+CSS3
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Python" <?php if($edit and in_array("Python", $skills)){echo "checked";} ?>/>
                                            Python
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="C/C++" <?php if($edit and in_array("C/C++", $skills)){echo "checked";} ?>/>
                                            C/C++
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Cocoa/Objective-C/Swift" <?php if($edit and in_array("Cocoa/Objective-C/Swift", $skills)){echo "checked";} ?>/>
                                            Cocoa/Objective-C/Swift
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value=".NET/Mono" <?php if($edit and in_array(".NET/Mono", $skills)){echo "checked";} ?>/>
                                            .NET/Mono
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Android" <?php if($edit and in_array("Android", $skills)){echo "checked";} ?>/>
                                            Android
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="iOS" <?php if($edit and in_array("iOS", $skills)){echo "checked";} ?>/>
                                            iOS
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Devops" <?php if($edit and in_array("Devops", $skills)){echo "checked";} ?>/>
                                            Devops
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="APIs" <?php if($edit and in_array("APIs", $skills)){echo "checked";} ?>/>
                                            APIs
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Databases" <?php if($edit and in_array("Databases", $skills)){echo "checked";} ?>/>
                                            Databases
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Sketch/Photoshop" <?php if($edit and in_array("Sketch/Photoshop", $skills)){echo "checked";} ?>/>
                                            Sketch/Photoshop
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="Go Lang" <?php if($edit and in_array("Go Lang", $skills)){echo "checked";} ?>/>
                                            Go Lang
                                        </label>
                                    </div>
                                </div>
                                <label for="otherSkillsInput" class="control-label">Outro:</label>
                                <input type="text" class="form-control" name="otherSkills" id="otherSkillsInput" placeholder="Awesome skill" <?php if($edit){echo "value=\"".$otherSkills['skill']."\"";} ?>/>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <p>Quais são as tuas áreas?</p>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Full-stack" <?php if($edit and in_array("Full-stack", $areas)){echo "checked";} ?>/>
                                            Full-stack
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Backend" <?php if($edit and in_array("Backend", $areas)){echo "checked";} ?>/>
                                            Backend
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Frontend" <?php if($edit and in_array("Frontend", $areas)){echo "checked";} ?>/>
                                            Frontend
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Game Dev" <?php if($edit and in_array("Game Dev", $areas)){echo "checked";} ?>/>
                                            Game Dev
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Design"  <?php if($edit and in_array("Design", $areas)){echo "checked";} ?>/>
                                            Design
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Segurança" <?php if($edit and in_array("Segurança", $areas)){echo "checked";} ?>/>
                                            Segurança
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Desktop" <?php if($edit and in_array("Desktop", $areas)){echo "checked";} ?>/>
                                            Desktop
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Mobile" <?php if($edit and in_array("Mobile", $areas)){echo "checked";} ?>/>
                                            Mobile
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Bioinformatics" <?php if($edit and in_array("Bioinformatics", $areas)){echo "checked";} ?>/>
                                            Bioinformatics
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Hardware" <?php if($edit and in_array("Hardware", $areas)){echo "checked";} ?>/>
                                            Hardware
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Cooking" <?php if($edit and in_array("Cooking", $areas)){echo "checked";} ?>/>
                                            Cooking
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="areas[]" value="Nickles Batatóides"  <?php if($edit and in_array("Nickles Batatóides", $areas)){echo "checked";} ?>/>
                                            Nickles Batatóides
                                        </label>
                                    </div>
                                </div>
                                <label for="frameworkInput" class="control-label">Tens alguma framework de preferência? Se sim, qual?</label>
                                <input type="text" name="framework" class="form-control" id="frameworkInput" placeholder="Ex: Ruby on Rails, Django, Phoenix, Laravel, React, Meteor" <?php if($edit){echo "value=\"".$frameworks['framework']."\"";} ?>/>

                            </div>
                        </div>

                        <p>Agora convence-nos</p>
                        <div class="form-group">
                            <label for="aboutInput" class="control-label">Fala-nos sobre ti. Quais os projetos que já desenvolveste?</label>
                            <textarea name="about" class="form-control" id="aboutInput" rows="5" placeholder="Pretendemos que escrevas uma pequena biografia e que te refiras a todos os projetos que já desenvolveste e que aches relevantes." required><?php if($edit){echo $entries['about'];} ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="whyInput" class="control-label">Porque é que deves ser escolhido para participar?</label>
                            <textarea name="why" class="form-control" id="whyInput" rows="5" placeholder="Não te desleixes nesta, convence-nos de que deves ser escolhido." required><?php if($edit){echo $entries['why'];} ?></textarea>
                        </div>

                        <input type="hidden" name="action" value="<?php if($edit){echo "edit";}else{echo "create";}?>"/>
                        <div class="form-group" id="submit">
                            <input class="button" type="submit" value="<?php if($edit){echo "Guardar alterações";}else{echo "Shift me up";}?>"/>
                        </div>

                    </form>
                </div>
            </section>
        </section>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.mousewheel.min.js"></script>
        <script src="assets/js/signin.js"></script>
<?php
if($edit and $entries['occupation']=='student'){
    print("
        <script type=\"text/javascript\">
            $(\"#faculty\").collapse('show');
        </script>
        ");
} else if($edit and $entries['occupation']=='worker'){
    print("
        <script type=\"text/javascript\">
            $(\"#workplace\").collapse('show');
        </script>
        ");
}


?>
    </body>
</html>
