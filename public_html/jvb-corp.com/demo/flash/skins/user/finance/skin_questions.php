<?php
class skin_news extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		
		$BWHTML .= <<<EOF
		<div class="container">
				<!--box_title-->
				<div id="margintop" class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="tieudes">
							<h2><span>Hỏi đáp</span></h2>
						</div>
						<div class="wtQuestions">
							<div class="Questions">
								<h2><a data-target=".formQuestion" data-toggle="modal" class="btn btn-link">ĐẶT CÂU HỎI</a></h2>
								<div aria-hidden="true" aria-labelledby="mySmallModalLabel" role="dialog" tabindex="-1" class="modal fade formQuestion">
									<div class="modal-dialog modal-sm">
										<div class="modal-content">
											<div id="tieude">
												<h2><span>HỎI ĐÁP</span></h2>
											</div>
											<div style="background:#FAFAFA;" class="modal-body">
												<form role="form" class="form-horizontal" action="{$bw->base_url}questions/send/" method="POST">
													<div id="form_cont">
														<div class="form-group">
															<label for="" class="col-sm-3 control-label">Họ Tên:</label>
															<div class="col-sm-9">
															  <input type="name" class="form-control" value="" name="question[name]" required="">
															</div>
														</div>
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-3 control-label">Điện thoại:</label>
															<div class="col-sm-9">
															  <input type="phone" value="" class="form-control" id="" name="question[phone]" required="">
															</div>
														</div>
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-3 control-label">Email:</label>
															<div class="col-sm-9">
															  <input type="email" value="" class="form-control" id="" name="question[email]" required="">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label">Tiêu đề:</label>
															<div class="col-sm-9">
															  <input type="title" value="" class="form-control" name="question[title]" required="">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label">Nội dung:</label>
															<div class="col-sm-9">
															  <textarea class="form-control" rows="3" name="question[intro]"></textarea>
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-offset-2 col-sm-10">
															  <button type="submit" name="btnSubmit" class="btn btn-success" style="margin-right:20px;">Gửi</button>
															  <button type="reset" class="btn btn-success" value="Reset">Làm lại</button>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end box_title-->
				
				<div class="row">
					<!--content rao vặt-->
					<div class="col-md-12">
						<div class="wrapper">
							
							<!--wrapper_content-->
							<div class="wrapper_content">
								<foreach="$option['pageList'] as $obj ">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="QuestionAsk">
										<div class="col-md-12 col-sm-12 col-xs-12 bgQuestion">
											<h2 class="iconQuestions">
												{$obj->getTitle()}
											</h2>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12 " id="padding">										
											<div class="panel-group" id="accordion">
												<div class="panel panel-default">
													<div class="panel-heading">
													  <h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#acc_{$obj->getId()}">
														  Trả lời
														</a>
													  </h4>
													</div>
													<div id="acc_{$obj->getId()}" class="panel-collapse collapse BGGray">
													  <div class="panel-body">
														{$obj->getContent()}
													  </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								</foreach>
								
							</div>
							<!--wrapper_content-->
						</div>
					</div>
					<!--end content rao vặt-->
				</div>
				
				<!--page-->
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 page">
						<ul class="pagination">
							{$option['paging']}
						</ul>
					</div>
				</div>
				<!--end page-->
			</div>
		

			
EOF;
	}
	
	function showDetail($obj,$option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		
		
		$BWHTML .= <<<EOF
		<div class="content_mid">
			<div class="content_mid_title">{$obj->getTitle()}</div>
			{$obj->getContent()}
			<div class="clear"></div>
			<div class="other">Tin khác</div>
			<ul class="other_post">
				<foreach="$option['other'] as $obj ">
				<li><a href="{$obj->getUrl('lease')}">{$obj->getTitle()}</a></li>
				</foreach>
			</ul>
		</div>		
				

EOF;
	}

	function success($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		<div class="container">
				<!--box_title-->
				<div id="margintop" class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="tieudes">
							<h2><span>Hỏi đáp</span></h2>
						</div>
						<div class="wtQuestions">
							<div class="Questions">
								<h2><a data-target=".formQuestion" data-toggle="modal" class="btn btn-link">ĐẶT CÂU HỎI</a></h2>
								<div aria-hidden="true" aria-labelledby="mySmallModalLabel" role="dialog" tabindex="-1" class="modal fade formQuestion">
									<div class="modal-dialog modal-sm">
										<div class="modal-content">
											<div id="tieude">
												<h2><span>HỎI ĐÁP</span></h2>
											</div>
											<div style="background:#FAFAFA;" class="modal-body">
												<form role="form" class="form-horizontal" action="{$bw->base_url}questions/send/" method="POST">
													<div id="form_cont">
														<div class="form-group">
															<label for="" class="col-sm-3 control-label">Họ Tên:</label>
															<div class="col-sm-9">
															  <input type="name" class="form-control" value="" name="question[name]" required="">
															</div>
														</div>
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-3 control-label">Điện thoại:</label>
															<div class="col-sm-9">
															  <input type="phone" value="" class="form-control" id="" name="question[phone]" required="">
															</div>
														</div>
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-3 control-label">Email:</label>
															<div class="col-sm-9">
															  <input type="email" value="" class="form-control" id="" name="question[email]" required="">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label">Tiêu đề:</label>
															<div class="col-sm-9">
															  <input type="title" value="" class="form-control" name="question[title]" required="">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label">Nội dung:</label>
															<div class="col-sm-9">
															  <textarea class="form-control" rows="3" name="question[content]"></textarea>
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-offset-2 col-sm-10">
															  <button type="submit" name="btnSubmit" class="btn btn-success" style="margin-right:20px;">Gửi</button>
															  <button type="reset" class="btn btn-success" value="Reset">Làm lại</button>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end box_title-->
				
				<div class="row success">
					
					Bạn đã gửi câu hỏi thành công, xin cám ơn!
				
				</div>
				
				<!--page-->
				
			</div>
		

			
            <script>

				$(document).ready(function()
                            {
                             
                            });
                        
                        setTimeout('relead()',5000);
                        function relead(){
                                document.location.href = "{$bw->base_url}questions";
                        }
                        
            </script>
EOF;
	}

}
?>