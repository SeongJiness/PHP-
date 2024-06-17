<!--- 게시글 수정 -->
<?php
	$con = mysqli_connect("localhost", "user1" , "12345","sample");
   
	$bno = $_GET['idx'];
    if($bno == "") {
        echo("
        <script>
        alert('잘못된 접근입니다.!!');
        location.href = 'index.php';
        </script>
    ");
    }
    $sql = "select * from normal where idx='$bno';"; 
    $sql = mysqli_query($con, $sql);
	$board = $sql->fetch_array();
    $filename = substr($board['file'], 20);
    mysqli_close($con);
 ?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" href="./board/css/style.css">
</head>

<body>
    <?php
	include "enter.php";
	?>
    <div id="board_write">
        <a href="normal.php">돌아가기</a>
        <h1>일반유저게시판</h1>

        <h4>글을 수정합니다.</h4>
        <div id="write_area">
            <form action="normal_modify_ok.php?idx=<?php echo $bno; ?>" method="post" enctype="multipart/form-data">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목은 100글자만 입력이 가능합니다."
                        maxlength="100" required><?php echo $board['title']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="name" id="uname" rows="1" cols="55" placeholder="글쓴이" maxlength="100"
                        disabled><?php echo $board['name']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용은 100글자만 입력가능합니다." required
                        maxlength="100"><?php echo $board['content']; ?></textarea>
                </div>
                <div id="in_pw">
                    <input type="password" name="pw" id="upw" placeholder="비밀번호" required />
                </div>
                <div id="in_lock">
                    <?php
                    // 데이터베이스에서 lock_post 값을 가져옴
                    $lock_post = $board['lock_post'];

                    // lock_post 값이 1인 경우에 체크되어 있는 체크박스를 만들기 위한 코드
                    if($lock_post == 1) {
                    $lockpost_checked = "checked";
                    } else {
                    $lockpost_checked = "";
                    }
                    ?>

                    <input type="checkbox" value="1" name="lockpost" <?php echo $lockpost_checked;?> />
                    해당글을 잠급니다.
                </div>
                <div id="in_file">
                    첨부 파일 : <span class="col2"><?=$filename ?></span> <br />
                    <?php
                    if($board['file'] != "") {
                    echo('<input type="radio" name="s_file" value="none"/> 업로드된 파일 제거 <br/>');
                    }
                    ?>
                    수정 할 파일 : <input type="file" name="b_file" value="1" id="fileInput"
                        onchange="return validateFile(this)" />
                </div>

                <div class="bt_se">
                    <button type="submit">글 작성</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    function validateFile(fileInput) {
        var file = fileInput.files[0]; // 첫 번째 선택된 파일 가져오기
        var maxSize = 8 * 1024 * 1024; // 8MB 제한 (바이트 단위)

        if (file.size > maxSize) {
            alert('파일 크기가 너무 큽니다. 최대 크기는 8MB입니다.');
            fileInput.value = ''; // 선택한 파일 지우기
            return false;
        }
    }
    </script>
</body>

</html>