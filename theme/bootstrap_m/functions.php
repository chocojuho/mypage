<?php
function get_active_menu($menu_datas)
{
	global $g5;

	foreach($menu_datas as $item)
	{
		$part = parse_url($item['me_link']);
		$item['path'] = $part['path'].'/';

		$part = parse_url($_SERVER['REQUEST_URI']);
		$self['path'] = $part['path'].'/';

		if($item['me_code'] == $g5['me_code'] || 
			(!$g5['me_code'] && !in_array($item['path'], array('', '/')) && strncmp($item['path'], $self['path'], strlen($item['path']))===0))
		{
			//echo $item['me_code'].' - '.$g5['me_code'].'<br />';
			//echo $item['path'].' - '.$self['path'].'<br />';
			//echo $item['path'] .' - '. strncmp($item['path'], $self['path'], strlen($item['path']));
			$g5['me_code'] = $item['me_code'];
		}

		if($item['sub']) get_active_menu($item['sub']);
	}
}

function get_layout_menu($menu_datas)
{
	global $g5;

	$output = '';
	foreach($menu_datas as $item)
	{
		$item['act'] = $item['me_code'] == substr($g5['me_code'], 0, strlen($item['me_code'])) ? 'active' : '';

		if(!$item['sub'])
		{
			$output .= '<li><a href="'.$item['me_link'].'" target="_'.$item['me_target'].'">'.$item['me_name'].'</a></li>';
		}
		else
		{
			$output .= '<li class="drop-down"><a href="'.$item['me_link'].'" target="_'.$item['me_target'].'">'.$item['me_name'].'</a><ul><li>';

			foreach($item['sub'] as $item2)
			{
				$item2['act'] = $item2['me_code'] == substr($g5['me_code'], 0, strlen($item2['me_code'])) ? 'active' : '';

				if($item2['me_id']==-1)
					$output .= '<ul></ul>';
				else
					$output .= '<a href="'.$item2['me_link'].'">'.$item2['me_name'].'</a>';
			}
			
			$output .= '</li></ul></li>';
		}
	}

	return $output;
}

function get_tail_menu($menu_datas)
{
	global $g5;

	$output = '';
	foreach($menu_datas as $item)
	{
		$item['act'] = $item['me_code'] == substr($g5['me_code'], 0, strlen($item['me_code'])) ? 'active' : '';

    $output .= '<li><a href="'.$item['me_link'].'" target="_'.$item['me_target'].'">'.$item['me_name'].'</a></li>';

	}

	return $output;
}


function get_layout_breadcrumb($menu_datas, $recursive=false)
{
	global $g5;

	$output = '';
	foreach($menu_datas as $item)
	{
		if($item['me_code'] == substr($g5['me_code'], 0, strlen($item['me_code'])))
			if($item['me_code'] != $g5['me_code'])
				$output .= '<li class="breadcrumb-item"><a href="'.$item['me_link'].'">'.$item['me_name'].'</a></li>';
			else
				$output .= '<li class="breadcrumb-item active">'.$item['me_name'].'</li>';

		if($item['sub']) $output .= get_layout_breadcrumb($item['sub'], true);
	}

	if(!$recursive) $output = '<li class="breadcrumb-item"><a href="'.G5_URL.'">Home</a></li>'.$output;

	return $output;
}

function get_member_info($mb_id, $name='', $email='', $homepage='')
{
    global $config;
    global $g5;
    global $bo_table, $sca, $is_admin, $member;

    $email_enc = new str_encrypt();
    $email = $email_enc->encrypt($email);
    $homepage = set_http(clean_xss_tags($homepage));

    $name     = get_text($name, 0, true);
    $email    = get_text($email);
    $homepage = get_text($homepage);

	$mb_ico_url = G5_IMG_URL.'/no_profile.gif';
	$mb_img_url = G5_IMG_URL.'/no_profile.gif';

    if ($mb_id)
	{
		$mb_icon_img = $mb_id.'.gif';

		if(file_exists(G5_DATA_PATH.'/member/'.substr($mb_id,0,2).'/'.$mb_icon_img))
			$mb_ico_url = G5_DATA_URL.'/member/'.substr($mb_id,0,2).'/'.$mb_icon_img;

		if(file_exists(G5_DATA_PATH.'/member_image/'.substr($mb_id,0,2).'/'.$mb_icon_img))
			$mb_img_url = G5_DATA_URL.'/member_image/'.substr($mb_id,0,2).'/'.$mb_icon_img;

		/*
        if ($config['cf_use_member_icon']) {
                if ($config['cf_use_member_icon'] == 2) // ???????????????+??????
		*/
	} else {
		if(!$bo_table)
		  return array('ico'=>$mb_ico_url, 'img'=>$mb_img_url, 'menu'=>'');

		$menu .= '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;sca='.$sca.'&amp;sfl=wr_name,1&amp;stx='.$name.'" title="'.$name.' ???????????? ??????" class="dropdown-item" rel="nofollow" onclick="return false;">'.$name.'</a>';
	}

	$menu = '<div class="dropdown-menu">';

    if($mb_id)
        $menu .= '<a href="'.G5_BBS_URL.'/memo_form.php?me_recv_mb_id='.$mb_id.'" class="dropdown-item" onclick="win_memo(this.href); return false;">???????????????</a>';
    if($email)
        $menu .= '<a href="'.G5_BBS_URL.'/formmail.php?mb_id='.$mb_id.'&name='.urlencode($name).'&email='.$email.'" class="dropdown-item"  onclick="win_email(this.href); return false;">???????????????</a>';
    if($homepage)
        $menu .= '<a href="'.$homepage.'" target="_blank">????????????</a>';
    if($mb_id)
        $menu .= '<a href="'.G5_BBS_URL.'/profile.php?mb_id='.$mb_id.'" onclick="win_profile(this.href); return false;" class="dropdown-item" >????????????</a>';
    if($bo_table) {
        if($mb_id)
            $menu .= '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&sca='.$sca.'&sfl=mb_id,1&stx='.$mb_id.'" class="dropdown-item" >???????????? ??????</a>';
        else
            $menu .= '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table."&sca=".$sca.'&sfl=wr_name,1&stx='.$name.'" class="dropdown-item" >???????????? ??????</a>';
    }
    if($mb_id)
        $menu .= '<a href="'.G5_BBS_URL.'/new.php?mb_id='.$mb_id.'" class="dropdown-item" onclick="check_goto_new(this.href, event);">???????????????</a>';
    if($is_admin == "super" && $mb_id) {
        $menu .= '<a href="'.G5_ADMIN_URL.'/member_form.php?w=u&mb_id='.$mb_id.'" class="dropdown-item" target="_blank">??????????????????</a>';
        $menu .= '<a href="'.G5_ADMIN_URL.'/point_list.php?sfl=mb_id&stx='.$mb_id.'" class="dropdown-item" target="_blank">???????????????</a>';
    }

	$menu .= '</div>';

    return array('ico'=>$mb_ico_url, 'img'=>$mb_img_url, 'menu'=>$menu);
}

function chg_paging($write_pages)
{
	$remove = array();
	$remove[] = '<span class="sound_only">?????????';
	$remove[] = '<span class="pg">';
	$remove[] = '</span>';
	$remove[] = ' pg_start';
	$remove[] = ' pg_end';
	$remove[] = ' pg_next';
	$remove[] = ' pg_prev';

	$write_pages = str_replace('<nav class="pg_wrap">', '<nav><ul class="pagination">', $write_pages);
	$write_pages = str_replace('</nav>', '</ul></nav>', $write_pages);
	$write_pages = str_replace($remove, '', $write_pages);
	$write_pages = str_replace('pg_page', 'page-link', $write_pages);

	$write_pages = str_replace('<a href="', '<li class="page-item"><a href="', $write_pages);
	$write_pages = str_replace('</a>', '</a></li>', $write_pages);

	$write_pages = str_replace('<span class="sound_only">??????<strong class="pg_current">', '<li class="page-item active"><a href="#" class="page-link">', $write_pages);
	$write_pages = str_replace('</strong>', '</a></li>', $write_pages);


	$write_pages = str_replace('??????', '<i class="fas fa-angle-double-left"></i>', $write_pages);
	$write_pages = str_replace('??????', '<i class="fas fa-angle-left"></i>', $write_pages);
	$write_pages = str_replace('??????', '<i class="fas fa-angle-right"></i>', $write_pages);
	$write_pages = str_replace('??????', '<i class="fas fa-angle-double-right"></i>', $write_pages);

	return $write_pages;
}

function chg_board_list($str_board_list)
{
	$str_board_list = str_replace('<li>', '<li class="list-inline-item">', $str_board_list);
	$str_board_list = str_replace('<strong>', '', $str_board_list);
	$str_board_list = str_replace('</strong><span class="cnt_cmt">', ' <span class="badge badge-light">', $str_board_list);
	$str_board_list = str_replace(' class=sch_on>', ' class="btn btn-primary btn-sm active">', $str_board_list);
	$str_board_list = str_replace(' >', ' class="btn btn-primary btn-sm">', $str_board_list);

	return $str_board_list;
}

// ???????????? 5.4 ????????? ??????
if(!function_exists('run_event')) {	function run_event() { } }
if(!function_exists('get_pretty_url')) {
	function get_pretty_url($folder, $no='', $query_string='', $action='')
	{
	    global $g5, $config;

		$boards = array();

		if( ! $boards ){
			$sql = " select bo_table from {$g5['board_table']} ";
			$result = sql_query($sql);

			while ($row = sql_fetch_array($result)) {
				$boards[] = $row['bo_table'];
			}
		}

		$segments = array();
		$url = $add_query = '';

		if(in_array($folder, $boards)) {
			$url = G5_BBS_URL. '/board.php?bo_table='. $folder;
			if($no) {
				$url .= '&amp;wr_id='. $no;
			}
			if($query_string) {
                if(substr($query_string, 0, 1) !== '&') {
                    $url .= '&amp;';
                }

				$url .= $query_string;
			}
		} else {
			$url = G5_BBS_URL. '/'.$folder.'.php';
            if($no) {
				$url .= ($folder === 'content') ? '?co_id='. $no : '?'. $no;
			}
            if($query_string) {
                $url .= ($no ? '?' : '&amp;'). $query_string;
			}
		}

        $segments[0] = $url;

		return implode('/', $segments).$add_query;
	}
}
?>