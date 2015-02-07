<?php
require_once (CORE_PATH . 'posts/posts.php');
class posts_controler extends VSControl_admin {

	function __construct($modelName) {
		global $vsTemplate, $bw; // $this->html=$vsTemplate->load_template("skin_posts");
		parent::__construct ( $modelName, "skin_posts", "post" );
		$this->model->categoryName = "posts";
		
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
	 * Skins for post .
	 * ..
	 * 
	 * @var skin_posts
	 *
	 */
	var $html;
	
	/**
	 * String code return to browser
	 */
	var $output;
}
