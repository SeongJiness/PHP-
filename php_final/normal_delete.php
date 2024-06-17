<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>일반유저게시판</title>
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
   // 게시글 삭제 시 파일 삭제
$sql = "SELECT * FROM normal WHERE idx = '$bno'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$filename = $row['file'];

if(file_exists("./upload/".$filename)) {
    unlink("./upload/".$filename);
}
// 게시글 삭제
$sql = "DELETE FROM normal WHERE idx = '$bno'";
mysqli_query($con, $sql);

//댓글 삭제
$sql2 = "DELETE FROM normal_reply WHERE con_num = '$bno'";
mysqli_query($con, $sql2);
mysqli_close($con);
?>
    <script>
    alert("삭제되었습니다.");
    </script>
    <meta http-equiv="refresh" content="0 url=normal.php" />
</body>

</html>