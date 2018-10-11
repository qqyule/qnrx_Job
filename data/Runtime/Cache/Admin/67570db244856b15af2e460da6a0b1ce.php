<?php if (!defined('THINK_PATH')) exit();?><!-- public:header 以下内容 -->
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>网站后台管理中心- Powered by 74cms.com</title>
	<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico"/>
	<meta name="author" content="骑士CMS" />
	<meta name="copyright" content="74cms.com" />
	<link href="__ADMINPUBLIC__/css/common.css" rel="stylesheet" type="text/css">
	<script src="__ADMINPUBLIC__/js/jquery.min.js"></script>
	<script src="__ADMINPUBLIC__/js/jquery.highlight-3.js"></script>
	<script src="__ADMINPUBLIC__/js/jquery.vtip-min.js"></script>
	<script src="__ADMINPUBLIC__/js/jquery.modal.dialog.js"></script>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="__ADMINPUBLIC__/js/PIE.js"></script>
	<script type="text/javascript">
		(function ($) {
			$.pie = function (name, v) {
				// 如果没有加载 PIE 则直接终止
				if (!PIE) return false;
				// 是否 jQuery 对象或者选择器名称
				var obj = typeof name == 'object' ? name : $(name);
				// 指定运行插件的 IE 浏览器版本
				var version = 9;
				// 未指定则默认使用 ie10 以下全兼容模式
				if (typeof v != 'number' && v < 9) {
					version = v;
				}
				// 可对指定的多个 jQuery 对象进行样式兼容
				if ($.browser.msie && obj.size() > 0) {
					if ($.browser.version * 1 <= version * 1) {
						obj.each(function () {
							PIE.attach(this);
						});
					}
				}
			}
		})(jQuery);
		if ($.browser.msie) {
			$.pie('.pie_about');
		};
	</script>
	<![endif]-->
	<script src="__ADMINPUBLIC__/js/jquery.disappear.tooltip.js"></script>
	<script src="__ADMINPUBLIC__/js/common.js"></script>
	<script>
		var URL = '/index.php/admin/tpl',
			SELF = '/index.php?m=admin&amp;c=tpl&amp;a=index',
			ROOT_PATH = '/index.php/admin',
			APP	 =	 '/index.php';

		var qscms = {
			is_subsite : <?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): ?>1<?php else: ?>0<?php endif; ?>,
			subsite_level : "<?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): echo C('SUBSITE_VAL.s_level'); else: echo C('qscms_category_district_level'); endif; ?>",
			default_district : "<?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): echo C('qscms_default_district'); else: echo C('SUBSITE_VAL.s_default_district'); endif; ?>"
		};
	</script>
	<?php echo ($synsitegroupunbindmobile); ?>
	<?php echo ($synsitegroupregister); ?>
	<?php echo ($synsitegroupedit); ?>
	<?php echo ($synsitegroup); ?>
</head>
<body>

<!-- public:header 以上内容 -->
<?php if(empty($menu_title)): ?><div class="allpagetop">后台管理中心<strong>/</strong>首页</div>
	<?php else: ?>
	<div class="allpagetop"><?php echo ($menu_title); ?><strong>/</strong><?php echo ($sub_menu_title); ?></div><?php endif; ?>
<div class="mains">
	<div class="h1tit">
		<div class="h1">
            <?php if($sub_menu['pageheader']): echo ($sub_menu["pageheader"]); ?>
                <?php else: ?>
                <!--欢迎登录 <?php echo C('qscms_site_name');?> 管理中心！--><?php endif; ?>
        </div>
        <?php if(!empty($sub_menu['menu'])): ?><div class="topnav">
                <?php if(is_array($sub_menu['menu'])): $i = 0; $__LIST__ = $sub_menu['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U($val['module_name'].'/'.$val['controller_name'].'/'.$val['action_name']); echo ($val["data"]); if($isget and $_GET): echo get_first(); endif; if($_GET['_k_v']): ?>&_k_v=<?php echo (_I($_GET['_k_v'])); endif; ?>" class="<?php echo ($val["class"]); ?>"><?php echo ($val["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </div><?php endif; ?>
		<div class="clear"></div>
	</div>
<div class="toptip">
    <div class="toptit">提示：</div>
    <p class="link_green_line">新增模板只需将模板文件上传至 /Application/Home/View/ 目录下，更多模版请到 <a href="http://www.74cms.com/tpl/lists.html" target="_blank" style="color:#009900">[官网]</a> 获取。</p>
    <p>使用与骑士CMS不同版本的模板易产生错误</p>
    <p class="link_green_line">如果您熟悉html语法，则可以参考 <a href="http://www.74cms.com/handbook" target="_blank" style="color:#009900">[模版开发手册]</a> 自定义风格模版。</p>
</div>
<div class="toptit">当前模板</div>
<table width="460" border="0" cellspacing="12" cellpadding="0" class="link_blue" style="padding-left:20px;font-size:12px;margin-bottom: 20px;" >
    <tr>
      <td width="225">
	  <img src="<?php echo ($templates["thumb_dir"]); ?>/Config/thumbnail.jpg" alt="<?php echo ($templates["info"]["name"]); ?>" width="225" height="136" border="1"  style="border: #CCCCCC;" />
	  </td>
      <td width="220" class="link_blue" style="line-height:180%">
	  名称：<?php echo ($templates["info"]["name"]); ?><br />
        版本：<?php echo ($templates["info"]["version"]); ?><br />
        作者：<a href="<?php echo ($templates["info"]["authorurl"]); ?>" target="_blank"><?php echo ($templates["info"]["author"]); ?></a><br />
		模版ID：<?php echo ($templates["dir"]); ?>
		<br />
	  <input type="button" name="Submit22" value="备份此模板" class="admin_submit"    onclick="window.location='<?php echo U('tpl/backup',array('tpl_name'=>$templates['dir']));?>'"  style="margin-top:10px;"/>
	  </td>
    </tr>
  </table>
	<div class="toptit">可用模板</div>
	<div style="padding-left:20px;font-size:12px;">
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><div style="float:left; width:240px;  text-align:center; padding:15px; line-height:180%;"  class="link_blue tpl_list">
	  <a href="<?php echo U('set',array('tpl_dir'=>$li['dir']));?>" onclick="return confirm('你确定要使用此模板吗？(提示：频繁更换模版会影响网站排名)')">
	  <img src="<?php echo ($li["thumb_dir"]); ?>/Config/thumbnail.jpg" alt="<?php echo ($li["info"]["name"]); ?>" width="225" height="136" border="1"  style="border: #CCCCCC;"/>
	  </a>
	  <br />
	 <strong><?php echo ($li["info"]["name"]); ?></strong>
	 <br />
	<?php echo ($li["info"]["version"]); ?> (作者:<a href="<?php echo ($li["info"]["authorurl"]); ?>" target="_blank"><?php echo ($li["info"]["author"]); ?></a>)
	 <br />
	模版ID：<?php echo ($li["dir"]); ?>
	 </div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<div class="clear"></div>
</div>
<!-- public:footer 以下内容 -->
<div class="footer link_blue">
    Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span
        style="color: #FF3300">cms</span></a> v<?php echo C('QSCMS_VERSION');?>
</div>
<!-- public:footer 以上内容 -->
<script type="text/javascript"> 
$(document).ready(function()
{
	$(".tpl_list").hover(
  function () {
    $(this).css("background-color","#E4F4FC");
  },
  function () {
    $(this).css("background-color","");
  }
);
});
</script>
</body>
</html>