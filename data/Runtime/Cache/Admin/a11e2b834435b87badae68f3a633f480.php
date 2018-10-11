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
		var URL = '/index.php/admin/config',
			SELF = '/index.php?m=admin&amp;c=config&amp;a=reg',
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
<form action="<?php echo U('config/edit');?>" method="post"  name="form1" id="form1">
    <div class="toptit">注册设置</div>
    <div class="form_main width200">
    <div class="fl">关闭会员注册：</div>
    <div class="fr">
        <div data-code="0,1" class="imgchecked_small <?php if(C('qscms_closereg') == 1): ?>select<?php endif; ?>"><input name="closereg" type="hidden" value="<?php echo C('qscms_closereg');?>" /></div>
        <div class="clear"></div>
    </div>
    <div class="fl">开启密码输入：</div>
    <div class="fr">
        <div data-code="0,1" class="imgchecked_small <?php if(C('qscms_register_password_open') == 1): ?>select<?php endif; ?>"><input name="register_password_open" type="hidden" value="<?php echo C('qscms_register_password_open');?>" /></div>
        <div class="clear"></div>
    </div>
    <div class="fl">手机注册用户名前缀：</div>
    <div class="fr">
        <input name="reg_prefix" type="text" class="input_text_default small" maxlength="10" value="<?php echo C('qscms_reg_prefix');?>"/>
        <label class="no-fl-note">（手机注册会自动生成用户名，生成规则：前缀+手机号末4位+随机字符，如:sp_3194nzlb）</label>
    </div>
    <div class="fl">第三方注册生成用户名前缀：</div>
    <div class="fr">
        <input name="third_reg_prefix" type="text" class="input_text_default small" maxlength="10" value="<?php echo C('qscms_third_reg_prefix');?>"/>
        <label class="no-fl-note">第三方注册是指微信注册，QQ注册后生成的用户名</label>
    </div>
    <div class="fl">快速注册生成密码：</div>
    <div class="fr">
        <div class="imgradio J_job_pw_type">
            <input name="reg_password_tpye" type="hidden" value="<?php echo C('qscms_reg_password_tpye');?>">
            <div class="radio <?php if(C('qscms_reg_password_tpye') == 1): ?>select<?php endif; ?>" data="1" title="与用户名相同">与用户名相同</div>
        <div class="radio <?php if(C('qscms_reg_password_tpye') == 2): ?>select<?php endif; ?>" data="2" title="随机密码">随机密码</div>
    <div class="radio <?php if(C('qscms_reg_password_tpye') == 3): ?>select<?php endif; ?>" data="3" title="指定密码">指定密码</div>
    <div class="clear"></div>
    </div>
    </div>
    <div id="config_reg_password" <?php if(C('qscms_reg_password_tpye') != 3): ?>style="display:none"<?php endif; ?>>
    <div class="fl">输入指定密码：</div>
    <div class="fr">
        <input name="reg_weixin_password" type="text" class="input_text_default small" maxlength="16" value="<?php echo C('qscms_reg_weixin_password');?>"/>
    </div>
    </div>
    <div class="fl"></div>
    <div class="fr">
        <input type="submit" class="admin_submit" value="保存修改"/>
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
<script type="text/javascript">
  $('.J_job_pw_type .radio').click(function(){
    if($(this).attr('data') == 3){
      $('#config_reg_password').show();
    }else{
      $('#config_reg_password').hide();
    }
  })
</script>
</body>
</html>