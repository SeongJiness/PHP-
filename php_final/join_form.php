<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" type="text/css" href="./board/css/style.css">
    <script>
    var isDuplicateChecked = false;

    function idcheck() {
        y = window.open('id_equal.php?userid=' + document.join.userid.value, 'y', 'width=300,height=300');
    }

    function main() {
        location.href = "index.php";
    }

    function check() {
        if (document.join.userid.value == "") {
            alert("아이디를 입력하세요");
            return;
        }

        if (document.join.userid.value.length > 15) {
            alert("아이디는 15자 이내여야 합니다");
            return;
        }

        if ((document.join.userpw.value == "") || (document.join.userpw2.value == "")) {
            alert("비밀번호를 입력하세요");
            return;
        }

        if (document.join.userpw.value != document.join.userpw2.value) {
            alert("비밀번호가 서로 다릅니다.");
            return;
        }

        if (document.join.name.value == "") {
            alert("이름을 입력하세요");
            return;
        }

        if (!isDuplicateChecked) {
            alert("아이디 중복확인을 해주세요.");
            return;
        }

        document.join.submit();

    }
    </script>
</head>

<body>
    <?php 
    $con = mysqli_connect("localhost", "user1" , "12345","sample");

if(isset($_SESSION['userid'])){
	echo "<script>alert('잘못된 접근입니다.');
    location.href='index.php';
    </script>"; 
}else{
?>
    <div id="join_form_in">
        <h2>회원가입</h2>
        <button onclick="main()">홈으로</button>
        <form name="join" action="join_ok.php" method="post">
            <div id="join_f">
                <div class="form-group">
                    <label for="userid">아이디</label>
                    <div class="mb"><input type="text" class="inp" id="userid" name="userid" placeholder="아이디" />
                        <input type="button" value="중복확인" onClick="javascript:idcheck()">
                    </div>
                </div>
                <div class="form-group">
                    <label for="userpw">비밀번호</label>
                    <div class="mb"><input type="password" class="inp" id="userpw" name="userpw" placeholder="비밀번호" />
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
                    <div class="mb"><input type="text" class="inp" id="name" name="name" placeholder="이름을 입력해 주세요" />
                    </div>
                </div>
                <div class="form_btn">
                    <button onClick="check()" type="button" class="form_bt" id="registerBtn">회원가입</button>
                    <button type="reset" class="form_bt2">초기화</button>
                </div>
            </div>
        </form>
    </div>
    <?php }?>
</body>

</html>