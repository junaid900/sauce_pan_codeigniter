<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function fy_backend($total,$row,$url,$page=10,$num_links=5,$url_type=1){
		//$total数据总数
		//$row数据第几个开始
		//$page每页显示几篇文章
		//$num_links左右两边显示个数
		if($row==0){$cur_page=1;}else{$cur_page=($row/$page)+1;}//当前页
		$yeshu=ceil($total/$page);//总页数
		$prev_row=$row-$page;//上一页的$row数据第几个开始
		$next_row=$row+$page;//下一页的$row数据第几个开始
		
		$first_open='<span class="page">';
		$first_close='</span>&nbsp;';
		$last_open='<span class="page">';
		$last_close='</span>&nbsp;';
		
		$omission='<span style="color:black;">...</span>&nbsp;';                        //省略显示的内容   通常是 " ... "
		$next='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">'.lang('cy_next_page').'</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$next_open='<span class="go_b" style="color:black;">';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$next_close='</span>&nbsp;';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$prev='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">'.lang('cy_prev_page').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$prev_open='<span class="go_b" style="color:black;">';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$prev_close='</span>&nbsp;';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$tag_open='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">';                          //数字的打开标签  通常是 "["
		$tag_close='</span>&nbsp;';                         //数字的关闭标签  通常是 "]"
		$cur_tag_open='<span style="background:black;color:white;padding:2px 5px 2px 5px;border:1px solid #bababa;font-weight:bold;">';    //当前页的打开标签  通常是 "<font color="red">["
		$cur_tag_close='</span>&nbsp;';              //当前页的关闭标签  通常是 "]</font>"
		
		$linkstyle='text-decoration: none;color:black;'; //链接的样式  通常是 "text-decoration: none;color:black;"

		if($url_type==2){
			$url_type_text='&row=';
		}else{
			$url_type_text='/';
		}
		//  echo $yeshu;exit;
		if($yeshu>$num_links){
			for($i=1;$i<=$num_links+1;$i++){
				${"linkl_".$i}=$cur_page-$i;
					$link_l=${"linkl_".$i};
				${"linkr_".$i}=$cur_page+$i;
					$link_r=${"linkr_".$i};

				$row_prev=($link_l-1)*$page;
				$row_next=($link_r-1)*$page;

				if($i<=$num_links){
					if($link_l>0){$number_l='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_prev.'">'.$tag_open.$link_l.$tag_close.'</a>';}else{$number_l='';}
					if($link_r<=$yeshu){$number_r='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_next.'">'.$tag_open.$link_r.$tag_close.'</a>';}else{$number_r='';}
				}else{
					if($link_l>0){$number_l=$first_open.'<a style="'.$linkstyle.'" href="'.$url.'">1</a>'.$first_close.$omission;}else{$number_l='';} //显示第1页
					if($link_r<=$yeshu){$number_r=$omission.$first_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.($yeshu-1)*$page.'">'.$yeshu.'</a>'.$first_close;}else{$number_r='';}//显示最后1页

					if($cur_page>1){
						$number_l =$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close.$number_l;
					}else{
						$number_l =''.$number_l;
					}
					if($cur_page<$yeshu){
						$number_r .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;
					}else{
						$number_r .='';
					}
				}
				${"contentl_".$i}=$number_l;
				${"contentr_".$i}=$number_r;
			}

			$data['create_line']='';
			for($i=$num_links+1;$i>=1;$i--){
				$row_prev=$row-$page;
				$data['create_line'] .=${"contentl_".$i};//输出左边页
			}
			$data['create_line'] .=$cur_tag_open.$cur_page.$cur_tag_close;  //输出当前页

			for($i=1;$i<=$num_links+1;$i++){
				$row_next=$row+$page;
				$data['create_line'] .=${"contentr_".$i};//输出右边页
			}
		}else{
			$data['create_line']='';
			if($cur_page>1){
				$data['create_line'] .=$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close;
			}
			if($yeshu>1){
				for($i=1;$i<=$yeshu;$i++){
					$row_prev=($i-1)*$page;

					if($i==$cur_page){
						$data['create_line'] .=$cur_tag_open.$i.$cur_tag_close;
					}else{
						$data['create_line'] .='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_prev.'">'.$tag_open.$i.$tag_close.'</a>';
					}
				}
			}
			if($cur_page<$yeshu){
				$data['create_line'] .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;
			}
		}
		return $data['create_line'];
	}
	
	
	function fy_frontend($total,$row,$url,$page=10,$num_links=5,$url_type=1){
		//$total数据总数
		//$row数据第几个开始
		//$page每页显示几篇文章
		//$num_links左右两边显示个数
		if($row==0){$cur_page=1;}else{$cur_page=($row/$page)+1;}//当前页
		$yeshu=ceil($total/$page);//总页数
		$prev_row=$row-$page;//上一页的$row数据第几个开始
		$next_row=$row+$page;//下一页的$row数据第几个开始
		
		$first_open='<span class="page">';
		$first_close='</span>';
		$last_open='<span class="page">';
		$last_close='</span>';
		
		$omission='<span style="float:left;background:#faf8f7;color:black;">...</span>&nbsp;';                        //省略显示的内容   通常是 " ... "
		$next='<span style="float:left;background:#faf8f7;margin-left:-1px;color:black;text-align:center;line-height:30px;width:60px;height:30px;border:1px solid #bababa;">'.lang('cy_next_page').'</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$next_off='<span style="float:left;background:#faf8f7;margin-left:-1px;color:#ccc;text-align:center;line-height:30px;width:60px;height:30px;border:1px solid #bababa;">'.lang('cy_next_page').'</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$next_open='<span class="go_b" style="background:#faf8f7;float:left;color:black;">';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$next_close='</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		
		
		$prev='<span style="float:left;background:#faf8f7;margin-left:-1px;color:black;text-align:center;line-height:30px;width:60px;height:30px;border:1px solid #bababa;">'.lang('cy_prev_page').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$prev_off='<span style="float:left;background:#faf8f7;margin-left:-1px;color:#ccc;text-align:center;line-height:30px;width:60px;height:30px;border:1px solid #bababa;">'.lang('cy_prev_page').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$prev_open='<span class="go_b" style="float:left;background:#faf8f7;color:black;">';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$prev_close='</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		
		
		$home='<span style="float:left;background:#faf8f7;margin-left:-1px;color:black;text-align:center;line-height:30px;width:60px;height:30px;border:1px solid #bababa;">'.lang('cy_first').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$home_off='<span style="float:left;background:#faf8f7;margin-left:-1px;color:#ccc;text-align:center;line-height:30px;width:60px;height:30px;border:1px solid #bababa;">'.lang('cy_first').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$home_open='<span class="go_b" style="float:left;background:#faf8f7;color:black;">';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$home_close='</span>';
		

		$end='<span style="float:left;background:#faf8f7;margin-left:-1px;color:black;text-align:center;line-height:30px;width:60px;height:30px;border:1px solid #bababa;">'.lang('cy_last').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$end_off='<span style="float:left;background:#faf8f7;margin-left:-1px;color:#ccc;text-align:center;line-height:30px;width:60px;height:30px;border:1px solid #bababa;">'.lang('cy_last').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$end_open='<span class="go_b" style="float:left;background:#faf8f7;color:black;">';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$end_close='</span>';
		
		
		$tag_open='<span style="float:left;background:#faf8f7;margin-left:-1px;color:black;text-align:center;line-height:30px;width:30px;height:30px;border:1px solid #bababa;">';                          //数字的打开标签  通常是 "["
		$tag_close='</span>';                         //数字的关闭标签  通常是 "]"
		$cur_tag_open='<span style="float:left;background:#faf8f7;margin-left:-1px;background:rgb(171,16,50);color:white;text-align:center;line-height:30px;width:30px;height:30px;border:1px solid rgb(171,16,50);font-weight:bold;">';    //当前页的打开标签  通常是 "<font color="red">["
		$cur_tag_close='</span>';              //当前页的关闭标签  通常是 "]</font>"
		
		$linkstyle='float:left;text-decoration: none;color:black;'; //链接的样式  通常是 "text-decoration: none;color:black;"

		if($url_type==2){
			$url_type_text='&row=';
		}else{
			$url_type_text='/';
		}
		//  echo $yeshu;exit;
		if($yeshu>$num_links){
			for($i=1;$i<=$num_links+1;$i++){
				${"linkl_".$i}=$cur_page-$i;
					$link_l=${"linkl_".$i};
				${"linkr_".$i}=$cur_page+$i;
					$link_r=${"linkr_".$i};

				$row_prev=($link_l-1)*$page;
				$row_next=($link_r-1)*$page;

				if($i<=$num_links){
					if($link_l>0){$number_l='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_prev.'">'.$tag_open.$link_l.$tag_close.'</a>';}else{$number_l='';}
					if($link_r<=$yeshu){$number_r='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_next.'">'.$tag_open.$link_r.$tag_close.'</a>';}else{$number_r='';}
				}else{
					if($link_l>0){$number_l=$first_open.'<a style="'.$linkstyle.'" href="'.$url.'">首页</a>'.$first_close.$omission;}else{$number_l='';} //显示第1页
// 					if($link_r<=$yeshu){$number_r=$omission.$first_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.($yeshu-1)*$page.'">末页</a>'.$first_close;}else{$number_r='';}//显示最后1页

					if($cur_page>1){
						$number_l =$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close.$number_l;
					}else{
// 						$number_l =''.$number_l;
						$number_l =$prev_open.'<a style="'.$linkstyle.'" href="javascript:;">'.$prev.'</a>'.$prev_close.$number_l;
					}
					if($cur_page < $yeshu){
						$number_r .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;
					}else{
// 						$number_r .='';
						$number_r .=$next_open.'<a style="'.$linkstyle.'" href="javascript:;">'.$next.'</a>'.$next_close;
					}
				}
				${"contentl_".$i}=$number_l;
				${"contentr_".$i}=$number_r;
			}

			$data['create_line']='';
			for($i=$num_links+1;$i>=1;$i--){
				$row_prev=$row-$page;
				$data['create_line'] .=${"contentl_".$i};//输出左边页
			}
			$data['create_line'] .=$cur_tag_open.$cur_page.$cur_tag_close;  //输出当前页

			for($i=1;$i<=$num_links+1;$i++){
				$row_next=$row+$page;
				$data['create_line'] .=${"contentr_".$i};//输出右边页
			}
		}else{
			$data['create_line']='';
			if($cur_page>1){
				$data['create_line'] .=$home_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.'0">'.$home.'</a>'.$home_close;
				$data['create_line'] .=$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close;
			}else{
				//原本是空的 -- else
				$data['create_line'] .=$home_open.'<a style="'.$linkstyle.'" href="javascript:;">'.$home_off.'</a>'.$home_close;
				$data['create_line'] .=$prev_open.'<a style="'.$linkstyle.'" href="javascript:;">'.$prev_off.'</a>'.$prev_close;
			}
			if($yeshu>1){
				for($i=1;$i<=$yeshu;$i++){
					$row_prev=($i-1)*$page;

					if($i==$cur_page){
						$data['create_line'] .=$cur_tag_open.$i.$cur_tag_close;
					}else{
						$data['create_line'] .='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_prev.'">'.$tag_open.$i.$tag_close.'</a>';
					}
				}
			}
			if($cur_page<$yeshu){
				$data['create_line'] .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;
				$data['create_line'] .=$end_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.(($yeshu - 1)*$page).'">'.$end.'</a>'.$end_close;
			}else{
				//原本是空的 -- else
				$data['create_line'] .=$next_open.'<a style="'.$linkstyle.'" href="javascript:;">'.$next_off.'</a>'.$next_close;
				$data['create_line'] .=$end_open.'<a style="'.$linkstyle.'" href="javascript:;">'.$end_off.'</a>'.$end_close;
			}
		}
		return $data['create_line'];
	}
	
	
	


	function fy_frontend_short($total,$row,$url,$page=10,$num_links=5,$url_type=1){
		//$total数据总数
		//$row数据第几个开始
		//$page每页显示几篇文章
		//$num_links左右两边显示个数
		if($row==0){$cur_page=1;}else{$cur_page=($row/$page)+1;}//当前页
		$yeshu=ceil($total/$page);//总页数
		$prev_row=$row-$page;//上一页的$row数据第几个开始
		$next_row=$row+$page;//下一页的$row数据第几个开始
	
		$first_open='<span class="page">';
		$first_close='</span>';
		$last_open='<span class="page">';
		$last_close='</span>';
	
		$omission='<span style="float:left;background:#faf8f7;color:black;">...</span>&nbsp;';                        //省略显示的内容   通常是 " ... "
		$next='<span style="float:left;background:#faf8f7;margin-left:10px;color:black;text-align:center;line-height:25px;width:60px;height:25px;border:1px solid #bababa;">'.lang('cy_next_page').'</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$next_off='<span style="float:left;background:#faf8f7;margin-left:10px;color:#ccc;text-align:center;line-height:25px;width:60px;height:25px;border:1px solid #bababa;">'.lang('cy_next_page').'</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$next_open='<span class="go_b" style="background:#faf8f7;float:left;color:black;">';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$next_close='</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"
	
	
		$prev='<span style="float:left;margin-left:10px;background:#faf8f7;margin-left:10px;color:black;text-align:center;line-height:25px;width:60px;height:25px;border:1px solid #bababa;">'.lang('cy_prev_page').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$prev_off='<span style="float:left;background:#faf8f7;margin-left:10px;color:#ccc;text-align:center;line-height:25px;width:60px;height:25px;border:1px solid #bababa;">'.lang('cy_prev_page').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$prev_open='<span class="go_b" style="float:left;background:#faf8f7;color:black;">';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$prev_close='</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
	
	
		$tag_open='<span style="float:left;background:#faf8f7;margin-left:-1px;color:black;text-align:center;line-height:25px;width:30px;height:25px;border:1px solid #bababa;">';                          //数字的打开标签  通常是 "["
		$tag_close='</span>';                         //数字的关闭标签  通常是 "]"
		$cur_tag_open='<span style="float:left;background:#faf8f7;margin-left:-1px;background:rgb(171,16,50);color:white;text-align:center;line-height:25px;width:30px;height:25px;border:1px solid rgb(171,16,50);font-weight:bold;">';    //当前页的打开标签  通常是 "<font color="red">["
		$cur_tag_close='</span>';              //当前页的关闭标签  通常是 "]</font>"
	
		$linkstyle='float:left;text-decoration: none;color:black;'; //链接的样式  通常是 "text-decoration: none;color:black;"
	
		if($url_type==2){
			$url_type_text='&row=';
		}else{
			$url_type_text='/';
		}
		$data['create_line']='';
		if($cur_page>1){
			$data['create_line'] .=$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close;
		}else{
			//原本是空的 -- else
			$data['create_line'] .=$prev_open.'<a style="'.$linkstyle.'" href="javascript:;">'.$prev_off.'</a>'.$prev_close;
		}
		if($cur_page<$yeshu){
			$data['create_line'] .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;
		}else{
			//原本是空的 -- else
			$data['create_line'] .=$next_open.'<a style="'.$linkstyle.'" href="javascript:;">'.$next_off.'</a>'.$next_close;
		}
		return $data['create_line'];
	}
	
	
	
	function fy_ajax($total,$row,$page=10,$fangfa,$fangfa_canshu=''){
	  //$total数据总数
	  //$row数据第几个开始
	  //$page每页显示几篇文章
	  if($row==0){$cur_page=1;}else{$cur_page=($row/$page)+1;}//当前页
	  $yeshu=ceil($total/$page);//总页数
	  $prev_row=$row-$page;//上一页的$row数据第几个开始
	  $next_row=$row+$page;//下一页的$row数据第几个开始
	  
		$next='<div style="float:left;background-color: #a6593f;color: white;font-size: 16px;height: 30px;width: auto;padding: 0px 10px 0px 10px;line-height: 30px;text-transform: uppercase;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">'.lang('cy_next_page').'</div>';                       //自定义上一页的内容   通常是 "&gt;&gt;"
		$prev='<div style="float:left;background-color: #a6593f;color: white;font-size: 16px;height: 30px;width: auto;padding: 0px 10px 0px 10px;line-height: 30px;text-transform: uppercase;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">'.lang('cy_prev_page').'</div>';                       //自定义下一页的内容  通常是 "&lt;&lt;"
		$linkstyle='text-decoration: none;color:white;'; //链接的样式  通常是 "text-decoration: none;color:black;"
	//  echo $yeshu;exit;
  	    $data['create_line']='';
  		if($cur_page>1){
	  		$data['create_line'] .='<a onclick="'.$fangfa.'('.$fangfa_canshu.$prev_row.')" style="'.$linkstyle.'" href="javascript:;">'.$prev.'</a>';
	  	}
  		if($cur_page<$yeshu){
	  	    $data['create_line'] .='<a onclick="'.$fangfa.'('.$fangfa_canshu.$next_row.')" style="'.$linkstyle.'" href="javascript:;">'.$next.'</a>';
  	    }
	  return $data['create_line'];
  }
	
	/*
	 * 判断客户登录客户端
	 * */
	function checkagent(){
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);  
	    $is_pc = (strpos($agent, 'windows nt')) ? true : false;  
	    $is_iphone = (strpos($agent, 'iphone')) ? true : false;  
	    $is_ipad = (strpos($agent, 'ipad')) ? true : false;  
	    $is_android = (strpos($agent, 'android')) ? true : false;  
	   
	    if($is_ipad){  
	        return 'ipad';
	    }else{
	     	if($is_iphone){  
	        	return 'iphone';
		    }else{
				if($is_android){
			    	return 'android';
			    }else{
			    	return 'pc';
			    }
		    }
	    }
	}
	
	//获取 all
	function randkey($num){
    	$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$randkey='';
		for($i = 0;$i < $num;$i++){
			$str = $string[rand(0,61)];
			$randkey.= $str;
		}
		return $randkey;
    }
    
    //获取 数字
	function randkey_number($num){
    	$string = "123456789";
		$randkey='';
		for($i = 0;$i < $num;$i++){
			$str = $string[rand(0,8)];
			$randkey.= $str;
		}
		return $randkey;
    }
	/**
	 * 获取字符串长度(汉字算2个字符)
	 */
    function getstrlen($str=''){
    	$str=strip_tags($str);
	    $length = strlen(preg_replace('/[x00-x7F]/', '', $str));
	    if ($length){
	        return strlen($str) - $length + intval($length / 3) * 2;
	    }else{
	        return strlen($str);
	    }
	}
	/**
	 * 截取字符串(汉字算2个字符并且防止截出乱码--目前只支持从第0位开始截取)
	 *
	 * @param String $string 要截取的字符串
	 * @param Int $start 从第几位开始截
	 * @param Int $length 要截取的长度
	 * @param String $fixStr 当字符长度大于$end时，给字符追加的字符
	 */
	function get_substr($string,$start,$length = null,$fixStr = 0){
		$string=strip_tags($string);
		$strRes='';
	    if (!$string || empty($string)) {
	        return $string;
	    }
 
	    $maxLen = ($length) ? $length - $start : $start;
	    $j=$start;
	    for ($i = $start; $i < $maxLen; $i++){
	        if (ord(mb_substr($string, $j, 1,'UTF-8')) > 0xa0) {
	            if ($i + 1 == $maxLen) {
	                //如果截取的最后一字是汉字，那么舍弃该汉字，结束截取
	                break;
	            }else {
	                //如果是中文，截取2个字符
//	                $strRes .= mb_substr($string, $i, 2,'UTF-8');
//	                $i++;
	                $strRes .= mb_substr($string, $j, 1,'UTF-8');
	                $i++;
	            }
	        }else {
	            //如果是英文，截取1个字符
	            $strRes .= mb_substr($string, $j, 1,'UTF-8');
	        }
	        $j++;
	    }
	    if($fixStr==1){
		     if(getstrlen($string)>$maxLen){
		    	 $strRes .= '…';
		   	 }
	    }
	    return $strRes;
	}
	
	//获取语言的列表
	function languagelist() {
		$CI =& get_instance();
		$lan = $CI->WelModel->getlanguage_list(array('status'=>1,'orderby'=>'sort','orderby_res'=>'ASC'));
	    return $lan;
	}
	/*替换内容*/
	function replace_content($reparr, $content) {
		if(!empty($reparr)){
			
		}else{
			$reparr = array();
		}
		
		if(!empty($reparr)){
			for($i=0;$i<count($reparr);$i++){
				$content=str_replace($reparr[$i]['name'],$reparr[$i]['value'],$content);
			}
		}
		
	    return $content;
	}
	/*替换内容*/
	function preg_replace_content($rep_arr, $content){
		if(!empty($rep_arr)){
			for ($r = 0; $r < count($rep_arr); $r++) {
				$content = preg_replace($rep_arr[$r]['rep_start'], $rep_arr[$r]['rep_to'], $content);
			}
		}
		return $content;
	}
	
	//默认替换内容
	function defaultreparr(){
		$reparr = array();
		$reparr[] = array('name'=>"{sign_douhao}", 'value'=>"'");
		$reparr[] = array('name'=>"<br />", 'value'=>"\n");
		$reparr[] = array('name'=>base_url(), 'value'=>"{base_url}");
		$reparr[] = array('name'=>'/(width:(\s)*(\d){1,3}(%|(px));(\s)height:(\s)*(\d){1,3}(%|(px));)/', 'value'=>"max-width:100%;");
		return $reparr;
	}
	//默认替换内容
	function pregreparr(){
		$reparr = array();
		$rep_start = '/(img src=)/';
		$rep_to = 'img style="max-width:100%;" src=';
		$reparr[] = array('rep_start'=>$rep_start, 'rep_to'=>$rep_to);
		
		$rep_start = '/(height="(\s)*(\d){1,3}")/';
		$rep_to = '';
		$reparr[] = array('rep_start'=>$rep_start, 'rep_to'=>$rep_to);
		
		$rep_start = '/(width:(\s)*(\d){1,3}(%|(px));(\s)height:(\s)*(\d){1,3}(%|(px));)/';
		$rep_to = "max-width:100%;";
		$reparr[] = array('rep_start'=>$rep_start, 'rep_to'=>$rep_to);
		
		return $reparr;
	}
	
	/*文件或图片的路径*/
	function enable_filepath($filepath) {
		$filepathsp = explode("http", $filepath);
		if(count($filepathsp)>=2){
			$fileshowpath = $filepath;
		}else{
			$fileshowpath = CDN_URL().$filepath;
		}
		return $fileshowpath;
	}
	/*编译转化{base_url}*/
	function enbaseurlcontent($content) {
		$reparr=array();
		$reparr[]=array('name'=>base_url(),'value'=>'{base_url}');
		for($i=0;$i<count($reparr);$i++){
			$content=str_replace($reparr[$i]['name'],$reparr[$i]['value'],$content);
		}
	    return $content;
	}
	/*解编译转化base_url()*/
	function debaseurlcontent($content) {
		$reparr=array();
		$reparr[]=array('name'=>'{base_url}','value'=>base_url());
		for($i=0;$i<count($reparr);$i++){
			$content=str_replace($reparr[$i]['name'],$reparr[$i]['value'],$content);
		}
	    return $content;
	}
	
	// js, css, 音频, 图片等使用的缓存标记
	function CACHE_USETIME(){
		$CI = & get_instance();
		$cache_usetime = $CI->config->item('cache_usetime');
		return $cache_usetime;
	}
	// js, css, 音频, 图片等使用的缓存标记
	function API_URL(){
		$CI = & get_instance();
		$api_url = $CI->config->item('api_url');
		return $api_url;
	}
	// js, css, 音频, 图片等使用的缓存标记
	function APIIMAGE_URL(){
		$CI = & get_instance();
		$apiimage_url = $CI->config->item('apiimage_url');
		return $apiimage_url;
	}
	//CDN URL
	function CDN_URL(){
		$CI = & get_instance();
		$cdn_url = $CI->config->item('cdn_url');
		if($cdn_url!=""){
			return $cdn_url;
		}else{
			return base_url();
		}
	}
	
	//微信APPID
	function WECHAT_APPID(){
		$CI =& get_instance();
		$WECHAT_APPID=$CI->config->item('WECHAT_APPID');
		return $WECHAT_APPID;
	}
	
	//微信APPSECRET
	function WECHAT_APPSECRET(){
		$CI =& get_instance();
		$WECHAT_APPSECRET=$CI->config->item('WECHAT_APPSECRET');
		return $WECHAT_APPSECRET;
	}
	
		/*修改图片路径 2014-06-10*/
	function autotofilepath($section,$arr_pic){
		$CI =& get_instance();
		
		$uploaddir = "upload/".$section;
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$uploaddir = "upload/".$section."/".date('Y');
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$uploaddir = "upload/".$section."/".date('Y')."/".date('m');
		if (! is_dir ( $uploaddir )) {
			mkdir ( $uploaddir, 0777 );
		}
		$arr=array();
		if(!empty($arr_pic)){
			for($i=0;$i<count($arr_pic);$i++){
				$CI->WelModel->delete_file_interim($arr_pic[$i]['value']);//删除临时文件表中信息
				$old_pic=$arr_pic[$i]['value'];
				$check_oldpic=explode('/',$old_pic);
				$ispass=1;
				if(isset($check_oldpic[1])){
					if($check_oldpic[1]==$section){
						$ispass=0;
					}
				}
				if(!empty($old_pic)&&$ispass==1){
					$old_arr=explode('.',$old_pic);
					$pic_type=end($old_arr);
					$copy_url = $uploaddir.'/'.$section.'_'.$arr_pic[$i]['num'].'_'.date('Y_m_d_H_i_s').'.'.$pic_type;
					$res=copy($old_pic, $copy_url);
					$arr[$arr_pic[$i]['item']]=$copy_url;
					
					
					
					//生成缩略图开始
					if(isset($arr_pic[$i]['isThumb'])&&$arr_pic[$i]['isThumb']==1){
						$copy_Thumb = $uploaddir.'/'.$section.'_'.$arr_pic[$i]['num'].'_small_'.date('Y_m_d_H_i_s').'.'.$pic_type;
						$res=copy($old_pic, $copy_Thumb);
						
						$oldpic_width=getImgWidth($old_pic);
						$oldpic_height=getImgHeight($old_pic);
						
						$scale = $arr_pic[$i]['Thumb_width']/$oldpic_width;
						resizeImage($copy_Thumb,$oldpic_width,$oldpic_height,$scale);//等比例缩放
						
						$arr[$arr_pic[$i]['Thumb_item']]=$copy_Thumb;
					}
					//生成缩略图结束
					
					if($arr_pic[$i]['item'] == 'product_pic_original'){
						$copy_Thumb = $uploaddir.'/'.$section.'_'.$arr_pic[$i]['num'].'_1000x1000_'.date('Y_m_d_H_i_s').'.'.$pic_type;
						$res = copy($old_pic, $copy_Thumb);
							
// 						$oldpic_width = getImgWidth($old_pic);
// 						$oldpic_height = getImgHeight($old_pic);
// 						$scale = 1000 / $oldpic_width;
// 						resizeImage($copy_Thumb, $oldpic_width, $oldpic_height, $scale);//等比例缩放

// 						$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 1000, 1000 );
// 						$arr['product_pic']=$copy_Thumb;
						
						
						$copy_Thumb = $uploaddir.'/'.$section.'_'.$arr_pic[$i]['num'].'_100x100_'.date('Y_m_d_H_i_s').'.'.$pic_type;
						$res = copy($old_pic, $copy_Thumb);
							
// 						$oldpic_width = getImgWidth($old_pic);
// 						$oldpic_height = getImgHeight($old_pic);
// 						$scale = 100 / $oldpic_width;
// 						resizeImage($copy_Thumb, $oldpic_width, $oldpic_height, $scale);//等比例缩放
						
// 						$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 100, 100 );
// 						$arr['product_pic_100']=$copy_Thumb;


						$copy_Thumb = $uploaddir.'/'.$section.'_'.$arr_pic[$i]['num'].'_400x400_'.date('Y_m_d_H_i_s').'.'.$pic_type;
						$res = copy($old_pic, $copy_Thumb);
							
// 						$oldpic_width = getImgWidth($old_pic);
// 						$oldpic_height = getImgHeight($old_pic);
// 						$scale = 100 / $oldpic_width;
// 						resizeImage($copy_Thumb, $oldpic_width, $oldpic_height, $scale);//等比例缩放
						
// 						$this->app->my_image_resize ( $copy_Thumb, $copy_Thumb, 400, 400 );
// 						$arr['product_pic_400']=$copy_Thumb;
					}
					
					
					
					$filename="".$old_pic;  //只能是相对路径
				    @unlink($filename);
				}
			}
		}
		return $arr;
	}
	//删除文件夹
	function file_todeldir($dir){
		$dh = opendir($dir);
		while ($file = readdir($dh)){
			if ($file != "." && $file != ".."){
				$fullpath = $dir . "/" . $file;
				if (!is_dir($fullpath)){
					unlink($fullpath);
				}else{
					file_todeldir($fullpath);
				}
			}
		}
		closedir($dh);
		if (rmdir($dir)){
			return true;
		}else{
			return false;
		}
	}
	//数据库前缀
	function DB_PRE(){
		$CI =& get_instance();
		$DB_PRE=$CI->config->item('DB_PRE');
		return $DB_PRE;
	}
	/*获取高度*/
	function getImgHeight($image) {
		$size = getimagesize($image);
		$height = $size[1];
		return $height;
	}
	
	/*获取宽度*/
	function getImgWidth($image) {
		$size = getimagesize($image);
		$width = $size[0];
		return $width;
	}
	
	/*验证图片*/
	function resizeImage($image,$width,$height,$scale) {
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		imagealphablending($newImage,false);//这里很重要,意思是不合并颜色,直接用$img图像颜色替换,包括透明色;
		imagesavealpha($newImage,true);//这里很重要,意思是不要丢了$thumb图像的透明色;
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
		    case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
		    case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
	  	}
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
		
		switch($imageType) {
			case "image/gif":
		  		imagegif($newImage,$image); 
				break;
	      	case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
		  		imagejpeg($newImage,$image,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$image);  
				break;
	    }
		
		chmod($image, 0777);
		return $image;
	}
	
	//判断列表的排序
	function doactionorderby($parameter){
		$contion=array('orderby');
		$parameter=explode('-',$parameter);
		$orderby='';
		$orderby_res='';
		if(!empty($parameter)){
			for($i=0;$i<count($parameter);$i++){
				for($j=0;$j<count($contion);$j++){
					if($parameter[$i]==$contion[$j]){
						$orderby=$parameter[$i+1];
						$orderby=explode('_',$orderby);
						$orderby=$orderby[1];
						$orderby_res=$parameter[$i+2];
						$orderby_res=explode('_',$orderby_res);
						$orderby_res=$orderby_res[2];
					}
				}
			}
		}
		return array('orderby'=>$orderby,'orderby_res'=>$orderby_res);
	}
	//判断列表的是否直接跳入下一节
	function doactionisnext($parameter){
		$parameter=explode('-',$parameter);
		$is_next=0;
		if(!empty($parameter)){
			for($i=0;$i<count($parameter);$i++){
				if($parameter[$i]=='next'){
					$is_next=1;
				}
			}
		}
		return $is_next;
	}
	
	function getwechatuserinfo($code){
		
		$CI =& get_instance();
		$wechat_appid = WECHAT_APPID();
		$wechat_secret = WECHAT_APPSECRET();
	
		//echo urlencode('http://www.gogre3n.cn/index.php/weixin_oauth/index');exit;
		//获取code
// 		echo '<a href="';
// 		echo "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code";
// 		echo '">hhh</a>';
// 		exit;
		//获取 code 后，请求以下链接获取 access_token：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code");
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		curl_close($ch);
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code";
		$output = file_get_contents($url);
		
		$output=json_decode($output);
		$access_token=$output->access_token;
	
		$expires_in=$output->expires_in;
		$refresh_token=$output->refresh_token;
		$openid=$output->openid;
		$scope=$output->scope;


// 获取第二步的 refresh_token 后，请求以下链接获取 access_token：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$wechat_appid&grant_type=refresh_token&refresh_token=".$refresh_token);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		curl_close($ch);

		$url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$wechat_appid&grant_type=refresh_token&refresh_token=".$refresh_token;
		$output = file_get_contents($url);
	
		$output=json_decode($output);
		$access_token=$output->access_token;
		$expires_in=$output->expires_in;
		$refresh_token=$output->refresh_token;
		$openid=$output->openid;
		$scope=$output->scope;
		
	
		//通过 access_token 拉取用户信息(仅限 scope= snsapi_userinfo)：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		// 		print_r($output);exit;
// 		curl_close($ch);
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid;
		$output = file_get_contents($url);
		
		$output=json_decode($output);
		//获取后得到的用户信息
		$wechat_openid = $output->openid;
		$wechat_nickname = $output->nickname;
		$wechat_sex = $output->sex;
		$wechat_language = $output->language;
		$wechat_headimgurl = $output->headimgurl;
		$wechat_province = $output->province;
		$wechat_city = $output->city;
		$wechat_country = $output->country;
		$wechat_privilege = $output->privilege;
	
		$arr=array('wechat_openid'=>$wechat_openid, 'wechat_nickname'=>$wechat_nickname, 'wechat_sex'=>$wechat_sex, 'wechat_language'=>$wechat_language, 'wechat_avatar'=>$wechat_headimgurl, 'wechat_province'=>$wechat_province, 'wechat_city'=>$wechat_city, 'wechat_country'=>$wechat_country, 'wechat_privilege'=>$wechat_privilege);

		//echo '<meta http-equiv="Content-Type" content="textml; charset=utf-8" />';
		return $arr;
	}
	
	/**
	 把用户输入的文本转义（主要针对特殊符号和emoji表情）
	 */
	function userTextEncode($str){
		if(!is_string($str))return $str;
		if(!$str || $str=='undefined')return '';
	
		$text = json_encode($str); //暴露出unicode
		$text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){
			return addslashes($str[0]);
		},$text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
		return json_decode($text);
	}
	
	/**
	 解码上面的转义
	 */
	function userTextDecode($str){
		$text = json_encode($str); //暴露出unicode
		$text = preg_replace_callback('/\\\\\\\\/i',function($str){
			return '\\';
		},$text); //将两条斜杠变成一条，其他不动
		return json_decode($text);
	}
	//将http网址转化为 https
	function urlHttpToHttps($str){
		$reparr = array();
		$reparr[] = array('name'=>"http://", 'value'=>"https://");
		$str = replace_content($reparr, $str);
	
		return $str;
	}

	//校验手机号码格式
	function isMobile($val){
		return (preg_match('/^(11|12|13|14|15|16|17|18|19)[0-9]{9}$/', $val) != 0 );
	}
	//转化成大小写，，，，search
	function actionsearchdaxiaoxiezimu($searchname, $thisname){
		if($thisname != $searchname && $searchname != ''){
			$searchname_low = strtolower($searchname);//转化为小写
			$thisname_low = strtolower($thisname);//转化为小写
		
			$thisnamezm = array();
			
			$thisnameisdaxie = array();
			if(mb_strlen($thisname, 'UTF8') > 0){
				for($i = 0; $i < mb_strlen($thisname, 'UTF8'); $i++){
					$thisnamezm[] = mb_substr($thisname, $i, 1,'UTF-8');
					
					if(strtoupper(mb_substr($thisname, $i, 1,'UTF-8')) === mb_substr($thisname, $i, 1,'UTF-8')){
						$thisnameisdaxie[] = 1;//大写字母
					}else{
						$thisnameisdaxie[] = 0;//小写字母
					}
				}
			}
			$testsplit = explode($searchname_low, $thisname_low);
			if(count($testsplit) > 1){
				$thisnamelast = '';
				
				$thisname_low = str_ireplace($searchname_low,'<font style="font-weight:bold;color:red;">'.$searchname_low.'</font>', $thisname_low);

				$thisname_low_split = explode('<font', $thisname_low);
				$start_start = mb_strlen($thisname_low_split[0], 'UTF8');
				
				$thisname_low_split = explode('ed;">', $thisname_low);
				$start_end = mb_strlen($thisname_low_split[0], 'UTF8');
				
				
				$thisname_low_split = explode('</fo', $thisname_low);
				$end_start = mb_strlen($thisname_low_split[0], 'UTF8');
				
				$thisname_low_split = explode('nt>', $thisname_low);
				$end_end = mb_strlen($thisname_low_split[0], 'UTF8');
				
// 				$start_start = strpos($thisname_low, '<font');
// 				$start_end = strpos($thisname_low, '0);">');
				
// 				$end_start = strpos($thisname_low, '</fo');
// 				$end_end = strpos($thisname_low, 'nt>');

				$tt = 0;
				
				for($jj = 0; $jj < mb_strlen($thisname_low, 'UTF8'); $jj++){
					if($start_start >= 0){
						if($jj >= $start_start && $jj <= ($start_end + 4)){
							$thisnamelast = $thisnamelast.mb_substr($thisname_low, $jj, 1,'UTF-8');
						}else if($jj >= $end_start && $jj <= ($end_end + 2)){
							$thisnamelast = $thisnamelast.mb_substr($thisname_low, $jj, 1,'UTF-8');
						}else{
							if(isset($thisnameisdaxie[$tt]) && $thisnameisdaxie[$tt] == 1){//转化为大写
								$thisnamelast = $thisnamelast.strtoupper(mb_substr($thisname_low, $jj, 1,'UTF-8'));
							}else{//转化为小写
								$thisnamelast = $thisnamelast.strtolower(mb_substr($thisname_low, $jj, 1,'UTF-8'));
							}
							$tt++;
						}
					}else{
						if($thisnameisdaxie[$tt] == 1){//转化为大写
							$thisnamelast = $thisnamelast.strtoupper(mb_substr($thisname_low, $jj, 1,'UTF-8'));
						}else{//转化为小写
							$thisnamelast = $thisnamelast.strtolower(mb_substr($thisname_low, $jj, 1,'UTF-8'));
						}
						$tt++;
					}
				}
			}else{
				$thisnamelast = $thisname;
			}
		}else{
			$thisnamelast = str_ireplace($searchname,'<font style="font-weight:bold;color:red;">'.$searchname.'</span>', $thisname);
		}
		return $thisnamelast;
	}
	
	
	//配置URL中get参数需要获取的内容
	function geturlparmersGETS(){
		$arr = array('keyword', 'row', 'backurl', 'subbackurl', 'user_type', 'admin_type', 'status', 'order_id', 'randkey', 'plan_id', 'weekdayplan_id', 'product_id', 'start_date', 'address_id_breakfast', 'address_id_lunch', 'address_id_dinner', 'time_id_breakfast', 'time_id_lunch', 'time_id_dinner', 'address_id_breakfast_str', 'address_id_lunch_str', 'address_id_dinner_str', 'time_id_breakfast_str', 'time_id_lunch_str', 'time_id_dinner_str', 'duration_start_int', 'duration_end_int', 'week_num', 'week_days','productid','cart_id','subTotal','cutlery','originalPrice');
		return $arr;
	}
	
	function getlancodelist(){
		$arr = array();
		$arr[] = array('langtype'=>'_en', 'langfolder'=>'english', 'langname'=>'English');
		$arr[] = array('langtype'=>'_ch', 'langfolder'=>'chinese', 'langname'=>'简体中文');
		return $arr;
	}
	
	//获取文章的所有的图片
	function getImgs($content, $order='ALL'){
		$pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
		preg_match_all($pattern,$content,$match);
		if(isset($match[1]) && !empty($match[1])){
			if($order==='ALL'){
				return $match[1];
			}
			if(is_numeric($order)&&isset($match[1][$order])){
				return $match[1][$order];
			}
		}
		return '';
	}
	
	//处理文章中的所有的图片
	function doactionarticlepic($id,$content){
		$CI =& get_instance();
	
		$allImgs = getImgs($content);
		$img_post=array();
		if(!empty($allImgs)){
			for($aaa=0;$aaa<count($allImgs);$aaa++){
				$rep_imgarr=array();
				$rep_imgarr[]=array('name'=>base_url(),'value'=>'');
				$rep_imgarr[]=array('name'=>'{baseurl}','value'=>'');
				$rep_imgarr[]=array('name'=>'{base_url}','value'=>'');
				$img_post[]=replace_content($rep_imgarr,$allImgs[$aaa]);
			}
		}
		if(!empty($img_post)){
			for($aaa=0;$aaa<count($img_post);$aaa++){
				$sql="SELECT * FROM `".DB_PRE()."article_picture` WHERE pic='".$img_post[$aaa]."' AND article_id=".$id;
				$chekexis_res=$CI->db->query($sql)->result_array();
				if(!empty($chekexis_res)){
					//此图片已存在，不处理
				}else{
					$CI->db->insert(DB_PRE().'article_picture',array('article_id'=>$id,'pic'=>$img_post[$aaa],'created'=>time()));
				}
			}
		}
		//获取需要删除的图片
		$sql="SELECT * FROM `".DB_PRE()."article_picture` WHERE article_id=".$id;
		$allpic_res=$CI->db->query($sql)->result_array();
		if(!empty($allpic_res)){
			for($aaa=0;$aaa<count($allpic_res);$aaa++){
				$isdel=1;//是否删除
				if(!empty($img_post)){
					for($bbb=0;$bbb<count($img_post);$bbb++){
						if($allpic_res[$aaa]['pic']==$img_post[$bbb]){
							$isdel=0;//不删除
						}
					}
				}
				if($isdel==1){
					$filename=$allpic_res[$aaa]['pic'];  //只能是相对路径
					if($filename!=""&&file_exists($filename)){
						@unlink($filename);
					}
					$CI->db->delete(DB_PRE().'article_picture',array('id'=>$allpic_res[$aaa]['id']));
				}
			}
		}
	}
	//curl Post 数据
	function do_post_request($url, $post_Data){
		$ch = curl_init($url);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));// 设置header需要发送的参数
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_Data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = curl_exec($ch);
		//		var_dump($data);
		return $data;
	}
	
	
	
	
	/**
	 * 只保留字符串首尾字符，隐藏中间用*代替（两个字符时只显示第一个）
	 * @param string $user_name 姓名
	 * @return string 格式化后的姓名
	 */
	function substr_cut($user_name){
		$strlen     = mb_strlen($user_name, 'utf-8');
		if($strlen == 0){
			return $user_name;
		}else if($strlen == 1){
			// 		return $user_name;
			return '*';
		}else{
			$firstStr     = mb_substr($user_name, 0, 5, 'utf-8');
			$lastStr     = mb_substr($user_name, -3, 3, 'utf-8');
// 			return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
			return $strlen == 2 ? $firstStr . str_repeat('*', 3) : $firstStr . str_repeat("*", 3) . $lastStr;
		}
	}
	
	
	function getipaddress(){
		if (! empty ( $_SERVER ["HTTP_CLIENT_IP"] )) {
			$ip_address = $_SERVER ["HTTP_CLIENT_IP"];
		} elseif (! empty ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
			$ip_address = $_SERVER ["HTTP_X_FORWARDED_FOR"];
		} elseif (! empty ( $_SERVER ["REMOTE_ADDR"] )) {
			$ip_address = $_SERVER ["REMOTE_ADDR"];
		} else {
			$ip_address = "127.0.0.1";
		}
		
		if ($ip_address == '::1') {
			$ip_address = '127.0.0.1';
		}
		return $ip_address;
	}
	
	function show_phoneformat($phone){
		$newphone = '';
		if(strlen($phone) == 11){
			$newphone = mb_substr(0, 3, $phone);
		}else{
			$newphone = $phone;
		}
	}
	
	
	function sendsms_contact($code, $phone){
		require_once './themes/sms/api_demo/SmsDemo.php';
	
		// 调用示例：
		// 		set_time_limit(0);
		// 		header('Content-Type: text/plain; charset=utf-8');
	
		$response = SmsDemo::sendSms(
				"大昌华嘉", // 短信签名
				"SMS_115670025", // 短信模板编号
				$phone, // 短信接收者
				Array(  // 短信模板中字段的值
						"code"=>$code
				),
				"123"   // 流水号,选填
		);
		// 		echo "发送短信(sendSms)接口返回的结果:\n";
		// 		print_r($response);
		// stdClass Object
		// (
		// 		[Message] => OK
		// 		[RequestId] => 6B14458D-530F-4C58-BA54-F58FD5F110C1
		// 		[BizId] => 287721811857550225^0
		// 		[Code] => OK
		// )
	
		$rearr = array();
		if(isset($response->Message)){
			$rearr['return_Message'] = $response->Message;
		}else{
			$rearr['return_Message'] = NULL;
		}
		if(isset($response->RequestId)){
			$rearr['return_RequestId'] = $response->RequestId;
		}else{
			$rearr['return_RequestId'] = NULL;
		}
		if(isset($response->BizId)){
			$rearr['return_BizId'] = $response->BizId;
		}else{
			$rearr['return_BizId'] = NULL;
		}
		if(isset($response->Code)){
			$rearr['return_Code'] = $response->Code;
		}else{
			$rearr['return_Code'] = NULL;
		}
		return $rearr;
	}
	
	function sendsms_register($code, $phone){
		require_once './themes/sms/api_demo/SmsDemo.php';
		
		// 调用示例：
// 		set_time_limit(0);
// 		header('Content-Type: text/plain; charset=utf-8');
		
		$response = SmsDemo::sendSms(
				"大昌华嘉", // 短信签名
				"SMS_109680601", // 短信模板编号
				$phone, // 短信接收者
				Array(  // 短信模板中字段的值
					"code"=>$code
				),
				"123"   // 流水号,选填
		);
// 		echo "发送短信(sendSms)接口返回的结果:\n";
// 		print_r($response);
		// stdClass Object
		// (
		// 		[Message] => OK
		// 		[RequestId] => 6B14458D-530F-4C58-BA54-F58FD5F110C1
		// 		[BizId] => 287721811857550225^0
		// 		[Code] => OK
		// )
		
		$rearr = array();
		if(isset($response->Message)){
			$rearr['return_Message'] = $response->Message;
		}else{
			$rearr['return_Message'] = NULL;
		}
		if(isset($response->RequestId)){
			$rearr['return_RequestId'] = $response->RequestId;
		}else{
			$rearr['return_RequestId'] = NULL;
		}
		if(isset($response->BizId)){
			$rearr['return_BizId'] = $response->BizId;
		}else{
			$rearr['return_BizId'] = NULL;
		}
		if(isset($response->Code)){
			$rearr['return_Code'] = $response->Code;
		}else{
			$rearr['return_Code'] = NULL;
		}
		return $rearr;
	}
	
	function sendsms_forget($code, $phone){
		require_once './themes/sms/api_demo/SmsDemo.php';
	
		// 调用示例：
		// 		set_time_limit(0);
		// 		header('Content-Type: text/plain; charset=utf-8');
	
		$response = SmsDemo::sendSms(
				"大昌华嘉", // 短信签名
				"SMS_114355065", // 短信模板编号
				$phone, // 短信接收者
				Array(  // 短信模板中字段的值
						"code"=>$code
				),
				"123"   // 流水号,选填
		);
		// 		echo "发送短信(sendSms)接口返回的结果:\n";
		// 		print_r($response);
		// stdClass Object
		// (
		// 		[Message] => OK
		// 		[RequestId] => 6B14458D-530F-4C58-BA54-F58FD5F110C1
		// 		[BizId] => 287721811857550225^0
		// 		[Code] => OK
		// )
	
		$rearr = array();
		if(isset($response->Message)){
			$rearr['return_Message'] = $response->Message;
		}else{
			$rearr['return_Message'] = NULL;
		}
		if(isset($response->RequestId)){
			$rearr['return_RequestId'] = $response->RequestId;
		}else{
			$rearr['return_RequestId'] = NULL;
		}
		if(isset($response->BizId)){
			$rearr['return_BizId'] = $response->BizId;
		}else{
			$rearr['return_BizId'] = NULL;
		}
		if(isset($response->Code)){
			$rearr['return_Code'] = $response->Code;
		}else{
			$rearr['return_Code'] = NULL;
		}
		return $rearr;
	}
	
	//获取真实的IP
	function getrealipaddress(){
		if(getenv('HTTP_CLIENT_IP')) {
			$onlineip = getenv('HTTP_CLIENT_IP');
		} elseif(getenv('HTTP_X_FORWARDED_FOR')) {
			$onlineip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif(getenv('REMOTE_ADDR')) {
			$onlineip = getenv('REMOTE_ADDR');
		} else {
			$onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
		}
		return $onlineip;
	}
	
	/**
	 * Http Get/Post 函数,请求为json 格式
	 * @param $url
	 * @param $data
	 * @param string $method
	 * @return mixed
	 */
	function Api_Request($url, $data, $method = "GET"){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		//以下两行，忽略https 证书
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$method = strtoupper($method);
		if ($method == "POST") {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;
	}
	
	function is_weixin(){
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
			return 'yes';
		}
		return 'no';
	}
	
	