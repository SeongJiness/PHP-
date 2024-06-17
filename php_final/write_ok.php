<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>

<body>
    <?php
	include "enter.php";
    if($_POST['title'] == "") {
        echo("
        <script>
        alert('잘못된 접근입니다.!!');
        location.href='index.php'
        </script>
    ");
    }
$con = mysqli_connect("localhost", "user1", "12345", "sample");

$board_id = $_POST["opt"];
$user_id = $_SESSION["userid"];

$sql = "select * from member where id='".$_SESSION['userid']."'";
$result = mysqli_query($con, $sql);
$user_level = mysqli_fetch_array($result)["point"];


if ($user_level < $board_id) {
  echo "<script>alert('해당 게시판에는 아직 글을 작성할 수 없습니다.');</script>";
  echo "<script>location.href='write.php';</script>";
} 
?>
    <?php


$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$date = date('Y-m-d-H-i-s');
if(isset($_FILES['b_file']['name']) && $_FILES['b_file']['name'] !== '') {
    $tmpfile =  $_FILES['b_file']['tmp_name'];
    $o_name = $date."_".$_FILES['b_file']['name'];
    $filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
    $folder = "./upload/".$date."_".$filename;
    move_uploaded_file($tmpfile,$folder);
    } else {
        $o_name = "";
    }
    
if(isset($_POST['lockpost'])){
	$lo_post = '1';
}else{
	$lo_post = '0';
}




if($_POST["opt"] == "0") {
$mqq = "alter table free auto_increment =1";
mysqli_query($con, $mqq);

$sql = "insert into free(name,pw,title,content,date,lock_post,file) 
values('".$_SESSION['userid']."','".$userpw."','".htmlspecialchars($_POST['title'])."','".htmlspecialchars($_POST['content'])."','".$date."','".$lo_post."','".$o_name."')";
mysqli_query($con, $sql);
mysqli_close($con);
echo ('<script>
    alert("글쓰기 완료되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0 url=free.php" />');
} elseif($_POST["opt"] == "1") {
    $mqq = "alter table normal auto_increment =1";
mysqli_query($con, $mqq);

$sql = "insert into normal(name,pw,title,content,date,lock_post,file) 
values('".$_SESSION['userid']."','".$userpw."','".htmlspecialchars($_POST['title'])."','".htmlspecialchars($_POST['content'])."','".$date."','".$lo_post."','".$o_name."')";
mysqli_query($con, $sql);
mysqli_close($con);
echo ('<script>
    alert("글쓰기 완료되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0 url=normal.php" />');
} elseif($_POST["opt"] == "2") {
    $mqq = "alter table hard auto_increment =1";
mysqli_query($con, $mqq);

$sql = "insert into hard(name,pw,title,content,date,lock_post,file) 
values('".$_SESSION['userid']."','".$userpw."','".htmlspecialchars($_POST['title'])."','".htmlspecialchars($_POST['content'])."','".$date."','".$lo_post."','".$o_name."')";
mysqli_query($con, $sql);
mysqli_close($con);
echo ('<script>
    alert("글쓰기 완료되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0 url=hard.php" />');
} elseif($_POST["opt"] == "3") {
    $mqq = "alter table star auto_increment =1";
mysqli_query($con, $mqq);

$sql = "insert into star(name,pw,title,content,date,lock_post,file) 
values('".$_SESSION['userid']."','".$userpw."','".htmlspecialchars($_POST['title'])."','".htmlspecialchars($_POST['content'])."','".$date."','".$lo_post."','".$o_name."')";
mysqli_query($con, $sql);
mysqli_close($con);
echo ('<script>
    alert("글쓰기 완료되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0 url=star.php" />');
} else {
    $mqq = "alter table moon auto_increment =1";
    mysqli_query($con, $mqq);
    
    $sql = "insert into moon(name,pw,title,content,date,lock_post,file) 
    values('".$_SESSION['userid']."','".$userpw."','".htmlspecialchars($_POST['title'])."','".htmlspecialchars($_POST['content'])."','".$date."','".$lo_post."','".$o_name."')";
    mysqli_query($con, $sql);
    mysqli_close($con);
    echo ('<script>
    alert("글쓰기 완료되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0 url=moon.php" />');
}
?>

</body>

</html>