<?php
class  MessageAction  extends Action{
	
	/*
	 * 会员留言列表
	 */
	public function  meslist(){
		$this->mesdata=M('Message')->select();
		$this->display();
	}
	
	/*
	 * 删除会员留言动作
	*/
	public function del(){
		$id=(int)$_GET['id'];
		$affected=M('Message')->where("id=$id")->delete();
		if($affected){
			$this->success('删除成功',U('Message/meslist'),2);exit;
		}else{
			$this->error('删除失败');
		}
	}
} 