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
			SELF = '/index.php?m=admin&amp;c=config&amp;a=bottom',
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
<form action="<?php echo U('config/edit');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <div class="toptit">首页底部二维码引导关注</div>
    <div class="form_main width200">
        <div class="fl">标题：</div>
        <div class="fr">
            <input name="index_bottom_title" type="text" class="input_text_default" value="<?php echo C('qscms_index_bottom_title');?>"/>
        </div>
        <div class="fl">内容：</div>
        <div class="fr">
            <input name="index_bottom_info" type="text" class="input_text_default" value="<?php echo C('qscms_index_bottom_info');?>"/>
        </div>
        <div class="fl">二维码图片</div>
        <div class="fr J-file-input-box">
            <div class="file-input-block" id="J_upload_img" name="index_bottom_wx"><span class="o-txt">上传</span>二维码图片<span class="re-txt">(建议尺寸114*114)</span></div>
             <input type="hidden" name="index_bottom_wx" id="index_bottom_wx" value="">
        </div>
  
        <div id="J_img" <?php if(C('qscms_index_bottom_wx') == '' ): ?>style="display:none;"<?php endif; ?>>
            <div class="fl">已上传：</div>
            <div class="fr link_blue" id="J_img_list">&nbsp;
                    <div style="float:left; text-align:center; margin-right: 15px; margin-bottom: 5px; border: 1px solid #CCCCCC;" class="img">
                        <input type="hidden" name="index_bottom_wx" value="<?php echo C('qscms_index_bottom_wx');?>">
                        <img src="<?php echo attach(C('qscms_index_bottom_wx'),'resource');?>?_t=<?php echo time();?>" width="180" height="130" border="1" style="border: #CCCCCC;"/><br/>
                        <a href="javascript:;" class="delete_img">删除</a>
                    </div>
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
  var uploadUrl = "<?php echo U('Upload/form_upload');?>";
</script>
<script src="__ADMINPUBLIC__/js/ajaxfileupload.js"></script>
<script src="__ADMINPUBLIC__/js/fileupload.js"></script>
<script>
    $.upload('#J_upload_img',{name:'index_bottom_wx',dir:'resource'},function(result){
            if(result.error == 1){
                var html = '<div style="float:left; text-align:center; margin-right: 15px; margin-bottom: 5px; border: 1px solid #CCCCCC;" class="img">';
                html += '<input type="hidden" name="index_bottom_wx" value="' + result.url.savename + '">'
                html += '<img src="' + result.url.src + '" width="180" height="130"><br/>';
                html += '<a href="javascript:;" class="delete_img">删除</a>';
                html += '</div>';
                // $(html).prependTo($("#J_img_list"));
                $("#J_img_list").html(html);
                var j_img = $('#J_img');
                if(j_img.is(":hidden")){
                    j_img.show();
                }
            } else {
                disapperTooltip("remind", "上传失败："+result.message);
            }
        });
        // 删除照片
        $(".delete_img").live('click', function () {
            $(this).parent('.img').remove();
            if($('#J_img_list').find('.img').length == 0){
                $('#J_img').hide();
                $('#index_bottom_wx').val();
            }
        });
</script>
</body>
</html>