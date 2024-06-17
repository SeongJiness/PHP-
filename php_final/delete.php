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
    $sql = "delete from board where idx='$bno';";
    mysqli_query($con, $sql);
    mysqli_close($con);
?>
    <script>
    confirm("삭제되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0 url=index.php" />
</body>

</html>