<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 삭제</title>
</head>

<body>
    <?php
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
    <script>
    let answer = confirm("정말로 삭제하시겠습니까?");
    if (answer === true) {
        location.href = "hard_delete.php?idx=" + encodeURIComponent(<?php echo $_GET['idx'];?>);
    } else {
        alert("홈으로 돌아갑니다.");
        location.href = "hard.php";
    }
    </script>

</body>

</html>