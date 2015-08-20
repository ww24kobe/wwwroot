<?php
class GoodsAction extends  AdminAction{
	
	/*
	 * 添加商品view
	 */
	public function add(){
		if(IS_POST){
			//获取上传的图片信息
			$img=$this->upload();
			$goodsdata=$_POST['goods'];//商品信息
			$goodsdata['goods_thumb']=$img['goods_thumb'];
			$goodsdata['goods_img']=$img['goods_img'];
			$goodsdata['goods_ori']=$img['goods_ori'];
			$goodsdata['add_time']=time();
			if(empty($goodsdata['goods_sn'])){//判断货号是否为空
				$goodsdata['goods_sn']='sn_'.uniqid();
			}
			$attrdata=$_POST['attr'];//属性信息
			$pricedata=$_POST['price'];//属性对应的价格信息
			$leveldata=$_POST['level'];//会员商品价格表
			
			//插入goods表
			if($goods_id=M('Goods')->add($goodsdata)){
				//插入member_price表
// 				$length=count($leveldata);
// 				$affect=0;
				foreach($leveldata as $k=>$v){
					if($v!=-1){
						$sql="insert into it_member_price(goods_id,level_id,level_price) values($goods_id,$k,'$v') ";
						$affect+=M('MemberPrice')->execute($sql);	
					}
				}
// 				if($length!=$affect){
// 					$this->error('插入member_price表失败');
// 				}
				//插入goods_attr表
				foreach($attrdata as  $k=>$v){
					//单选属性
					if(is_array($v)){
						foreach($v as  $k1=>$v1){
							
								$price=$pricedata[$k][$k1];
								$sql="insert  into  it_goods_attr(goods_id,attr_id,attr_value,attr_price)
								values('$goods_id','$k','$v1','$price')";
								M()->Execute($sql);
						}
					   
					//唯一属性	
					}else{
						$sql="insert  into  it_goods_attr(goods_id,attr_id,attr_value) 
								 values('$goods_id','$k','$v')";
						M()->Execute($sql);
					}
					
					
				}
				$this->success('添加商品成功!',U('Goods/goodslist'));exit;
			}else{
				$this->error('添加商品失败!');
			}
 		
		}
		//取出商品类型
		$gtype_model=D('GoodsType');
		$type_data=$gtype_model->select();
		$this->assign('typedata',$type_data);
		//取出品牌
		$brand=D('Brand');
		$branddata=$brand->select();
		$this->assign('branddata',$branddata);
		
		//取出分类
		$cat_model=D('Category');
		$cat_data=$cat_model->getSonTree();
		$this->assign('catdata',$cat_data);
		$this->memberlevel=D('MemberLevel')->select();
		$this->display();
	}
	
	/*
	 * ajax请求属性
	 */
	public function showAttr(){
		$type_id=(int)$_GET['type_id'];
		$attrmodel=D('Attribute');
		$attrdata=$attrmodel->getAttr($type_id);
		$this->assign('attrdata',$attrdata);
		$this->display();
	}
	
	/*
	 * 上传图片3张
	 */
   Public function upload(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
		$upload->thumb = true; //缩略图处理
		$upload->thumbPrefix="thumb_,img_";
		$upload->thumbMaxWidth = '100,230';
		$upload->thumbMaxHeight = '100,230';
		$upload->autoSub=true;
		$upload->subType='date';
		$upload->dateFormat='Ym/d';
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info=$upload->getUploadFileInfo();
		}
		$dir=date('Ym/d');
		$savename=end(explode('/',$info[0]['savename']));
		//三个图存在数据库的路径
		$arr=array(
			'goods_thumb'=>$dir.'/'.'thumb_'.$savename,
			'goods_img'=>$dir.'/'.'img_'.$savename,
			'goods_ori'=>$info[0]['savename'],
		);
		return $arr;
  }
	
	
	/*
	 * 商品列表视图
	 * Array
		(
	     [cat_id] => 6
	    [intro_type] => is_best
	    [is_sale] => no
	    [keywords] => 发生地方和
	 */
  public  function goodsList() {
  	
  	//批量放入回收站
  	if(isset($_POST['delsubmit'])){
  		$all_id=$_POST['ids'];
  		if(empty($all_id)){
  			$this->error('没选择要放入回收站的项目!');
  		}
  		//showbug($_POST);exit;
  		$where=implode(',', $all_id);
  		$data['is_delete']=1;
  		if(D('Goods')->where("id in ($where)")->save($data)){
  			$this->success('放入回收站成功','goodsList');exit;
  		}else{
  			$this->error('放入回收站失败');
  		}
  	
  	}
  	$where='';
  	//类别查询条件
  	if(!empty($_GET['cat_id'])){
  		$where.=" and cat_id={$_GET['cat_id']}";
  		$this->assign('cat_id',$_GET['cat_id']);
  	}
  	
  	//品牌查询条件
  	if(!empty($_GET['brand_id'])){
  		$where.=" and brand_id={$_GET['brand_id']}";
  		$this->assign('brand_id',$_GET['brand_id']);
  	}
  
  	//精,热,新品查询条件
  	if(!empty($_GET['intro_type'])){
  		//精品
  		if($_GET['intro_type']=='is_best'){
  			$where.=" and is_best=1";
  			$this->assign('is_best',1);
  		}
  		//新品
  		if($_GET['intro_type']=='is_new'){
  			$where.=" and is_new=1";
  			$this->assign('is_new',1);
  		}
  		//热销
  		if($_GET['intro_type']=='is_hot'){
  			$where.=" and is_hot=1";
  			$this->assign('is_hot',1);
  		}
  		//是否上架查询条件
  		if(!empty($_GET['is_sale'])){
  			if($_GET['is_sale']=='yes'){
  				$where.=" and is_sale=1";
  				$this->assign('yes_sale',1);
  			}else{
  				$where.=" and is_sale=0";
  				$this->assign('no_sale',1);
  			}
  		}
  	 }	
  		//关键字查询条件
  		if(!empty($_GET['keywords'])){
  			$where.=" and keywords like '%{$_GET['keywords']}%'";//前面加上%号不会使用索引查询
  			$this->assign('keywords',$_GET['keywords']);
  		}
  			
  		$goods = D('Goods'); // 实例化Goods对象
  		$cat = D('Category'); // 实例化Category对象
  		import('@.Tool.Page'); //引入自定义分页类
  		$count=$goods->where("1 and  is_delete=0 $where")->count();
  		$page=new Page($count,5);
  		$sql="select *  from  it_goods where 1 and is_delete=0 $where order  by add_time desc   {$page->limit}";
  		$this->goodsdata=$goods->query($sql);
  		$this->assign('page',$page->fpage());
  		//取出分类
  		$this->branddata=D('Brand')->select();
  		//取出分类
  		$this->catdata=$cat->getSonTree();
  		$this->display();
  }
  
  /*
   * ajax改变图片
  */
  public function ajaxImg(){
  		$id=(int)$_GET['id'];
  		$type=$_GET['type'];
  		if(D('Goods')->where("id=$id")->getField($type)){ //值为1
  			$data[$type] = 0;
  			$affected=D('Goods')->where("id=$id")->save($data);
  				echo '0';
  		}else{//值为0
  			$data[$type] = 1;
  			$affected=D('Goods')->where("id=$id")->save($data);
  				echo '1';
  		}
  }
  
  /*
   * 添加至回收站
   */
  public  function addTrash(){
  	$id=(int)$_GET['id'];
  	$data['is_delete']=1;
  	$affected=D('Goods')->where("id=$id")->save($data);
  	if($affected){
  		$this->success('放入回收站成功',U('Goods/goodsList'),2);exit;
  	}else{
  		$this->error('放入回收站失败');
  	}
  }
  /*
   * 删除商品
   */
  public function del(){
  	$id=(int)$_GET['id'];
  	$affected=D('Goods')->where("id=$id")->delete();
  	if($affected){
  		$this->success('删除成功',U('Goods/trashList'),2);exit;
  	}else{
  		$this->error('删除失败');
  	}
  }
  
  /*
   * 还原商品
   */
  public function restore(){
  	$id=(int)$_GET['id'];
  	$data['is_delete']=0;
  	$affected=D('Goods')->where("id=$id")->save($data);
  	if($affected){
  		$this->success('还原成功',U('Goods/goodsList'),2);exit;
  	}else{
  		$this->error('还原失败');
  	}
  }
  
  /*
   * 回收站视图
   */
  public  function  trashList(){
  	//批量放入回收站
  	if(isset($_POST['delsubmit'])){
  		$all_id=$_POST['ids'];
  		if(empty($all_id)){
  			$this->error('没选择要删除的项目!');
  		}
  		//showbug($_POST);exit;
  		$where=implode(',', $all_id);
  		//echo $where;exit;
  		if(D('Goods')->where("id in ($where)")->delete()){
  			$this->success('删除成功','trashList');exit;
  		}else{
  			$this->error('删除失败');
  		}
  		 
  	}
  	$this->goodsdata=D('Goods')->where("is_delete=1")->select();
  	$this->display();
  }
  
  
  /*
   * 编辑视图
   * Array
(
    [goods_name] => 你好
    [shop_price] => 345.00
    [goods_number] => 100
    [id] => 12
)
   */
  public function edit(){
  	if(IS_POST){
  		$goodsmodel=D('Goods');
  		if($goodsmodel->create()){
  			if($goodsmodel->save($_POST)){
  				$this->success('编辑成功',U('Goods/goodslist'));exit;
  			}else{
  				$this->error('编辑失败');
  			}
  		}else{
  			$this->error($goodsmodel->getError());
  		}
  	}
  	$id=(int)$_GET['id'];
  	$this->goodsinfo=D('Goods')->find($id);
  	$this->display();
  }
  
  /*
   * 回收站
   */
  public function  trash(){
  	echo 'trash';
  }
	
}		