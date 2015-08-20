<?php

class CategoryAction extends  AdminAction{
	
	/*
	 *添加栏目 
	 * 
	 */
	public  function add() {
		$cat_model=D('Category');
		$cat_data=$cat_model->getSonTree();
		if(IS_POST){
			if($cat_model->create()){
				if($cat_model->add()){
					$this->success('栏目添加成功','catList');exit;
				}else{
					$this->success('栏目添加失败');
				}
			}else{
				$this->error($cat_model->getError());
			}
		}
		$this->assign('cat_data',$cat_data);
		$this->display();
	}
	
	/*
	 * 栏目列表
	 * 
	 */
	public function catList(){
		$cat_model=D('Category');
		$cat_data=$cat_model->getSonTree();
		$this->assign('cat_data',$cat_data);
		$this->display();
	}
	
	/*
	 * 商品栏目编辑视图
	*/
	public function edit(){
		if(IS_POST){
			$catmodel=D('Category');
			if($catmodel->create()){
				if($catmodel->save($_POST)){
					$this->success('编辑成功',U('Category/catList'));exit;
				}else{
					$this->error('编辑失败');
				}
			}else{
				$this->error($catmodel->getError());
			}
		}
		$id=(int)$_GET['id'];
		$this->catinfo=D('Category')->find($id);
		$this->display();
	}
	
	/*
	 * 删除栏目(递归删除)
	*/
	public function del(){
		$id=(int)$_GET['id'];
		$ids=D('Category')->getSonId($id);
		//判断是否存在子栏目
		if($ids){
			$this->error('请先删除该栏目下的子栏目');
		}
		$affected=D('Category')->where("id=$id")->delete();
		if($affected){
			$this->success('删除成功',U('Category/catList'),2);exit;
		}else{
			$this->error('删除失败');
		}
	}
}
