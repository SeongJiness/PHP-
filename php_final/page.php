<!--페이징 넘버-->
<div id="page_num">
    <ul>
        <?php
                 if($page <= 1) {  //$page변수가 1보다 작거나 같으면 "처음" 링크를 출력
                    echo "<li class='fo_re'>처음</li>";
                } else {
                    echo "<li><a href='?page=1'>처음</a></li>";
                }
                if($page <= 1) { 
                } else { // $page변수가 1보다 작거나 같으면 "이전" 링크를 출력하지 않습니다.
                    $pre = $page-1;
                    echo "<li><a href = '?page=$pre'>이전</a></li>";
                }
                for($i = $block_start; $i<=$block_end; $i++) { //$block_start부터 $block_end까지의 페이지 번호에 대한 링크를 출력합니다. 
                    if($page == $i) { //현재 페이지 번호와 같은 페이지 번호는 "fo_re" 클래스를 추가하여 굵게 표시합니다.
                        echo "<li class='fo_re'>[$i]</li>";
                    }else{
                        echo "<li><a href='?page=$i'>[$i]</a></li>";
                    }
                }
                if($block_num >= $total_block) { //$block_num이 $total_block보다 크거나 같으면 "다음" 링크를 출력하지 않습니다. 
                }else{ // 그렇지 않으면 "다음" 링크에 해당하는 페이지 번호를 구하고, 해당 페이지 번호에 대한 링크를 출력합니다.
                    $next= $page + 1;
                    echo "<li><a href='?page=$next'>다음</a></li>";
                }
                if($page >= $total_page) { // $page 변수가 $total_page보다 크거나 같으면 "마지막" 링크를 출력
                    echo "<li class='fo_re'>마지막</li>";
                }else{  //그렇지 않으면 "마지막" 링크에 해당하는 페이지 번호를 출력합니다.
                    echo "<li><a href='?page=$total_page'>마지막</a></li>";
                }
                
                ?>
    </ul>
</div>
<div id="write_btn">
    <a href="write.php"><button>글쓰기</button></a>
</div>