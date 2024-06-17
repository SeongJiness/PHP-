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
	$bno = $_GET['idx'];
    if($bno == "") {
        echo("
        <script>
        alert('잘못된 접근입니다.!!');
        location.href = 'index.php';
        </script>
    ");
    }
    $thumbup = "select thumbup from star where idx='$bno';";
    $thumbup = mysqli_query($con, $thumbup);
	$thumbup = mysqli_fetch_array($thumbup);
    $thumbup = $thumbup['thumbup'] + 1;
    $thum = "update star set thumbup=".$thumbup." where idx=".$bno.";";
    mysqli_query($con, $thum);
    mysqli_close($con);
    ?>
    <script>
    alert("추천되었습니다.");
    history.go(-1)
    </script>
</body>

</html>