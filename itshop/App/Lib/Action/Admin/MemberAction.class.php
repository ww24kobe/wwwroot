<?php
class MemberAction extends  AdminAction{
	
	/*
	 * 会员列表视图
	 */
	public function userlist(){
		$sql="select a.*,b.level_name from it_member a  left join it_member_level b on a.level_id=b.id";
		$this->userdata=M()->query($sql);
		$this->display();
	}
	
	/*
	 select a.*,b.level_name from it_member a  left join it_member_level b on a.level_id=b.id;
	
	*/

	/*
	 * 删除会员动作
	*/
	public function del(){
		$id=(int)$_GET['id'];
		$affected=M('Member')->where("id=$id")->delete();
		if($affected){
			$this->success('删除成功',U('Member/userlist'),2);exit;
		}else{
			$this->error('删除失败');
		}
	}
}