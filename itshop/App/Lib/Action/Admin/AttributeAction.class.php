<?php
class  AttributeAction  extends  AdminAction{
	
	/**
	 * 添加属性
	 */
	public  function add(){
		$type_id=$_GET['id'];
		if($this->ispost()){
			$attr_model=D('Attribute');
			if($attr_model->create()){	
				
				if($attr_model->add()){
					$this->success('添加商品属性成功','attrList');exit;
				}else{
					$this->error('添加商品属性失败');
				}
				
			}else{
				$this->error($attr_model->getError());
			}
			
		}
		$this->type_id=$type_id;
		$this->typedata=D('GoodsType')->select();
		$this->display();
	}
	
	/**
	 * 属性列表
	 */
	public  function attrList(){
		$type_id=(int)$_GET['id'];
		$this->typedata=D('GoodsType')->select();
		$this->attrdata=D('Attribute')->getAttr($type_id);	
		$this->type_id=$type_id;
		$this->display();
	}
	
	
	
	/**
	 * ajax返回属性值
	 */
	public function ajaxGetAttrs(){
		$type_id=(int)$_GET['id'];
		$this->attrdata=D('Attribute')->getAttr($type_id);
		$this->display();		
	}
	
	/*
	 * 商品属性编辑视图
	*/
	public function edit(){
		if(IS_POST){
			$attrmodel=D('Attribute');
			if($attrmodel->create()){
				if($attrmodel->save($_POST)){
					$this->success('编辑成功',U('Attribute/attrlist'));exit;
				}else{
					$this->error('编辑失败');
				}
			}else{
				$this->error($attrmodel->getError());
			}
		}
		$id=(int)$_GET['id'];
		$this->typedata=D('GoodsType')->select();
		$this->attrinfo=D('Attribute')->find($id);
		$this->display();
	}
	
	/*
	 * 删除属性
	*/
	public function del(){
		$id=(int)$_GET['id'];
		$affected=D('Attribute')->where("id=$id")->delete();
		if($affected){
			$this->success('删除成功',U('attribute/attrList'),2);exit;
		}else{
			$this->error('删除失败');
		}
	}
	
}