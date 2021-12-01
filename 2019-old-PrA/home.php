<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="プログラミングに関する質問をするサイトです">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/style.css">
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
<!--[if lt IE 10]>
<style>
.slide0,.slide1,.slide2,.slide3 {background: url(images/1.jpg) no-repeat center center;}
</style>
<![endif]-->
</head>

<body class="home">

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

<section id="new">

<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print '<h2>ログインされていません</h2><br/>';
    ?><font color="black"><?php
    print '※このページには直接アクセスできません。<br/>'; ?></font>
    <div class="home">
        <a href="login.html">ログイン画面へ</a>
    </div>
    <?php
    exit();
}
else
{

    print $_SESSION['m_id'];
    print 'さんログイン中<br />';
    print '会員ランク : ';
    print $_SESSION['m_rank'];
    print '<br/>';
    print 'ポイント : ';
    print $_SESSION['m_point'];

    try{

        $dsn='mysql:dbname=bolt;host=localhost;charset=utf8';
        $user='root';
        $password='';
        $dbh=new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='SELECT code,dl_date,title FROM question ORDER BY q_date DESC limit 10';
        $stmt=$dbh->prepare($sql);
        $stmt->execute();

        ?>
        <br>
        <h2>最近投稿された質問</h2>
        <dl>
        <?php
        while($rec=$stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form method="get" action="a_new.php">
                <dt><?php print $rec['dl_date']; ?></dt>
                <input type="hidden" name="post_q" value="<?php print $rec['code']; ?>"> 
                <dd><input type="submit" style="border:none" value="<?php print $rec['title']; ?>"></dd>
            </form>
            <?php                
        }
        ?>
        </dl>
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
<!--/#new-->

<footer>
    <?php print $_SESSION['m_id']; ?>さんではありませんか？ ➡ 
    <a href="logout.php">ログアウト</a><br/>
    <small>Copyright&copy; <a href="index.html">SAMPLE SITE</a> All Rights Reserved.</small>
    <span class="pr"><a href="https://template-party.com/" target="_blank">《Web Design:Template-Party》</a></span>
</footer>

</div>
<!--/#main-->

</div>
<!--/#contents-->

<!--スライドショー-->
<aside id="mainimg">
<div class="slide0">slide0</div>
<div class="slide1">slide1</div>
<div class="slide2">slide2</div>
<div class="slide3">slide3</div>
</aside>

</div>
<!--/#container-->

<!--ページの上部に戻る「↑」ボタン-->
<p class="nav-fix-pos-pagetop"><a href="#pagetop">↑</a></p>

<!--メニュー開閉ボタン-->
<div id="menubar_hdr" class="close"></div>

<!--メニューの開閉処理条件設定　800px以下-->
<script>
if (OCwindowWidth() <= 800) {
	open_close("menubar_hdr", "menubar-s");
}
</script>

</body>
</html>
