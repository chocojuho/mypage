<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

switch(substr($_SERVER['SCRIPT_FILENAME'], strlen(G5_PATH)))
{
	case '/bbs/register.php':
	case '/bbs/register_form.php':
	case '/bbs/register_result.php':
	case '/plugin/social/register_member.php':
		include_once(G5_THEME_PATH.'/head.def.php');
		return;
		break;
}

include_once(G5_THEME_PATH.'/head.def.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_THEME_PATH.'/functions.php');

// 메뉴 계산 (/head.php 응용)
$sql = " select *
			from {$g5['menu_table']}
			where me_use = '1'
			  and length(me_code) = '2'
			order by me_order, me_id ";
$result = sql_query($sql, false);
$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
$menu_datas = array();

for ($i=0; $row=sql_fetch_array($result); $i++) {
	$menu_datas[$i] = $row;

	$sql2 = " select *
				from {$g5['menu_table']}
				where me_use = '1'
				  and length(me_code) = '4'
				  and substring(me_code, 1, 2) = '{$row['me_code']}'
				order by me_order, me_id ";
	$result2 = sql_query($sql2);
	for ($k=0; $row2=sql_fetch_array($result2); $k++) {
		$menu_datas[$i]['sub'][$k] = $row2;
	}

}

get_active_menu($menu_datas);

$g5['sidebar']['right'] = !defined('_INDEX_')&&is_file(G5_PATH.'/sidebar.right.php') ? true : false;
?>

<!------------------------------------------------------------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>NewBiz Bootstrap Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?php echo G5_THEME_IMG_URL ?>/favicon.png" rel="icon">
  <link href="<?php echo G5_THEME_IMG_URL ?>/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo G5_THEME_URL ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
  <link href="<?php echo G5_THEME_URL ?>/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo G5_THEME_URL ?>/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo G5_THEME_URL ?>/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo G5_THEME_URL ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo G5_THEME_URL ?>/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo G5_THEME_URL ?>/css/style.css?version=<?php echo time(); ?>" rel="stylesheet">

</head>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">

  <!--=============================================================================-->

    <div class="container">
      <div class="logo float-left">
        <a href="<?php echo G5_URL ?>" class="scrollto"><img src="<?php echo G5_THEME_IMG_URL ?>/hi_logo.png" alt="" class="img-fluid"></a>
      </div>
      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
           <li>
              <?php echo get_layout_menu($menu_datas) ?>
				      
           </li>
           
        </ul>
      </nav><!-- .main-nav -->
      <ul id="logingo">
        <li >
        <?php echo outlogin('theme/basic'); ?>
        </li>
      </ul>
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <div class="intro-info">
        <h2>안녕하십니까<br><span>이주호</span>가<br>운영하고 있는 홈페이지입니다.</h2>
        <div>
          <a href="#services" class="btn-services scrollto">서비스 안내</a>
        </div>
      </div>

    </div>
  </section><!-- #intro -->

<!----------------------------------------------------------------------------->

  <?php if (!defined("_INDEX_")) { ?>
      <main role="main" class="container">
      <p><br>
  <?php }else{ ?>
      <main id="main">
  <?php } ?>
  
	<?php if($g5['sidebar']['right']) { ?>
		<div class="row">
			<div class="col-lg-9">
	<?php } ?>