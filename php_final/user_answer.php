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
	include "enter.php";
	?>
    <script>
    let answer = confirm("정말로 탈퇴하시겠습니까?");
    if (answer === true) {
        location.href = "user_delete.php";
    } else {
        alert("홈으로 돌아갑니다.");
        location.href = "index.php";
    }
    </script>

</body>

</html>