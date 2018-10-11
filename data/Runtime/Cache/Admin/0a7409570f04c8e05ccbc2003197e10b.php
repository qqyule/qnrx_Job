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
		var URL = '/index.php/admin/safety',
			SELF = '/index.php?m=admin&amp;c=safety&amp;a=index&amp;type=captcha',
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
    <p class="link_green_line">骑士人才系统集成《极验》安全验证，用户仅需1.82秒即可完成验证，使用前必须获取<a href="http://www.geetest.com" target="_blank">极验密钥</a></p>
</div>
<form id="form1" name="form1" method="post"   action="<?php echo U('safety/index');?>" >
    <div class="toptit">PC端极验设置</div>
    <div class="form_main width150">
        <div class="fl">开启验证：</div>
        <div class="fr">
            <div data-code="0,1" class="J_gt imgchecked_small <?php if(C('qscms_captcha_open') == 1): ?>select<?php endif; ?>"><input name="captcha_open" type="hidden" value="<?php echo C('qscms_captcha_open');?>" /></div>
            <div class="clear"></div>
        </div>
        <div id="gtBox" <?php if(C('qscms_captcha_open') == 0): ?>style="display:none;"<?php endif; ?>>
            <div class="fl">极验ID：</div>
            <div class="fr">
                <input name="captcha[id]" type="text" class="input_text_default" value="<?php echo C('qscms_captcha.id');?>"/>
            </div>
            <div class="fl">极验KEY：</div>
            <div class="fr">
                <input name="captcha[key]" type="text" class="input_text_default" value="<?php echo C('qscms_captcha.key');?>"/>
            </div>
        </div>
        <div class="fl"></div>
        <div class="fr">
            <input name="submit3" type="submit" class="admin_submit" value="保存"/>
        </div>
        <div class="clear"></div>
    </div>
</form>

<form id="form2" name="form2" method="post"   action="<?php echo U('safety/index');?>" >
    <div class="toptit">验证项目</div>
    <div class="form_main width150">
        <div class="fl">手机验证：</div>
        <div class="fr">
            <div data-code="0,1" class="imgchecked_small <?php if(C('qscms_captcha_config.varify_mobile') == 1): ?>select<?php endif; ?>"><input name="captcha_config[varify_mobile]" type="hidden" value="<?php echo C('qscms_captcha_config.varify_mobile');?>" /></div>
            <div class="note">（开启后，用户在注册、验证手机号发送短信时发起验证）</div>
            <div class="clear"></div>
        </div>
        <div class="fl">意见/建议：</div>
        <div class="fr">
            <div data-code="0,1" class="imgchecked_small <?php if(C('qscms_captcha_config.varify_suggest') == 1): ?>select<?php endif; ?>"><input name="captcha_config[varify_suggest]" type="hidden" value="<?php echo C('qscms_captcha_config.varify_suggest');?>" /></div>
            <div class="note">（开启后，用户在提交意见建议时发起验证）</div>
            <div class="clear"></div>
        </div>
        <div class="fl">会员登录：</div>
        <div class="fr">
            <input name="captcha_config[user_login]" type="text" class="input_text_default small" value="<?php echo C('qscms_captcha_config.user_login');?>"/>
            <label class="no-fl-note">（填写数字，0为开启验证码，如设置为3，则错误3次才发起验证）</label>
        </div>
        <div class="fl">后台登录：</div>
        <div class="fr">
            <input name="captcha_config[admin_login]" type="text" class="input_text_default small" value="<?php echo C('qscms_captcha_config.admin_login');?>"/>
            <label class="no-fl-note">（填写数字，0为开启验证码，如设置为3，则错误3次才发起验证）</label>
        </div>
        <div class="fl"></div>
        <div class="fr">
            <input name="submit3" type="submit" class="admin_submit" value="保存"/>
        </div>
        <div class="clear"></div>
    </div>
</form>
</div>
<!-- public:footer 以下内容 -->
<div class="footer link_blue">
    Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span
        style="color: #FF3300">cms</span></a> v<?php echo C('QSCMS_VERSION');?>
</div>
<!-- public:footer 以上内容 -->
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script type="text/javascript">
  $(".J_gt").click(function(){
    if($(this).hasClass('select')){
      $("#gtBox").hide();
    }else{
      $("#gtBox").show();
    }
  })
</script>
</body>
</html>