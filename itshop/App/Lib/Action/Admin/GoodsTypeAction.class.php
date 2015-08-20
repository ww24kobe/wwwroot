<?php
class  GoodsTypeAction extends AdminAction{
	
	/**
	 *添加商品类型
	 * 
	 */
	public  function  add(){
		if($this->ispost()){
			$type_model=D('GoodsType');
			if($type_model->create()){			
				if($type_model->add()){
					$this->success('添加商品类型成功','typeList');exit;
				}else{
					$this->error('添加商品类型失败');
				}
				
			}else{
				$this->error($type_model->getError());
			}
			
		}
		$this->display();
		
	}
	
	/*
	 * 类型列表
	 */
	public  function  typeList(){
		$sql="select a.*,count(b.id) count  from it_goods_type a  left join it_attribute b on a.id=b.type_id group by a.id";
		$this->typedata=D('GoodsType')->query($sql);
		$this->display();
	}
	
	/*
	 * 商品类型编辑视图
	 */
	public function edit(){
		if(IS_POST){
			$typemodel=D('GoodsType');
			if($typemodel->create()){
				if($typemodel->save($_POST)){
					$this->success('编辑成功','typeList');exit;
				}else{
					$this->error('编辑失败');
				}
			}else{
				$this->error($typemodel->getError());
			}
		}
		$id=(int)$_GET['id'];
		$this->typeinfo=D('GoodsType')->find($id);
		$this->display();
	}
	
	/*
	 * 删除商品
	*/
	public function del(){
		$id=(int)$_GET['id'];
		$affected=D('GoodsType')->where("id=$id")->delete();
		if($affected){
			$this->success('删除成功',U('GoodsType/typeList'),2);exit;
		}else{
			$this->error('删除失败');
		}
	}
	
	
	
}
