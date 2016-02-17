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