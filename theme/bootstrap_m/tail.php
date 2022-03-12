<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$admin = get_admin("super"); 

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}

switch(substr($_SERVER['SCRIPT_FILENAME'], strlen(G5_PATH)))
{
	case '/bbs/register.php':
	case '/bbs/register_form.php':
	case '/bbs/register_result.php':
	case '/plugin/social/register_member.php':
		include_once(G5_THEME_PATH."/tail.sub.php");
		return;
		break;
}
?>
		<?php if($g5['sidebar']['right']) { ?>
		</div>

		<div class="col-lg-3 mt-lg-0">
			<?php @include G5_PATH.'/sidebar.right.php'; ?>
		</div>
		<?php } ?>

</main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <?php if($admin['mb_signature'] == '없음') echo ''; else if($admin['mb_signature']){ ?>
            <h3>회사의 사명</h3>
            <p><?php echo $admin['mb_signature']?></p>
            <?php } else echo '<p>관리자정보여분필드4 내용이 없을 경우 없음 이라고 입력.</p>';?>
          </div>
          
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>빠른메뉴</h4>
            <ul>
             <?php echo get_tail_menu($menu_datas) ?>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>오시는 길</h4>
            <p>
              <?php if($admin['mb_addr1']){ ?><?php echo $admin['mb_addr1']?><br><?php } else echo '관리자정보 기본주소 입력<br>';?> 
              <?php if($admin['mb_addr2']){ ?><?php echo $admin['mb_addr2']?><br><?php } else echo '관리자정보 상세주소 입력<br>';?> 
              <?php if($admin['mb_1'] == '없음') echo ''; else if($admin['mb_1']){ ?><?php echo $admin['mb_1']?><br><?php } else echo '관리자정보여분필드1 내용이 없을 경우 없음 이라고 입력.<br>';?>
              <?php if($admin['mb_2'] == '없음') echo ''; else if($admin['mb_2']){ ?><?php echo $admin['mb_2']?><br><?php } else echo '관리자정보여분필드2 내용이 없을 경우 없음 이라고 입력.<br>';?>
		          <?php if($admin['mb_3'] == '없음') echo ''; else if($admin['mb_3']){ ?><?php echo $admin['mb_3']?><br><?php } else echo '관리자정보여분필드3 내용이 없을 경우 없음 이라고 입력.<br>';?>
              <?php if($admin['mb_tel']){ echo  ' <strong>Phone:</strong> '; ?><?php echo $admin['mb_tel']?><br><?php } else echo '관리자정보 전화번호 입력<br>';?> 
              <?php if($admin['mb_email']){ echo  ' <strong>Email:</strong> '; ?><a href='mailto:<?php echo $admin['mb_email']?>'><?php echo $admin['mb_email']?></a><br><?php } else echo '관리자정보 이메일 입력<br>';?> 
            </p>

            <div class="social-links">
              <?php if($admin['mb_6']){ ?><a href="<?php echo $admin['mb_6']?>" class="twitter"><i class="fa fa-twitter"></i></a><?php } ?>
              <?php if($admin['mb_7']){ ?><a href="<?php echo $admin['mb_7']?>" class="facebook"><i class="fa fa-facebook"></i></a><?php } ?> 
              <?php if($admin['mb_8']){ ?><a href="<?php echo $admin['mb_8']?>" class="instagram"><i class="fa fa-instagram"></i></a><?php } ?> 
              <?php if($admin['mb_9']){ ?><a href="<?php echo $admin['mb_9']?>" class="google-plus"><i class="fa fa-google-plus"></i></a><?php } ?> 
              <?php if($admin['mb_10']){ ?><a href="<?php echo $admin['mb_10']?>" class="linkedin"><i class="fa fa-linkedin"></i></a><?php } ?> 
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>사내소식</h4>
<p>
				<?php
				/* 게시판 최신글 */
				// 사용방법 : latest('theme/basic', '게시판아이디', 출력라인, 글자수);
				echo latest('theme/mbootstrap', 'tip', 6, 27);
				?>
</p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><?php echo $_SERVER['HTTP_HOST']; ?></strong>. All Rights Reserved
      </div>
      <div class="credits">
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="<?php echo G5_THEME_URL ?>/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/easing/easing.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/mobile-nav/mobile-nav.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/wow/wow.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/waypoints/waypoints.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/counterup/counterup.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/lightbox/js/lightbox.min.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/lib/contactform/contactform.js"></script>
  <script src="<?php echo G5_THEME_URL ?>/js/main.js"></script>

<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>