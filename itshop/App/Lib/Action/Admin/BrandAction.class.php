<?php
class BrandAction extends AdminAction{
	
	
	
	/*
	 * 添加品牌视图
	 */
	public function add(){
		if(IS_POST){
			$_POST['b_logo']=$this->upload();//图片路径
			$brand=D('Brand');
			if($brand->create()){
				if($brand->add()){
					$this->success('添加品牌成功',U('Brand/brandlist'));
				}else{
					$this->error('添加品牌失败！');
				}
			}else{
				$this->error($brand->getError());
			}
		}
		$this->display();
	}
	
	/*
	 * 品牌列表
	 */
	public function brandList(){
		$brand=D('Brand');
		$this->branddata=$brand->select();
		$this->display();
	}
	
	/*
	 * 上传图片方法
	 */
	Public function upload(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/brand/';// 设置附件上传目录
		$upload->thumb = true; //缩略图处理
		$upload->thumbPrefix="thumb_,img_";
		$upload->thumbMaxWidth = '88';
		$upload->thumbMaxHeight = '31';
		$upload->autoSub=true;
		$upload->subType='date';
		$upload->dateFormat='Ym/d';
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info=$upload->getUploadFileInfo();
		}
 		return $info[0]['savename'];
	}
	
	/*
	 * 商品品牌编辑视图
	*/
	public function edit(){
		if(IS_POST){
			//var_dump($_POST);exit;
			$brand=D('Brand');
			if($brand->create()){
				if($brand->save($_POST)){
					$this->success('编辑成功',U('brand/brandList'));exit;
				}else{
					$this->error('编辑失败');
				}
			}else{
				$this->error($brand->getError());
			}
		}
		$id=(int)$_GET['id'];
		$this->brandinfo=D('brand')->find($id);
		$this->display();
	}
	
	/*
	 * 删除品牌
	*/
	public function del(){
		$id=(int)$_GET['id'];
		$affected=D('Brand')->where("id=$id")->delete();
		if($affected){
			$this->success('删除成功',U('Brand/brandList'),2);exit;
		}else{
			$this->error('删除失败');
		}
	}
}