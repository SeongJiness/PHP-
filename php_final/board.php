<?php $con = mysqli_connect("localhost", "user1" , "12345","sample");?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css" />
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "user1" , "12345","sample");
    include "header.php";
    ?>
    <div id="board_area">
        <h1>자유게시판</h1>
        <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
        <div id="search_box">
            <form action="search_result.php" method="get">
                <select name="catgo">
                    <option value="title">제목</option>
                    <option value="name">글쓴이</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required" /><button>검색</button>
            </form>
        </div>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <!-- 추천수 항목 추가 -->
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
             $sql = "select * from free";
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

             $sql2 = "select * from free order by idx desc limit $start_num, $list";
             $sql2 = mysqli_query($con, $sql2);  
             while($board = $sql2->fetch_array()){
             $title=$board["title"]; 
               if(strlen($title)>30)
               { 
                 $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
               }
               $con_idx = $board["idx"];
               $reply_count = "SELECT COUNT(*) as cnt FROM reply where con_num=$con_idx";
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
                        ?><a href="ck_read.php?idx=<?php echo $board["idx"];?>"><?php echo $title."[".$con_reply_count["cnt"]."]", $lockimg, $img; 
                     }else {?>
                            <a
                                href="read.php?idx=<?php echo $board["idx"];?>"><?php echo $title."[".$con_reply_count["cnt"]."]",$img;}?></a>
                    </td>

                    <td width="120"><?php echo $board['name']?></td>
                    <td width="100"><?php echo $board['date']?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                    <!-- 추천수 표시해주기 위해 추가한 부분 -->
                    <td width="100"><?php echo $board['thumbup']?></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <!--페이징 넘버-->
        <div id="page_num">
            <ul>
                <?php
                if($page <= 1) {
                    echo "<li class='fo_re'>처음</li>";
                } else {
                    echo "<li><a href='?page=1'>처음</a></li>";
                }
                if($page <= 1) { 
                } else {
                    $pre = $page-1;
                    echo "<li><a href = '?page=$pre'>이전</a></li>";
                }
                for($i = $block_start; $i<=$block_end; $i++) {
                    if($page == $i) {
                        echo "<li class='fo_re'>[$i]</li>";
                    }else{
                        echo "<li><a href='?page=$i'>[$i]</a></li>";
                    }
                }
                if($block_num >= $total_block) {
                }else{
                    $next= $page + 1;
                    echo "<li><a href='?page=$next'>다음</a></li>";
                }
                if($page >= $total_page) {
                    echo "<li class='fo_re'>마지막</li>";
                }else{
                    echo "<li><a href='?page=$total_page'>마지막</a></li>";
                }
                
                ?>
            </ul>
        </div>
        <div id="write_btn">
            <a href="write.php"><button>글쓰기</button></a>
        </div>
    </div>
</body>

</html>