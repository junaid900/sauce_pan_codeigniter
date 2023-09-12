<?php $this->load->view('admin/header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_cms_keyword.js?date=<?php echo CACHE_USETIME()?>'></script>
	

					
					
<script src="<?php echo base_url()?>themes/elychats/lib/DP_Debug.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/lib/raphael.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo base_url()?>themes/elychats/src/elycharts_core.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_anchor.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_animation.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_balloon.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_highlight.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_label.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_legend.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_mouse.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_shadow.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_manager_tooltip.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_chart_barline.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_chart_funnel.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_chart_line.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_chart_pie.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>themes/elychats/src/elycharts_defaults.js" type="text/javascript" charset="utf-8"></script>
    

<?php 
	//第一个和最后一个  作为副寸不显示
	$thelabels = array();
	$thelabels[] = '2017-11-01';
	$thelabels[] = '2017-11-02';
	$thelabels[] = '2017-11-03';
	$thelabels[] = '2017-11-04';
	$thelabels[] = '2017-11-05';
	$thelabels[] = '2017-11-06';
	$thelabels[] = '2017-11-07';
	$thelabels[] = '2017-11-08';

	$group = array();
	//组1
	$subgroup = array();
	$subgroup['group_name'] = '新闻';
	$subgroup['group_color'] = '#30373f';
	$group_line = array();
	if (!empty($thelabels)){
		for ($j = 0; $j < count($thelabels); $j++) {
			//获取该 labels 该日期的值
			$group_line[] = array('group_name'=>$subgroup['group_name'], 'label_name'=>$thelabels[$j], 'line_value'=>rand(0, 100));
		}
	}
	$subgroup['group_line'] = $group_line;
	$group[] = $subgroup;
	
	//组2
	$subgroup = array();
	$subgroup['group_name'] = '论坛';
	$subgroup['group_color'] = '#B3c2c7';
	$group_line = array();
	if (!empty($thelabels)){
		for ($j = 0; $j < count($thelabels); $j++) {
			//获取该 labels 该日期的值
			$group_line[] = array('group_name'=>$subgroup['group_name'], 'label_name'=>$thelabels[$j], 'line_value'=>rand(0, 100));
		}
	}
	$subgroup['group_line'] = $group_line;
	$group[] = $subgroup;

	//组3
	$subgroup = array();
	$subgroup['group_name'] = '微博';
	$subgroup['group_color'] = '#ED413d';
	$group_line = array();
	if (!empty($thelabels)){
		for ($j = 0; $j < count($thelabels); $j++) {
			//获取该 labels 该日期的值
			$group_line[] = array('group_name'=>$subgroup['group_name'], 'label_name'=>$thelabels[$j], 'line_value'=>rand(0, 100));
		}
	}
	$subgroup['group_line'] = $group_line;
	$group[] = $subgroup;

	//组4
	$subgroup = array();
	$subgroup['group_name'] = '微信';
	$subgroup['group_color'] = '#FAA299';
	$group_line = array();
	if (!empty($thelabels)){
		for ($j = 0; $j < count($thelabels); $j++) {
			//获取该 labels 该日期的值
			$group_line[] = array('group_name'=>$subgroup['group_name'], 'label_name'=>$thelabels[$j], 'line_value'=>rand(0, 100));
		}
	}
	$subgroup['group_line'] = $group_line;
	$group[] = $subgroup;
?>

<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
// this is a reausable template definition. scroll down for the real chart call.
$.elycharts.templates['raphael_analytics'] = {
    type: "line",
    margins: [10, 40, 10, 70],
    defaultSeries: {
        plotProps: {
            "stroke-width": 4
        },
        dot: true,
        rounded: false,
        dotProps: {
            stroke: "white",
            size: 5,
            "stroke-width": 1
        },
        startAnimation: { // use an animation to start plotting the chart
            active: true,
            type: "reg",
            // start from the average line.
            speed: 1000,
            // animate in 1 second.
            easing: ">"
        },
        stepAnimation : { // defines an animation for data updates //定义了一个动画数据更新
            active: true,
            speed : 2000,
            delay : 0,
            easing : '<>'
        },
        color: 'black',
        highlight: {
            scaleSpeed: 0,
            // do not animate the dot scaling. instant grow. //没有动画的点缩放。瞬间成长。
            scaleEasing: '',
            scale: 1.5 // enlarge the dot on hover //扩大悬停点
        },
        tooltip: {
            height: 50,
            width: 80,
            padding: [3, 3],
            offset: [-15, -10],
            frameProps: {
                opacity: 0.75,
                /* fill: "white", */
                stroke: "#CCC"

            }
        }
    },
    series: {
		<?php if(!empty($group)){for ($i = 0; $i < count($group); $i++) {?>
        	<?php if($i == 0){?>
		        serie<?php echo ($i+1)?>: {
		            //****隐藏****
		            fill: true,
		            fillProps: { opacity: .0 },
		            color: "<?php echo $group[$i]['group_color']?>",
		            plotProps: {
		                "stroke-width": 4,
		            },
		            dotProps: {
		                stroke: "white",
		                size: 6,
		                "stroke-width": 1
		            }
		            //****隐藏****
		// 			axis: 'r',
		//             color: "#30373f",
		//             plotProps: {
		//                 "stroke-width": 4,
		//             },
		//             dotProps: {
		//                 stroke: "white",
		//                 size: 6,
		//                 "stroke-width": 1
		//             }
		            
		            // make sure our serie 1 uses black dots and grey tooltip borders, otherwise they are inherithed by the serie color.
		            //确保我们的意甲1使用黑点和灰色提示边界，否则它们是由意甲颜色inherithed。
		        },
	        <?php }else{?>
		        serie<?php echo ($i+1)?>: {
		            axis: 'r',
		            color: "<?php echo $group[$i]['group_color']?>",
		            plotProps: {
		                "stroke-width": 4,
		            },
		            dotProps: {
		                stroke: "white",
		                size: 6,
		                "stroke-width": 1
		            }
		        },
	        <?php }?>
        <?php }}?>
    },
    defaultAxis: {
        labels: true,
        labelsProps: {
            fill: "#888",
            "font-size": "12px",
            "margin-left": "100px"
        },
        labelsDistance: 100,
        labelsHideCovered: true,
        labelsAnchor: 'start'
    },
    axis: {
        l: { // left axis
            labels: true,
            labelsDistance: 40,
            labelsSkip: 0,
            labelsAnchor: "start",
            labelsMargin: 0,
            labelsProps: {
                fill: "#AAA",
                "font-size": "11px",
                "font-weight": "bold"
            },
            max : 100,
            suffix : ""
        },
        r: { // right axis
            labels: false,
            labelsDistance: 11,
            labelsSkip: 0,
            labelsAnchor: "end",
            labelsMargin: 15,
            labelsProps: {
                fill: "#AAA",
                "font-size": "11px",
                "font-weight": "bold"
            },
        	max : 100,
        	suffix : ""
        }
    },
    
    features: {
        legend: {
          horizontal: true,
          width: "auto",
          itemWidth: "auto",
          y: -275,
          height : 0,
          borderProps : { "stroke-width": 0, "fill": "transparent"  },
          dotProps: { "stroke-width": 0 }
        },
        mousearea: {
//        type: 'axis'
        },
        tooltip: {
            positionHandler : function(env, tooltipConf, mouseAreaData, suggestedX, suggestedY) { return [mouseAreaData.event.pageX, mouseAreaData.event.pageY, true] }
        },
        grid: {
            draw: true,
            // draw both x and y grids
            forceBorder: [true, false, true, false],
            // force grid for external border
            ny: 5,
            // use 10 divisions for y grid
            nx: 0,
            // 10 divisions for x grid
            props: {
                stroke: "#CCC" // color for the grid
            }
        }/*,
        animation: {
        	startAnimation: false,
        	stepAnimation: false
        }
        */
    }
}

// the chart values
<?php if(!empty($group)){for ($i = 0; $i < count($group); $i++) {?>
	var thevalues<?php echo ($i+1)?> = [];
	<?php 
		$group_line = $group[$i]['group_line'];
		if (!empty($group_line)) {for ($j = 0; $j < count($group_line); $j++) {
	?>
	thevalues<?php echo ($i+1)?>.push(<?php echo $group_line[$j]['line_value']?>);
	<?php }}?>
<?php }}?>

// let's loop to build tooltips and x labels.
<?php if(!empty($group)){for ($i = 0; $i < count($group); $i++) {?>
	var thetooltips_<?php echo ($i+1)?> = new Array();
	<?php 
		$group_line = $group[$i]['group_line'];
		if (!empty($group_line)) {for ($j = 0; $j < count($group_line); $j++) {
	?>
	thetooltips_<?php echo ($i+1)?>.push("<div class='label'><p class='charlab'><?php echo $group_line[$j]['line_value']?> 次</p><p class='date'><?php echo $group_line[$j]['label_name']?></p><p class='date'><?php echo $group_line[$j]['group_name']?></p></div>");
	<?php }}?>
<?php }}?>


var thelabels = new Array();
<?php if(!empty($thelabels)){for ($j = 0; $j < count($thelabels); $j++) {?>
	thelabels.push('<?php echo $thelabels[$j];?>');
<?php }}?>
// build the chart with 1 serie using the above template.
$("#mychart").chart({
    template: "raphael_analytics",
    tooltips: {
    	<?php if(!empty($group)){for ($i = 0; $i < count($group); $i++) {?>
    	serie<?php echo ($i+1)?>: thetooltips_<?php echo ($i+1)?>,
        <?php }}?>
      },
    autoresize: true,
    values: {
    	<?php if(!empty($group)){for ($i = 0; $i < count($group); $i++) {?>
        serie<?php echo ($i+1)?>: thevalues<?php echo ($i+1)?>,
        <?php }}?>
    },
    legend : {
      <?php if(!empty($group)){for ($i = 0; $i < count($group); $i++) {?>
	      serie<?php echo ($i+1)?> : "<?php echo $group[$i]['group_name']?>",
      <?php }}?>
     },
    labels: thelabels,
});

});//]]>  

</script>
<div style="float:left;width:100%;padding-top:30px;background:rgba(152,152,154,0.2);">
	<!-- the div where we are going to plot -->
	<div id="mytongji" style="float:left;width:100%;">
		<div style="float:left;width:100%;height: 350px;overflow:hidden;">
			<div style="float:left;width:100%;">
				<div id="mychart" style="float:left;width:100%;height: 300px;overflow:hidden;">
					
				</div>
			</div>
			<div style="float:left;width:100%;">
				<div style="float:left;width:calc(100% - 70px - 40px);margin-left:70px;height: 30px;margin-top:20px;color:#999;">
					<?php if(!empty($thelabels)){for ($j = 0; $j < count($thelabels); $j++) {?>
						<?php if($j != (count($thelabels) - 1)){?>
							<div style="float:left;width:calc(100%/<?php echo (count($thelabels) - 1)?>);">
								<div style="float:left;margin-left:-30px;">
									<?php echo $thelabels[$j]?>
								</div>
								
								<?php if($j == (count($thelabels) - 2)){?>
									<div style="float:right;margin-right:-30px;">
										<?php echo $thelabels[$j + 1]?>
									</div>
								<?php }?>
							</div>
						<?php }?>
					<?php }}?>
				</div>
			</div>
		</div>
	</div>
</div>


<?php 
$group = array();
//组1
$subgroup = array();
$subgroup['group_name'] = '正面';
$subgroup['group_color'] = '#F87C7A';
$subgroup['group_value'] = 73;
$group[] = $subgroup;
//组2
$subgroup = array();
$subgroup['group_name'] = '中面';
$subgroup['group_color'] = '#F5E323';
$subgroup['group_value'] = 21;
$group[] = $subgroup;
//组2
$subgroup = array();
$subgroup['group_name'] = '负面';
$subgroup['group_color'] = '#87E5D2';
$subgroup['group_value'] = 6;
$group[] = $subgroup;
?>
<script>
var pie_serie1 = [];
var pie_labels = [];
var pie_serie1_tooltips = [];
<?php if(!empty($group)){for ($i = 0; $i < count($group); $i++) {?>
	pie_serie1.push(<?php echo $group[$i]['group_value']?>);
	pie_labels.push('');
	pie_serie1_tooltips.push('');
<?php }}?>
$(function() {
	  $("#pienewchart").chart({
	  template: "raphael_analytics",
	  values: {
	    serie1: pie_serie1
	  },
	  labels: pie_labels,
	  tooltips: {
	    serie1: pie_serie1_tooltips
	  },
	  defaultSeries: {
	    r: -0.5,
	    values: [
		<?php if(!empty($group)){for ($i = 0; $i < count($group); $i++) {?>
	    {
	      plotProps: {
	        fill: "<?php echo $group[$i]['group_color']?>"
	      }
	    },
		<?php }}?>
	    ]
	  }
	});

	});

	$.elycharts.templates['raphael_analytics'] = {
	  type: "pie",
	  style: {
	    "background-color": ""
	  },
	  defaultSeries: {
	    plotProps: {
	      stroke: "black",
	      "stroke-width": 0,
	      opacity: 0.6
	    },
	    highlight: {
	      newProps: {
	        opacity: 1
	      }
	    },
	    tooltip: {
	      frameProps: {
	        opacity: 0.8
	      }
	    },
	    label: {
	      active: true,
	      props: {
	        fill: "white"
	      }
	    },
	    startAnimation: {
	      active: true,
	      type: "avg"
	    }
	  }
	};
</script>
<div style="float:left;width:100%;padding-top:30px;">
	<div style="float:left;width:180px;margin-top:30px;">
		<div id="pienewchart" style="float:left;width: 150px; height: 150px"></div>
	</div>
	<div style="float:left;width:calc(100% - 180px);margin-top:55px;">
		<div style="float:left;width:100%;">
			<img  style="float:left;width:12px;height:12px;margin-top:5px;" src="themes/default/images/oval_green.png"></img>
			<div style="float:left;font-size:14px;margin-left:10px;">正面</div><div style="float:left;font-size:16px;margin-left:10px;font-family:Roboto-Medium;">73%</div>
		</div>
		<div style="float:left;width:100%;margin-top:15px;">
			<img  style="float:left;width:12px;height:12px;margin-top:5px;" src="themes/default/images/oval_yellow.png"></img>
			<div style="float:left;font-size:14px;margin-left:10px;">中面</div><div style="float:left;font-size:16px;margin-left:10px;font-family:Roboto-Medium;">21%</div>
		</div>
		<div style="float:left;width:100%;margin-top:15px;">
			<img  style="float:left;width:12px;height:12px;margin-top:5px;" src="themes/default/images/oval_red.png"></img>
			<div style="float:left;font-size:14px;margin-left:10px;">负面</div><div style="float:left;font-size:16px;margin-left:10px;font-family:Roboto-Medium;">6%</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/footer')?>