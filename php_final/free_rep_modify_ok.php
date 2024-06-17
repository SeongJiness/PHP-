<?php
include "enter.php";
if($_POST['rno'] == "") {
    echo("
    <script>
    alert('잘못된 접근입니다.!!');
    location.href = 'index.php';
    </script>
");
}
$con = mysqli_connect("localhost", "user1" , "12345","sample");
$rno = $_POST['rno'];//댓글번호
$sql = "select * from free_reply where idx='".$rno."'"; //reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$sql = mysqli_query($con, $sql);
$reply = $sql->fetch_array();

$bno = $_POST['b_no']; //게시글 번호
$sql2 = "select * from free where idx='".$bno."'";//board테이블에서 idx가 bno변수에 저장된 값을 찾음
$sql2 = mysqli_query($con, $sql2);
$board = $sql2->fetch_array();

$input_pw = $_POST['pw'];
$db_pw = $reply['pw'];

// reply 테이블의 idx가 rno변수에 저장된 값의 content를 선택해서 값 저장
// 수정시 비밀번호 체크
if (password_verify($input_pw, $db_pw)) {
    $sql3 = "UPDATE free_reply SET content='" . $_POST['content'] . "' WHERE idx = '" . $rno . "'"; 
    mysqli_query($con, $sql3);
    mysqli_close($con);
    ?>
<script type="text/javascript">
alert('수정되었습니다.');
location.replace("free_read.php?idx=<?php echo $bno; ?>");
</script>
<?php
    } else { ?>
<script type="text/javascript">
alert('비밀번호가 틀립니다');
history.back();
</script>
<?php } ?>