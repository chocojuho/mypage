<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/custom.css">');
?>

<style>
#sns_login h3 { display: none; }
#sns_login { border-bottom: 1px solid #edeaea; margin-bottom: 15px; }
.sns-wrap { margin: 10px 0 10px; }
</style>

<div class="form-signin">
<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">

	<div class="text-center mb-5">
		<a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>" class="logo"></a>
	</div>

	<?php
    // 소셜로그인 사용시 소셜로그인 버튼
    @include_once(get_social_skin_path().'/social_login.skin.php');
    ?>

	<div>
		<label for="inputUser" class="sr-only">아이디</label>
		<input type="user" name="mb_id" class="form-control" placeholder="아이디" required autofocus>
		<label for="inputPassword" class="sr-only">비밀번호</label>
		<input type="password" name="mb_password" class="form-control" placeholder="비밀번호" required>
	</div>

	<div class="custom-control custom-checkbox mb-4">
		<input type="checkbox" class="custom-control-input" name="auto_login" id="login_auto_login">
		<label class="custom-control-label" for="login_auto_login">자동로그인</label>
	</div>

	<div class="mb-4">
		<button class="btn btn-primary btn-block" type="submit">로그인</button>
	</div>

	<div class="text-center">
		<a href="./register.php">회원 가입</a> |
		<a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="login_password_lost">암호를 분실하셨나요?</a>
	</div>

</form>
</div>

<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>