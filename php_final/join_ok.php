<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css">
</head>

<body>
    <?php
$con = mysqli_connect("localhost", "user1" , "12345","sample");
$bno = $_POST['userid'];
    if($bno == "") {
        echo("
        <script>
        alert('잘못된 접근입니다.!!');
        location.href = 'index.php';
        </script>
    ");
    }
$userid = $_POST['userid'];
$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
$username = $_POST['name'];
$sql = "insert into member (id,pw,name,point) values('$userid','$userpw','$username','0')";
mysqli_query($con, $sql);
mysqli_close($con);

?>
    <script type="text/javascript">
    alert('회원가입이 완료되었습니다.');
    </script>
    <meta http-equiv="refresh" content="0 url='index.php'">
</body>

</html>