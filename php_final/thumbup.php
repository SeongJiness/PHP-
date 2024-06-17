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
    $thumbup = "select thumbup from board where idx='$bno';";
    $thumbup = mysqli_query($con, $thumbup);
	$thumbup = mysqli_fetch_array($thumbup);
    $thumbup = $thumbup['thumbup'] + 1;
    $thum = "update board set thumbup=".$thumbup." where idx=".$bno.";";
    mysqli_query($con, $thum);
    mysqli_close($con);
    ?>
    <script>
    alert("추천되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0 url=index.php" />
</body>

</html>