<?php
include_once('../../../common.php');

$login_action_url = G5_HTTPS_BBS_URL."/login_check.php";

include_once('../../../head.sub.php');

add_stylesheet('<link rel="stylesheet" href="'.G5_URL.'/_publishing/member/member_05/style.css?ver='.G5_CSS_VER.'" />');
?>

<div id="" class="mem05_skin">
    <div class="inner">
        <div class="logo">
            <img src="./img/yourlogo.svg" alt="로고" />
        </div>

        <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post" autocomplete="off">
            <input type="hidden" name="url" value="<?php echo $login_url ?>">
            <fieldset id="login_fs">
                <legend>회원로그인</legend>
                <label for="login_id" class="sound_only">회원아이디<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="아이디">
                <label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
                <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호">

                <div class="info_wrap">
                    <div id="login_info" class="check_box">
                        <input type="checkbox" name="auto_login" id="login_auto_login" class="select_chk">
                        <label for="login_auto_login">자동로그인</label>
                    </div>
                    <div id="lost_password">
                        <a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="family_medium" id="login_password_lost">아이디/비밀번호 찾기</a>
                    </div>
                </div>

                <button type="submit" class="btn_submit family_medium">로그인</button>
            </fieldset>
        </form>

        <div class="join">
            <p>아직 회원이 아니신가요?<a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="family_medium" id="join">회원가입</a></p>
        </div>

        <div class="sns_login">
            <div class="sns_login_title">
                <span>SNS 아이디로 로그인</span>
            </div>
            <ul class="sns_list">
                <li>
                    <a href="#" class="google_login"><img src="./img/ico-google.svg" alt="구글"/></a>
                </li>
                <li>
                    <a href="#" class="facebook_login"><img src="./img/ico-facebook.svg" alt="페이스북"/></a>
                </li>
                <li>
                    <a href="#" class="naver_login"><img src="./img/ico-naver.svg" alt="네이버"/></a>
                </li>
                <li>
                    <a href="#" class="kakao_login"><img src="./img/ico-kakao.svg" alt="카카오"/></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
jQuery(function($){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}
</script>

<?php
include_once('../../../tail.sub.php');
?>