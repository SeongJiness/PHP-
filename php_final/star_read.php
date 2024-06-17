<?php $con = mysqli_connect("localhost", "user1" , "12345","sample");?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>별신게시판</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css" />
    <link rel="stylesheet" type="text/css" href="./board/css/jquery-ui.css" />
    <script src="./board/js/jquery-3.2.1.min.js"></script>
    <script src="./board/js/jquery-ui.js"></script>
    <script src="./board/js/common.js"></script>
</head>

<body>
    <?php
	    include "enter.php";
		$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
        if($bno == "") {
            echo("
            <script>
            alert('잘못된 접근입니다.!!');
            location.href = 'index.php';
            </script>
        ");
        }
        $hit = "select * from star where idx ='".$bno."'";
        $hit = mysqli_query($con, $hit);
		$hit = mysqli_fetch_array($hit);
		$hit = $hit['hit'] + 1;
        $fet = "update star set hit = '".$hit."' where idx = '".$bno."'";
        $fet = mysqli_query($con, $fet);
        $sql = "select * from star where idx='".$bno."'";
        $sql = mysqli_query($con, $sql);
		$board = $sql->fetch_array();
	?>
    <!-- 글 불러오기 -->
    <div id="board_read">
        <h2><?php echo $board['title']; ?></h2>
        <div id="user_info">
            <?php echo $board['name']; ?> <?php echo $board['date']; ?>
            조회:<?php echo $board['hit']; ?>추천수:<?php echo $board['thumbup']; ?>
            <div id="bo_line"></div>
        </div>
        <div>
            파일(다운로드 가능) : <a href="upload/<?php echo $board['file'];?>" download>
                <?php $filename = substr($board['file'], 20); 
            echo $filename;
            ?></a>
        </div>

        <div id="bo_content">
            <?php echo nl2br("$board[content]"); ?>
        </div>
        <!-- 목록, 수정, 삭제 -->
        <div id="bo_ser">
            <ul>
                <li><a href="star.php">[목록으로]</a></li>
                <li><a href="star_thumbup.php?idx=<?php echo $board['idx']; ?>">[추천]</a></li>
                <?php
               if(isset($_SESSION['userid']) && $_SESSION['userid'] == $board['name']) {
                echo '<li><a href="star_modify.php?idx='. $board['idx']. '">[수정]</a></li>';
                echo '<li><a href="star_answer.php?idx='. $board['idx']. '">[삭제]</a></li>';
            }
                ?>
            </ul>
        </div>
    </div>
    <!--- 댓글 불러오기 -->
    <div class="reply_view">
        <h3>댓글목록</h3>
        <?php
			$sql3 = "select * from star_reply where con_num='".$bno."' order by idx desc";
            $sql3 = mysqli_query($con, $sql3);
			while($reply = $sql3->fetch_array()){ 
		?>
        <div class="dap_lo">
            <div><b><?php echo $reply['name'];?></b></div>
            <div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
            <div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
            <div class="rep_me rep_menu">
                <?php
                if(isset($_SESSION['userid']) && $_SESSION['userid'] == $reply['name']) {
                    echo '<button class="dat_edit_bt">수정</button>';
                    echo '<button class="dat_delete_bt">삭제</button>';
                }
                ?>
            </div>
            <!-- 댓글 수정 폼 dialog -->
            <div class="dat_edit">
                <form method="post" action="star_rep_modify_ok.php">
                    <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
                    <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                    <input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
                    <textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
                    <input type="submit" value="수정하기" class="re_mo_bt" id="modify-btn">
                </form>
            </div>

            <script>
            // 수정 폼 숨기기
            document.querySelector('.dat_edit').style.display = 'none';

            // 수정 버튼 클릭 시 수정 폼 보이기
            document.querySelector('#modify-btn').addEventListener('click', function() {
                document.querySelector('.dat_edit').style.display = 'block';
            });
            </script>
            <!-- 댓글 삭제 비밀번호 확인 -->
            <div class='dat_delete'>
                <form action="star_reply_delete.php" method="post">
                    <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
                    <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                    <p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인"></p>
                </form>
            </div>

            <script>
            // 삭제 폼 숨기기
            document.querySelector('.dat_delete').style.display = 'none';

            // 삭제 버튼 클릭 시 삭제 폼 보이기
            document.querySelector('.delete-btn').addEventListener('click', function() {
                document.querySelector('.dat_delete').style.display = 'block';
            });
            </script>
        </div>
        <?php } mysqli_close($con);?>

        <!--- 댓글 입력 폼 -->
        <div class="dap_ins">
            <form action="star_reply.php?idx=<?php echo $bno; ?>" method="post">
                <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15"
                    value="<?=$_SESSION['userid']?>" disabled>
                <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
                <div style="margin-top:10px; ">
                    <textarea name="content" class="reply_content" id="re_content"></textarea>
                    <button id="rep_bt" class="re_bt">댓글</button>
                </div>
            </form>
        </div>
    </div>
    <!--- 댓글 불러오기 끝 -->
    <div id="foot_box"></div>
    </div>
</body>

</html>