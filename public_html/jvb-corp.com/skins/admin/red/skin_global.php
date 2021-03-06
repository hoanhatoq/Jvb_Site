<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY VIET SOLUTION
 /* CACHE FILE: Generated: Wed, 28 Jul 2004 10:38:07 GMT
 /* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE
 /* WRITTEN TO THE DATABASE AUTOMATICALLY
 /* Modify date: September 03, 2009
 /*--------------------------------------------------*/

class skin_global extends skin_board_admin{

	//===========================================================================
	// css_external
	//===========================================================================
	function addCSS($cssUrl="", $media = "") {
		
		$media = $media?"media='$media'":'';
		
		$BWHTML .= <<<EOF
<link type="text/css" rel="stylesheet" href="{$cssUrl}.css"  $media/>
EOF;
		//--endhtml--//
		return $BWHTML;
	}
	
	function addJavaScriptFile($file = "",$type='file') {
		global $bw;
		$BWHTML = "";
		$BWHTML .= <<<EOF
<if="$type=='cur_file'">
		<script type="text/javascript" src='{$bw->vars['cur_scripts']}/{$file}.js'></script>
		<else />
		<if="$type=='external'">
			<script type="text/javascript" src='{$file}'></script>
			<else />
			<if="$type=='file'">
				<script type="text/javascript" src='{$bw->vars['board_url']}/javascripts/{$file}.js'></script>
			</if>
		</if>
	</if>

EOF;
		return $BWHTML;
	}

	function addJavaScript($script = "") {
		$BWHTML .= <<<EOF
<script language="javascript" type="text/javascript">
{$script}
</script>

EOF;
return $BWHTML;
	}

	function SelectOption($options = array()) {
		$BWHTML .= <<<EOF
<option value="{$options['value']}" {$options['selected']}>{$options['name']}</option>
EOF;
		return $BWHTML;
	}

	function Select($options = array()) {
		$BWHTML .= <<<EOF
<select name="{$options['name']}" id="{$options['name']}"{$options['properties']}>
<!--OPTION LIST-->
</select>
EOF;
		return $BWHTML;
	}

	function addDropDownScript($id = "") {
		$BWHTML .= <<<EOF



EOF;
		return $BWHTML;
	}

	function PermissionDenied($error = "") {

		$BWHTML .= <<<EOF
<div class="red">
		{$error}</div>
EOF;
		return $BWHTML;
	}

	function displayFatalError($message = "", $line = "", $file = "", $trace = "") {
		$BWHTML .= <<<EOF
<div class="red" align="left" style="padding: 20px">
Error: {$message}<br />
Line: {$line}<br />
File: {$file}<br />
Trace: <pre>{$trace}</pre><br />
</div>
EOF;
		return $BWHTML;
	}

	function global_main_title() {
		global $vsPrint;
		$BWHTML .= <<<EOF
		{$vsPrint->mainTitle}
EOF;
		return $BWHTML;
	}
	//===========================================================================
	// vs_global
	//===========================================================================
	function vs_global() {
		global $bw,  $vsUser;
		
		$this->bw = $bw;
		$BWHTML = "";
		
		$vsUser = VSFactory::getAdmins();
		$vsLang = VSFactory::getLangs();
		
		
	
		
		$BWHTML .= <<<EOF
		<if=" !$this->getAdmin()->basicObject->getId() ">
			{$this->SITE_MAIN_CONTENT}
		<else />
			<div id="header">
				<ul class="headerTop left">
					<li class="logo">
						<a class="title_semibold" href="{$bw->vars['board_url']}/admin">VS Frameworks 5.1</a>
					</li>
					<li class="menu_collapse">
						<span>Menu</span>		
					</li>
					<li class="user_header">
						<if="$vsUser->obj->getImage()">
							{$vsUser->obj->createImageCache($vsUser->obj->getImage(),40,40)}
						<else />
							<img src="{$bw->vars['img_url']}/avatar.png" />
						</if>
						<div>
							<p>{$vsLang->getWords("admins_welcome",'Chào mừng')}, <span class="title_semibold">{$vsUser->obj->getName()}</span></p>
							<p>{$vsLang->getWords("admins_login_last",'Hoạt động cuối')}: {$this->dateTimeFormat($vsUser->obj->getLastLogin(),'d/m/Y h:i')}</p>
						</div>
					</li>
				</ul>
				<ul class="right">
					<li><a href="{$bw->vars['board_url']}" class="back_home" target="_blank"/><span class="icon-wrapper"><img class="icon-wrapper-vs vs-icon-home" src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" /></span><span>{$vsLang->getWords("global_title_home",'Xem trang chủ')}</span></a></li>
					<li><a href="{$bw->base_url}admins/logout" class="logout"/><span class="icon-wrapper"><img class="icon-wrapper-vs vs-icon-logout" src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" /></span><span>{$vsLang->getWords("global_logout",'Thoát')}</span></a></li>
					<li>	{$this->getAddon()->getLangList()}</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div id="vsf_wrapper">
				<div id="adminmenuback"></div>
				<div id="contextLeft">
					<ul id="menu">
						<if=" $this->getAddon()->getMenuTop() ">
						<foreach="$this->getAddon()->getMenuTop() as $menu">
						<li class="{$menu->active}"><a href="<if="$menu->getType()==1">{$menu->getUrl(1)}<else />{$menu->getUrl(0)}</if>" ><span>{$menu->getTitle()}</span><span class="icon-wrapper right"><img class="icon-wrapper-vs vs-menu-hover" src="{$bw->vars['img_url']}/pixel-vfl3z5WfW.gif" /></span></a>
						</li>
						</foreach>
						</if>
					</ul>
				</div>
				<div id="contextRight">
					{$this->SITE_MAIN_CONTENT}		
				</div>
			</div>
			<div id="footer" class="vs_footer">
				<div id="footerWrap">
					
				</div>	
			</div>
			<script type="text/javascript">
				$(document).ready(function()
				{
						 $( document ).tooltip({items: "input, [data-title], button",
								content: function() {
									var element = $( this );
									var title = element.attr( "title" );
									if ( element.is( "[data-title]" ) ) title = element.attr( "data-title" ); 
									return title;
								}
						});
						$("#countries").msDropDown().data("dd");
							 $('.menu_collapse').click(function() {
									$('#contextRight').css('margin-left',265);
									$('#adminmenuback').slideToggle(300,function() {
									      if($(this).css('display')=='none') $('#contextRight').css('margin-left',0);
										  else $('#contextRight').css('margin-left',265);
									  });
									$('#contextLeft').slideToggle(300);
							
								}); 
				});
			</script>
		</if>
		

EOF;
  		return $BWHTML;
	}
	
	function importantAjaxCallBack($Text="",$Url="",$css="") {
		global $bw;
		$BWHTML = "";
		//--starthtml--//
		//
		$BWHTML .= <<<EOF
<script type="text/javascript">
	$(document).ready(function(){
		Custom.init();
	});
</script>
EOF;

		//--endhtml--//
		return $BWHTML;
	}

	//===========================================================================
	// pop_up_window
	//===========================================================================

	//===========================================================================
	// Redirect
	//===========================================================================
	function Redirect($Text="",$Url="",$css="") {
		global $bw;
		$BWHTML = "";
		//--starthtml--//
		//
		$BWHTML .= <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html40/loose.dtd">
<html>
	<head>
	<title>Redirecting...</title>
	<meta http-equiv='refresh' content='2; url=$Url' />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	$css
	<style type="text/css">
		.title
		{
			color:red;
		}
		.text
		{
			padding:10px;
			color:#009F3C;
		}
	</style>
	</head>
  	<body >
		<center>
		<table style="background-color:#6ac3cb" cellpadding="0" cellspacing="0" width="100%" height="100%"> 
			<tr>
				<td width="416px" align="center" valign="middle" style="background:url({$bw->vars ['board_url']}/styles/redirect/direct.jpg) no-repeat center  top;" height="432px">
						<br/><br/><br/><br/>
					<img src="{$bw->vars ['board_url']}/styles/redirect/turtle.gif">
					<br/><br/>
					<p class="text">{$Text}</p>
				    <a href='$Url' title="{$Url}" class="title">( Click here if you do not wish to wait )</a>
				 </td>
			</tr>  
		</table> 
		</center>
	</body>
</html>
EOF;

	//--endhtml--//
	return $BWHTML;
	}
}
?>