<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>별신게시판</title>
    <link rel="stylesheet" type="text/css" href="./board/css/board.css">

</head>

<body>
    <?php
$con = mysqli_connect("localhost", "user1" , "12345","sample");
session_start();;
?>
    <a class="link" href="index.php">홈으로</a>
    <div id="board_area">
        <h1>별신게시판</h1>
        <h4>별신등급이상 회원만 글을 볼 수 있는 게시판입니다.</h4>
        <span id="mem_info">
            <?php
if(isset($_SESSION['userid'])){ //세션 userid가 있으면 페이지를 보여줍니다
// lo_point변수에 sql쿼리결과를 저장
$sql = "select * from member where id='".$_SESSION['userid']."'";
$sql = mysqli_query($con, $sql); 
$lo_point = $sql->fetch_array();
?>
            <?php echo $_SESSION['username']; ?>님 어서오세요. &nbsp;&nbsp;&nbsp;<a href="logout.php">로그아웃</a><br />
            <?php
        switch ($lo_point['point']) {
        case '0':
        echo "현재등급 : 새싹등급 0포인트";
        break;
                
        case '1':
        echo "현재등급 : 일반등급 1포인트";
        break;

        case '2':
        echo "현재등급 : 열심등급 2포인트";
        break;
        
        case '3';
        echo "현재등급 : 별신등급 3포인트";
        break;

        case '4';
        echo "현재등급 : 달신등급 4포인트";
        break;

        default:
        echo "현재등급 : 슈퍼등급 ",$lo_point['point'],"포인트";
        break;
    } //switch문 끝 
?>
            <?php }else{ ?>
            <!--세션 userid체크해서 세션값 없으면 로그인 폼 표시 -->
            <form action="login_ok.php" method="post">
                <ul>
                    <li><input type="text" name="userid" placeholder="아이디" required /></li>
                    <li><input type="text" name="userpw" placeholder="비밀번호" required /></li>
                    <li><input type="submit" value="로그인"></li>
                    <li> <a href='join_form.php'>회원가입</a></li>
                </ul>
            </form>
            <?php } ?>
        </span>
        <?php

if(isset($_SESSION['userid'])){ // 로그인한 사용자인 경우
        echo '<div id="search_box">
            <form action="star_search_result.php" method="get">
                <select name="catgo">
                    <option value="title">제목</option>
                    <option value="name">글쓴이</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required" /><button>검색</button>
            </form>
        </div>';}
        ?>
        <div id="board_list">
            <p><b>게시판 선택</b></p>
            <ul>
                <li><a href="free.php">자유게시판</a></li>
                <li><a href="normal.php">일반유저게시판</a></li>
                <li><a href="hard.php">열심게시판</a></li>
                <li><a href="star.php">별신게시판</a></li>
                <li><a href="moon.php">달신게시판</a></li>
            </ul>
        </div>
        <?php
				if(!isset($_SESSION['userid'])){
					echo "<div id='not_use'>로그인을 해야 볼 수 있습니다.</div>";
				}else if( $lo_point['point']=='3' || $lo_point['point']>'3'){
			?>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="100">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                    <th width="100">추천수</th>
                </tr>
            </thead>
            <?php
        if(isset($_GET['page'])){
         $page = $_GET['page'];
           }else{
             $page = 1;
           }
             $sql = "select * from star";
             $sql = mysqli_query($con, $sql);
             $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
             $list = 10; //한 페이지에 보여줄 개수
             $block_ct = 5; //블록당 보여줄 페이지 개수

             $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
             $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
             $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

             $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
             if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
             $total_block = ceil($total_page/$block_ct); //블럭 총 개수
             $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

             $sql2 = "select * from star order by idx desc limit $start_num, $list";
             $sql2 = mysqli_query($con, $sql2);  
             while($board = $sql2->fetch_array()){
             $title=$board["title"]; 
               if(strlen($title)>30)
               { 
                 $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
               }
               $con_idx = $board["idx"];
               $reply_count = "SELECT COUNT(*) as cnt FROM star_reply where con_num=$con_idx";
               $reply_count = mysqli_query($con, $reply_count);
               $con_reply_count = $reply_count->fetch_array();
             ?>

            <tbody>
                <tr>

                    <td width="70"><?php echo $board['idx']; ?></td>
                    <td width="500"><?php
                     $lockimg = "<img src='board/img/lock.png' alt='lock' title='lock' width='20' height='20'/>";
                     $boardtime = $board['date'];
                     $timenow = date("Y-m-d");

                     if($boardtime==$timenow) {
                        $img = "<img src ='./board/img/new.png' alt='new' title='new' />";
                    } else {
                        $img = "";
                    }
                    if($board['lock_post'] == "1") {
                        ?><a href="star_ck_read.php?idx=<?php echo $board["idx"];?>"><?php echo $title, $lockimg, $img; 
                     }else {?>
                            <a href="star_read.php?idx=<?php echo $board["idx"];?>"><?php echo $title,$img;}?></a>
                    </td>

                    <td width="120"><?php echo $board['name']?></td>
                    <td width="100"><?php echo $board['date']?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                    <td width="100"><?php echo $board['thumbup']?></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <?php
            include "page.php";
            ?>
    </div>

    <?php }else{
			echo "<div id='not_use'>별신등급만 볼 수 있는 게시판입니다.<br />글을 작성해서 3포인트를 적립하세요.(별신등급 3포인트)</div>";
		}?>
    </div>
</body>

</html>
</body>

</html>