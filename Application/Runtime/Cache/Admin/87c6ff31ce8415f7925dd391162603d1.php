<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>控制台 - 后台管理系统</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="/book11-15/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/book11-15/Public/assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="/book11-15/Public/assets/css/ace.min.css" />
		<link rel="stylesheet" href="/book11-15/Public/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/book11-15/Public/assets/css/ace-skins.min.css" />
		<script src="/book11-15/Public/assets/js/ace-extra.min.js"></script>
		
		
	</head>

	<h1>
		分类管理
		<small>
			<i class="icon-double-angle-right"></i>
			 分类树列表
		</small>
	</h1>


	<div class="widget-box">
	<div class="widget-header header-color-blue2">
		<h4 class="lighter smaller">Choose Categories</h4>
	</div>

	<div class="widget-body">
		<div class="widget-main padding-8">
			<div id="tree1" class="tree"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.jQuery || document.write("<script src='/book11-15/Public/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script type="text/javascript">
	if("ontouchend" in document) document.write("<script src='/book11-15/Public/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="/book11-15/Public/assets/js/bootstrap.min.js"></script>
<script src="/book11-15/Public/assets/js/typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->

<script src="/book11-15/Public/assets/js/fuelux/data/fuelux.tree-sampledata.js"></script>
<script src="/book11-15/Public/assets/js/fuelux/fuelux.tree.min.js"></script>

<!-- ace scripts -->

<script src="/book11-15/Public/assets/js/ace-elements.min.js"></script>
<script src="/book11-15/Public/assets/js/ace.min.js"></script>
<script type="text/javascript">
	jQuery(function($){
		var tree_data_list = {};
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>tree_data_list['<?php echo ($vo["id"]); ?>'] = {name: '<?php echo ($vo["name"]); ?>', type: <?php if(!empty($vo["child"])): ?>"folder"<?php else: ?>"item"<?php endif; ?>};	
			
			<?php if(!empty($vo["child"])): ?>var child = {};
				<?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item1): $mod = ($i % 2 );++$i;?>child['<?php echo ($item1["id"]); ?>'] = {name: '<?php echo ($item1["name"]); ?>', type:<?php if(!empty($item1["child"])): ?>"folder"<?php else: ?>"item"<?php endif; ?>};
					<?php if(!empty($item1["child"])): ?>var child2 = {};
						<?php if(is_array($item1["child"])): $i = 0; $__LIST__ = $item1["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item2): $mod = ($i % 2 );++$i;?>child2['<?php echo ($item2["id"]); ?>'] = {name: '<?php echo ($item2["name"]); ?>', type:<?php if(!empty($item2["child"])): ?>"folder"<?php else: ?>"item"<?php endif; ?>};<?php endforeach; endif; else: echo "" ;endif; ?>
						child['<?php echo ($item1["id"]); ?>']['additionalParameters'] = {'children': child2};<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				tree_data_list['<?php echo ($vo["id"]); ?>']['additionalParameters'] = {'children': child};<?php endif; endforeach; endif; else: echo "" ;endif; ?>
		var treeDataSource = new DataSourceTree({data: tree_data_list});

		$('#tree1').ace_tree({
			dataSource: treeDataSource ,
			multiSelect:true,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : false,
			'selected-icon' : 'icon-ok',
			//'unselected-icon' : 'icon-remove'
			'unselected-icon' : 'icon-spin'
		});

		$('#tree2').ace_tree({
			dataSource: treeDataSource2 ,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-folder-open',
			'close-icon' : 'icon-folder-close',
			'selectable' : false,
			'selected-icon' : null,
			'unselected-icon' : null
		});
	});
</script>

		<script src="/book11-15/Public/assets/js/typeahead-bs2.min.js"></script>
		<script src="/book11-15/Public/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="/book11-15/Public/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="/book11-15/Public/assets/js/jquery.slimscroll.min.js"></script>
		<script src="/book11-15/Public/assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="/book11-15/Public/assets/js/jquery.sparkline.min.js"></script>
		<script src="/book11-15/Public/assets/js/flot/jquery.flot.min.js"></script>
		<script src="/book11-15/Public/assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="/book11-15/Public/assets/js/flot/jquery.flot.resize.min.js"></script>
		<script src="/book11-15/Public/assets/js/ace-elements.min.js"></script>
		<script src="/book11-15/Public/assets/js/ace.min.js"></script>
</body>
</html>