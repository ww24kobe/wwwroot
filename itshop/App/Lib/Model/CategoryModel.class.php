<?php
class  CategoryModel extends  Model{
	//自动验证
	protected   $_validate=array(
		array('cat_name','require','必须填写栏目名称'),		
	);
	/*
	 * 获取指定栏目的子孙id
	 */
	public  function getSonId($cat_id){
		$arr=$this->select();
		return $this->_getSonId($arr,$cat_id);
	}
	
	public function _getSonId($arr,$id){
		static  $list=array();
		foreach($arr as $v){
			if($v['parent_id']==$id){
				$list[]=$v['id'];
				$this->_getSonId($arr, $v['id']);
			}
			
		}
		
		return  $list;
	}

	/*
	 * 获取顶级栏目
	 */
	public function  getTop(){
		return D('Category')->where('parent_id=0')->select();
	}
	
	/*
	 * 获取全部栏目子孙树
	 */
	public function  getSonTree(){
		$arr=$this->select();
		return $this->_getSonTree($arr);
	}
	

	public  function  _getSonTree($arr,$id=0,$lev=0){
		static  $listdata=array();
		foreach($arr as $v){
			if($v['parent_id']==$id){
				$v['lev']=$lev;
				$listdata[]=$v;
				$this->_getSonTree($arr, $v['id'],$lev+1);
			}
			
		}
		
		return  $listdata;
	}
	
	
	/*
	 * 获取家朴树
	 */
	public function findfamily($cat_id){
		//要取出所有的栏目
		$arr = $this->select();
		return array_reverse($this->_findfamily($arr,$cat_id));
	}
	public function _findfamily($arr,$cat_id){
		static $list=array();
		foreach($arr as $v){
			//先找到属栏目的信息,再传当前栏目的parent_id找父栏目
			if($v['id']==$cat_id){
				$list[]=$v;
				$this->_findfamily($arr,$v['parent_id']);
			}
			 
		}
		return $list;
	}
}