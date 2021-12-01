<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - Question Done</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="プログラミングに関する質問をするサイトです">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/print.css" media="print">
<script src="js/openclose.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<style>
.menu1 a {background-position: -10px -10px;}
.menu2 a {background-position: -10px -130px;}
.menu3 a {background-position: -10px -250px;}
.menu4 a {background-position: -10px -370px;}
.menu5 a {background-position: -10px -490px;}
</style>
<![endif]-->
</head>


<body class="company">

<div id="container">

<header class="pc">

	<h1 class="logo"><a href="index.html"><img src="images/logo.png"></a></h1>

	<!--メニュー-->
	<nav id="menubar">
	<ul>
	<li class="menuimg menu1 current"><a href="home.php"><span>Home</span></a></li>
	<li class="menuimg menu2"><a href="q_new.php"><span>Question</span></a></li>
	<li class="menuimg menu3"><a href="a_list.php"><span>Answer</span></a></li>
	<li class="menuimg menu4"><a href="q_hist.php"><span>Histroty</span></a></li>
	<li class="menuimg menu5"><a href="contact.html"><span>Contact</span></a></li>
	</ul>
	</nav>
	<ul class="icon">
	<li><a href="#"><img src="images/icon_facebook.png" alt="Facebook"></a></li>
	<li><a href="#"><img src="images/icon_twitter.png" alt="Twitter"></a></li>
	<li><a href="#"><img src="images/icon_instagram.png" alt="Instagram"></a></li>
	<li><a href="#"><img src="images/icon_youtube.png" alt="YouTube"></a></li>
	</ul>

</header>


<div id="contents">

<div id="main">

<span id="pagetop"></span>

<section>

<h2 class="title">Question Form<span>新規質問</span></h2>

<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print '<h2>ログインされていません</h2><br />';
    print '※このページには直接アクセスできません。'; ?>
    <div class="normal">
        <a href="login.html">ログイン画面へ</a>
    </div>
    <?php
    exit();
}
else
{

    $q_lang_type=$_POST['lang_type'];
    $q_title=$_POST['title'];
    $q_main=$_POST['main'];
    $q_soce=$_POST['soce'];

    $point_check=$_SESSION['m_point'];

    $q_lang_type=htmlspecialchars($q_lang_type,ENT_QUOTES,'UTF-8');
    $q_title=htmlspecialchars($q_title,ENT_QUOTES,'UTF-8');
    $q_main=htmlspecialchars($q_main,ENT_QUOTES,'UTF-8');
    $q_soce=htmlspecialchars($q_soce,ENT_QUOTES,'UTF-8');

    try
    {
        $dsn='mysql:dbname=bolt;host=localhost;charset=utf8';
        $user='root';
        $password='';
        $dbh=new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='INSERT INTO question(code_member,id_member,dl_date,q_date,lang_type,title,main,soce) VALUES (?,?,?,?,?,?,?,?)';
        $stmt=$dbh->prepare($sql);
        $data[]=$_SESSION["m_code"];
        $data[]=$_SESSION["m_id"];
        $data[]=date('Y-m-d H:i:s');
        $data[]=date('Y-m-d H:i:s');
        $data[]=$q_lang_type;
        $data[]=$q_title;
        $data[]=$q_main;
        $data[]=$q_soce;
        $stmt->execute($data);

        $sql2='UPDATE member SET point=point-100 WHERE code=? ';
        $stmt2=$dbh->prepare($sql2);
        $data2[]=$_SESSION['m_code'];
        $stmt2->execute($data2);

        $sql3='SELECT point FROM member WHERE code=? ';
        $stmt3=$dbh->prepare($sql3);
        $data3[]=$_SESSION['m_code'];
        $stmt3->execute($data3);

        $rec=$stmt3->fetch(PDO::FETCH_ASSOC);
        $_SESSION['m_point']=$rec['point'];

        if(1500 < $point_check )
        {
            if(3000 < $point_check )
            {
                $sql4='UPDATE member SET rank=? WHERE code=? ';
                $stmt4=$dbh->prepare($sql4);
                $data4[]='ゴールド';
                $data4[]=$_SESSION['m_code'];
                $stmt4->execute($data4);
    
                $sql5='SELECT rank FROM member WHERE code=? ';
                $stmt5=$dbh->prepare($sql5);
                $data5[]=$_SESSION['m_code'];
                $stmt5->execute($data5);
    
                $rec=$stmt5->fetch(PDO::FETCH_ASSOC);
                $_SESSION['m_rank']=$rec['rank'];
            }
            else
            {
                $sql4='UPDATE member SET rank=? WHERE code=? ';
                $stmt4=$dbh->prepare($sql4);
                $data4[]='シルバー';
                $data4[]=$_SESSION['m_code'];
                $stmt4->execute($data4);

                $sql5='SELECT rank FROM member WHERE code=? ';
                $stmt5=$dbh->prepare($sql5);
                $data5[]=$_SESSION['m_code'];
                $stmt5->execute($data5);

                $rec=$stmt5->fetch(PDO::FETCH_ASSOC);
                $_SESSION['m_rank']=$rec['rank'];
            }
        }
        else
        {
            $sql4='UPDATE member SET rank=? WHERE code=? ';
            $stmt4=$dbh->prepare($sql4);
            $data4[]='ブロンズ';
            $data4[]=$_SESSION['m_code'];
            $stmt4->execute($data4);

            $sql5='SELECT rank FROM member WHERE code=? ';
            $stmt5=$dbh->prepare($sql5);
            $data5[]=$_SESSION['m_code'];
            $stmt5->execute($data5);

            $rec=$stmt5->fetch(PDO::FETCH_ASSOC);
            $_SESSION['m_rank']=$rec['rank'];
        }

        $dbh=null;

        ?>
        <h2>質問が完了しました</h2>
        <p>質問を投稿いただきありがとうございます。<br>
        回答者からの回答をお待ちください。投稿した質問は質問履歴から確認できます。</p>
        <p>ポイントが100ポイント引かれました。新しく回答してポイントを増やそう！</p>
        <button type="submit" onclick="location.href='home.php'" class="btn-gradient-3d-simple">完了</button>
        <?php     
    }
    catch(Exception $e)
    {
        print '<h2>ただいまデータ障害が発生しています。</h2>';
        print '<h2>お手数ですが時間を空けてから再度アクセスしてください。</h2>';
        exit();
    }
}
?>

</section>

<footer>
    <small>Copyright&copy; <a href="index.html">SAMPLE SITE</a> All Rights Reserved.</small>
    <span class="pr"><a href="https://template-party.com/" target="_blank">《Web Design:Template-Party》</a></span>
</footer>

</div>
<!--/#main-->

</div>
<!--/#contents-->

</div>
<!--/#container-->

<p class="nav-fix-pos-pagetop"><a href="#pagetop">↑</a></p>

<div id="menubar_hdr" class="close"></div>

<script>
if (OCwindowWidth() <= 800) {
	open_close("menubar_hdr", "menubar-s");
}
</script>

</body>
</html>
