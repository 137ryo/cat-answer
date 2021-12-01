<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - Answer Check</title>
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
    <h2 class="title">Answer New<span>新規回答</span></h2>
    <?php

    $a_code=$_POST['code'];
    $a_main=$_POST['main'];
    $a_soce=$_POST['soce'];

    $a_code=htmlspecialchars($a_code,ENT_QUOTES,'UTF-8');
    $a_main=htmlspecialchars($a_main,ENT_QUOTES,'UTF-8');
    $a_soce=htmlspecialchars($a_soce,ENT_QUOTES,'UTF-8');

    if($a_main=='')
    {
        ?>
        <h2>回答本文が未入力です。<br/></h2>
        <?php
    }
    else
    {
        ?>
        <form method="post" action="a_new_done.php">
            <input type="hidden" name="code" value=<?php print $a_code ?>>
            <div>
                <h2>回答を入力してください</h2>
                <p>(500文字以内)</p>
                <textarea name="main" maxlength="500" cols="30" rows="10" class="wl" style="border:none" style="overflow:scroll;" readonly="readonly"><?php print $a_main ?></textarea>
                <br/>
            </div>
            <div>
                <h2>ソースプログラムを入力してください</h2>
                <p>(任意 10000文字以内)</p>
                <textarea name="soce" maxlength="10000" cols="30" rows="10" class="wl" style="border:none" style="overflow:scroll;" readonly="readonly"><?php print $a_soce ?></textarea>
                <br/>
            </div>
            <h3>この内容で回答しますか？訂正する場合は戻るを押してください。</h3>
            <br/>
            <button type="button" onclick="history.back()" class="btn">内容訂正</button>
            <button type="submit" onclick="location.href='a_new_done.php'" class="btn">回答を投稿する</button>
        </form>
        <?php
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
