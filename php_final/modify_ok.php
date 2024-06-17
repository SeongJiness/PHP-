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
$con = mysqli_connect("localhost", "user1" , "12345","sample");


$bno = $_GET['idx'];
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$sql = "update board set name='".$username."',pw='".$userpw."',title='".$title."',content='".$content."' where idx='".$bno."'";
$sql = mysqli_query($con, $sql);

$bno = $_GET['idx'];
$sql = "select * from board where idx='$bno';"; 
$sql = mysqli_query($con, $sql);
$board = $sql->fetch_array();



mysqli_close($con);
?>

    <script>
    confirm("수정되었습니다.");
    </script>"


    <meta http-equiv="refresh" content="0 url=index.php">
</body>

</html>