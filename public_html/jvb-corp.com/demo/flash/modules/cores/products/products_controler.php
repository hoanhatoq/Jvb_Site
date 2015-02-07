<?php
require_once (CORE_PATH . 'products/products.php');
class products_controler extends VSControl_admin {

	function __construct($modelName) {
		global $vsTemplate, $bw; // $this->html=$vsTemplate->load_template("skin_products");
		parent::__construct ( $modelName, "skin_products", "product" );
		$this->model->categoryName = "products";
	}
	function auto_run() {
		global $bw;
		
		switch ($bw->input [1]) {
			case $this->modelName."_popup":
				$this->popup();
				break;	
			case $this->modelName."_export_excel":
				$this->Export_excel();
				break;	

			default :
				parent::auto_run();
				break;
		}
	}
	

	function Export_excel(){

		require_once ROOT_PATH.'phpexel/PHPExcel.php';
		$objPHPExcel = new PHPExcel();


		$option['product']=Object::getObjModule('products', 'products', '>-1');
	
		$backkup=serialize($option['product']);
		$file_back="backup_export_ngay_".VSFactory::getDateTime()->getDate(time(),'d_m_Y_H_i_s').".txt";
		$file = UPLOAD_PATH."backup_database_product/{$file_back}";
		file_put_contents($file, $backkup);	

		$this->menu=VSFactory::getMenus();
			
		//$objPHPExcel->getActiveSheet()->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
	

		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue('A1','id')
		        ->setCellValue('B1','mã sản phẩm')
		        ->setCellValue('C1','tiêu đề')
		        ->setCellValue('D1','danh mục')
		        ->setCellValue('E1','giới thiệu ngắn')
		        ->setCellValue('F1','nội dung')
		        ->setCellValue('G1','nhãn hiệu')
		        ->setCellValue('H1','size(dung lượng)')
		        ->setCellValue('I1','Giá ')
		        ->setCellValue('J1','Giá Khuyến mãi')
		        ;

		$i=2;       
		foreach ($option['product'] as $key => $value) {
			
			if($this->menu->getCategoryById($value->getCatId()))
			$catId=$this->menu->getCategoryById($value->getCatId())->getTitle();
			
			if($this->menu->getCategoryById($value->getSize()))
			$size=$this->menu->getCategoryById($value->getSize())->getTitle();
			
			if($this->menu->getCategoryById($value->getBrand()))
			$brand=$this->menu->getCategoryById($value->getBrand())->getTitle();
			
			$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue('A'.$i, $value->getId())
		        ->setCellValue('B'.$i, $value->getCode())
		        ->setCellValue('C'.$i, $value->getTitle())
		        ->setCellValue('D'.$i, $catId)
		        ->setCellValue('E'.$i, $value->getIntro())
		        ->setCellValue('F'.$i, $value->getContent())
		        ->setCellValue('G'.$i, $brand)
		        ->setCellValue('H'.$i, $size)
		        ->setCellValue('I'.$i, $value->getprice())
		        ->setCellValue('J'.$i, $value->getPromotion())
		        ;


		         $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFill()
		        ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
		        'startcolor' => array('rgb' => 'F28A8C')
		        ));

			$i++;
		}

		$i=$i+4;
		$info="File này dung để chỉnh sửa offline \n 
		Vui lòng sửa dụng file mới nhất bằng cách export trong hệ thống quản trị \n 
		Chú file này không dùng để thêm dử liệu mới mà chỉ để chỉnh sửa sản phẩm có sản trên hệ thống \n 
		Không được phép chỉnh sửa côt A(id) \n 
		";
		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue('A'.$i,$info);

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$i.':J'.$i); 
		$j=$i+1;   
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$i.':A'.$j); 
		$j=$i+1;   
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$i.':J'.$j);  
		$j=$i+1;   
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$i.':A'.$j); 
		$j=$i+1;   
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$i.':J'.$j);      

		/*for ($i=1;$i<=10;$i++)
		{
		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue('A'.$i, $i)
		        ->setCellValue('B'.$i, 'sản phẩm '.$i);
		}*/

		//$objPHPExcel->setActiveSheetIndex(0)
		      //  ->setCellValue('A12', 'Created by Nguyen Van Teo - Nhất Nghệ');


		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('danh sach san pham');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel5)

		$file_name="Export_excel_San_pham_".VSFactory::getDateTime()->getDate(time(),'d_m_Y_H_i_s').".xls";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$file_name.'');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit; 



	}


	function popup(){
		global $bw;
		
		//$bw->input['iframe']=1;
		
		@unlink(ROOT_PATH.'import_product/import.xls');
		@unlink(ROOT_PATH.'import_product/import.xlsx');
		if(!$_FILES){
			echo  $this->getHtml()->popup();exit();
		}	
			
		if ($_FILES["file"]["error"] > 0) {
			    echo "Error: " . $_FILES["file"]["error"] . "<br>";
			}
			else {
			  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			  echo "Type: " . $_FILES["file"]["type"] . "<br>";
			  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			  echo "Stored in: " . $_FILES["file"]["tmp_name"];
			 
			  // Save file
			  
			  $newfilename = 'import.'.end(explode(".",$_FILES["file"]["name"]));
			  
			  
			  move_uploaded_file($_FILES["file"]["tmp_name"], "import_product/" . $newfilename);
			  echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			  
			  
			  
			  
			  
			  
			  
		$lines=array();

	    require_once ROOT_PATH.'phpexel/PHPExcel/IOFactory.php';
	 
		$excelFile = ROOT_PATH.'import_product/import.xlsx';
		
			if (file_exists($excelFile)) {
			    $excelFile = ROOT_PATH.'import_product/import.xlsx';
			} else {
			    $excelFile = ROOT_PATH.'import_product/import.xls';
			}
		
		
		
		$type="Excel2007";
		if(substr($excelFile,-3)=='xls'){
			$type="Excel5";
		}
		$objReader = PHPExcel_IOFactory::createReader($type);
		$objPHPExcel = $objReader->load($excelFile);
		 
		//Itrating through all the sheets in the excel workbook and storing the array data
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		    $lines[$worksheet->getTitle()] = $worksheet->toArray();
		}
        
		$lines=current($lines);

		
   		
         $lines=array_filter($lines);
         unset($lines[0]);




       // echo "<pre>";
		//print_r($lines);die;

        $insert_string = "INSERT INTO `vsf_product`(`code`,`title`,`catId`,`intro`,`content`,`brand`,`size`, `price`,
        				 `promotion`,`postDate`) VALUES";
        $counter = 0;
        
        $db=VSFactory::createConnectionDB();

        $maxsize = count($lines);
        foreach($lines as $line => $array_f) {
           	//if($array_f[0]=='')
           		//continue;
           	$array=array();	
           	for($i=0;$i<15;$i++){
           		$array[$i]=mysql_real_escape_string(trim($array_f[$i]));	
           	}	


           	if(isset($array[3])){
           	$array[3]=strtolower($array[3]);	
  			$query="SELECT `menuId` FROM `vsf_menu` WHERE `menuTitle` ='{$array[3]}'";  
  			$db->query($query);       	
  			$row=$db->fetch_row();
  			$array[3]=$row['menuId'];
  				if(!$row['menuId']){
  					echo "<p>Lỗi---Sản phẩm - {$array[1]}-{$array[2]} ---------Không tìm được danh mục</p>";
  					continue;	
  				}
  			unset($row);	
  			}

  			if(isset($array[6])){
           	$array[6]=strtolower($array[6]);	
  			$query="SELECT `menuId` FROM `vsf_menu` WHERE `menuTitle` ='{$array[6]}'";  
  			$db->query($query);       	
  			$row=$db->fetch_row();
  			$array[6]=$row['menuId'];
  				if(!$row['menuId']){
  					echo "<p>Lỗi--- Sản phẩm -{$array[2]}-{$array[6]} ---------Không tìm được thương hiệu </p>";
  					continue;	
  				}
  			unset($row);	
  			}

  			

  			if(isset($array[7])){
           	$array[7]=strtolower($array[7]);	
  			$query="SELECT `menuId` FROM `vsf_menu` WHERE `menuTitle` ='{$array[7]}'";  
  			$db->query($query);       	
  			$row=$db->fetch_row();
  			$array[7]=$row['menuId'];
  				if(!$row['menuId']){
  					echo "<p>Lỗi--- Sản phẩm -{$array[2]}-{$array[7]} ---------Không tìm được  size ('dung lượng') </p>";
  					continue;	
  					//$array[7]='none';
  				}
  			unset($row);	
  			}

  			require_once CORE_PATH . 'products/products.php';
  			$pro=new products();
  			if(isset($array[0])){
	  			if($array[0]!=''){

	  				$array[4]=str_replace("\n","",$array[4]);
					//$array[4]=str_replace("@","",$array[4]);	

					$array[5]=str_replace("\n","",$array[5]);
					//$array[5]=str_replace("@","",$array[5]);
						

	  				$pro->basicObject->setId($array[0]);
	  				$pro->basicObject->setCode($array[1]);
	  				$pro->basicObject->setTitle($array[2]);
	  				$pro->basicObject->setCatId($array[3]);
	  				//$pro->basicObject->setIntro($array[4]);
	  				//$pro->basicObject->setContent($array[5]);
	  				$pro->basicObject->setBrand($array[6]);
	  				$pro->basicObject->setSize($array[7]);
	  				$pro->basicObject->setprice($array[8]);
	  				$pro->basicObject->setPromotion($array[9]);
	  				$pro->updateObject();

	  				$update=1;
	  				continue;
	  			}
	  		}
  				//$pro->basicObject->setId($array[0]);
				$pro->basicObject->setCode($array[1]);
				$pro->basicObject->setTitle($array[2]);
				$pro->basicObject->setCatId($array[3]);
				$pro->basicObject->setIntro($array[4]);
				$pro->basicObject->setContent($array[5]);
				$pro->basicObject->setBrand($array[6]);
				$pro->basicObject->setSize($array[7]);
				$pro->basicObject->setprice($array[8]);
				$pro->basicObject->setPromotion($array[9]);
				$pro->basicObject->setPostDate(time());
				$pro->insertObject();	
				$insert=1;
				continue;	
	  			




//code`,`title`,`catId`,`intro`,`content`,`brand`,`size`, `price`,
        			//	 `promotion`,`postDate`


  			//print_r($row['menuId']);die;

			
            $insert_string .= "('".trim($array[1])."','".trim($array[2])."','".trim($array[3])."','".trim($array[4])."','".trim($array[5])."'
            	,'".trim($array[6])."','".trim($array[7])."','".trim($array[8])."','".trim($array[9])."','".time()."')";
            $counter++;
            if($counter < $maxsize){
                $insert_string .= ",";
            }//if
        	
        }//foreach

        
        //echo $insert_string ;die;
        if(isset($insert))
        	 echo "<h1>Import file thành công!</h1>";
//VSFactory::createConnectionDB()->query(substr($insert_string,0,-1));
        
       
        
        exit();
			  
			  

			}
	
		
	
		echo  $this->getHtml()->popup();exit();
		//return $this->output = $this->html->popup ();
	}





function addEditObjProcess() {
		global $bw, $vsStd;
		/****file processing**************/
		
		$bw->input[$this->modelName]['module'] = $bw->input[0];
		
	
		     
		$arr = explode ( " ", $bw->input [$this->modelName] ['dateStart'] );
		$arr = array_merge ( explode ( ":", $arr [1] ), explode ( "/", $arr [0] ), $arr );
		$bw->input[$this->modelName]['dateStart'] = gmmktime ( $arr [0], $arr [1], 0, $arr [3], $arr [2], $arr [4] ) - (7 * 3600);    

		
		$arr = explode ( " ", $bw->input [$this->modelName] ['dateEnd'] );
		$arr = array_merge ( explode ( ":", $arr [1] ), explode ( "/", $arr [0] ), $arr );
		$bw->input[$this->modelName]['dateEnd'] = gmmktime ( $arr [0], $arr [1], 0, $arr [3], $arr [2], $arr [4] ) - (7 * 3600);
		     
		if($bw->input[$this->modelName]['label']){
			$bw->input[$this->modelName]['label']="--".implode("--",$bw->input[$this->modelName]['label'])."--";
		}
		if($bw->input[$this->modelName]['price']){
			$bw->input[$this->modelName]['price']=str_replace(array(",","."),"", $bw->input[$this->modelName]['price']);
		}
		
		
		if(is_array($bw->input['files'])){
			foreach ($bw->input['files'] as $name=> $file) {
				$bw->input[$this->modelName][$name]=$file;
			}	
		}

		/*if(!$bw->input[$this->modelName]['type'])
			$bw->input[$this->modelName]['type']=1;

		if(!$bw->input[$this->modelName]['deal'])
			$bw->input[$this->modelName]['deal']=0;*/


		$bw->input[$this->modelName]['hot']=implode(",",$bw->input[$this->modelName]['hot']);

        if(is_array($bw->input['links'])){
			foreach ($bw->input['links'] as $name=> $value) {
				$url=parse_url($value);
				if($bw->input['filetype'][$name]=='link'&&$url['host']){
					$files=new files();
					$fid=$files->copyFile($value,$bw->input[0]);
					if($fid)
					$bw->input[$this->modelName][$name]=$fid;
				}
				unset($url);
			}
			
		}

		if(!$bw->input[$this->modelName]['slug']){
			$bw->input[$this->modelName]['slug']=VSFactory::getTextCode()->removeAccent($bw->input[$this->modelName]['title'],"-");	
		}
		$bw->input[$this->modelName]['mUrl']=$bw->input[$this->modelName]['mUrl']?$bw->input[$this->modelName]['mUrl']:$bw->input[$this->modelName]['slug'];
		$bw->input[$this->modelName]['mUrl']=strtolower($bw->input[$this->modelName]['mUrl']);
		//if($_POST[$this->modelName]['size'])
			//$bw->input [$this->modelName] ['size']=implode(",",$_POST[$this->modelName] ['size']);
			
		/****end file processing**************/
		if($bw->input[$this->modelName]['id']){
			$this->model->getObjectById($bw->input[$this->modelName]['id']);
			if(!$this->model->basicObject->getId()){
				return $this->output =  $this->getObjList ($bw->input['pageIndex'],"Not define object of id={$bw->input[$this->modelName]['id']} submited!");
			}
			if($bw->input[$this->modelName]['image']){
				$files=new files();
				$files->deleteFile($this->model->basicObject->getImage());				
			}
			/////delete some here..........................................
		}else{
			$bw->input[$this->modelName]['postDate']=time();
			
			/////delete some here before inserting...................
		}
		
		$this->model->basicObject->convertToObject($bw->input[$this->modelName]);
		if(!$this->model->basicObject->getCatId()){
			if($this->model->getCategoryField()){
				$this->model->basicObject->setCatId($this->model->getCategories()->getId());
			}
		}
		if($this->model->basicObject->getId()){
			$this->model->updateObject();
			$message= VSFactory::getLangs()->getWords('update_success');
		}else{
			$this->model->insertObject();
			$message=VSFactory::getLangs()->getWords('insert_success');
		}
		/**add tags process***/
		require_once CORE_PATH.'tags/tags.php';
		$tags=new tags();
		$tags->addTagForContentId($bw->input[0], $this->model->basicObject->getId(), $bw->input['tags_submit_list']);
		/****/
		$this->afterProcess($this->model);
		if(!$this->model->result['status']){
			$message=$this->model->result['developer'];
			
		}
		///////some here.....................
		$this->lastModifyChange();
		
		if($bw->input[2]=="apply"){
			$result=$this->model->basicObject;
			echo json_encode($result);exit();
		}
		
		return $this->output =  $this->getObjList ($bw->input['pageIndex'],$message);
	}

	function getHtml() {
		return $this->html;
	}

	function getOutput() {
		return $this->output;
	}

	function setHtml($html) {
		$this->html = $html;
	}

	function setOutput($output) {
		$this->output = $output;
	}
	
	/**
	 * Skins for product .
	 * ..
	 * 
	 * @var skin_products
	 *
	 */
	var $html;
	
	/**
	 * String code return to browser
	 */
	var $output;
}
