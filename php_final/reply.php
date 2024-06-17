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
    $userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
    
    if($bno && $_POST['dat_user'] && $userpw && $_POST['content']){
        $sql = "insert into reply(con_num,name,pw,content) values('".$bno."','".$_POST['dat_user']."','".$userpw."','".$_POST['content']."')";
        mysqli_query($con, $sql);
        mysqli_close($con);
        echo "<script>confirm('댓글이 작성되었습니다.'); 
        location.href='read.php?idx=$bno';</script>";
    }else{
        echo "<script>confirm('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    }
?>
</body>

</html>