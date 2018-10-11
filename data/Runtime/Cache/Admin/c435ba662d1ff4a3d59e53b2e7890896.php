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
		var URL = '/index.php/admin/jobs',
			SELF = '/index.php?m=admin&amp;c=jobs&amp;a=index&amp;menu_id=194&amp;sub_menu_id=195',
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
    <p>有效职位是指：审核通过、审核中、服务未到期等网站能正常显示的职位。</p>
    <p>无效职位是指：审核未通过、服务到期等网站前台不显示的职位。</p>
  </div>
<div class="seltpye_y">
    <div class="tit">有效状态</div>
    <div class="ct">
        <div class="txt <?php if(!empty($_GET['jobtype'])): ?>select<?php endif; ?>"><?php echo ((_I($_GET['jobtype_cn']) != "")?(_I($_GET['jobtype_cn'])):"有效职位"); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('jobtype'=>'1','jobtype_cn'=>'有效职位'));?>">有效职位<span>(<?php echo ($count[1]); ?>)</span></li>
        <li url="<?php echo P(array('jobtype'=>'2','jobtype_cn'=>'无效职位'));?>">无效职位<span>(<?php echo ($count[2]); ?>)</span></li>
    </div>
</div>
<div class="seltpye_y">
    <div class="tit">审核状态</div>
    <div class="ct">
        <div class="txt <?php if(!empty($_GET['audit'])): ?>select<?php endif; ?>"><?php echo ((_I($_GET['audit_cn']) != "")?(_I($_GET['audit_cn'])):"不限"); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('audit'=>'0','audit_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('audit'=>'2','audit_cn'=>'等待审核'));?>">等待审核<?php if($count[4] > 0): ?><span style="color:#FF0000">(<?php echo ($count[4]); ?>)</span><?php endif; ?></li>
        <li url="<?php echo P(array('audit'=>'1','audit_cn'=>'审核通过'));?>">审核通过<span>(<?php echo ($count[3]); ?>)</span></li>
        <?php if($_GET['jobtype']!= 1): ?><li title="审核未通过" url="<?php echo P(array('audit'=>'3','audit_cn'=>'审核未通过'));?>">审核未通过<span>(<?php echo ($count[5]); ?>)</span></li><?php endif; ?>
    </div>
</div>
<?php if($_GET['jobtype']== 2): ?><div class="seltpye_y">
    <div class="tit">无效原因</div>
    <div class="ct">
        <div class="txt <?php if(!empty($_GET['invalid'])): ?>select<?php endif; ?>"><?php echo ((_I($_GET['invalid_cn']) != "")?(_I($_GET['invalid_cn'])):"不限"); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('invalid'=>'0','invalid_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('invalid'=>'2','invalid_cn'=>'套餐到期'));?>">套餐到期</li>
        <li url="<?php echo P(array('invalid'=>'3','invalid_cn'=>'职位暂停'));?>">职位暂停</li>
        <li url="<?php echo P(array('invalid'=>'4','invalid_cn'=>'非审核通过'));?>">非审核通过</li>
    </div>
</div><?php endif; ?>
<div class="seltpye_y">
    <div class="tit">服务到期</div>
    <div class="ct">
        <div class="txt <?php if(!empty($_GET['deadline'])): ?>select<?php endif; ?>"><?php echo ((_I($_GET['deadline_cn']) != "")?(_I($_GET['deadline_cn'])):"不限"); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('deadline'=>'','deadline_cn'=>'不限'));?>">不限</li>
        <?php if($_GET['jobtype']== '2'): ?><li url="<?php echo P(array('deadline'=>'1','deadline_cn'=>'已到期'));?>">已到期</li>
            <li url="<?php echo P(array('deadline'=>'2','deadline_cn'=>'未到期'));?>">未到期</li><?php endif; ?>
        <li url="<?php echo P(array('deadline'=>'3','deadline_cn'=>'三天内'));?>">三天内</li>
        <li url="<?php echo P(array('deadline'=>'7','deadline_cn'=>'一周内'));?>">一周内</li>
        <li url="<?php echo P(array('deadline'=>'30','deadline_cn'=>'一月内'));?>">一月内</li>
    </div>
</div>
<div class="seltpye_y">
    <div class="tit">推广类型</div>
    <div class="ct">
        <div class="txt <?php if(!empty($_GET['promote'])): ?>select<?php endif; ?>"><?php echo ((_I($_GET['promote_cn']) != "")?(_I($_GET['promote_cn'])):"不限"); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('promote'=>'','promote_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('promote'=>'-1','promote_cn'=>'未推广'));?>">未推广</li>
        <li url="<?php echo P(array('promote'=>'1','promote_cn'=>'置顶'));?>">置顶</li>
        <li url="<?php echo P(array('promote'=>'2','promote_cn'=>'紧急'));?>">紧急</li>
    </div>
</div>
<div class="seltpye_y">
    <div class="tit">添加时间</div>
    <div class="ct">
        <div class="txt <?php if(!empty($_GET['addsettr'])): ?>select<?php endif; ?>"><?php echo ((_I($_GET['addsettr_cn']) != "")?(_I($_GET['addsettr_cn'])):"不限"); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('addsettr'=>'','addsettr_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('addsettr'=>'3','addsettr_cn'=>'三天内'));?>">三天内</li>
        <li url="<?php echo P(array('addsettr'=>'7','addsettr_cn'=>'一周内'));?>">一周内</li>
        <li url="<?php echo P(array('addsettr'=>'30','addsettr_cn'=>'一月内'));?>">一月内</li>
    </div>
</div>
<div class="seltpye_y">
    <div class="tit">刷新时间</div>
    <div class="ct">
        <div class="txt <?php if(!empty($_GET['settr'])): ?>select<?php endif; ?>"><?php echo ((_I($_GET['settr_cn']) != "")?(_I($_GET['settr_cn'])):"不限"); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('settr'=>'','settr_cn'=>'不限'));?>">不限</li>
        <li url="<?php echo P(array('settr'=>'3','settr_cn'=>'三天内'));?>">三天内</li>
        <li url="<?php echo P(array('settr'=>'7','settr_cn'=>'一周内'));?>">一周内</li>
        <li url="<?php echo P(array('settr'=>'30','settr_cn'=>'一月内'));?>">一月内</li>
    </div>
</div>
<div class="seltpye_y">
    <div class="tit">排序方式</div>
    <div class="ct">
        <div class="txt <?php if(($_GET['orderby']!= '') AND ($_GET['orderby']!= 'addtime')): ?>select<?php endif; ?>"><?php echo ((_I($_GET['orderby_cn']) != "")?(_I($_GET['orderby_cn'])):"发布时间"); ?></div>
    </div>
    <div class="downlist">
        <li url="<?php echo P(array('orderby'=>'addtime','orderby_cn'=>'发布时间'));?>">发布时间</li>
        <li url="<?php echo P(array('orderby'=>'refreshtime','orderby_cn'=>'刷新时间'));?>">刷新时间</li>
    </div>
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
<div class="clear"></div>

<form id="form1" name="form1" method="post" action="<?php echo U('set_audit');?>">
    <div class="list_th">
        <div class="td" style=" width:23%;">
            <label id="chkAll" class="left_padding">
                <input type="checkbox" name="chkAll" id="chk" title="全选/反选"/>职位名称
            </label>
        </div>
        <div class="td" style=" width:22%;">公司名称</div>
        <div class="td center" style=" width:10%;">审核状态&nbsp;&nbsp;&nbsp;</div>
        <div class="td center" style=" width:10%;">发布时间</div>
        <div class="td center" style=" width:10%;">刷新时间</div>
        <div class="td" style=" width:20%;">操作</div>
        <div class="clear"></div>
    </div>

    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list_tr link_black">
            <div class="td" style=" width:23%;">
                <div class="left_padding striking">
                    <input name="id[]" type="checkbox" id="id" value="<?php echo ($vo['id']); ?>"/>
                    <input name="uid[<?php echo ($vo['id']); ?>]" type="hidden" id="uid" value="<?php echo ($vo['uid']); ?>"/>
                    <a href="<?php echo ($vo['jobs_url']); ?>&validation=1" target="_blank" <?php if(($vo['deadline'] < $now && $vo['deadline'] != 0) || $vo['display'] == 2): ?>style="color:#999999"<?php endif; ?>><?php echo ($vo['jobs_name']); ?></a>
                    <?php if($vo['emergency'] == 1): ?>&nbsp;<span style="color: #FF6600" title="紧急">[急]</span><?php endif; ?>
                    <?php if($vo['stick'] == 1): ?>&nbsp;<span style="color: #FF3399" title="置顶">[顶]</span><?php endif; ?>
                    <?php if($vo['display'] == 2): ?>&nbsp;<span style="color: #999999" title="暂停招聘">[暂停]</span><?php endif; ?>
                </div>
            </div>
            <div class="td" style=" width:22%;">
                <a href="<?php echo ($vo['company_url']); ?>" target="_blank" style="color: #333;" title="<?php echo ($vo['companyname']); ?>"><?php echo ($vo['companyname']); ?></a>
                <?php if($vo['company_audit'] == 1): ?>&nbsp;<span style="color: #009900" title="已认证企业">[已认证]</span><?php endif; ?>
                <?php if($vo['famous'] == 1): ?>&nbsp;<span style="color: #FF6600" title="诚聘通">[诚]</span><?php endif; ?>
            </div>
            <div class="td center" style=" width:10%;">
                <?php if($vo['audit'] == 1): ?><span style="color: #009900">审核通过</span>
                    <?php elseif($vo['audit'] == 2): ?>
                    <span style="color:#FF0000">等待审核</span>
                    <?php elseif($vo['audit'] == 3): ?>
                    审核未通过<?php endif; ?>
                <span class="view audit_log" title="查看日志" parameter="type=jobs_id&id=<?php echo ($vo['id']); ?>">&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="td center" style=" width:10%;"><?php echo admin_date($vo['addtime']);?></div>
            <div class="td center" style=" width:10%;"><?php echo admin_date($vo['refreshtime']);?></div>
            <div class="td edit" style=" width:20%;">
                <a href="javascript:void(0);" class="business" parameter="uid=<?php echo ($vo['uid']); ?>" hideFocus="true">业务</a>
                <a href="<?php echo U('jobs/edit',array('id'=>$vo['id']));?>">编辑</a>
                <a href="javascript:void(0);" class="blue jobs_log" parameter="id=<?php echo ($vo['id']); ?>">日志</a>
                <a href="javascript:;" class="J_message" parameter="uid=<?php echo ($vo['uid']); ?>">发消息</a>
                <a href="<?php echo U('delete_jobs',array('id'=>$vo['id']));?>" onClick="return confirm('你确定要删除该职位吗？')" class="gray">删除</a>
            </div>
            <div class="clear"></div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</form>

<?php if(empty($list)): ?><div class="list_empty">没有任何信息！</div><?php endif; ?>

<div class="list_foot">
    <div class="btnbox">
        <input type="button" class="admin_submit" id="ButAudit" value="审核"/>
        <input type="button" class="admin_submit" id="ButRefresh" value="刷新"/>
        <input type="button" class="admin_submit" id="ButDel" value="删除"/>
        <?php if($apply['Export']): ?><input type="button" class="admin_submit" id="ExPort" value="导出"/>
            <input type="button" class="admin_submit" id="ExPort_s" value="导出全部"/><?php endif; ?>
    </div>

    <div class="footso">
        <form action="?" method="get">
            <div class="sobox">
                <input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
                <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
                <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
                <input name="key" type="text" class="sinput" value="<?php echo (_I($_GET['key'])); ?>"/>
                <input name="key_type" id="J_key_type_id" type="hidden" value="<?php echo ((_I($_GET['key_type']) != "")?(_I($_GET['key_type'])):'1'); ?>" />
                <input name="key_type_cn" id="J_key_type_cn" type="hidden" value="<?php echo ((_I($_GET['key_type_cn']) != "")?(_I($_GET['key_type_cn'])):'职位名'); ?>"/>
                <input name="" type="submit" value="" class="sobtn"/>
                <div class="sotype" id="J_key_click"><?php echo ((_I($_GET['key_type_cn']) != "")?(_I($_GET['key_type_cn'])):'职位名'); ?></div>
                <div class="mlist" id="J_mlist">
                    <ul>
                        <li id="1" title="职位名">职位名</li>
                        <li id="2" title="公司名">公司名</li>
                        <li id="3" title="职位ID">职位ID</li>
                        <li id="4" title="公司ID">公司ID</li>
                        <li id="5" title="会员ID">会员ID</li>
                        <li id="6" title="手机号">手机号</li>
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
        //职位日志
        $(".jobs_log").click(function () {
            var qsDialog = $(this).dialog({
                title: '职位日志',
                loading: true,
                footer : false
            });
            var param = $(this).attr('parameter');
            var url = "<?php echo U('Ajax/jobs_log');?>&" + param;
            $.getJSON(url, function (result) {
                qsDialog.setContent(result.data);
            });
        });
        //职位审核日志
        $(".audit_log").click(function () {
            var qsDialog = $(this).dialog({
                title: '审核日志',
                loading: true,
                footer : false
            });
            var param = $(this).attr('parameter');
            var url = "<?php echo U('Ajax/audit_log');?>&" + param;
            $.getJSON(url, function (result) {
                qsDialog.setContent(result.data);
            });
        });
        //审核职位
        $("#ButAudit").click(function () {
            var data = $("form[name=form1]").serialize();
            if(data.length == 0){
                disapperTooltip('remind','请选择职位！');
            } else {
                var qsDialog = $(this).dialog({
                    title: '审核职位',
                    loading: true,
                    footer : false
                });
                var url = "<?php echo U('Ajax/jobs_audit');?>";
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
                $("form[name=form1]").attr("action", "<?php echo U('delete_jobs');?>");
                $("form[name=form1]").submit();
            }
        });
        //点击批量刷新
        $("#ButRefresh").click(function () {
            $("form[name=form1]").attr("action", "<?php echo U('refresh_jobs');?>");
            $("form[name=form1]").submit();
        });
        <?php if($apply['Export']): ?>//点击批量导出
            $("#ExPort").click(function () {
                var data = $("form[name=form1]").serialize();
                if(data.length == 0){
                    disapperTooltip('remind','请选择职位！');
                    qsDialog.hide();
                }
                $("form[name=form1]").attr("action", "<?php echo U('Export/Export/export_jobs');?>");
                $("form[name=form1]").submit();
            });
            $("#ExPort_s").click(function () {
                $("form[name=form1]").attr("action", "<?php echo U('Export/Export/export_jobs_s');?>");
                $("form[name=form1]").submit();
            });<?php endif; ?>
    });
</script>
</html>