<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자페이지</title>
    <link rel="stylesheet" type="text/css" href="./board/css/admin.css">
</head>

<body>
    <?php
session_start();

    if($_SESSION['userid'] != 'admin')
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            location.href = 'index.php';
            </script>
        ");
    }
    ?>
    <section>
        <div id="admin_box">
            <a href="index.php">홈으로 가기</a>
            <h3 id="member_title">
                관리자 모드 > 회원 관리
            </h3>

            <ul id="member_list">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">아이디</span>
                    <span class="col3">이름</span>
                    <span class="col4">레벨</span>
                    <span class="col5">수정</span>
                    <span class="col6">삭제</span>
                </li>
                <?php
	$con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql = "select * from member order by idx desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 회원 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
      $idx        = $row["idx"];
	  $id          = $row["id"];
	  $name        = $row["name"];
	  $point       = $row["point"];
?>

                <li>
                    <form method="post" action="admin_member_update.php?idx=<?=$idx?>">
                        <span class="col7"><?=$number?></span>
                        <span class="col8"><?=$id?></a></span>
                        <span class="col9"><?=$name?></span>
                        <span class="col10"><input type="text" name="point" value="<?=$point?>"></span>
                        <span class="col11"><button type="submit">수정</button></span>
                        <span class="col12"><button type="button"
                                onclick="location.href='admin_member_delete.php?idx=<?=$idx?>'">삭제</button></span>
                    </form>
                </li>

                <?php
   	   $number--;
   }
   mysqli_close($con);
?>
            </ul>

        </div>
    </section>

</body>


</html>