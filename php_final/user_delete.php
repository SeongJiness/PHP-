<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원삭제</title>
</head>

<body>
    <?php
// DB 열기
     $con = mysqli_connect("localhost", "user1" , "12345","sample"); // localhost DB가 존재 하는 
     // 명령어를 실행 sql 쿼리로 실행
	include "enter.php";
     $uid = $_SESSION["userid"];
     $sql = "delete from member where id = '$uid'";
     
     mysqli_query($con, $sql); // 실행코드

     // DB 닫기
     mysqli_close($con);

     unset($_SESSION["userid"]);
    ?>
    <script>
    alert("탈퇴되었습니다.");
    location.href = "index.php"; // 강제 페이지이동
    </script>
</body>

</html>