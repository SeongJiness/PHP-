<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>열심게시판</title>


</head>

<body>
    <?php
include "enter.php";
$con = mysqli_connect("localhost", "user1" , "12345","sample");
$bno = $_GET['idx'];
if($bno == "") {
    echo("
    <script>
    alert('잘못된 접근입니다.!!');
    location.href = 'index.php';
    </script>
");
}

$sql = "SELECT * FROM hard WHERE idx = '$bno'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$filename = $row['file'];

if(file_exists("./upload/".$filename) && isset($_FILES['b_file']['name'])) {
    unlink("./upload/".$filename);
}

$date = date('Y-m-d-H-i-s');
$username = $_SESSION['userid'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);

if(isset($_FILES['b_file']['name']) && $_FILES['b_file']['name'] !== '') {
$tmpfile =  $_FILES['b_file']['tmp_name'];
$o_name = $date."_".$_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
$folder = "./upload/".$date."_".$filename;
move_uploaded_file($tmpfile,$folder);
} elseif($_FILES['b_file']['name'] == '' && $_POST['s_file'] =="none" ) {
    $o_name = "";
} else{
    $o_name = $filename;
}



if(isset($_POST['lockpost'])){
	$lo_post = '1';
}else{
	$lo_post = '0';
}

$sql = "update hard set name='".$username."',pw='".$userpw."',title='".$title."',content='".$content."',lock_post='".$lo_post."',file='".$o_name."' where idx='".$bno."'";
if ($lo_post == "1") {
  $sql.= " and lock_post='0'";
}
$sql = mysqli_query($con, $sql);

$bno = $_GET['idx'];
$sql = "select * from hard where idx='$bno';"; 
$sql = mysqli_query($con, $sql);
$board = $sql->fetch_array();



mysqli_close($con);
?>

    <script>
    alert("수정되었습니다.");
    </script>"


    <meta http-equiv="refresh" content="0 url=hard.php">
</body>

</html>