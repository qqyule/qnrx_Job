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
		var URL = '/index.php/admin/sms_queue',
			SELF = '/index.php?m=admin&amp;c=sms_queue&amp;a=index',
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
    <p>短信模块属收费模块，需申请开通后才能使用，请联系我司客服申请开通。</p>
    <p class="link_green_line">资费标准请联系骑士销售获取，更多介绍请进入 <a href="http://www.74cms.com" target="_blank">骑士人才系统官方网站</a></p>
</div>
<div class="seltpye_x">
    <div class="left">筛选类型</div>
    <div class="right">
        <a href="<?php echo P(array('s_type'=>0));?>" <?php if($_GET['s_type']== "" || $_GET['s_type']== 0): ?>class="select"<?php endif; ?>>不限</a>
        <a href="<?php echo P(array('s_type'=>1));?>" <?php if($_GET['s_type']== 1): ?>class="select"<?php endif; ?>>等待发送</a>
        <a href="<?php echo P(array('s_type'=>2));?>" <?php if($_GET['s_type']== 2): ?>class="select"<?php endif; ?>>发送成功</a>
        <a href="<?php echo P(array('s_type'=>3));?>" <?php if($_GET['s_type']== 3): ?>class="select"<?php endif; ?>>发送失败</a>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<form id="form1" name="form1" method="post" action="<?php echo U('del');?>">
    <div class="list_th">
        <div class="td" style=" width:10%;">
            <label id="chkAll" class="left_padding">
                <input type="checkbox" name="chkAll" id="chk" title="全选/反选"/>类型
            </label>
        </div>
        <div class="td" style=" width:15%;">手机号</div>
        <div class="td" style=" width:45%;">短信内容</div>
        <div class="td center" style=" width:10%;">添加时间</div>
        <div class="td center" style=" width:10%;">发送时间</div>
        <div class="td center" style=" width:10%;">操作</div>
        <div class="clear"></div>
    </div>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list_tr link_black">
        <div class="td" style=" width:10%;">
            <div class="left_padding striking">
                <input type="checkbox" name="id[]"  value="<?php echo ($vo["s_id"]); ?>"/>
                <?php if($vo['s_type'] == 1): ?><span style="color:#FF6600">等待发送</span><?php endif; ?>
                <?php if($vo['s_type'] == 2): ?><span style="color:#009900">发送成功</span><?php endif; ?>
                <?php if($vo['s_type'] == 3): ?><span style="color:#666666">发送失败</span><?php endif; ?>
            </div>
        </div>
        <div class="td" style=" width:15%;"><?php echo ($vo["s_mobile"]); ?></div>
        <div class="td vtip" title="<?php echo (nl2br($vo["s_body"])); ?>" style=" width:45%;"><?php echo ($vo["s_body_"]); ?>&nbsp;</div>
        <div class="td center" style=" width:10%;"><?php echo date('Y-m-d',$vo['s_addtime']);?></div>
        <div class="td center" style=" width:10%;">
            <?php if($vo['s_sendtime'] == 0): ?>----
            <?php else: ?>
            <?php echo date('Y-m-d',$vo['s_sendtime']); endif; ?>
        </div>
        <div class="td center edit" style=" width:10%;"><a href="<?php echo U('smsqueue_edit',array('s_id'=>$vo['s_id']));?>">修改</a></div>
        <div class="clear"></div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php if(empty($list)): ?><div class="list_empty">没有任何信息！</div><?php endif; ?>
    <span id="OpDel">
    </span>
    <span id="OpSend">
    </span>
</form>
<div class="list_foot">
    <div class="btnbox">
        <input type="button" name="Submit22" value="发送" class="admin_submit" id="ButSend"/>
        <input type="button" name="Submit22" value="添加任务" class="admin_submit"    onclick="window.location='<?php echo U('smsqueue_add');?>'"/>
        <input type="button" name="Submit22" value="批量添加" class="admin_submit"    onclick="window.location='<?php echo U('smsqueue_batchadd');?>'"/>
        <input type="button" name="ButDel" id="ButDel" value="删除" class="admin_submit" />
    </div>
    <div class="footso">
        <form action="?" method="get">
            <div class="sobox">
                <input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
                <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
                <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
                <input name="key" type="text" class="sinput" value="<?php echo (_I($_GET['key'])); ?>"/>
                <input name="key_type" id="J_key_type_id" type="hidden" value="<?php echo ((_I($_GET['key_type']) != "")?(_I($_GET['key_type'])):'1'); ?>" />
                <input name="key_type_cn" id="J_key_type_cn" type="hidden" value="<?php echo ((_I($_GET['key_type_cn']) != "")?(_I($_GET['key_type_cn'])):'短信内容'); ?>"/>
                <input name="" type="submit" value="" class="sobtn"/>
                <div class="sotype" id="J_key_click"><?php echo ((_I($_GET['key_type_cn']) != "")?(_I($_GET['key_type_cn'])):'短信内容'); ?></div>
                <div class="mlist" id="J_mlist">
                    <ul>
                        <li id="1" title="短信内容">短信内容</li>
                        <li id="2" title="手机号码">手机号码</li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="pages"><?php echo ($page); ?></div>
</div>
<!-- public:footer 以下内容 -->
<div class="footer link_blue">
    Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span
        style="color: #FF3300">cms</span></a> v<?php echo C('QSCMS_VERSION');?>
</div>
<!-- public:footer 以上内容 -->
<script type="text/javascript">
    $(document).ready(function() {
        showmenu("#key_type_cn","#sehmenu","#key_type");
        //发送
        $("#ButSend").click(function () {
            var data = $("form[name=form1]").serialize();
            var qsDialog = $(this).dialog({
                title: '请选择',
                loading: true,
                footer : false
            });
            var url = "<?php echo U('Ajax/send_sms_queue');?>";
            $.post(url,data, function (result) {
                if(result.status == 1){
                    qsDialog.setContent(result.data);
                } else {
                    qsDialog.hide();
                    disapperTooltip('remind',result.msg);
                }
            });
        })

        // 删除
        $("#ButDel").click(function () {
            var data = $("form[name=form1]").serialize();
            var qsDialog = $(this).dialog({
                title: '您要删除哪些信息',
                loading: true,
                footer : false
            });
            var url = "<?php echo U('Ajax/delete_sms_queue');?>";
            $.post(url,data, function (result) {
                if(result.status == 1){
                    qsDialog.setContent(result.data);
                } else {
                    qsDialog.hide();
                    disapperTooltip('remind',result.msg);
                }
            });
        })
    });
</script>
</body>
</html>