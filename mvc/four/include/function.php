<?php
/**
 * 无限分类 树
 * @parame 
 */
function getChilds($arr,$id){
	$childs = array();
	foreach($arr as $k=>$v){
		if($arr[$k]['pid'] == $id){
			$childs[] = $v;
		}
	}
	return $childs;
	
	
}
function fenlei($arr,$f_id=0){
  		$childs=getChilds($arr,$f_id);
		foreach($childs as $k=>$v){
			$tem_arr = fenlei($arr,$childs[$k]['id']);
			if(!empty($tem_arr)){
				$childs[$k]['childs'] = $tem_arr;
			}
			
		}
		return $childs;
}
function import($className){
	$classPath = ROOT_DIR.'/framework/utils/'.$className;
	if(file_exists($classPath)){
		include_once($classPath);
	}else{
		echo "没有找到".$classPath;
	}
	
}