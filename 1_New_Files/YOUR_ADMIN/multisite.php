<?php
/**
 * Multisite for Zen-Cart
 * 
 * This file should be in YOUR_ADMIN/multisite.php
 * 
 */
  require('includes/application_top.php');
  set_time_limit(60*5); //set 5 minutes time limit
  /**
   * Save cats/sites
   */
  if(isset($_GET['action'])&&($_GET['action']=='categories_sites')&&isset($_GET['mode'])&&($_GET['mode']=='save')) {
    if(isset($_GET['site'])) {
    $site_param = '&site='.$_GET['site'];
  } else {
    $site_param = '';
  }
  if(isset($_POST['site'])) {
    foreach($_POST['site'] as $multisite_cat_id =>$multisite_sites) {
      $multisite_query = $db->Execute('SELECT categories_description, language_id
      FROM '.TABLE_CATEGORIES_DESCRIPTION.' cd
      WHERE categories_id = '.$multisite_cat_id);
      while(!$multisite_query->EOF) {
        $multisite_cat_desc = preg_replace('/<!--(.|\s)*?-->/', '', $multisite_query->fields['categories_description']);
        while($multisite_cat_desc['0']=="\n") {
          $multisite_cat_desc = substr($multisite_cat_desc,1);
        }
        if($multisite_sites!='') {
          $multisite_cat_desc = "<!--$multisite_sites-->\n$multisite_cat_desc";
        }
        //echo $multisite_cat_id.' -> '.$multisite_cat_desc."\n";
        $sql = "UPDATE ".TABLE_CATEGORIES_DESCRIPTION." SET categories_description=:multisiteCategoriesDescription
            WHERE language_id=".$multisite_query->fields['language_id']." AND categories_id = ".$multisite_cat_id;
        $sql = $db->bindVars($sql, ':multisiteCategoriesDescription', $multisite_cat_desc, 'string'); 
        $db->Execute($sql);
        $multisite_query->MoveNext();
      }
    }
  }
  zen_redirect(zen_href_link('multisite','action='.$_GET['action'].$site_param));
  exit;
  }

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/SyntaxHighlighter.css">
<script type="text/javascript" language="javascript" src="includes/menu.js"></script>
<script type="text/javascript" language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  
  function add_to_all_cats() {
    var new_site = document.getElementById('txt_site').value;
    if(new_site!="") {
      var form_elements = document.forms["save_multisite"].elements;
      for( var element_id in form_elements) {
        if((form_elements[element_id].name)&&(form_elements[element_id].name.substr(0,5)=="site[")) {
          if(form_elements[element_id].value=="") {
            form_elements[element_id].value = new_site;
          } else {
            var split_sites = form_elements[element_id].value.split("-");
            var found=false;
            for(var i  in split_sites) {
              if(split_sites[i]==new_site) {
                found = true;
              }
            }
            if(!found) {
              split_sites[split_sites.length]=new_site;
            }
            split_sites.sort();
            form_elements[element_id].value = split_sites.join('-');
          }
        }
      }
      document.getElementById('txt_site').value = "";
    }
  }
  function remove_from_all_cats() {
    var rmv_site = document.getElementById('txt_site').value;
    if(rmv_site!="") {
      var form_elements = document.forms["save_multisite"].elements;
      for( var element_id in form_elements) {
        if((form_elements[element_id].name)&&(form_elements[element_id].name.substr(0,5)=="site[")) {
          var split_sites = form_elements[element_id].value.split("-");
          var split_result = new Array();
          var j = 0;
          for(var i  in split_sites) {
            if(split_sites[i]!=rmv_site) {
              split_result[j] = split_sites[i];
              j++;
            }
          }
          split_result.sort();
          form_elements[element_id].value = split_result.join('-');
        }
      }
      document.getElementById('txt_site').value = "";
    }
  }
  // -->
</script>
<style type="text/css">
table.multisite_cats_sites {
  width:400px;
  margin-left:auto;
  margin-right:auto;
}
table.multisite_cats_sites td {
border-bottom:1px solid #bbb;
white-space: nowrap;
}

input.multisite_sites{
  width:200px;
}
</style>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo MULTISITE_TITLE ; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%" valign="top">
<?php
//Display menu ...
?>
<div style="text-align:center;vertical-align:middle;margin-bottom:20px;">
  <a href="?action=display_config"><?php echo MULTISITE_CONFIG_LINK ; ?></a> -
  <a href="?action=categories_sites"><?php echo MULTISITE_RELATIONS_LINK ; ?></a>
</div>
<div style="text-align:center;vertical-align:middle;margin-bottom:20px;">
<?php
if(isset($_GET['action'])) {
  switch($_GET['action']) {
    case 'display_config':
    ?>
      <?php echo MULTISITE_CONFIG_TEXT ; ?><br /><br />
      <textarea name="code" class="php" cols="100" rows="40" style="width:90%;"><?php
      $config_query = $db->Execute('SELECT cg.configuration_group_title,c.configuration_key,c.configuration_value,c.configuration_title
      FROM '.TABLE_CONFIGURATION.' c
      LEFT JOIN '.TABLE_CONFIGURATION_GROUP.' cg
      ON c.configuration_group_id=cg.configuration_group_id
      ORDER BY cg.sort_order, c.sort_order');
      $current_group_title='';
      while (!$config_query->EOF) {
        if($config_query->fields['configuration_group_title']!=$current_group_title) {
          $current_group_title = $config_query->fields['configuration_group_title'];
          echo "\n/**\n";
          echo " * $current_group_title\n";
          echo " */\n";
        }
        echo "define('".($config_query->fields['configuration_key']."','".$config_query->fields['configuration_value']."'); //".str_replace("\n",' ',$config_query->fields['configuration_title'])."\n");
        $config_query->MoveNext();
      }
      echo '</textarea>';
    break;
    case 'categories_sites':
      if(!isset($_GET['mode'])||($_GET['mode']!='save')) {
      ?>
      
      <h1><?php echo MULTISITE_CATEGORIE_TITLE ; ?></h1>
      
      <p><?php echo MULTISITE_CATEGORIE_TEXT ; ?></p>
      <label><?php echo MULTISITE_CATEGORIE_ADD_LABEL ; ?></label>&nbsp;<input id="txt_site" type="text" size="32" />
      <input type="button" onclick="add_to_all_cats()" value="<?php echo MULTISITE_BUTTON_ADD_ALL ; ?>" />
      <input type="button" onclick="remove_from_all_cats()" value="<?php echo MULTISITE_BUTTON_REMOVE_ALL ; ?>" />
      <?php echo MULTISITE_CATEGORIE_REMINDER_TEXT ; ?>
      <br /><br />
      <?php
      $multisite_category_tree=zen_get_category_tree();
      //print_r($multisite_category_tree);exit;
      $multisite_list = array();
      if(isset($_GET['site'])) {
        $filter = ' AND cd.categories_description LIKE "%-'.$_GET['site'].'-%" ';
        $site_param = '&amp;site='.$_GET['site'];
      } else {
        $filter ='';
        $site_param = '';
      }
      $total_cats = sizeof($multisite_category_tree)-'1';
      foreach($multisite_category_tree as $multisite_key=>$multisite_category) {
        if($multisite_category['id']=='0') {
          unset($multisite_category_tree[$multisite_key]); //remove the top category
        } else {
          $multisite_query = $db->Execute('SELECT cd.categories_description,c.categories_status
          FROM '.TABLE_CATEGORIES_DESCRIPTION.' cd
          INNER JOIN '.TABLE_CATEGORIES.' c ON cd.categories_id=c.categories_id
          WHERE c.categories_id = '.$multisite_category['id'].'
          '.$filter);
          $sites = array();
          if($multisite_query->EOF) {
            unset($multisite_category_tree[$multisite_key]);
          } else {
            while(!$multisite_query->EOF)  {
              $multisite_cat_desc = $multisite_query->fields['categories_description'];
              preg_match_all('/<!--(.|\s)*?-->/',$multisite_cat_desc,$multisite_comments,PREG_PATTERN_ORDER);
              $multisite_cat_sites=array();
                foreach($multisite_comments['0'] as $multisite_comment) {
                $multisite_comment= preg_replace('/\s\s+|/','', $multisite_comment);
                $multisite_cat_sites[]=substr($multisite_comment,4,sizeof($multisite_comment)-4); //remove html comment
                }
                //Add to the list of all sites
                $multisite_cat_sites = implode('-',$multisite_cat_sites);
                $new_sites = explode('-',$multisite_cat_sites);
                foreach($new_sites as $site) {
                  if($site!='') {
                    $sites[$site]='1';
                  }
                }
                $multisite_query->MoveNext();
            }
            //print_r($sites);exit;
            ksort($sites);
            $multisite_cat_sites=array();
            foreach($sites as $site=>$value) {
              $multisite_cat_sites[]=$site;
            }
            $multisite_category_tree[$multisite_key]['sites']=implode('-',$multisite_cat_sites);
              $multisite_category_tree[$multisite_key]['status']=$multisite_query->fields['categories_status'];
              $multisite_category_tree[$multisite_key]['cPath_parent']=MultisiteGetcPath($multisite_category['id']);
              if($multisite_category_tree[$multisite_key]['cPath_parent']=='0') {
                $multisite_category_tree[$multisite_key]['cPath']=$multisite_category['id'];
              } else {
                $multisite_category_tree[$multisite_key]['cPath']=$multisite_category_tree[$multisite_key]['cPath_parent'].'_'.$multisite_category['id'];
              }
              foreach($sites as $site=>$value) {
                if(!isset($multisite_list[$site])) {
                  $multisite_list[$site]='1';
                } else {
                  $multisite_list[$site]++;
                }
              }
          }
        }
      }
      arsort($multisite_list);
      $display_sites = array();
      $display_sites[] = '<a href="'.zen_href_link('multisite','action='.$_GET['action']).'">' . MULTISITE_CATEGORIE_ALL_TEXT . '</a> ('.$total_cats.')';
      foreach($multisite_list as $site=>$cat_number) {
        $display_sites[] =  '<a href="'.zen_href_link('multisite','action='.$_GET['action'].'&amp;site='.$site).'">'.$site.'</a> ('.$cat_number.')';
      }
      echo implode(' - ',$display_sites)."<br /><br />\n";
      echo zen_draw_form('save_multisite', 'multisite', 'action='.$_GET['action'].'&amp;mode=save'.$site_param,'post', 'enctype="multipart/form-data"');
      echo zen_image_submit('button_save.gif', IMAGE_SAVE);
      ?>
      <table class="multisite_cats_sites">
      <tr style="text-align:center;font-weight:bold;"><td><?php echo MULTISITE_CATEGORIE ; ?></td><td><?php echo MULTISITE_SITE ; ?></td></tr>
      <?php
      foreach($multisite_category_tree as $multisite_category) {
          echo '<tr>';
          echo '<td>';
          if ($multisite_category['status'] == '1') {
            echo '<a target="_blank" href="'.zen_href_link(FILENAME_CATEGORIES, 'action=setflag_categories&amp;flag=0&amp;cID='.$multisite_category['id'].'&amp;cPath='.$multisite_category['cPath_parent']).'">'.zen_image(DIR_WS_IMAGES.'icon_green_on.gif',IMAGE_ICON_STATUS_ON).'</a>';
          } else {
            echo '<a target="_blank" href="'.zen_href_link(FILENAME_CATEGORIES, 'action=setflag_categories&amp;flag=1&amp;cID='.$multisite_category['id'].'&amp;cPath='.$multisite_category['cPath_parent']).'">'.zen_image(DIR_WS_IMAGES.'icon_red_on.gif',IMAGE_ICON_STATUS_OFF).'</a>';
          }
          echo '&nbsp;<a href="'.zen_href_link(FILENAME_CATEGORIES,'action=edit_category&amp;cPath='.$multisite_category['cPath_parent'].'&amp;cID='.$multisite_category['id']).'">';
          echo zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT);
          echo '</a>&nbsp;';
          echo '<a href="'.zen_href_link(FILENAME_CATEGORIES,'cPath='.$multisite_category['cPath']).'">';
          echo str_replace(' ','&nbsp;',str_replace('&nbsp;&nbsp;&nbsp;','_&nbsp;',$multisite_category['text']));
          echo '</a>';
          echo '</td>';
          echo '<td><input class="multisite_sites" type="text" name="site['.$multisite_category['id'].']" value="'.$multisite_category['sites'].'"/></td>';
          echo "</tr>\n";
      }
      ?>
      </table>
      <?php echo zen_image_submit('button_save.gif', IMAGE_SAVE); ?>
      </form>
      <?php
    }
    break;
  }
}
?>
</div>
        </td>
      </tr>
<!-- body_text_eof //-->
    </table>
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<script type="text/javascript" language="javascript" src="includes/shCore.js"></script>
<script type="text/javascript" language="javascript" src="includes/shBrushPhp.js"></script>
<script type="text/javascript" language="javascript" src="includes/shBrushXml.js"></script>
<script type="text/javascript" language="javascript">
dp.SyntaxHighlighter.ClipboardSwf = '/includes/clipboard.swf';
dp.SyntaxHighlighter.HighlightAll('code');
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php');

/**
 * 
 * FUNCTION USED ....
 * 
 */

// retrieve full cPath from category ID
function MultisiteGetcPath($cID){
  global $db;
  static $parent_cache = array();
  $cats = array();
  //$cats[] = $cID;
  $parent = $db->Execute("SELECT parent_id, categories_id
                          FROM " . TABLE_CATEGORIES . "
                          WHERE categories_id=" . (int)$cID);
  while(!$parent->EOF && $parent->fields['parent_id'] != '0') {
    $parent_cache[(int)$parent->fields['categories_id']] = (int)$parent->fields['parent_id'];
    $cats[] = $parent->fields['parent_id'];
    if(isset($parent_cache[(int)$parent->fields['parent_id']])) {
      $parent->fields['parent_id'] = $parent_cache[(int)$parent->fields['parent_id']];
    } else {
      $parent = $db->Execute("SELECT parent_id, categories_id
                              FROM " . TABLE_CATEGORIES . "
                              WHERE categories_id=" . (int)$parent->fields['parent_id']);
    }
  }
  $cats = array_reverse($cats);
  $cPath = implode('_', $cats);
  if($cPath=='') {
    $cPath='0';
  }
  return $cPath;
}
?>