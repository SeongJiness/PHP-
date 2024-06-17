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
    $userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
    
    if($bno && $_SESSION['userid'] && $userpw && $_POST['content']){
        $sql = "insert into hard_reply(con_num,name,pw,content) values('".$bno."','".$_SESSION['userid']."','".$userpw."','".$_POST['content']."')";
        mysqli_query($con, $sql);
        mysqli_close($con);
        echo "<script>alert('댓글이 작성되었습니다.'); 
        location.href='hard_read.php?idx=$bno';</script>";
    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    }
?>
</body>

</html>