<div id="contentWrapper">
  <h1>Multi Site Module v1.0 for ZC 1.5.1 Documentation</h1>
  <div id="contentMenu">
    <ul>
      <li><a href="#introduction">Introduction</a></li>
      <li><a href="#whats_new">What's New</a></li>
      <li><a href="#installation">Installation</a></li>
      <li><a href="#upgrade">Upgrade</a></li>
      <li><a href="#version_history">Version History</a></li>
      <li><a href="#faqs">FAQs</a></li>
      <li><a href="#support">Support</a></li>
      <li><a href="#donations">Donations</a></li>
    </ul>
  </div>
  <h2><a name="introduction" id="introduction"></a>Introduction</h2>
  <div id="contentDescription">
    <p>This contribution Multi Site support to Zen Cart.</p>
    <p>Credit is due to <a href="http://www.medea.co.uk/" target="_blank">Gerome Romey</a> for creating Multi Site 0.4, <a href="http://www.gjbenterprises.com/" target="_blank">Gordon Bunker</a> for his work on the ez-page filter module for multi sites, and the <a href="http://www.zen-cart.com/index.php" target="_blank">Zen Cart Team</a> for creating the best open source ecommerce package available!</p>
  </div>
  <h2><a name="whats_new" id="whats_new"></a>What's New</h2>
  <div id="contentDescription">
    <p>Version 1.0 - Release Date: 2012-xx-xx</p>
    <ul>
    <li>Updated most files to contain the code of Zen Cart 1.5.1</li>
    <li>Added the admin module registration for Zen Cart 1.5.x</li>
    <li>The module is now multi lingual on the admin side as well as the Frontend</li>
    <li>The sitelink sidebox has its own tpl file</li>
    <li>Added ez-page filter module for multi site</li>
    <li>Added SybtaxHightlighter 1.5.1 to multisite.php</li>
    </ul>
  </div>
  <h2><a name="installation" id="installation"></a>Installation</h2>
  <div id="contentDescription">
    <p>This version of Multi Site has been updated and tested for use with Zen Cart 1.5.1</p>
<p>Please remember to <strong>backup your website files and database</strong> before you continue.</p>
    <p>To install Multi Site follow the steps below.</p>
    <ol>
      <li>Download the latest version of Multi Site from <span style="color:red;font-size:smaller;">(this link will be edited when the final release is on zen-cart.com)</span>:<br />
        <a href="http://www.zen-cart.com/index.php?main_page=product_contrib_info&amp;products_id=273" target="_blank">https://github.com/Zen4All/Zen-Cart-Multisite-Module/archive/Beta-for-ZC-1.5.1.zip<br />
        <br />
        </a></li>
      <li>Extract the contents  (of Beta-for-ZC-1.5.1.zip) to a temporary location, keeping the file structure intact. (Note: If you can't open this file try using <a href="http://www.7-zip.org/" target="_blank">7-Zip</a>, it's free!)<br />
        <br />
      </li>
      <li>Open the <strong>4_SQL_Files</strong> folder and then open the install.sql file in a text editor (not microsoft word) and copy all of the text to the clipboard. Next go to (Admin &gt; Tools &gt; Install SQL Patches) in your Zen Cart admin and paste the contents of install.sql into the text area and then press the send button.<br />
      This adds the column 'order_site' to the 'Orders' Table to know which site orders originate from, and the column 'ezpages_description' to the 'ezpages' Table for ez page filtering.
        <br />
      </li>
      <li><span style="color:#900"><b>Alternative to step 3.</b></span> Open phpMyAdmin for your site and navigate to your database. Choose 'Import' and then 'choose file' and navigate to and select install.sql then choose 'Go'.<br /><br />
      </li>
      <li>Open the <strong>1_New_Files</strong> folder<br />
        <br />
      </li>
      <li>Rename the following folders to match your admin folder name.<strong>
        <br />
        <ul>
          <li>YOUR_ADMIN</li>
        </ul></strong><br />
      </li>
      <li>Upload the entire contents of the <strong>1_New_Files</strong> folder, includes folder and the images folder to your server, again keeping the file structure intact.
        <br />
        <ul>
          <li>YOUR_ADMIN/multisite.php</li>
          <li>YOUR_ADMIN/includes/autoloaders/config.multisite.php</li>
          <li>YOUR_ADMIN/includes/extra_datafiles/multisite.php</li>
          <li>YOUR_ADMIN/includes/init_includes/init_multisite_config.php</li>
          <li>YOUR_ADMIN/includes/languages/dutch/multisite.php</li>
          <li>YOUR_ADMIN/includes/languages/dutch/extra_definitions/multisite.php</li>
          <li>YOUR_ADMIN/includes/languages/dutch/extra_definitions/order_site.php</li>
          <li>YOUR_ADMIN/includes/languages/english/multisite.php</li>
          <li>YOUR_ADMIN/includes/languages/english/extra_definitions/multisite.php</li>
          <li>YOUR_ADMIN/includes/languages/english/extra_definitions/order_site.php</li>
          <li>YOUR_ADMIN/includes/clipboard.swf</li>
          <li>YOUR_ADMIN/includes/shBrushPhp.js</li>
          <li>YOUR_ADMIN/includes/shBrushXml.js</li>
          <li>YOUR_ADMIN/includes/shCore.js</li>
          <li>YOUR_ADMIN/includes/SyntaxHighlighter.css</li>
          <li>includes/config_sites/2fastshoes.com_config.php <span style="color:red;font-size:smaller;">(This is only an example config file)</span></li>
          <li>includes/config_sites/help.txt</li>
          <li>includes/config_sites/sites_switch.php</li>
          <li>includes/config_sites/www.example.com_config.php <span style="color:red;font-size:smaller;">(This is only an example config file)</span></li>
          <li>includes/functions/extra_functions/cat_filter.php</li>
          <li>includes/functions/extra_functions/ezpages_filter.php</li>
          <li>includes/languages/dutch/extra_definitions/site_links.php</li>
          <li>includes/languages/english/extra_definitions/site_links.php</li>
          <li>includes/modules/sideboxes/site_links.php</li>
          <li>includes/templates/template_default/sideboxes/tpl_site_links.php</li>
        </ul>
        <br />
      </li>
    </ol>
    <p>Zen Lightbox is now installed and ready to use!</p>
    <p>You can configure various settings from the Zen Cart admin (Admin &gt; Configuration &gt; Zen Lightbox).</p>
    <p><strong>EZ-Pages</strong></p>
    <p>By default the lightbox effect will be applied to all links that point to images on your EZ-Pages. This functionality can easily be modified via the admin.</p>
    <p>The gallery mode will automatically be used when more than one link to an image (on an EZ-Page) are located within the same parent element.</p>
    <p>The only manual bit of coding required is the addition of captions (if you need them). You can add captions by including the rel=&quot;&quot; attribute in your href tag. An example of this can be found below.</p>
    <div id="code">&lt;a href=&quot;myimage.jpg&quot; <span style="color: #FF0000">rel=&quot;here is my caption&quot;</span>&gt;My Image&lt;/a&gt;  </div>
  </div>
  <h2><a name="upgrade" id="upgrade"></a>Upgrade <span style="color: #F00;">(fresh installation is recommended)</span></h2>
  <div id="contentDescription" >
  <h3><span style="color: blue; border-bottom:1px solid;">Upgrading from Zen Lightbox 1.6.3</span></h3>
  <p><strong>File updates</strong>:  
  <ul>
    <li>Remove [images/zen_lightbox]</li>
    <li> [includes/classes/zen_lightbox/autoload_default.php] </li>
    <li> [includes/modules/pages/page/jscript_zen_lightbox.php] </li>
    <li> [includes/templates/YOUR_TEMPLATE_FOLDER/css/stylesheet_zen_lightbox.css</li>
  </ul>
  <hr />
  </div>
  <h2><a name="version_history" id="version_history"></a>Version History</h2>
  <div id="content<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Multi Site v1.0</title>
<style>
#code{background-color:#CCC;border:1px solid #000;padding:5px;}
#contentDescription{line-height:150%;margin:30px 20px;}
#contentMenu{font-size:12px;font-weight:700;text-align:center;}
#contentMenu ul{list-style-type:none;margin:auto;padding:20px;}
#contentMenu ul li{display:inline;}
#contentMenu ul li a{padding-left:10px;padding-right:10px;text-decoration:none;}
#contentWrapper{font-size:14px;margin:auto;padding-top:15px;width:800px;}
#copyright{font-size:11px;margin-bottom:15px;text-align:center;}
#exampleImage{text-align:center;}
#payPalBanner{margin:auto;text-align:center;}
#payPalBannerBorder{border-bottom:1px solid #696969;padding-bottom:15px;}
#payPalBannerWrapper{background-color:#FFFFE1;border-bottom:1px solid #A0A0A0;color:#000;padding-top:15px;text-decoration:none;}
#payPalBannerWrapper:hover{background-color:#39F;color:#FFF;}
#payPalButton2{padding:5px;text-align:center;}
.payPalBannerDescription{font-size:12px;}
.payPalLink{display:block;}
a{color:#03C;}
a img{border:none;}
a:hover{color:#C00;}
body{font-family:Verdana, Arial, Helvetica, sans-serif;margin:0;}
h1{font-size:24px;}
h2{
	border:1px solid #000;
	font-size:18px;
	padding:5px;
}
</style>
</head>
<body>
<a name="top" id="top"></a>

<script language="JavaScript" type="text/javascript"><!--
	document.write('</span></a>');
	//--></script>
<div id="contentWrapper">
  <h1>Multi Site Module v1.0 for ZC 1.5.1 Documentation</h1>
  <div id="contentMenu">
    <ul>
      <li><a href="#introduction">Introduction</a></li>
      <li><a href="#whats_new">What's New</a></li>
      <li><a href="#installation">Installation</a></li>
      <li><a href="#upgrade">Upgrade</a></li>
      <li><a href="#version_history">Version History</a></li>
      <li><a href="#faqs">FAQs</a></li>
      <li><a href="#support">Support</a></li>
      <li><a href="#donations">Donations</a></li>
    </ul>
  </div>
  <h2><a name="introduction" id="introduction"></a>Introduction</h2>
  <div id="contentDescription">
    <p>This contribution Multi Site support to Zen Cart.</p>
    <p>Credit is due to <a href="http://www.medea.co.uk/" target="_blank">Gerome Romey</a> for creating Multi Site 0.4, <a href="http://www.gjbenterprises.com/" target="_blank">Gordon Bunker</a> for his work on the ez-page filter module for multi sites, and the <a href="http://www.zen-cart.com/index.php" target="_blank">Zen Cart Team</a> for creating the best open source ecommerce package available!</p>
  </div>
  <h2><a name="whats_new" id="whats_new"></a>What's New</h2>
  <div id="contentDescription">
    <p>Version 1.0 - Release Date: 2012-xx-xx</p>
    <ul>
    <li>Updated most files to contain the code of Zen Cart 1.5.1</li>
    <li>Added the admin module registration for Zen Cart 1.5.x</li>
    <li>The module is now multi lingual on the admin side as well as the Frontend</li>
    <li>The sitelink sidebox has its own tpl file</li>
    <li>Added ez-page filter module for multi site</li>
    <li>Added SybtaxHightlighter 1.5.1 to multisite.php</li>
    </ul>
  </div>
  <h2><a name="installation" id="installation"></a>Installation</h2>
  <div id="contentDescription">
    <p>This version of Multi Site has been updated and tested for use with Zen Cart 1.5.1</p>
<p>Please remember to <strong>backup your website files and database</strong> before you continue.</p>
    <p>To install Multi Site follow the steps below.</p>
    <ol>
      <li>Download the latest version of Multi Site from <span style="color:red;font-size:smaller;">(this link will be edited when the final release is on zen-cart.com)</span>:<br />
        <a href="http://www.zen-cart.com/index.php?main_page=product_contrib_info&amp;products_id=273" target="_blank">https://github.com/Zen4All/Zen-Cart-Multisite-Module/archive/Beta-for-ZC-1.5.1.zip<br />
        <br />
        </a></li>
      <li>Extract the contents  (of Beta-for-ZC-1.5.1.zip) to a temporary location, keeping the file structure intact. (Note: If you can't open this file try using <a href="http://www.7-zip.org/" target="_blank">7-Zip</a>, it's free!)<br />
        <br />
      </li>
      <li>Open the <strong>4_SQL_Files</strong> folder and then open the install.sql file in a text editor (not microsoft word) and copy all of the text to the clipboard. Next go to (Admin &gt; Tools &gt; Install SQL Patches) in your Zen Cart admin and paste the contents of install.sql into the text area and then press the send button.<br />
      This adds the column 'order_site' to the 'Orders' Table to know which site orders originate from, and the column 'ezpages_description' to the 'ezpages' Table for ez page filtering.
        <br />
      </li>
      <li><span style="color:#900"><b>Alternative to step 3.</b></span> Open phpMyAdmin for your site and navigate to your database. Choose 'Import' and then 'choose file' and navigate to and select install.sql then choose 'Go'.<br /><br />
      </li>
      <li>Open the <strong>1_New_Files</strong> folder<br />
        <br />
      </li>
      <li>Rename the following folders to match your admin folder name.
        <br />
        <ul>
          <li><strong>YOUR_ADMIN</strong></li>
        </ul><br />
      </li>
      <li>Upload the entire contents of the <strong>1_New_Files</strong> folder, includes folder and the admin folder to your server, again keeping the file structure intact.
        <br />
        <ul>
          <li>YOUR_ADMIN/multisite.php</li>
          <li>YOUR_ADMIN/includes/autoloaders/config.multisite.php</li>
          <li>YOUR_ADMIN/includes/extra_datafiles/multisite.php</li>
          <li>YOUR_ADMIN/includes/init_includes/init_multisite_config.php</li>
          <li>YOUR_ADMIN/includes/languages/dutch/multisite.php</li>
          <li>YOUR_ADMIN/includes/languages/dutch/extra_definitions/multisite.php</li>
          <li>YOUR_ADMIN/includes/languages/dutch/extra_definitions/order_site.php</li>
          <li>YOUR_ADMIN/includes/languages/english/multisite.php</li>
          <li>YOUR_ADMIN/includes/languages/english/extra_definitions/multisite.php</li>
          <li>YOUR_ADMIN/includes/languages/english/extra_definitions/order_site.php</li>
          <li>YOUR_ADMIN/includes/clipboard.swf</li>
          <li>YOUR_ADMIN/includes/shBrushPhp.js</li>
          <li>YOUR_ADMIN/includes/shBrushXml.js</li>
          <li>YOUR_ADMIN/includes/shCore.js</li>
          <li>YOUR_ADMIN/includes/SyntaxHighlighter.css</li>
          <li>includes/config_sites/2fastshoes.com_config.php <span style="color:red;font-size:smaller;">(This is only an example config file)</span></li>
          <li>includes/config_sites/help.txt</li>
          <li>includes/config_sites/sites_switch.php</li>
          <li>includes/config_sites/www.example.com_config.php <span style="color:red;font-size:smaller;">(This is only an example config file)</span></li>
          <li>includes/functions/extra_functions/cat_filter.php</li>
          <li>includes/functions/extra_functions/ezpages_filter.php</li>
          <li>includes/languages/dutch/extra_definitions/site_links.php</li>
          <li>includes/languages/english/extra_definitions/site_links.php</li>
          <li>includes/modules/sideboxes/site_links.php</li>
          <li>includes/templates/template_default/sideboxes/tpl_site_links.php</li>
        </ul>
        <br />
      </li>
      <li>Open the<strong> 2_Required_Core_Edits</strong> folder.<br />
        <br />
      </li>
      <li>Rename the following folder to match your admin folder name.
        <br />
        <ul>
          <li><strong>YOUR_ADMIN</strong></li>
        </ul><br />
      </li>
      <li>Before we proceed there are a couple of things to note. The files in the '2_Required_Core_Edits' folder are of two types. The first type of file CANNOT be over-ridden by the use of templates, the second type is of course the opposite and CAN be overridden by the use of Zen-Cart templates. You can read more about Zen-Cart templates on the Zen-Cart website. Thefiles in the folders listed in the next step are the files which CAN be overridden by the use of templates. In the previous version it was advised to just overide the default template files, but I advise against it. It may mean less work now, but in a future upgrade of your Zen Cart it complicates updates.<br>
        It is also possible your custom template already contains files in the mentioned folders, which would mean the old method is useless.
        <br />
        <br />
      </li>
      <li>The next folders contain files that have to replace the existing zencart files by the use of the templates. Rename the following folders to match your template folder name.<strong> You need to do this for every template installed !!</strong> The files in these folders <strong>may</strong> need merging with existing files in your template.<br />
        <ul>
          <li><strong>includes/modules/YOUR_TEMPLATE</strong></li>
          <li><strong>includes/modules/sideboxes/YOUR_TEMPLATE</strong></li>
          <li><strong>includes/templates/YOUR_TEMPLATE</strong></li>
        </ul>
      In the next folder there also already may be files present<br />
        <ul>
          <li><strong>includes/init_includes/overides</strong></li>
        </ul>
        </strong><br />
      </li>
      <li>Upload and MERGE where needed the entire contents of the <strong>2_Required_Core_Edits</strong> folder, includes folder and the admin folder to your server, again keeping the file structure intact.
        <br />
        <ul>
          <li>includes/classes/category_tree.php</li>
          <li>includes/classes/order.php</li>
          <li>includes/classes/site_map.php</li>
          <li><em><strong>more files need to be added</strong></em></li>
        </ul>
        <br />
      </li>
      <li>Make a Template for each site
        <ul>
          <li>We assume that you already have a Zen-cart shop installed with some categories and products. You need to have a 2nd template that will be use for your 2nd shop. You can simply copy and past the one from your folder "includes/template/[YOUR_TEMPLATE]" Or you can download some from www.zen-cart.com.<br />
          <br />
          </li>
          <li>TIP: In order to make the things easy, I highly advice you to rename the template to the name of
each of your site. In this way, you will find easily the folder of the shop you want to modify...
When you rename your template's name, think of renaming every overriding folder too !
These folders should be:
            <ul>
              <li>includes/templates/YOUR_TEMPLATE</li>
              <li>includes/languages/YOUR_LANGUAGE/YOUR_TEMPLATE</li>
              <li>includes/languages/YOUR_LANGUAGE/extra_definitions/YOUR_TEMPLATE</li>
              <li>includes/languages/YOUR_LANGUAGE/html_includes/YOUR_TEMPLATE</li>
              <li>includes/languages/YOUR_LANGUAGE/modules/order_total/YOUR_TEMPLATE</li>
              <li>includes/languages/YOUR_LANGUAGE/modules/payment[YOUR_TEMPLATE</li>
              <li>includes/languages/YOUR_LANGUAGE/modules/shipping/YOUR_TEMPLATE</li>
              <li>includes/languages/YOUR_LANGUAGE/modules/YOUR_TEMPLATE</li>
              <li>includes/languages/YOUR_LANGUAGE/modules/sideboxes/YOUR_TEMPLATE</li>
            </ul><br />
          </li>
          <li>Do not use a template for two sites, otherwise, you will be obliged to have the same language files too (same shops' name and same sideboxes position)<br />
          <br /></li>
          <li>In the includes/templates/[YOUR_TEMPLATE]/template_info.php, change the template_name to the name of your site that uses the template:
            <ul>
              <li><em>$template_name = 'mysite';</em></li>
            </ul><br />
          </li>
          <li>So, if your sites are called www.site1.com and www.site2.net Then your should rename your template to site1 and site2.<br />The file includes/templates/site1/template_info.php should have the line:
            <ul>
              <li><em>$template_name = 'site1';</em></li>
            </ul>
          <br />The file includes/templates/site2/template_info.php should have the line:
            <ul>
              <li><em>$template_name = 'site1';</em></li>
            </ul>
          <br />This will help you later in the admin section; the template selector is now only use for choose the site for which you want to change the sidebox setting.<br /><br />
          </li>
        </ul>
      <li>Create the configuration files of your sites</li>
      </li>
    </ol>
    <p>Multi Site is now installed and ready to use!</p>
    <p>Go to the configuration chapter to read more on how to configuer your sites.</p>
  </div>
  <h2><a name="upgrade" id="upgrade"></a>Upgrade <span style="color: #F00;">( Do a fresh installation)</span></h2>
  <div id="contentDescription" >
  <p><strong>Upgrading from previous vwersions is not supported</strong> Please do a fresh instaltion</p>
  </div>
  <h2><a name="version_history" id="version_history"></a>Version History</h2>
  <div id="contentDescription">
  	<p>Version 1.0 Current- Release Date: 2012-xx-xx</p>
    <ul>
    <li>Removed []</li>
    <li>modified [includes/classes/]
      <ul>
        <li>some text</li></ul></li><li>
    </li>
    </ul>
    <p>Version 0.4 -  Release Date: 2007-08-07</p>
    <ul>
      <li>Initial release</li>
    </ul>
  </div>
  <h2><a name="faqs" id="faqs"></a>FAQs</h2>
  <div id="contentDescription">
    <p>&nbsp;</p>
  </div>
  <h2><a name="support" id="support"></a>Support</h2>
  <div id="contentDescription">
    <p>You will find the official support thread at the link below. Please feel free to post any comments or questions there.</p>
    <p>&nbsp;</p>
  </div>

</div>
</body>
</html>
Description">
  	<p>Version 1.6.4_1.5 - Release Date: 2012-04-28/p>
    <ul>
    <li>Removed [images/zen_lightbox]</li>
    <li>modified [includes/classes/zen_lightbox/autoload_default.php]
      <ul>
        <li>handles the &quot;Always show Prev / Next&quot; Setting better</li>
        </ul>
    </li>
    <li>modified [includes/modules/pages/page/jscript_zen_lightbox.php]
      <ul>
        <li>brings back missing EZ-Page auto lightbox feature</li>
        </ul>
    </li>
    <li>modified [includes/templates/YOUR_TEMPLATE_FOLDER/css/stylesheet_zen_lightbox.css
      <ul>
        <li>added 2 classes to hande new &quot;Always show Prev / Next&quot; code</li>
        </ul>
    </li>
    </ul>
    <p>Version 1.0 -  Release Date: 2006-09-05</p>
    <ul>
      <li>Initial release</li>
    </ul>
  </div>
  <h2><a name="faqs" id="faqs"></a>FAQs</h2>
  <div id="contentDescription">
    <p>Below is a list of frequently asked questions.</p>
    <p><strong>How do I setup additional images for my products?</strong><br />
    While this question isn't directly related to Zen Lightbox, I find that a lot of people have trouble setting up additional images and, therefore, are unable to experience the gallery feature of Zen Lightbox. Please read the tutorial at the link below to understand how additional images work.</p>
    <p><a href="http://tutorials.zen-cart.com/index.php?article=58" target="_blank">http://tutorials.zen-cart.com/index.php?article=58</a></p>
    <p><strong>How do I change the colour of the overlay?</strong><br />
    Open includes/templates/YOUR-TEMPLATE-FOLDER/css/stylesheet_lightbox.css and find the following code, which should be at the bottom.</p>
<div id="code"> #lbOverlay{background-color:<span style="color: #FF0000">#000</span>;height:100%;left:0;position:fixed;top:0;width:100%;z-index:9999}</div>
    <p>Now, change the background-color value to the colour of your choice.</p>
  </div>
  <h2><a name="support" id="support"></a>Support</h2>
  <div id="contentDescription">
    <p>You will find the official support thread at the link below. Please feel free to post any comments or questions there.</p>
    <p><a href="http://www.zen-cart.com/forum/showthread.php?t=45314" target="_blank">http://www.zen-cart.com/forum/showthread.php?t=45314</a></p>
  </div>

</div>