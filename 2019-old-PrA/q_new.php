<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - New Question</title>
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
    $point_check=$_SESSION['m_point'];

    if($point_check > 0)
    {
        print $_SESSION['m_id'];
        print 'さんログイン中<br />';
        print '会員ランク : ';
        print $_SESSION['m_rank'];
        print '<br/>';
        print 'ポイント : ';
        print $_SESSION['m_point'];
        ?>
    
        <form method="post" action="q_new_check.php">
            <div>
                <h2>言語の種類を選択してください(必須)</h2>
                <select name="lang_type">
                <option value="HTML">HTML</option>
                <option value="PHP">PHP</option>
                <option value="JavaScript">JavaScript</option>
                <option value="C言語">C言語</option>
                <option value="Java">Java</option>
                <option value="Python">Python</option>
                <option value="SQL">SQL</option>
                <option value="Ruby">Ruby</option>
                </select>
            </div>
            <div>
                <h2>タイトルを入力してください</h2>
                <p>(100文字以内)</p>
                <textarea name="title" maxlength="100" cols="30" rows="10" class="wl" style="overflow:scroll;"></textarea>
                <br/>
            </div>
            <div>
                <h2>質問本文を入力してください</h2>
                <p>(500文字以内)</p>
                <textarea name="main" maxlength="500" cols="30" rows="10" class="wl" style="overflow:scroll;"></textarea>
                <br/>
            </div>
            <div>
                <h2>ソースプログラムを入力してください</h2>
                <p>(任意 10000文字以内)</p>
                <textarea name="soce" maxlength="10000" cols="30" rows="10" class="wl" style="overflow:scroll;"></textarea>
                <br/>
            </div>
            <p style="margin-bottom:4em;"></p>
            <button type="submit" onclick="location.href='q_new_check.php'" class="btn-gradient-3d-simple">内容確認</button>
        </form>
        <?php
    }
    else
    {
        print 'ポイントが不足しています';
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

