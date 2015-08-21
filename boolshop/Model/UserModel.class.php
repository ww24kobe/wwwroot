<?php
defined('ACC')||exit('Acc Deined');


class UserModel extends Model {
    protected $table = 'user';



	/*  
     *  更新用户的数据
     *
	 * @return bool
     */
    public function add($data,$username) {
        return $this->db->autoExecute($this->table,$data,'update',' where username='."'".$username."' ");
    }//db是由model中获取mysql的实例

	/*  
     *  更新密码
     *
	 * @return bool
     */
    public function updatePwd($data,$username) {
		$data['password']=md5($data['password']);
        return $this->db->autoExecute($this->table,$data,'update',' where username='."'".$username."'");
    }



    

	   /*  
	    * 检查用户是否正确
		* @parm1 string $username 要判断的用户名
		* @return string 存在返回用户的密码，否则false   
		*/
		public function checkLoginUser($username){		
		  $sql='select password from ' .$this->table .'  where username='."'".$username."'";
		 
		  return $this->db->getOne($sql);		  	
		}
		/*  
	    * 检查密码是否正确
		* @parm1 string $username 要判断的密码
		* @return string 存在返回用户的密码，否则false   
		*/
		public function checkPwd($username){		
		  $sql='select password from ' .$this->table .'  where username='."'".$username."'";
		  return $this->db->getOne($sql);		  	
		}


	  


	   /*  
	    * 检查用户名是否重复
		* @parm1 string $username 要判断的用户名
		* @return boolean 存在返回true，否则false   
		*/
		public function checkUser($username){
		
		  $sql='select * from ' .$this->table .'  where username="'.$username.'"';
		  return $this->db->getRow($sql)? true:false;	
		}

	   /*  
	    * 添加用户信息
		* @parm1 array $data 添加的用户信息
		* @return boolean 存在返回true，否则false   
		*/
		public function insertUserAndPass($data){
			$data['password']=md5($data['password']);
          return  $this->db->autoExecute($this->table,$data,'insert')? true:false;
		}




    
      
 
}


