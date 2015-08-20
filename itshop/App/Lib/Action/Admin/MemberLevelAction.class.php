<?php
class  MemberLevelAction  extends  AdminAction{
	
	/*
	 * 会员等级添加视图
	 */
	public  function  add(){
		if($this->ispost()){
			$mem_model=D('MemberLevel');
			//var_dump($_POST);exit;
			if($mem_model->create()){
				if($mem_model->add()){
					$this->success('添加会员等级成功','memList');exit;
				}else{
					$this->error('添加会员等级失败');
				}
		
			}else{
				$this->error($mem_model->getError());
			}
				
		}
		$this->display();
	}
	
	/*
	 * 会员等级视图
	 */
	public  function  memList(){
		$this->memdata=D('MemberLevel')->select();
		$this->display();
	}
	
	/*
	 * 会员等级编辑视图
	*/
	public function edit(){
		if(IS_POST){
			$memmodel=D('MemberLevel');
			//showbug($memmodel);exit;
			if($memmodel->create()){
				if($memmodel->save($_POST)){
					$this->success('编辑成功',U('MemberLevel/memlist'));exit;
				}else{
					$this->error('编辑失败');
				}
			}else{
				$this->error($memmodel->getError());
			}
		}
		$id=(int)$_GET['id'];
		$this->meminfo=D('MemberLevel')->find($id);
		$this->display();
	}
	
	/*
	 * 删除会员等级
	*/
	public function del(){
		$id=(int)$_GET['id'];
		$affected=D('MemberLevel')->where("id=$id")->delete();
		if($affected){
			$this->success('删除成功',U('MemberLevel/memList'),2);exit;
		}else{
			$this->error('删除失败');
		}
	}
}