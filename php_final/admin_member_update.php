<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자페이지</title>
</head>

<body>
    <?php
    session_start();

    if ($_SESSION['userid'] != 'admin' )
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            location.href = 'index.php';
            </script>
        ");
    }

    $idx   = $_GET["idx"];
    $point = $_POST["point"];

    $con = mysqli_connect("localhost", "user1", "12345", "sample");
    $sql = "update member set  point=$point where idx=$idx";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo("
            <script>
            alert('수정되었습니다.');
            location.href = 'admin.php';
            </script>
        ");
    
?>
</body>

</html>