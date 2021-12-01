<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cat Answer - History</title>
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
    <h2 class="title">History<span>質問履歴</span></h2>
    <?php

    try
    {

        ?>
        <div>
        <p><?php print $_SESSION['m_id']; ?> さんの過去の質問一覧を表示します。</p>
        <p>確認したい質問の左ボタンをクリックすると詳細を表示します。</p>
        <br/>
        </div>
        <?php

        $dsn='mysql:dbname=bolt;host=localhost;charset=utf8';
        $user='root';
        $password='';
        $dbh=new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='SELECT code,q_date,lang_type,title FROM question WHERE code_member=? ORDER BY q_date DESC';
        $stmt=$dbh->prepare($sql);
        $data[]=$_SESSION['m_code'];
        $stmt->execute($data);
        
        ?>
        <table class="ta2">
        <thead>
            <tr>
            <td scope="col">タイトル</td>
            <td scope="col">言語</td>
            <td scope="col">質問日時</td>
            </tr>
        </thead>
        <tbody>
            <?php
            while($rec=$stmt->fetch(PDO::FETCH_ASSOC))
            {
            ?>
            <tr>
                <form method="get" action="q_hist_details.php">
                    <input type="hidden" name="post_q" value="<?php print $rec['code']; ?>">
                    <th> <input type="submit" style="border:none" value="<?php print $rec['title']; ?>"> </th>
                    <td data-label="言語"> <?php print $rec['lang_type']; ?> </td>
                    <td data-label="質問日時"> <?php print $rec['q_date']; ?> </td>
                </form>
            </tr>
            <?php                
            }
            ?>
        </tbody>
        </table>

        <?php
        $dbh=null;

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

