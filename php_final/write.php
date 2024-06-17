<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>글쓰기</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css" />
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "user1" , "12345","sample");
	include "enter.php";
        $sql = "select * from member where id='".$_SESSION['userid']."'";
        $sql = mysqli_query($con, $sql); 
        $lo_point = $sql->fetch_array();
?>

    <div id="board_write">
        <a href="index.php">돌아가기</a>

        <div id="write_area">
            <form onsubmit="return validateForm()" action="write_ok.php" method="post" enctype="multipart/form-data">
                <?php
					switch ($lo_point['point']) {
					case '0':
					echo "현재등급 : 새싹등급";
					break;

					case '1':
					echo "현재등급 : 일반등급";
					break;

					case '2':
					echo "현재등급 : 열심등급";
					break;
					
					case '3';
					echo "현재등급 : 별신등급";
					break;

					case '4';
					echo "현재등급 : 달신등급";
					break;

					default:
					echo "현재등급 : 슈퍼등급 ";
					break;
				}//switch문 끝  
			?>
                <br>
                <select id="opt" name="opt">
                    <option value="default" selected>게시판을 선택해주세요</option>
                    <option value="0">자유게시판</option>
                    <option value="1">일반유저게시판</option>
                    <option value="2">열심게시판</option>
                    <option value="3">별신게시판</option>
                    <option value="4">달신게시판</option>
                </select>
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목은 100글자만 입력가능합니다."
                        maxlength="100" required></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="name" id="uname" rows="1" cols="55" placeholder="아이디 : <?=$_SESSION['userid']?>"
                        disabled maxlength="100"></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용은 100글자만 입력가능합니다." required
                        maxlength="100"></textarea>
                </div>
                <div id="in_pw">
                    <input type="password" name="pw" id="upw" placeholder="비밀번호" required />
                </div>
                <div id="in_lock">
                    <input type="checkbox" value="1" name="lockpost" /> 해당글을 잠급니다.
                </div>
                <div id="in_file">
                    <input type="file" name="b_file" id="fileInput" onchange="return validateFile(this)" />
                </div>
                <div class="bt_se">
                    <button type="submit">글 작성</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    function validateForm() {
        var board = document.getElementById("opt").value;
        if (board == "default") {
            alert("게시판을 선택해주세요.");
            return false;
        }

    }

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