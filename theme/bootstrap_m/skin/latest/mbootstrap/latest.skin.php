<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php for ($i=0; $i<count($list); $i++) {  ?>
<?php echo $list[$i]['subject'] ?>  <a href="<?php echo $list[$i]['href'] ?>">more</a><br>
<?php } ?>
</p>