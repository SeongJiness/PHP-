<?php
$con = mysqli_connect("localhost", "user1", "12345", "sample");
?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css" />
</head>

<body>
    <div id="board_area">
        <!-- 18.10.11 검색 추가 -->
        <?php
        /* 검색 변수 */
        $catagory = isset($_GET['catgo']) ? $_GET['catgo'] : '';
        $search_con = isset($_GET['search']) ? $_GET['search'] : '';
        $catname = '';
        if ($catagory == 'title') {
            $catname = '제목';
        } else if ($catagory == 'name') {
            $catname = '작성자';
        } else if ($catagory == 'content') {
            $catname = '내용';
        }
        ?>
        <h1><?php echo $catname; ?>:<?php echo $search_con; ?> 검색결과</h1>
        <h4 style="margin-top:30px;"><a href="index.php">홈으로</a></h4>
        <?php
        if (!empty($catagory) && !empty($search_con)) {
            $sql2 = "select * from board where $catagory like '%$search_con%' order by idx desc";
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
                    while ($board = mysqli_fetch_array($result)) {

                        $title = $board["title"];
                        if (strlen($title) > 30) {
                            $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8") . "...", $board["title"]);
                        }
                        $sql3 = "select * from reply where con_num='" . $board['idx'] . "'";
                        $result2 = mysqli_query($con, $sql3);
                        $rep_count = mysqli_num_rows($result2);
                    ?>
            <tbody>
                <tr>
                    <td width="70"><?php echo $board['idx']; ?></td>
                    <td width="500">
                        <?php
                                    $lockimg = "<img src='./board/img/lock.png' alt='lock' title='lock' with='20' height='20' />";
                                    if ($board['lock_post'] == "1") {
                                        ?><a href='ck_read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title, $lockimg;
                                                                                                        } else { ?>

                            <!--- 추가부분 18.08.01 --->
                            <?php
                                        $boardtime = $board['date']; //$boardtime변수에 board['date']값을 넣음
                                        $timenow = date("Y-m-d"); //$timenow변수에 현재 시간 Y-M-D를 넣음

                                        if ($boardtime == $timenow) {
                                            $img = "<img src='./board/img/new.png' alt='new' title='new' />";
                                        } else {
                                            $img = "";
                                        }
                                        ?>
                            <!--- 추가부분 18.08.01 END -->
                            <a href='read.php?idx=<?php echo $board["idx"]; ?>'><span
                                    style="background:yellow;"><?php echo $title; ?></span><span
                                    class="re_ct">[<?php echo $rep_count; ?>]<?php echo $img; ?> </span></a></td>
                    <td width="120"><?php echo $board['name'] ?></td>
                    <td width="100"><?php echo $board['date'] ?></td>
                </tr>
            </tbody>
            <?php
                    }
                }}
            }
            ?>
        </table>
    </div>
</body>

</html>