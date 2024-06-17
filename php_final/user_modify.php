<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원수정</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css">
    <script>
    function main() {
        location.href = "index.php";
    }

    function check() {
        if ((document.modify.userpw.value == "") || (document.modify.userpw2.value == "")) {
            alert("비밀번호를 입력하세요");
            return;
        }

        if (document.modify.userpw.value != document.modify.userpw2.value) {
            alert("비밀번호가 서로 다릅니다.");
            return;
        }

        if (document.modify.name.value == "") {
            alert("이름을 입력하세요");
            return;
        }


        document.modify.submit();
    }
    </script>
</head>

<body>
    <?php 
	include "enter.php";
    $con = mysqli_connect("localhost", "user1" , "12345","sample");
    $uid = $_SESSION['userid'];
    $sql = "select * from member where id = '$uid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
     mysqli_close($con);
?>
    <div id="join_form_in">
        <h2>회원수정</h2>
        <button onclick="main()">홈으로</button>
        <form name="modify" action="user_modify_ok.php" method="post">
            <div id="join_f">
                <div class="form-group">
                    <label for="userid">아이디</label>
                    <div class="mb"><input type="text" class="inp" id="userid" name="userid"
                            value='<?= $_SESSION["userid"]?>' disabled /></div>
                </div>
                <div class="form-group">
                    <label for="userpw">비밀번호</label>
                    <div class="mb"><input type="password" class="inp" id="userpw" name="userpw"
                            placeholder="수정할 비밀번호" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="userpw">비밀번호확인</label>
                    <div class="mb"><input type="password" class="inp" id="userpw2" name="userpw2"
                            placeholder="비밀번호확인" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">이름</label>
                    <div class="mb"><input type="text" class="inp" id="name" name="name" value='<?=$row["name"]?>' />
                    </div>
                </div>
                <div class="form_btn">
                    <button onClick="check()" type="button" class="form_bt">수정완료</button>
                    <button type="reset" class="form_bt2">초기화</button>
                </div>
            </div> <!-- join_f end -->
        </form>
    </div>
</body>

</html>