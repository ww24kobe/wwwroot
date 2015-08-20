<?php
class AdvertAction extends AdminAction{
	
	/*
	 * 添加公告视图
	 */
	public function add(){
		if(IS_POST){
			$advmodel=M('Advert');
			$_POST['add_time']=time();
			if($advmodel->add($_POST)){
				$this->success("添加公告成功",U('Advert/advlist'));exit;
			}else{
				$this->error('添加公告失败');
			}
		}
		$this->display();
	}
	
	/*
	 * 公告视图列表
	 */
	public function advlist(){
		$this->advdata=M('Advert')->order("add_time  desc")->select();
		$this->display();
	}
	
	/*
	 * 删除公告动作
	*/
	public function del(){
		$id=(int)$_GET['id'];
		$affected=M('Advert')->where("id=$id")->delete();
		if($affected){
			$this->success('删除成功',U('Advert/advlist'),2);exit;
		}else{
			$this->error('删除失败');
		}
	}
}