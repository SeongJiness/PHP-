<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    
    session_start();

    header('Content-Type: text/html; charset=utf-8');

    $db = new mysqli("localhost", "user1", "12345", "sample");
    $db-> set_charset("utf8");

    function query($query) {
        global $db;
        return $db->query($query);
    }
    
    
    ?>
</body>

</html>