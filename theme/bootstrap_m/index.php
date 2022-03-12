<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');

if(is_file(G5_PATH.'/main.php'))
{
	include G5_PATH.'/main.php';
}else{
?>

<!----------------------------------------------------------------------------->

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>자기소개</h3>
          <p>안녕하세요. <br>현재 선린인터넷고등학교를 다니고 있는 <br>꿈꾸는 개발자 이주호입니다</p>
        </header>

        <div class="row about-container">



          </div>





          
        </div>

      </div>
    </section><!-- #about -->

<!----------------------------------------------------------------------------->

<?php
}

include_once(G5_THEME_PATH.'/tail.php');
?>