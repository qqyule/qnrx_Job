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
		var URL = '/index.php/admin/company',
			SELF = '/index.php?m=admin&amp;c=company&amp;a=index',
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

<?php if(!empty($apply['Subsite'])): ?><div class="seltpye_y">
        <div class="tit">所属分站</div>
        <div class="ct">
            <div class="txt <?php if(($_GET['subsite_id']) != ""): ?>select<?php endif; ?>"><?php echo ((_I($_GET['subsite_cn']) != "")?(_I($_GET['subsite_cn'])):"不限"); ?></div>
        </div>
        <?php $tag_subsite_class = new \Common\qscmstag\subsiteTag(array('列表名'=>'subsite_list','cache'=>'0','type'=>'run',));$subsite_list = $tag_subsite_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"","keywords"=>"","description"=>"","header_title"=>""),$subsite_list);?>
        <div class="downlist">
            <li url="<?php echo P(array('subsite_id'=>'','subsite_cn'=>'不限'));?>">不限</li>
            <?php if($visitor['role_id'] == 1): if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i;?><li url="<?php echo P(array('subsite_id'=>$subsite['s_id'],'subsite_cn'=>$subsite['s_sitename']));?>"><?php echo ($subsite["s_sitename"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                <?php if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i; if(in_array($subsite['s_id'],$visitor['subsite'])): ?><li url="<?php echo P(array('subsite_id'=>$subsite['s_id'],'subsite_cn'=>$subsite['s_sitename']));?>"><?php echo ($subsite["s_sitename"]); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
    </div><?php endif; ?>
<div class="seltpye_y">
    <div class="tit">企业认证</div>
    <div class="ct">
        <div class="txt <?php if(($_GET['audit']) != ""): ?>select<?php endif; ?>"><?php echo ((_I($_GET['audit_cn']) != "")?(_I($_GET['audit_cn'])):'不限'); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('audit'=>'','audit_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('audit'=>'1','audit_cn'=>'已通过'));?>">已通过</li>
        <li url="<?php echo P(array('audit'=>'2','audit_cn'=>'待认证'));?>">待认证<?php if($count): ?><span style="color:#FF0000">(<?php echo ($count); ?>)</span><?php endif; ?></li>
        <li url="<?php echo P(array('audit'=>'3','audit_cn'=>'未通过'));?>">未通过</li>
        <li url="<?php echo P(array('audit'=>'0','audit_cn'=>'未认证'));?>">未认证</li>
    </div>
</div>
<?php if(C('apply.Sincerity')): ?><div class="seltpye_y">
        <div class="tit">诚聘通</div>
        <div class="ct">
            <div class="txt <?php if(($_GET['famous']) != ""): ?>select<?php endif; ?>"><?php echo ((_I($_GET['famous_cn']) != "")?(_I($_GET['famous_cn'])):'不限'); ?></div>
        </div>
        <div class="downlist">
            <li url="<?php echo P(array('famous'=>'','famous_cn'=>'不限'));?>">不限</li>
            <li url="<?php echo P(array('famous'=>'1','famous_cn'=>'诚聘通'));?>">诚聘通</li>
            <li url="<?php echo P(array('famous'=>'0','famous_cn'=>'非诚聘通'));?>">非诚聘通</li>
        </div>
    </div><?php endif; ?>
<div class="seltpye_y">
    <div class="tit">套餐类型</div>
    <div class="ct">
        <div class="txt <?php if(($_GET['setmeal_id']) != ""): ?>select<?php endif; ?>"><?php echo ((_I($_GET['setmeal_cn']) != "")?(_I($_GET['setmeal_cn'])):'不限'); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('setmeal_id'=>'','setmeal_cn'=>'不限'));?>">不限</li>
        <?php if(is_array($setmeal)): $i = 0; $__LIST__ = $setmeal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li url="<?php echo P(array('setmeal_id'=>$key,'setmeal_cn'=>$vo));?>"><?php echo ($vo); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div class="seltpye_y">
    <div class="tit">注册时间</div>
    <div class="ct">
        <div class="txt <?php if(($_GET['settr']) != ""): ?>select<?php endif; ?>"><?php echo ((_I($_GET['settr_cn']) != "")?(_I($_GET['settr_cn'])):'不限'); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('settr'=>'','settr_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('settr'=>'3','settr_cn'=>'三天内'));?>">三天内</li>
        <li url="<?php echo P(array('settr'=>'7','settr_cn'=>'一周内'));?>">一周内</li>
        <li url="<?php echo P(array('settr'=>'30','settr_cn'=>'一月内'));?>">一月内</li>
        <li url="<?php echo P(array('settr'=>'180','settr_cn'=>'半年内'));?>">半年内</li>
        <li url="<?php echo P(array('settr'=>'360','settr_cn'=>'一年内'));?>">一年内</li>
    </div>
</div>
<div class="seltpye_y">
    <div class="tit">套餐到期</div>
    <div class="ct">
        <div class="txt <?php if(($_GET['overtime']) != ""): ?>select<?php endif; ?>"><?php echo ((_I($_GET['overtime_cn']) != "")?(_I($_GET['overtime_cn'])):'不限'); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('overtime'=>'','overtime_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('overtime'=>'3','overtime_cn'=>'三天内'));?>">三天内</li>
        <li url="<?php echo P(array('overtime'=>'7','overtime_cn'=>'一周内'));?>">一周内</li>
        <li url="<?php echo P(array('overtime'=>'30','overtime_cn'=>'一月内'));?>">一月内</li>
        <li url="<?php echo P(array('overtime'=>'-1','overtime_cn'=>'半年内'));?>">半年内</li>
    </div>
</div>
<div class="seltpye_y">
    <div class="tit">微信绑定</div>
    <div class="ct">
        <div class="txt <?php if(($_GET['is_bind']) != ""): ?>select<?php endif; ?>"><?php echo ((_I($_GET['is_bind_cn']) != "")?(_I($_GET['is_bind_cn'])):'不限'); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('is_bind'=>'','is_bind_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('is_bind'=>'1','is_bind_cn'=>'绑定'));?>">绑定</li>
        <li url="<?php echo P(array('is_bind'=>'0','is_bind_cn'=>'未绑定'));?>">未绑定</li>
    </div>
</div>
<div class="clear"></div>

<form id="form1" name="form1" method="post" action="<?php echo U('company/delete_company');?>">
    <div class="list_th">
        <div class="td" style=" width:20%;">
            <label id="chkAll" class="left_padding">
                <input type="checkbox" name="chkAll" id="chk" title="全选/反选"/>公司名称
            </label>
        </div>
        <div class="td" style=" width:4%; text-align: right;">&nbsp;</div>
        <div class="td" style=" width:8%;">企业认证</div>
        <?php if(C('apply.Sincerity')): ?><div class="td center" style=" width:4%;">诚聘通</div><?php endif; ?>
        <div class="td center" style=" width:8%;">实地认证</div>
        <div class="td center" style=" width:8%;">创建时间</div>
        <div class="td center" style=" width:8%;">刷新时间</div>
        <div class="td center" style=" width:8%;">套餐名称</div>
        <div class="td center" style=" width:8%;">在招职位</div>
        <div class="td" style=" width:19%;">操作</div>
        <div class="clear"></div>
    </div>

    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list_tr link_black">
            <div class="td" style=" width:20%;">
                <div class="left_padding striking">
                    <input name="y_id[]" type="checkbox" id="id" value="<?php echo ($vo['uid']); ?>"/>
                    <a href="<?php echo ($vo['company_url']); ?>" target="_blank"><?php echo ($vo['companyname']); ?></a>
                    <span style="color:#999999;">(uid:<?php echo ($vo['uid']); ?>)</span>
                    <?php if($vo['audit'] == 1): ?>&nbsp;<span style="color: #009900" title="已认证">[证]</span><?php endif; ?>
                    <?php if($vo['famous'] == 1): ?>&nbsp;<span style="color: #FF9900" title="诚聘通">[诚]</span><?php endif; ?>
                    <?php if($vo['is_bind']): ?><span class="weixin_bind">&nbsp;&nbsp;&nbsp;&nbsp;</span><?php endif; ?>
                </div>
            </div>
            <div class="td link_blue" style=" width: 4%; text-align: right;">
                <?php if($vo['certificate_img']): ?><a href="<?php echo attach($vo['certificate_img'],'certificate_img');?>" target="_blank" title="点击查看">[证件]</a>&nbsp;
                    <?php else: ?>&nbsp;<?php endif; ?>
            </div>
            <div class="td" style=" width:8%;">
                <?php if($vo['audit'] == 0): ?>未认证<?php endif; ?>
                <?php if($vo['audit'] == 1): ?><span style="color: #009900">已通过</span><?php endif; ?>
                <?php if($vo['audit'] == 2): ?><span style="color:#FF3300">待认证</span><?php endif; ?>
                <?php if($vo['audit'] == 3): ?>未通过<?php endif; ?>
                <span class="view audit_log" title="查看日志" parameter="uid=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;</span>
            </div>
            <?php if(C('apply.Sincerity')): ?><div class="td center" style=" width:4%;">
                    <?php if($vo['famous'] == 1): ?><span style="color: #FF6600" title="诚聘通">是</span>
                        <?php else: ?>
                        <span style="color: #999999">否</span><?php endif; ?>
                    <span class="view famous_log" title="查看日志" parameter="uid=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;</span>
                </div><?php endif; ?>
            <div class="td center" style=" width:8%;"><?php if(($vo['report_open']) == "1"): ?><span style="color: #009900" title="已认证">是</span><?php if(($vo['report']['status']) == "0"): ?>&nbsp;<span style="color: #999999">[不对外显示]</span><?php endif; else: ?>否<?php endif; ?></div>
            <div class="td center" style=" width:8%;"><?php echo admin_date($vo['addtime']);?></div>
            <div class="td center" style=" width:8%;"><?php echo admin_date($vo['refreshtime']);?></div>
            <div class="td center" style=" width:8%;">
                <?php if($vo['setmeal_name']): ?><span <?php if($vo['setmeal_id'] != '1'): ?>style="color: #FF6600"<?php endif; ?>><?php echo ($vo['setmeal_name']); ?></span>
                    <?php else: ?>
                    <span style="color:#FF3300">无套餐</span><?php endif; ?>
                <span class="view setmeal_detail" title="套餐详情" parameter="uid=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="td center" style=" width:8%;">
                <?php echo ($vo['jobs_count']); ?>
            </div>
            <div class="td edit" style=" width:19%;">
                <a href="javascript:void(0);" class="business" parameter="uid=<?php echo ($vo['uid']); ?>" hideFocus="true">业务</a>
                <a href="<?php echo U('edit_company',array('uid'=>$vo['uid'],'_k_v'=>$vo['id']));?>">编辑</a>
                <a href="javascript:void(0);" class="blue company_log" parameter="uid=<?php echo ($vo['uid']); ?>">日志</a>
                <a href="<?php echo U('Company/statistics_visitor',array('id'=>$vo['id'],'_k_v'=>$vo['id']));?>">统计</a>
                <a href="javascript:;" class="J_message" parameter="uid=<?php echo ($vo['uid']); ?>">发消息</a>
            </div>
            <div class="clear"></div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</form>

<?php if(empty($list)): ?><div class="list_empty">没有任何信息！</div><?php endif; ?>

<div class="list_foot">
    <div class="btnbox">
        <input type="button" class="admin_submit" id="ButAdd" value="添加企业" onclick="window.location.href='<?php echo U('add');?>'"/>
        <input type="button" class="admin_submit" id="ButAudit" value="认证企业"/>
        <input type="button" class="admin_submit" id="ButConsultant" value="设置顾问"/>
        <?php if($apply['Export']): ?><input type="button" class="admin_submit" id="ExPort" value="导出"/>
            <input type="button" class="admin_submit" id="ExPort_s" value="导出全部"/><?php endif; ?>
        <input type="button" class="admin_submit" id="ButRefresh" value="刷新"/>
        <input type="button" class="admin_submit" id="ButDel" value="删除"/>
    </div>

    <div class="footso">
        <form action="?" method="get">
            <div class="sobox">
                <input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
                <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
                <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
                <input name="key" type="text" class="sinput" value="<?php echo (_I($_GET['key'])); ?>"/>
                <input name="key_type" id="J_key_type_id" type="hidden" value="<?php echo ((_I($_GET['key_type']) != "")?(_I($_GET['key_type'])):'1'); ?>" />
                <input name="key_type_cn" id="J_key_type_cn" type="hidden" value="<?php echo ((_I($_GET['key_type_cn']) != "")?(_I($_GET['key_type_cn'])):'公司名'); ?>"/>
                <input name="" type="submit" value="" class="sobtn"/>
                <div class="sotype" id="J_key_click"><?php echo ((_I($_GET['key_type_cn']) != "")?(_I($_GET['key_type_cn'])):'公司名'); ?></div>
                <div class="mlist" id="J_mlist">
                    <ul>
                        <li id="1" title="公司名">公司名</li>
                        <li id="2" title="公司ID">公司ID</li>
                        <li id="3" title="会员名">会员名</li>
                        <li id="4" title="会员ID">会员ID</li>
                        <li id="5" title="地址">地址</li>
                        <li id="6" title="电话">电话</li>
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

</body>
<script type="text/javascript">
    $(document).ready(function () {
        $(".J_message").click(function () {
            $('.modal_backdrop').remove();
            $('.modal').remove();
            var qsDialog = $(this).dialog({
                title: '发消息',
                loading: true,
                footer : false
            });
            var param = $(this).attr('parameter');
            var url = "<?php echo U('Ajax/ajax_message');?>&" + param;
            $.getJSON(url, function (result) {
                qsDialog.setContent(result.data);
            });
        });
        //审核日志
        $(".audit_log").click(function () {
            var qsDialog = $(this).dialog({
                title: '审核日志',
                loading: true,
                footer : false
            });
            var param = $(this).attr('parameter');
            var url = "<?php echo U('Ajax/company_audit_log');?>&" + param;
            $.getJSON(url, function (result) {
                qsDialog.setContent(result.data);
            });
        });
        $(".company_log").click(function () {
            var qsDialog = $(this).dialog({
                title: '企业日志',
                loading: true,
                footer : false
            });
            var param = $(this).attr('parameter');
            var url = "<?php echo U('Ajax/company_log');?>&" + param;
            $.getJSON(url, function (result) {
                qsDialog.setContent(result.data);
            });
        });
        //诚聘通记录
        $(".famous_log").click(function () {
            var qsDialog = $(this).dialog({
                title: '诚聘通',
                loading: true,
                footer : false
            });
            var param = $(this).attr('parameter');
            var url = "<?php echo U('Ajax/famous_log');?>&" + param;
            $.getJSON(url, function (result) {
                qsDialog.setContent(result.data);
            });
        });
        //套餐详情
        $(".setmeal_detail").click(function () {
            var qsDialog = $(this).dialog({
                title: '套餐详情',
                loading: true,
                footer : false
            });
            var param = $(this).attr('parameter');
            var url = "<?php echo U('Ajax/setmeal_detail');?>&" + param;
            $.getJSON(url, function (result) {
                qsDialog.setContent(result.data);
            });
        });
        //业务
        $(".business").click(function () {
            var qsDialog = $(this).dialog({
                title: '业务',
                loading: true,
                footer : false
            });
            var param = $(this).attr('parameter');
            var url = "<?php echo U('Ajax/business');?>&" + param;
            $.getJSON(url, function (result) {
                qsDialog.setContent(result.data);
            });
        });
        //批量审核
        $("#ButAudit").click(function () {
            var data = $("form[name=form1]").serialize();
            if(data.length == 0){
                disapperTooltip('remind','请选择企业！');
            } else {
                var qsDialog = $(this).dialog({
                    title: '审核企业',
                    loading: true,
                    footer : false
                });
                var url = "<?php echo U('Ajax/company_audit');?>";
                $.post(url, data, function (result) {
                    if(result.status == 1){
                        qsDialog.setContent(result.data);
                    } else {
                        qsDialog.hide();
                        disapperTooltip('remind',result.msg);
                    }
                });
            }
        });
        //批量刷新
        $("#ButRefresh").click(function () {
            var data = $("form[name=form1]").serialize();
            if(data.length == 0){
                disapperTooltip('remind','请选择企业！');
            } else {
                var qsDialog = $(this).dialog({
                    title: '刷新',
                    loading: true,
                    footer : false
                });
                var url = "<?php echo U('Ajax/refresh_company');?>";
                $.post(url, data, function (result) {
                    if(result.status == 1){
                        qsDialog.setContent(result.data);
                    } else {
                        qsDialog.hide();
                        disapperTooltip('remind',result.msg);
                    }
                });
            }
        });
        //点击批量删除
        $("#ButDel").click(function () {
            if (confirm('你确定要删除吗？')) {
                $("form[name=form1]").attr("action", "<?php echo U('delete_company');?>");
                $("form[name=form1]").submit();
            }
        });
        /*//批量删除
        $("#ButDel").click(function () {
            var data = $("form[name=form1]").serialize();
            if(data.length == 0){
                disapperTooltip('remind','请选择企业！');
            } else {
                var qsDialog = $(this).dialog({
                    title: '删除企业',
                    loading: true,
                    footer : false
                });
                var url = "<?php echo U('Ajax/delete_company');?>";
                $.post(url, data, function (result) {
                    if(result.status == 1){
                        qsDialog.setContent(result.data);
                    } else {
                        qsDialog.hide();
                        disapperTooltip('remind',result.msg);
                    }
                });
            }
        });*/
        //设置顾问
        $("#ButConsultant").click(function () {
            var ids = $("input[name='y_id[]']:checked");
            if(ids.length == 0){
                disapperTooltip('remind','请选择会员！');
            } else {
                var qsDialog = $(this).dialog({
                    title: '设置顾问',
                    loading: true,
                    footer : false
                });
                var data = $("[name=form1]").serialize();
                var url = "<?php echo U('Ajax/set_consultant');?>";
                $.post(url, data, function (result) {
                    if(result.status == 1){
                        qsDialog.setContent(result.data);
                    } else {
                        qsDialog.hide();
                        disapperTooltip('remind',result.msg);
                    }
                });
            }
        });
        <?php if($apply['Export']): ?>//点击批量导出
            $("#ExPort").click(function () {
                var data = $("form[name=form1]").serialize();
                if(data.length == 0){
                    disapperTooltip('remind','请选择企业！');
                    qsDialog.hide();
                }
                $("form[name=form1]").attr("action", "<?php echo U('Export/Export/export_company');?>");
                $("form[name=form1]").submit();
            });
            $("#ExPort_s").click(function () {
                $("form[name=form1]").attr("action", "<?php echo U('Export/Export/export_company_s');?>");
                $("form[name=form1]").submit();
            });<?php endif; ?>
    });
</script>
</html>