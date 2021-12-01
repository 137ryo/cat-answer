<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - New Answer</title>
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
    ?>
    <h2 class="title">Question List<span>質問一覧</span></h2>
    <?php

    print $_SESSION['m_id'];
    print 'さんログイン中<br />';
    print '会員ランク : ';
    print $_SESSION['m_rank'];
    print '<br/>';
    print 'ポイント : ';
    print $_SESSION['m_point'];

    try{

    $check_code=$_GET['post_q'];
    $check_code2=$_GET['post_q'];

    $dsn='mysql:dbname=bolt;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT code,q_date,lang_type,title,main,soce FROM question WHERE code=?';
    $sql2='SELECT code,m_rank,reply,reply_soce,a_date FROM answer WHERE code_question=?';

    $stmt=$dbh->prepare($sql);
    $data[]=$check_code;
    $stmt->execute($data);

    $stmt2=$dbh->prepare($sql2);
    $data2[]=$check_code2;
    $stmt2->execute($data2);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    $q_code=$rec['code'];
    $q_title=$rec['title'];

    ?>
    <div class="box">
        <br/>
        <h2><?php print $q_title; ?></h2>
        <p><?php print nl2br($rec['main']); ?></p>
        <div class="box">
            <h3>Program</h3>
            <p><?php print nl2br($rec['soce']); ?></p>
        </div>
        <p>質問日付 : <?php print $rec['q_date']."</br>"; ?></p>
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>

    <h2>Answers</h2> 

    <?php
    while($rec=$stmt2->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <?php print nl2br($rec['reply']); ?>
            <div class="box">
                <h3>Program</h3>
                <?php print nl2br($rec['reply_soce']); ?>
            </div>
            <p>回答者のランク : <?php print $rec['m_rank']."</br>"; ?></p>
            <p><?php print $rec['a_date']."</br>"; ?></p>
        </div>
        <?php
    }

    $dbh=null;


    ?>
    <br/>
    <br/>
    <div class="box"> 
        <br/>
        <form method="post" action="a_new_check.php">
            <div>
                <input type="hidden" name="code" value="<?php print $q_code ?>">
            </div>
            <div>
                <h2>回答を入力してください</h2>
                <p>(500文字以内)</p>
                <textarea name="main" maxlength="500" cols="30" rows="10" class="wl" style="overflow:scroll;"></textarea>
                <br/>
            </div>
            <div>
                <h2>プログラムを入力してください</h2>
                <p>(任意 10000文字以内)</p>
                <textarea name="soce" maxlength="10000" cols="30" rows="10" class="wl" style="overflow:scroll;"></textarea>
                <br/>
            </div>
            <p style="margin-bottom:4em;"></p>
            <button type="submit" onclick="location.href='a_new_check.php'" class="btn-gradient-3d-simple">回答内容を確認する</button>
        </form>
    </div>
    <?php
    }
    catch(Exception $e)
    {
    print'ただいま障害により大変ご迷惑をお掛けしております。';
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
