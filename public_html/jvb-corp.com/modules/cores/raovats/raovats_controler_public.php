<?php
require_once(CORE_PATH.'raovats/raovats.php');

class raovats_controler_public extends VSControl_public {

	public	function auto_run(){
	
	global $bw;
				switch ($bw->input['action']) {
			case $this->modelName.'_uploadfile':
				$this->uploadfile();
				break;
			case $this->modelName.'_user_post':
				$this->post();
				break;	
			default:
				parent::auto_run();
				break;
		}

	}

	function post() {
		global $bw;

		if(!$bw->input['title']){
			echo "Vui lòng nhập tiêu đề";die;
		}
		if(!$bw->input['email']){
				echo "Vui lòng nhập Email";die;
			}
		if(!$bw->input['phone']){
				echo "Vui lòng nhập số điện thoại";die;
			}
		if(!$bw->input['content']){
				echo "Vui lòng nhập nội dung";die;
			}
		if(!$bw->input['name']){
			echo "Vui lòng nhập họ tên";die;
		}
		
		$this->model->basicObject->convertToObject($bw->input);
		$this->model->basicObject->setStatus(1);
		$this->model->basicObject->setPostDate(time());
		$this->model->insertObject();
		echo 1;die;



	}

	function uploadfile() {
		global $bw;

		$file=VSFactory::getFiles();
	
        if($file->uploadLocalToHost($_FILES['files']['tmp_name'],'userUploadRaoVat',$_FILES['files']['name'], $file->obj)){
          $html="<input type='hidden' value=".$file->obj->getId()." name='image'>";
          $html.=$file->obj->createImageCache($file->obj,60,60);
          echo json_encode(array('html'=>$html));die;
        }
	}

	function showDetail($objId,$option=array()){
		global $vsPrint, $bw,$vsTemplate;     
                $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$obj=$this->model->getObjectById($this->getIdFromUrl($objId));
		if(!$obj->getId()||$obj->getStatus()<=0){
			return $this->output=VSFactory::getLangs()->getWords('not_count_item');
		}
		$obj->createSeo();
		$option['breakcrum']=$this->createBreakCrum($obj);
		$option['other']=$this->model->getOtherList($obj);
        $option['cate'] = $category->getChildren();
        $option['cate_obj']=VSFactory::getMenus()->getCategoryById($obj->getCatId());
       	$obj->createSeo();

       	require_once (CORE_PATH . 'comments/comments.php');
       	$cm=new comments();


       	$obj->setContent(nl2br($obj->getContent()));

      


       	$cm->setCondition("status>0 AND objId={$obj->getId()} AND module='{$bw->input[0]}'");
       	$cm->setLimit(array(0,10));
       	$option['comment']=$cm->getObjectsByCondition();


       	if (!isset($_SESSION[$bw->input[0].$obj->getId().'view'])){
			$obj->setHit($obj->getHit()+1);
			$this->model->updateObjectById($obj);	
			$_SESSION[$bw->input[0].$obj->getId().'view']="stop_view++";
		}

       	//print_r($option['comment']);die();


    	$this->output = $this->getHtml()->showDetail($obj,$option);
	}


	public	function __construct($modelName){
	
		global $vsTemplate,$bw;
//		$this->html=$vsTemplate->load_template("skin_raovat");
		parent::__construct($modelName,"skin_raovats","raovat",$bw->input[0]);
//		$this->model->categoryName=$bw->input[0];

	}





	function getHtml(){
		return $this->html;
	}



	function setHtml($html){
		$this->html=$html;
	}



	
	/**
	*
	*@var raovats
	**/
	var		$model;

	
	/**
	*
	*@var skin_raovats
	**/
	var		$html;
}
