<?php
/**
 * Multisite for Zen-Cart
 * 
 * This file should be in includes/admin/multisite.php
 * 
 */
require('includes/application_top.php');

$action = (isset($_GET['action']) ? $_GET['action'] : '');
/**
 * Save cats/sites
 */
if (isset($action) && ($action == 'categories_sites') && isset($_GET['mode']) && ($_GET['mode'] == 'save')) {
  if (isset($_GET['site'])) {
    $site_param = '&site=' . $_GET['site'];
  } else {
    $site_param = '';
  }
  if (isset($_POST['site'])) {
    foreach ($_POST['site'] as $multisite_cat_id => $multisite_sites) {
      $multisite_query = $db->Execute("SELECT categories_description, language_id
                                       FROM " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                       WHERE categories_id = " . (int)$multisite_cat_id);
      foreach ($multisite_query as $site) {
        $multisite_cat_desc = preg_replace('/<!--(.|\s)*?-->/', '', $site['categories_description']);
        while ($multisite_cat_desc['0'] == "\n") {
          $multisite_cat_desc = substr($multisite_cat_desc, 1);
        }
        if ($multisite_sites != '') {
          $multisite_cat_desc = "<!--$multisite_sites-->\n$multisite_cat_desc";
        }
        //echo $multisite_cat_id.' -> '.$multisite_cat_desc."\n";
        $sql = "UPDATE " . TABLE_CATEGORIES_DESCRIPTION . "
                SET categories_description = :multisiteCategoriesDescription
                WHERE language_id = " . (int)$site['language_id'] . "
                AND categories_id = " . (int)$multisite_cat_id;
        $sql = $db->bindVars($sql, ':multisiteCategoriesDescription', $multisite_cat_desc, 'string');
        $db->Execute($sql);
      }
    }
  }
  zen_redirect(zen_href_link(FILENAME_MULTISITE, 'action=' . $_GET['action'] . $site_param));
  exit;
}
?>

<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" href="includes/stylesheet.css">
    <link rel="stylesheet" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <script src="includes/menu.js"></script>
    <script src="includes/general.js"></script>
    <script type="text/javascript">
      function init() {
          cssjsmenu('navbar');
          if (document.getElementById)
          {
              var kill = document.getElementById('hoverJS');
              kill.disabled = true;
          }
      }

      function add_to_all_cats() {
          var new_site = $('#txt_site').val();
          if (new_site != '') {
              var form_elements = document.forms["save_multisite"].elements;
              for (var element_id in form_elements) {
                  if ((form_elements[element_id].name) && (form_elements[element_id].name.substr(0, 5) == " site[")) {
                      if (form_elements[element_id].value == '') {
                          form_elements[element_id].value = new_site;
                      } else {
                          var split_sites = form_elements[element_id ].value.split("-");
                          var found = false;
                          for (var i in split_sites) {
                              if (split_sites[i] == new_site) {
                                  found = true;
                              }
                          }
                          if (!found) {
                              split_sites[split_sites.length] = new_site;
                          }
                          split_sites.sort();
                          form_elements[element_id].value = split_sites.join('-');
                      }
                  }
              }
              $('#txt_site').val('');
          }
      }
      function remove_from_all_cats() {
          var rmv_site = $('#txt_site').val();
          if (rmv_site != '') {
              var form_elements = document.forms['save_multisite'].elements;
              for (var element_id in form_elements) {
                  if ((form_elements[element_id].name) && (form_elements[element_id].name.substr(0, 5) == 'site[')) {
                      var split_sites = form_elements[element_id].value.split("-");
                      var split_result = new Array();
                      var j = 0;
                      for (var i  in split_sites) {
                          if (split_sites[i] != rmv_site) {
                              split_result[j] = split_sites[i];
                              j++;
                          }
                      }
                      split_result.sort();
                      form_elements[element_id].value = split_result.join('-');
                  }
              }
              $('#txt_site').val('');
          }
      }
    </script>
  </head>
  <body onLoad="init()">
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->

    <!-- body //-->
    <div class="container-fluid">
      <!-- body_text //-->
      <h1><?php echo MULTISITE_TITLE; ?></h1>
      <?php
//Display menu ...
      ?>
      <div class="row text-center">
        <a href="<?php echo zen_href_link(FILENAME_MULTISITE, 'action=display_config'); ?>" class="btn btn-default" role="button"><?php echo MULTISITE_CONFIG_LINK; ?></a> - <a href="<?php echo zen_href_link(FILENAME_MULTISITE, 'action=categories_sites'); ?>" class="btn btn-default" role="button"><?php echo MULTISITE_RELATIONS_LINK; ?></a>
      </div>
      <?php
      if (isset($action)) {
        switch ($action) {
          case 'display_config':
            ?>
            <div class="row text-center">
              <?php echo MULTISITE_CONFIG_TEXT; ?><br><br>
              <textarea name="code" class="php form-control" cols="100" rows="40" style="width:90%;">
                  <?php
                  $config_query = $db->Execute("SELECT cg.configuration_group_title,c.configuration_key,c.configuration_value,c.configuration_title
                                                FROM " . TABLE_CONFIGURATION . " c
                                                LEFT JOIN " . TABLE_CONFIGURATION_GROUP . " cg ON c.configuration_group_id = cg.configuration_group_id
                                                ORDER BY cg.sort_order, c.sort_order");
                  $current_group_title = '';
                  foreach ($config_query as $config) {
                    if ($config['configuration_group_title'] != $current_group_title) {
                      $current_group_title = $config['configuration_group_title'];
                      echo "\n/**\n";
                      echo " * $current_group_title\n";
                      echo " */\n";
                    }
                    echo "define('" . ($config['configuration_key'] . "','" . $config['configuration_value'] . "'); //" . str_replace("\n", ' ', $config['configuration_title']) . "\n");
                  }
                  ?>
              </textarea>
            </div>
            <?php
            break;
          case 'categories_sites':
            if (!isset($_GET['mode']) || ($_GET['mode'] != 'save')) {
              ?>
              <div class="row">
                <div class="text-center">
                  <h4><?php echo MULTISITE_CATEGORIE_TITLE; ?></h4>
                  <p><?php echo MULTISITE_CATEGORIE_TEXT; ?></p>
                </div>
                <?php echo zen_draw_label(MULTISITE_CATEGORIE_ADD_LABEL, 'txt_site', ' class="control-label col-sm-3"'); ?>
                <div class="col-sm-9 col-md-6">
                    <?php echo zen_draw_input_field('txt_site', '', 'id="txt_site" size="32" class="form-control"'); ?>
                </div>
                <div class="col-sm-offset-3 col-sm-9 col-md-6 text-right" style="margin-top: 5px;">
                  <button type="button" onclick="add_to_all_cats()" class="btn btn-default"><?php echo MULTISITE_BUTTON_ADD_ALL; ?></button>
                  <button type="button" onclick="remove_from_all_cats()" class="btn btn-default"><?php echo MULTISITE_BUTTON_REMOVE_ALL; ?></button>
                  <span class="help-block"><?php echo MULTISITE_CATEGORIE_REMINDER_TEXT; ?></span>
                </div>
                <?php
                $multisite_category_tree = zen_get_category_tree();
                //print_r($multisite_category_tree);exit;
                $multisite_list = array();
                if (isset($_GET['site'])) {
                  $filter = ' AND cd.categories_description LIKE "%-' . $_GET['site'] . '-%" ';
                  $site_param = '&amp;site=' . $_GET['site'];
                } else {
                  $filter = '';
                  $site_param = '';
                }
                $total_cats = sizeof($multisite_category_tree) - '1';
                foreach ($multisite_category_tree as $multisite_key => $multisite_category) {
                  if ($multisite_category['id'] == '0') {
                    unset($multisite_category_tree[$multisite_key]); //remove the top category
                  } else {
                    $multisite_query = $db->Execute("SELECT cd.categories_description,c.categories_status
                                                     FROM " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                                     INNER JOIN " . TABLE_CATEGORIES . " c ON cd.categories_id = c.categories_id
                                                     WHERE c.categories_id = " . $multisite_category['id'] . "
                                                     " . $filter);
                    $sites = array();
                    if ($multisite_query->EOF) {
                      unset($multisite_category_tree[$multisite_key]);
                    } else {
                      foreach ($multisite_query as $item) {
                        $multisite_cat_desc = $item['categories_description'];
                        preg_match_all('/<!--(.|\s)*?-->/', $multisite_cat_desc, $multisite_comments, PREG_PATTERN_ORDER);
                        $multisite_cat_sites = array();
                        foreach ($multisite_comments['0'] as $multisite_comment) {
                          $multisite_comment = preg_replace('/\s\s+|/', '', $multisite_comment);
                          $multisite_cat_sites[] = substr($multisite_comment, 4, sizeof($multisite_comment) - 4); //remove html comment
                        }
                        //Add to the list of all sites
                        $multisite_cat_sites = implode('-', $multisite_cat_sites);
                        $new_sites = explode('-', $multisite_cat_sites);
                        foreach ($new_sites as $site) {
                          if ($site != '') {
                            $sites[$site] = '1';
                          }
                        }
                      }
                      //print_r($sites);exit;
                      ksort($sites);
                      $multisite_cat_sites = array();
                      foreach ($sites as $site => $value) {
                        $multisite_cat_sites[] = $site;
                      }
                      $multisite_category_tree[$multisite_key]['sites'] = implode('-', $multisite_cat_sites);
                      $multisite_category_tree[$multisite_key]['status'] = $multisite_query->fields['categories_status'];
                      $multisite_category_tree[$multisite_key]['cPath_parent'] = MultisiteGetcPath($multisite_category['id']);
                      if ($multisite_category_tree[$multisite_key]['cPath_parent'] == '0') {
                        $multisite_category_tree[$multisite_key]['cPath'] = $multisite_category['id'];
                      } else {
                        $multisite_category_tree[$multisite_key]['cPath'] = $multisite_category_tree[$multisite_key]['cPath_parent'] . '_' . $multisite_category['id'];
                      }
                      foreach ($sites as $site => $value) {
                        if (!isset($multisite_list[$site])) {
                          $multisite_list[$site] = '1';
                        } else {
                          $multisite_list[$site] ++;
                        }
                      }
                    }
                  }
                }
                arsort($multisite_list);
                $display_sites = array();
                $display_sites[] = '<a href="' . zen_href_link(FILENAME_MULTISITE, 'action=' . $action) . '" class="btn btn-default btn-sm" role="button">' . MULTISITE_CATEGORIE_ALL_TEXT . '</a> (' . $total_cats . ')';
                foreach ($multisite_list as $site => $cat_number) {
                  $display_sites[] = '<a href="' . zen_href_link(FILENAME_MULTISITE, 'action=' . $action . '&site=' . $site) . '" class="btn btn-default btn-sm" role="button">' . $site . '</a> (' . $cat_number . ')';
                }
                ?>
                <div class="col-sm-12 text-center">
                    <?php
                    echo implode(' - ', $display_sites) . "<br><br>\n";
                    ?>
                </div>
                <div class="col-sm-12">
                    <?php echo zen_draw_form('save_multisite', FILENAME_MULTISITE, 'action=' . $action . '&mode=save' . $site_param, 'post', 'enctype="multipart/form-data" class="form-horizontal"'); ?>
                  <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary"><?php echo IMAGE_SAVE; ?></button>
                  </div>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th><?php echo TABLE_HEADING_MULTISITE_CATEGORIE; ?></th>
                        <th><?php echo TABLE_HEADING_MULTISITE_SITE; ?></th>
                        <th><?php echo TABLE_HEADING_ACTION; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($multisite_category_tree as $multisite_category) {
                          ?>
                        <tr>
                          <td>
                            <a href="<?php echo zen_href_link(FILENAME_CATEGORIES, 'cPath=' . $multisite_category['cPath']); ?>">
                                <?php echo str_replace(' ', '&nbsp;', str_replace('&nbsp;&nbsp;&nbsp;', '_&nbsp;', $multisite_category['text'])); ?>
                            </a>
                          </td>
                          <td>
                              <?php echo zen_draw_input_field('site[' . $multisite_category['id'] . ']', $multisite_category['sites'], 'class="form-control"'); ?>
                          </td>
                          <td>

                            <?php
                            if ($multisite_category['status'] == '1') {
                              ?>
                              <a target="_blank" href="<?php echo zen_href_link(FILENAME_CATEGORIES, 'action=setflag_categories&flag=0&cID=' . $multisite_category['id'] . '&cPath=' . $multisite_category['cPath_parent']); ?>'"><?php echo zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON); ?></a>
                              <?php
                            } else {
                              ?>
                              <a target="_blank" href="<?php echo zen_href_link(FILENAME_CATEGORIES, 'action=setflag_categories&flag=1&cID=' . $multisite_category['id'] . '&cPath=' . $multisite_category['cPath_parent']); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF); ?></a>
                              <?php
                            }
                            ?>
                            &nbsp;<a href="<?php echo zen_href_link(FILENAME_CATEGORIES, 'action=edit_category&cPath=' . $multisite_category['cPath_parent'] . '&cID=' . $multisite_category['id']); ?>">
                              <?php echo zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT); ?></a>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><?php echo IMAGE_SAVE; ?></button>
                  </div>
                  <?php echo '</form>'; ?>
                </div>
                <?php
              }
              ?>
            </div>
            <?php
            break;
        }
      }
      ?>
      <!-- body_text_eof //-->
    </div>
    <!-- body_eof //-->

    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php
require(DIR_WS_INCLUDES . 'application_bottom.php');
