<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - Member Check</title>
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
	<li class="menuimg menu1 current"><a href="login.php"><span>Login</span></a></li>
	<li class="menuimg menu2"><a href="m_new.html"><span>New Account</span></a></li>
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

<h2>登録情報の確認</h2>

<?php

$m_id=$_POST['id'];
$m_pass=$_POST['pass'];
$m_pass2=$_POST['pass2'];

$m_id=htmlspecialchars($m_id,ENT_QUOTES,'UTF-8');
$m_pass=htmlspecialchars($m_pass,ENT_QUOTES,'UTF-8');
$m_pass2=htmlspecialchars($m_pass2,ENT_QUOTES,'UTF-8');


if($m_id=='')
{
?><h3>※メンバーIDが入力されていません。</h3><?php
}

if($m_pass=='')
{
?><h3>※パスワードが入力されていません。</h3><?php
}

if($m_pass!=$m_pass2)
{
?><h3>※パスワードが一致しません。再度入力ミスがないか確認してください。<h3><?php
}

if(mb_strlen($m_id) < 6 || mb_strlen($m_id) >=15)
{
?><h3>※メンバーIDは6文字以上15文字未満で入力してください。</h3><?php
}

if(mb_strlen($m_pass) < 8 || mb_strlen($m_pass) >=20)
{
?><h3>※パスワードは8文字以上20文字未満で入力してください。</h3><?php
}

if($m_id=='' || $m_pass=='' || $m_pass!=$m_pass2 || mb_strlen($m_id) < 6 || mb_strlen($m_id) >=15 || mb_strlen($m_pass) < 8 || mb_strlen($m_pass) >=20)
{
print '<form>';
?><br/><button type="button" onclick="history.back()" class="btn">戻る</button><?php
print '</form>';
}
else
{
?><h3>あなたのid : <?php print $m_id ?></h3>
<p>この内容で登録を完了するなら完了を、訂正する場合は戻るを押してください。</p>
<?php $m_pass=md5($m_pass); ?>
<form method="post" action="m_new_done.php">
    <input type="hidden" name="id" value=<?php print $m_id ?>>
    <input type="hidden" name="pass" value=<?php print $m_pass ?>>
    <input type="hidden" name="pass2" value=<?php print $m_pass2 ?>>
    <br/>
<button type="button" onclick="history.back()" class="btn">戻る</button>
<button type="submit" onclick="location.href='m_new_done.php'" class="btn">会員登録を完了する</button>
</form>
<?php
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

