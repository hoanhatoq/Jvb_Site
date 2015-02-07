<?php
class skin_news extends skin_objectpublic{
	function showDefault($option = array()) {
		global $bw,$vsPrint;
		$this->bw=$bw;
		
		$BWHTML .= <<<EOF
		<div class="container">
				<!--box_title-->
				<div class="row" id="margintop">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="tieude">
							<h2><span>tin tức</span></h2>
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
								<div class="col-md-6 col-sm-6 col-xs-12" id="Linenews">
									<div class="media">
										<a class="pull-left media-object" href="{$obj->getUrl('news')}">
											{$obj->createImageCache($obj->getImage(),113,76)}
										</a>
										<div class="media-body" style="text-align: justify;">
											<h5 class="media-heading">
												<a href="{$obj->getUrl('news')}">{$obj->getTitle()}</a>
												<span>[{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}]</span>
											</h5>
											<p> 
												{$this->cut($obj->getIntro(),280)}
											</p>
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
							<li><a href="#">&lt;</a></li>
							<li class="active"><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">&gt;</a></li>
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
		
		$this->catTitle=$option['cate_obj']->getTitle();
		$this->urlCate="{$this->bw->base_url}news/category/{$option['cate_obj']->getSlugId()}";
		
		$BWHTML .= <<<EOF
		<div class="container">
				<!--box_title-->
				<div class="row" id="margintop">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="tieude">
							<h2><span>tin tức</span></h2>
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
								<div class="col-md-12 col-sm-12 col-xs-12">
									<h1 class="titleDetail">
										{$obj->getTitle()}
										<span>[{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}]</span>
									</h1>
									{$obj->getContent()}
								</div>
								
								<div id="padding" class="col-md-12 col-sm-12 col-xs-12 border-top">
									<div class="wrapper_content">
										<div class="col-md-8 col-xs-12 col-sm-7 com_info" id="padding"><!--comment face-->
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="pel_com">
													<strong>BÌNH LUẬN</strong>
												</div>
												<form role="form">
													<div class="form-group">
														<input type="text" placeholder="Nội dung" id="form_height" class="form-control">
													</div>
													<button class="btn btn-info" type="submit">Gửi</button>
												</form>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 info_pel_com">
												<ul>
													<li>
														<div class="pel_img">
															<span>
																<a href="#"><img src="images/comment_pro.jpg" alt=""></a>
															</span>
														</div>
														<div class="info_com">
															<label>Mark</label><span> - 17 tuần trước</span>
															<p>
																Nói chung Samsung S5360 được đánh giá là dế rẻ cho người mới sử dụng Android smartphone, mức độ xử lý ở mức trung bình khá, ngoại hình nhỏ gọn thích hợp với các bạn sinh viên nữ. Pin xài tầm được hơn 2 ngày. Cảm ứng mượt so với giá tiền. Máy có độ phân giải.
															</p>
														</div>
													</li>
													
													<li>
														<div class="pel_img">
															<span>
																<a href="#"><img src="images/comment_pro.jpg" alt=""></a>
															</span>
														</div>
														<div class="info_com">
															<label>Mark</label><span> - 17 tuần trước</span>
															<p>
																Nói chung Samsung S5360 được đánh giá là dế rẻ cho người mới sử dụng Android smartphone, mức độ xử lý ở mức trung bình khá, ngoại hình nhỏ gọn thích hợp với các bạn sinh viên nữ. Pin xài tầm được hơn 2 ngày. Cảm ứng mượt so với giá tiền. Máy có độ phân giải.
															</p>
														</div>
													</li>
													
													<li>
														<div class="pel_img">
															<span>
																<a href="#"><img src="images/comment_pro.jpg" alt=""></a>
															</span>
														</div>
														<div class="info_com">
															<label>Mark</label><span> - 17 tuần trước</span>
															<p>
																Nói chung Samsung S5360 được đánh giá là dế rẻ cho người mới sử dụng Android smartphone, mức độ xử lý ở mức trung bình khá, ngoại hình nhỏ gọn thích hợp với các bạn sinh viên nữ. Pin xài tầm được hơn 2 ngày. Cảm ứng mượt so với giá tiền. Máy có độ phân giải.
															</p>
														</div>
													</li>
													
													<li>
														<div class="pel_img">
															<span>
																<a href="#"><img src="images/comment_pro.jpg" alt=""></a>
															</span>
														</div>
														<div class="info_com">
															<label>Mark</label><span> - 17 tuần trước</span>
															<p>
																Nói chung Samsung S5360 được đánh giá là dế rẻ cho người mới sử dụng Android smartphone, mức độ xử lý ở mức trung bình khá, ngoại hình nhỏ gọn thích hợp với các bạn sinh viên nữ. Pin xài tầm được hơn 2 ngày. Cảm ứng mượt so với giá tiền. Máy có độ phân giải.
															</p>
														</div>
													</li>
												</ul>
											
												<div class="col-md-12 col-sm-12 col-xs-12 text-right">
													<a class="readmore" href="#">Xem tất cả &gt;&gt;</a> 
												</div>
											
											</div>
										</div>
										
										<!--advertisement-->
										<div class="col-md-4 col-xs-12 col-sm-5">
											<div class="col-md-12 col-xs-12 col-sm-12">
												<div class="promotion">
													<strong>KHUYẾN MÃI</strong>
												</div>
											</div>
											<div class="col-md-12 col-xs-12 col-sm-12 smImg">
												<img class="img-resposive" src="images/qc.png" alt="">
												<img class="img-resposive" src="images/qc.png" alt="">
											</div>
										</div>
										<!--end advertisement-->
									</div>
								</div>
								
								<div id="padding" class="col-md-12 col-sm-12 col-xs-12 border-top">
									<div id="padding" class="col-md-12 col-sm-12 col-xs-12">
										<div class="newsdiff"><h2>TIN LIÊN QUAN</h2></div>
									</div>
									<div id="padding" class="col-md-12 col-sm-12 col-xs-12">
										<div class="rowNews">
											<ul>
												<foreach="$option['other'] as $other ">
												<li>
													<a href="">{$other->getTitle()}</a>
													<span>[{$this->dateTimeFormat($obj->getPostDate(),'d/m/y')}]</span>
												</li>
												</foreach>
											</ul>
										</div>
									</div>
									
								</div>
								
							</div>
							<!--wrapper_content-->
						</div>
					</div>
					<!--end content rao vặt-->
				</div>
			</div>
<script>
var urlcate= '{$this->urlCate}';

</script>
		
				

EOF;
	}

	function showMore($option = array()) {
		global $bw;
		$BWHTML .= <<<EOF
		
EOF;
	}

}
?>