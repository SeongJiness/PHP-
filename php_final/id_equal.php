<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>아이디 확인</title>
</head>

<body>
    <?php
    if(isset($_GET['userid']) == "") {
        echo("
        <script>
        alert('잘못된 접근입니다.!!');
        location.href = 'index.php';
        </script>
    ");
    }
    ?>
    <h3>*아이디 중복확인 결과*</h3> <br>
    <?php

    $userid = $_GET['userid'];
    echo "입력 ID : ".$userid. "<br>";

// DB 열기
$con = mysqli_connect("localhost", "user1" , "12345","sample"); // localhost DB가 존재 하는 컴퓨터 멀리 있으면 ip를 입력



// 명령어를 실행 sql 쿼리로 실행
$sql = "select * from member where id ='$userid'";

$result = mysqli_query($con, $sql); // 실행코드

if(mysqli_num_rows($result) != 0) {
    $qqq = "<script>window.opener.document.join.userid.value ='';
    window.opener.document.join.userid.focus();
    </script>";
    echo $qqq;
    echo "아이디가 중복됩니다. <br>";
    echo "<a href ='javascript:window.close()'>[창닫기]</a>";
}
elseif($userid == ""){
    echo "아이디를 입력해주세요 <br>";
    echo "<a href ='javascript:window.close()'>[창닫기]</a>";
}

else{
    echo "사용가능합니다. <br>";
    echo "<a href ='javascript:window.opener.isDuplicateChecked = true; window.close()'>[창닫기]</a>";
}

// DB 닫기
mysqli_close($con);


?>
</body>

</html>