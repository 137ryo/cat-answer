<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - Login Check</title>
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

<?php

try{
  $m_id=$_POST['id'];
  $m_pass=$_POST['pass'];

  $m_id=htmlspecialchars($m_id,ENT_QUOTES,'UTF-8');
  $m_pass=htmlspecialchars($m_pass,ENT_QUOTES,'UTF-8');

  $m_pass=md5($m_pass);

  $dsn='mysql:dbname=bolt;host=localhost;charset=utf8';
  $user='root';
  $password='';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT code,rank,point FROM member WHERE id=? AND pass=?';
  $stmt=$dbh->prepare($sql);
  $data[]=$m_id;
  $data[]=$m_pass;
  $stmt->execute($data);

  $dbh=null;
  
  $rec=$stmt->fetch(PDO::FETCH_ASSOC);

  if($rec==false)
  {
    print '<h3>※ユーザーIDかパスワードが間違っています。<h3/><br/>';
    ?><button type="submit" onclick="location.href='login.html'" class="btn">戻る</button>
    <?php
  }
  else
  {
    session_start();
    $_SESSION['login']=1;
    $_SESSION['m_id']=$m_id;
    $_SESSION['m_code']=$rec['code'];
    $_SESSION['m_rank']=$rec['rank'];
    $_SESSION['m_point']=$rec['point'];
    header('Location:home.php');
    exit();
  }
}
catch(Exception $e)
{
  print '<h3>ただいまデータ障害が発生しています。</h3>';
  print '<p>お手数ですが時間を空けてから再度アクセスしてください。</p>';
  exit();
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
