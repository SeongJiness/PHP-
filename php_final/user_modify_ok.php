<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원수정</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css">
</head>

<body>
    <?php
session_start();
$con = mysqli_connect("localhost", "user1" , "12345","sample");
	include "enter.php";
    if($_POST['userpw'] == "") {
        echo("
        <script>
        alert('잘못된 접근입니다.!!');
        location.href = 'index.php';
        </script>
    ");
    }
$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
$username = $_POST['name'];
$uid = $_SESSION["userid"];
$sql2 = "update member set pw = '$userpw', name = '$username' where id = '$uid'";
mysqli_query($con, $sql2);
mysqli_close($con);

session_destroy();

?>
    <script type="text/javascript">
    alert('수정이 완료되었습니다.');
    alert("수정사항이 생겨 재로그인이 필요합니다.")
    </script>
    <meta http-equiv="refresh" content="0 url='index.php'">
</body>

</html>