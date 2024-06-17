<?php
$con = mysqli_connect("localhost", "user1", "12345", "sample");
?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>일반유저게시판</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style4.css" />
</head>

<body>
    <?php
	include "enter.php";
    if(!isset($_GET['search'])) {
        echo("
        <script>
        alert('잘못된 접근입니다.!!');
        location.href = 'index.php';
        </script>
    ");
    }
	?>
    <div id="board_area">
        <?php
 
  /* 검색 변수 */
$catagory = isset($_GET['catgo']) ? $_GET['catgo'] : '';
$search_con = isset($_GET['search']) ? $_GET['search'] : '';
?>
        <?php if($catagory=='title'){
        $catname = '제목';
    } else if($catagory=='name'){
        $catname = '작성자';
    } else if($catagory=='content'){
        $catname = '내용';
    } ?>
        <h1>일반유저게시판</h1>
        <h2><?php echo $catname; ?>:<?php echo $search_con; ?> 검색결과</h2>
        <h4 style="margin-top:30px;"><a href="free.php">홈으로</a></h4>
        <div id="search_box2">
            <form action="normal_search_result.php" method="get">
                <select name="catgo">
                    <option value="title">제목</option>
                    <option value="name">글쓴이</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required" /> <button>검색</button>
            </form>
        </div>
        <?php
        $sql2 = "select * from normal where $catagory like '%$search_con%' order by idx desc";
        $result = mysqli_query($con, $sql2);
        $count = mysqli_num_rows($result);
        if ($count == 0) {
            echo "<p>검색 결과가 없습니다.</p>";
            } else {
       ?>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>
            <?php
          $sql2 = "select * from normal where $catagory like '%$search_con%' order by idx desc";
          $sql2 = mysqli_query($con, $sql2);
          $img = "";
          while($board = $sql2->fetch_array()){
           
          $title=$board["title"]; 
            if(strlen($title)>30)
              { 
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
            $sql3 = "select * from normal_reply where con_num='".$board['idx']."'";
            $sql3 = mysqli_query($con, $sql3);
            $rep_count = mysqli_num_rows($sql3);
        ?>
            <tbody>
                <tr>
                    <td width="70"><?php echo $board['idx']; ?></td>
                    <td width="500">
                        <?php 
              $lockimg = "<img src='./board/img/lock.png' alt='lock' title='lock' with='20' height='20' />";
              if($board['lock_post']=="1")
              { ?><a href='normal_ck_read.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
              }else{?>


                            <?php
          $boardtime = $board['date']; //$boardtime변수에 board['date']값을 넣음
          $timenow = date("Y-m-d"); //$timenow변수에 현재 시간 Y-M-D를 넣음
          
          if($boardtime==$timenow){
            $img = "<img src='./board/img/new.png' alt='new' title='new' />";
          }else{
            $img ="";
          }
          ?>

                            <a href='normal_read.php?idx=<?php echo $board["idx"]; ?>'><span><?php echo $title; }?></span><span
                                    class="re_ct"><?php echo $img; ?> </span></a></td>
                    <td width="120"><?php echo $board['name']?></td>
                    <td width="100"><?php echo $board['date']?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>

                </tr>
            </tbody>

            <?php }} ?>
        </table>

    </div>
</body>

</html>