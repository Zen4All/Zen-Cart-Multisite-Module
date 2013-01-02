<?php
/**
 * Multisite Module function
 * Modify the queries of Zen-cart in order to filter the ezpages
 *
 * @param String $sql
 * @return String
 *
 * Create a function
 * Create an extra field in expages called sites that works like product / category - uses same site name
 * e.g. <!--Site Name1-Site Name2-->
 * Edit routines that look for ezpages
 */
function ezpages_filter($sql) { // only allow selected ezpages
  if(!defined('ALLOW_EZPAGES_FILTER')||(ALLOW_EZPAGES_FILTER!='no')) {
    // define('ALLOW_EZPAGES_FILTER','no') will desactivate the category filter
    $sql = preg_replace('/\s\s+/', ' ', $sql);
    $sql2 = $sql;
    $sql_lower = strtolower($sql);
    $str_pos_ezpages = strpos($sql_lower,TABLE_EZPAGES);
    $str_pos_where = strpos($sql_lower,'where');
    $fix = 0;
    if(($str_pos_where===false)&&($str_pos_ezpages!==false)) {
    // There is a the table EZPAGES in "FROM" and there is no "WHERE"
      $fix = 1;
    } elseif (($str_pos_ezpages!==false)&&($str_pos_ezpages<$str_pos_where)) {
    // There is "ezpages p" before "WHERE"
      $fix = 1;
    }

    if ($fix == 1) {
      $sql = substr($sql,0,$str_pos_where + 6).
        " ezpages_description LIKE '%-".SITE_NAME."-%'
        AND languages_id=".$_SESSION['languages_id']." AND ".
        substr($sql,$str_pos_where + 6);
    }
  }
  if($sql==$sql2) {
    $fh = fopen(DIR_FS_LOGS.'/multisite_logs.txt','a');
    fwrite($fh, "Query not changed:\n".$sql2."\n\n");
    fclose($fh);
  }
  return $sql;
}
?>