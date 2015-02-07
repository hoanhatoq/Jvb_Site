<?php
require_once(CORE_PATH.'users/users.php');

class users_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw,$vsPrint,$vsSkin;
//		if(file_exists(ROOT_PATH.$vsSkin->basicObject->getFolder()."/skin_".$bw->input[0].".php")){
//			parent::__construct($modelName,"skin_".$bw->input[0],"page",$bw->input[0]);;
//		}else{
		parent::__construct($modelName,"skin_users","user");
//		}
		//$this->model->categoryName=$bw->input[0];
		//$vsPrint->addExternalJavaScriptFile("http://maps.google.com/maps/api/js?sensor=true&language=vi",1);
	}
	public	function auto_run(){
	
	global $bw;
				switch ($bw->input['action']) {
			case $this->modelName.'_registry':
				$this->registry($bw->input[2]);
				break;
			case $this->modelName.'_do_registry':
				$this->doRregistry();
				break;
			case $this->modelName.'_check_username':
				$this->checkUsername();
				break;	
			case $this->modelName.'_do_login':
				$this->doLogin();
				break;
			case $this->modelName.'_logout':
				$this->doLogOut();
				break;
			case $this->modelName.'_forgot_password':
				$this->forgotPassword();
				break;
			case $this->modelName.'_do_forgot_password':
				$this->doForgotPassword();
				break;
			case $this->modelName.'_chang_password':
				$this->changePassword();
				break;
			case $this->modelName.'_do_chang_password':
				$this->doChangePassword();
				break;
			case $this->modelName.'_chang_info':
				$this->changeInfo();
				break;
			case $this->modelName.'_do_chang_info':
				$this->doChangeInfo();
				break;
			case $this->modelName.'_submit_video':
				$this->submitVideo();
				break;
			case $this->modelName.'_do_submit_video':
				$this->doSubmitVideo();
				break;
			case $this->modelName.'_reg_list':
				$this->showRegList();
				break;
			case $this->modelName.'_approve_list':
				$this->showApproveList();
				break;
			case $this->modelName.'_view_info':
				$this->showViewInfo();
				break;
			case $this->modelName.'_comment':
				$this->userComment();
				break;
			case $this->modelName.'_users':
				$this->userComment();

			case $this->modelName.'_login_mobile':
				$this->loginMobile();

				break;	
			default:
				//parent::auto_run();
				$this->registry();
				break;
		}

	}

function loginMobile(){
	global $bw;

	$option=array();
	return $this->output= $this->html->loginMobile($option);


}
function checkUsername($option=array()){
		//echo 123;exit();
		global $bw,$vsPrint;
		$this->model->setCondition("`name`='".strtolower($bw->input['name'])."'");
			$value['ok']=0;
			$this->model->getOneObjectsByCondition();
			if($this->model->basicObject->getId()){
				$option['message']= VSFactory::getLangs()->getWords('username_exist','Tên đăng nhập đã tồn tại');
				$value['ok']=1;
				
			}
			
			
			if($value['ok']==0){
				require_once(CORE_PATH.'admins/admins.php');
				$ad=new admins();
				$ad->setFieldsString('id');
				$ad->setCondition("`name`='".strtolower($bw->input['name'])."'");
				$ad->getOneObjectsByCondition();
				if($ad->basicObject->getId()){
					$option['message']= VSFactory::getLangs()->getWords('username_exist','Tên đăng nhập đã tồn tại');
					$value['ok']=1;
					
				}
			}	
			
			$value['message']=$option['message'];
			echo json_encode($value);exit();
			
		return $this->output= $this->html->checkUsername($option);
	}
	
	
	function registry($option=array()){
		
		
		return $this->output= $this->html->registry($option);
	}
	function doRregistry(){
		global $bw,$vsPrint;
		
		require_once ROOT_PATH.'vscaptcha/VsCaptcha.php';
		$vscaptcha=new VsCaptcha();
		if(!$vscaptcha->check($bw->input['sec_code'])){
			echo "Mã bảo mật không đúng";die;
		}
		//if(($bw->input['password']!=$bw->input['password_confirm'])||!$bw->input['password']){
		//	$option['message']= VSFactory::getLangs()->getWords('password_not_available','Mật khẩu không hợp lệ');
		//}
		if(strlen($bw->input['name'])<4){
			$option['message']= VSFactory::getLangs()->getWords('name_not_available','Tên đăng nhập quá ngắn');
			echo $option['message'];die;
		}
		/*$this->model->setCondition("`name`='".strtolower($bw->input['name'])."'");
		$this->model->getOneObjectsByCondition();
		if($this->model->basicObject->getId()){
			$option['message']= VSFactory::getLangs()->getWords('username_exist','Tên đăng nhập đã tồn tại');
			echo $option['message'];die;
		}*/

		if (!filter_var($bw->input['email'], FILTER_VALIDATE_EMAIL)) {
		    $option['message']='Email không hợp lệ';
			echo $option['message'];die;
		}


		$this->model->setCondition("`email`='".strtolower($bw->input['email'])."'");
		$this->model->getOneObjectsByCondition();
		if($this->model->basicObject->getId()){
			$option['message']= 'Email này đã đăng kí';
			echo $option['message'];die;
		}

			/*if(!preg_match('/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/iu', $bw->input['email'])){
				$option['message']='Email không hợp lệ';
				echo $option['message'];die;
			}*/
		
		$bw->input['name']=strtolower($bw->input['name']);
		$bw->input['email']=strtolower($bw->input['email']);
		$this->model->basicObject->convertToObject($bw->input);
		$this->model->basicObject->setTitle($bw->input['name']);
		$this->model->basicObject->setPassword(md5($bw->input['password']));
		$this->model->basicObject->setStatus(1);
		$this->model->insertObject();

		VSFactory::getUsers()->updateSession($this->model->basicObject);

		$option['message']='1';

		echo $option['message'];die;


		
	}
	function forgotPassword($message=""){
		return $this->output= $this->html->forgotPassword($option);
	}
	function doForgotPassword($message=""){
		global $bw,$vsStd;


		require_once ROOT_PATH.'vscaptcha/VsCaptcha.php';
		$vscaptcha=new VsCaptcha();

		//print_r($vscaptcha->check($bw->input['security']));die;
		if(!$vscaptcha->check($bw->input['security'])){
			echo "Mã bảo mật không đúng";die;
		}
		if(!$bw->input['security']){
			echo "Vui lòng nhập mã bảo vệ";die;
		}


		$this->model->setCondition("email='{$bw->input['email']}'");
		$result=$this->model->getOneObjectsByCondition();
		
		if(!isset($result->id)){
			echo "Địa chỉ Email không chính xác.";die;
		}


			
		$length = 15;
		$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
		


		$this->model->basicObject->setToken($randomString);
		$this->model->updateObject();


		$vsStd->requireFile(LIBS_PATH."Email.class.php",true);
		$email=new Emailer();
		
		$content.='Bạn vừa gửi yêu cầu tim mật khẩu từ website http://memoryshop.vn/ '."<br/>";
		$content.='Sau khi nhận lại mật khẩu , xin hảy đổi lại mật khẩu mới. '."<br/>";
		$content.='Đây là mật khẩu mới của bạn: <b>'.$randomString."</b><br/>";
		$content.='Hảy click vào đây để đổi mật khẩu mới '."<a target='_blank' href='{$bw->base_url}users/chang_info''>Click</a>";
	
		
		$email->setBody($content);
		
		$email->setFrom('alert@vsmail.vn');
		$email->setTo($result->getEmail());
		$email->setSubject("Yêu cầu tìm mật khẩu memoryshop.vn");
		
		$email->sendMail();
		echo "Mật khẩu đã được gửi về địa chỉ Email '{$bw->input['email']}'.<br/> Vui lòng kiểm tra hộp thư để lấy lại mật khẩu";die;
		//$option['message']=VSFactory::getLangs()->getWords('forgot_passwd_message','Hệ thống đã gửi mật khẩu vào tài khoản email của bạn vui lòng kiểm tra email');
		return $this->output= $this->html->doForgotPassword($option);
	}
	
	function doChangePassword(){
		global $vsPrint,$bw;
		

		$session_user=VSFactory::getUserLogin();

		VSFactory::getUsers()->getObjectById($session_user['id']);


		/*print_r(md5($bw->input['password_old']));
		print_r('<br>');
		print_r(VSFactory::getUsers()->basicObject->getPassword());
		die;*/

		//print_r(VSFactory::getUsers()->basicObject->getToken());die;
		if(trim($bw->input['password_old'])==VSFactory::getUsers()->basicObject->getToken() ){
			//echo 1233;die;
		}else{
			if(md5($bw->input['password_old'])!=VSFactory::getUsers()->basicObject->getPassword() ){
				echo "Mật khẩu củ không chính xác";die;
			}

		}

		/*if(md5($bw->input['password_old'])!=VSFactory::getUsers()->basicObject->getPassword() ){
			echo "Mật khẩu củ không chính xác";die;
		}*/

		if($bw->input['password']==''){
			echo "Vui lòng nhập mật khẩu mới";die;
		}


		
		VSFactory::getUsers()->basicObject->setPassword(md5($bw->input['password']));
		VSFactory::getUsers()->basicObject->setToken('');
		VSFactory::getUsers()->updateObject();
	

		echo "Đổi mật khẩu thành công!";die;
		return $this->output= $this->html->doChangePassword($option);
	}

function changeInfo(){
		global $vsPrint,$bw;

		$session_user=VSFactory::getUserLogin();
		if(!$session_user['id']){
			$vsPrint->boink_it($bw->base_url);
		}
		
		$user=VSFactory::getUsers();
		
		$session_user=VSFactory::getUserLogin();
		$option['obj']=$user->getObjectById($session_user['id']);
		
		
		return $this->output= $this->html->changeInfo($option);

}


	function doChangeInfo(){
		global $vsPrint;
		global $bw;
		
			
		if($bw->input['name']=='' || $bw->input['phone']=='' || $bw->input['address']==''){
			echo "Vui lòng nhập đầy đủ thông tin.";die;
		}


		$user_login=VSFactory::getUserLogin();	
		VSFactory::getUsers()->basicObject->convertToObject($bw->input);
		//VSFactory::getUsers()->basicObject->setPassword(null);
		VSFactory::getUsers()->basicObject->setTitle($bw->input['name']);
		VSFactory::getUsers()->basicObject->setId($user_login['id']);
		//VSFactory::getUsers()->basicObject->setLocation(null);
		VSFactory::getUsers()->basicObject->setStatus(null);

		VSFactory::getUsers()->updateObject();
		
		echo "Cập nhật thông tin thành công";die;
		//$vsPrint->redirect_screen(VSFactory::getLangs()->getWords('change_info'),'/');
		$option['obj']=VSFactory::getUsers()->basicObject;
			
			
		
		return $this->output= $this->html->changeInfo($option);
	}
	
	function doLogin($email='',$pass=''){
		global $bw,$vsPrint;
		
		if($email!='')
			$bw->input['email']=$email;

		if($pass!='')
			$bw->input['password']=$pass;


		if(strlen($bw->input['email'])<4){
			echo "Vui lòng nhập địa chỉ Email";die;
		}

		if (!filter_var($bw->input['email'], FILTER_VALIDATE_EMAIL)) {
			echo 'Email không hợp lệ';die;
		}

		if(strlen($bw->input['password'])<1){
			echo "Vui lòng nhập mật khẩu";die;
		}

		$option['login_ok']=0;
		$this->model->setCondition("email='".strtolower($bw->input['email'])."' and password='".md5(strtolower($bw->input['password']))."' OR token='".$bw->input['password']."'");
		$result=$this->model->getOneObjectsByCondition();

		if(!$result){
			$option['login_ok']=0;
			$option['message']='Địa chỉ email hoặc mật khẩu không chính xác';
			echo $option['message'];die;
			//return $this->output=$this->html->loginForm($option);	
		}

		if($result->getStatus()==0){
			echo "Tài khoản này của bạn hiện không thể sử dụng. ";die;
		}

		VSFactory::getUsers()->basicObject=$result;
		VSFactory::getUsers()->updateSession();

		echo 1;die;
		
	}
	
	function doLogOut(){
		global $bw,$vsPrint;
		unset($_SESSION['user']);
		setcookie('id_user','',-time()+36000000,'/');
		$vsPrint->boink_it($bw->base_url);
		
	}
	function showRegList(){
		global $bw,$vsPrint;
		$option['location']=VSFactory::getMenus()->getCategoryById($bw->input[2]);
		if(!$option['location']) $option['location']=new Menu();
		if($option['location']->getId()){
			$ids=VSFactory::getMenus()->getChildrenIdInTree($option['location']->getId());
			$this->model->setCondition("`status`=1 and location in ($ids)");
		}else{
			$this->model->setCondition("`status`=1");
		}
		$this->model->setOrder('`index`');
		$option=array_merge($option, $this->model->getPageList("users/reg_list/{$bw->input[2]}/",3,VSFactory::getSettings()->getSystemKey('limit_users_home',12)));
		foreach ($option['pageList'] as $u) {
			$u->location=VSFactory::getMenus()->getCategoryById($u->getLocation());
			if(!$u->location) $u->location=new Menu();
		}
		return $this->output=$this->html->showRegList($option);
		
	}
	function showApproveList(){
		global $bw,$vsPrint;
		$option['location']=VSFactory::getMenus()->getCategoryById($bw->input[2]);
		if(!$option['location']) $option['location']=new Menu();
		if($option['location']->getId()){
				$ids=VSFactory::getMenus()->getChildrenIdInTree($option['location']->getId());
			$this->model->setCondition("`status`=2 and location in ($ids)");
		}else{
			$this->model->setCondition("`status`=2");
		}
		$this->model->setOrder('`index`');
		$option=array_merge($option,$this->model->getPageList("users/approve_list/{$bw->input[2]}/",3,VSFactory::getSettings()->getSystemKey('limit_users_home',12)));
		
		foreach ($option['pageList'] as $u) {
			$u->location=VSFactory::getMenus()->getCategoryById($u->getLocation());
			if(!$u->location) $u->location=new Menu();
		}
		return $this->output=$this->html->showApproveList($option);
	}
	function showViewInfo(){
		global $bw,$vsPrint;
		$this->model->getObjectById($this->getIdFromUrl( $bw->input[2]));
		require_once CORE_PATH.'users/videos.php';
		$option['video']=new Video();
		if(!$this->model->basicObject->getId()){
			$vsPrint->boink_it($bw->base_url);
		}
		$videos=new videos();
		$videos->setCondition("username='{$this->model->basicObject->getName()}' and status>0");
		$videos->setOrder('`index`,`id` DESC');
		$tmp=$videos->getOneObjectsByCondition();
		if($tmp){
			$option['video']=$tmp;
		}
		require_once CORE_PATH.'comments/comments.php';
		$comments=new comments();
		$comments->setCondition("userId='{$this->model->basicObject->getId()}' and status>0");
		$coption=$comments->getPageList("users/comment/{$bw->input[2]}/",3,VSFactory::getSettings()->getSystemKey('limit_of_comment',10),1,"comment_panel");
		$option['comment']=str_replace(array("page_prev.jpg","page_next.jpg"), array("binhluan_prev.jpg","binhluan_next.jpg"), $this->html->userComment($coption));
		$option['other']=array();
		$ids=VSFactory::getMenus()->getChildrenIdInTree($this->model->basicObject->getLocation());
		if($ids){
		$users=new users();
			$users->setCondition("location in ($ids) and `id`!='{$this->model->basicObject->getId()}'");
			$option['other']=$users->getObjectsByCondition();
		}
		return $this->output=$this->html->viewInfo($this->model->basicObject,$option);
	}
	function userComment(){
		global $bw,$vsPrint;
		require_once CORE_PATH.'comments/comments.php';
		$this->model->getObjectById($this->getIdFromUrl( $bw->input[2]));
		$comments=new comments();
		$comments->setCondition("userId='{$this->model->basicObject->getId()}' and status>0");
		$option=$comments->getPageList("users/comment/{$bw->input[2]}/",3,VSFactory::getSettings()->getSystemKey('limit_of_comment',10),1,"comment_panel");
		return $this->output=str_replace(array("page_prev.jpg","page_next.jpg"), array("binhluan_prev.jpg","binhluan_next.jpg"), $this->html->userComment($option));
	}
	function getHtml(){
		return $this->html;
	}



	function setHtml($html){
		$this->html=$html;
	}



	
	/**
	*
	*@var users
	**/
	var		$model;

	
	/**
	*
	*@var skin_users
	**/
	var		$html;
}
