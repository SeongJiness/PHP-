<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>별신게시판</title>
</head>

<body>
    <?php
$con = mysqli_connect("localhost", "user1" , "12345","sample");
	include "enter.php";
    if(!isset($_GET['idx'])) {
        echo("
        <script>
        alert('잘못된 접근입니다.!!');
        location.href = 'index.php';
        </script>
    ");
    }
?>
    <link rel="stylesheet" type="text/css" href="/BBS/css/jquery-ui.css" />
    <script type="text/javascript" src="/BBS/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/BBS/js/jquery-ui.js"></script>
    <script type="text/javascript">
    $(function() {
        $("#writepass").dialog({
            modal: true,
            title: '비밀글입니다.',
            width: 400,
        });
    });
    </script>
    <?php

$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
$sql = "select * from star where idx='".$bno."'";
$sql = mysqli_query($con, $sql);
$board = $sql->fetch_array();
mysqli_close($con);
?>
    <div id='writepass'>
        <a href="star.php">홈으로</a>
        <form action="" method="post">
            <p>비밀번호<input type="password" name="pw_chk" /> <input type="submit" value="확인" /></p>
        </form>
    </div>
    <?php
	 	$bpw = $board['pw'];

	 	if(isset($_POST['pw_chk'])) //만약 pw_chk POST값이 있다면
	 	{
	 		$pwk = $_POST['pw_chk']; // $pwk변수에 POST값으로 받은 pw_chk를 넣습니다.
			if(password_verify($pwk,$bpw)) //다시 if문으로 DB의 pw와 입력하여 받아온 bpw와 값이 같은지 비교를 하고
			{
				$pwk == $bpw;
			?>
    <script type="text/javascript">
    location.replace("star_read.php?idx=<?php echo $board["idx"]; ?>");
    </script><!-- pwk와 bpw값이 같으면 read.php로 보내고 -->
    <?php 
			}else{ ?>
    <script type="text/javascript">
    alert('비밀번호가 틀립니다');
    </script>
    <!--- 아니면 비밀번호가 틀리다는 메시지를 보여줍니다 -->
    <?php } } ?>
</body>

</html>