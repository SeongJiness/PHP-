<?php
    session_start();
if($_SESSION['userid'] == "")
    {
        echo("
            <script>
            alert('잘못된 접근입니다.!!');
            location.href = 'index.php';
            </script>
        ");
    }


    ?>