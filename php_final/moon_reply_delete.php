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
$con = mysqli_connect("localhost", "user1" , "12345","sample");
$rno = $_POST['rno']; 
$sql = "select * from moon_reply where idx='".$rno."'";//reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$sql = mysqli_query($con, $sql);
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = "select * from moon where idx='".$bno."'";//board테이블에서 idx가 bno변수에 저장된 값을 찾음
$sql2 = mysqli_query($con, $sql2);
$board = $sql2->fetch_array();

$pwk = $_POST['pw'];
$bpw = $reply['pw'];

if(password_verify($pwk, $bpw)) 
	{
		$sql = "delete from moon_reply where idx='".$rno."'"; 
		mysqli_query($con, $sql);
		mysqli_close($con);
		?>

<script>
alert('댓글이 삭제되었습니다.');
location.replace("moon_read.php?idx=<?php echo $board["idx"]; ?>");
</script>
<?php 
	}else{ ?>
<script>
alert('비밀번호가 틀립니다');
history.back();
</script>
<?php } ?>