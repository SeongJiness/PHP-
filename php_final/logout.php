<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그아웃</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css">
</head>

<body>
    <?php
    session_start();
    $con = mysqli_connect("localhost", "user1" , "12345","sample");
	session_destroy();
?>
    <meta charset="utf-8">
    <script>
    alert("로그아웃되었습니다.");
    location.href = "index.php";
    </script>
</body>

</html>