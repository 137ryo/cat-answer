<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - Question Check</title>
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

    $q_lang_type=htmlspecialchars($q_lang_type,ENT_QUOTES,'UTF-8');
    $q_title=htmlspecialchars($q_title,ENT_QUOTES,'UTF-8');
    $q_main=htmlspecialchars($q_main,ENT_QUOTES,'UTF-8');
    $q_soce=htmlspecialchars($q_soce,ENT_QUOTES,'UTF-8');

    if($q_lang_type=='')
    {
        ?><h2>未入力です。<br/></h2><?php
    }
    if($q_title=='')
    {
        ?><h2>タイトルが未入力です。<br/></h2><?php
    }
    if($q_main=='')
    {
        ?><h2>本文が未入力です。<br/></h2><?php
    }
    if($q_lang_type=='' || $q_title=='' || $q_main=='' )
    {
        print '<form>';
        ?><button type="button" onclick="history.back()" class="btn-gradient-3d-simple">戻る</button><?php
        print '</form>';
    }
    else
    {
        ?>
        <form method="post" action="q_new_done.php">
        <div>
            <h3>質問する言語</h3>
            <input type="hidden" name="lang_type" value="<?php print $q_lang_type?>">
            <h5><?php print $q_lang_type ?></h5>
            <br/>
        </div>
        <div>
            <h2>タイトルを入力してください</h2>
            <p>(100文字以内)</p>
            <textarea name="title" maxlength="100" cols="30" rows="10" class="wl"  style="border:none" style="overflow:scroll;" readonly="readonly"><?php print $q_title ?></textarea>
        </div>
        <div>
            <h2>質問本文を入力してください</h2>
            <p>(500文字以内)</p>
            <textarea name="main" maxlength="500" cols="30" rows="10" class="wl"  style="border:none" style="overflow:scroll;" readonly="readonly"><?php print $q_main ?></textarea>
            <br/>
        </div>
        <div>
            <h2>ソースプログラムを入力してください</h2>
            <p>(任意 10000文字以内)</p>
            <textarea name="soce" maxlength="10000" cols="30" rows="10" class="wl"  style="border:none" style="overflow:scroll;" readonly="readonly"><?php print $q_soce ?></textarea>
        </div>
        <h3>この内容で登録を完了するなら完了を、訂正する場合は戻るを押してください。</h3>
        <br/>
        <button type="button" onclick="history.back()" class="btn">内容訂正</button>
        <button type="submit" onclick="location.href='q_new_done.php'" class="btn">質問を投稿する</button>
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
