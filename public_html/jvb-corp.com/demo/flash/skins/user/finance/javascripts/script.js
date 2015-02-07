



var x=0;
$(document).ready(function(){
  $(window).resize(function(){
    	
  });
});



	$(document).load($(window).bind("resize", checkPosition));

		function checkPosition()
		{
		    if($(window).width() < 767)
		    {
		        $("#body-container .main-content").remove().insertBefore($("#body-container .left-sidebar"));
		    } else {
		        $("#body-container .main-content").remove().insertAfter($("#body-container .left-sidebar"));
		    }
		}

	
	function Talert($str){
        $('html').append('<div class"t_alert">dfgdfgdfg</div>');
        $('.t_alert').css({'padding':'20px'});
    }

	
		

	$(document).ready(function() {
          //Talert('21313');
         $('.single-item-session').slick({
			infinite: false,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 1
		});

		 $('.single-item').slick({
			infinite: false,
			speed: 300,
			slidesToShow: 3,
			slidesToScroll: 1
		});
		
	});

	
	function startTime() {
	    var today=new Date();
	    var h=today.getHours();
	    var m=today.getMinutes();
	    var s=today.getSeconds();
	    var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10) {
		    dd='0'+dd
		} 

		if(mm<10) {
		    mm='0'+mm
		} 

		ddd = mm+'/'+dd+'/'+yyyy;
	    m = checkTime(m);
	    s = checkTime(s);
	    document.getElementById('clock').innerHTML = h+":"+m+" "+ddd;
	    var t = setTimeout(function(){startTime()},500);
	}

	function checkTime(i) {
	    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
	    return i;
	}

	function addCart(id,number){
		$.ajax({
			type : 'POST',
			url : baseUrl + 'orders/addcart',
			data : 'ajax=1&id='+id+'',
			success : function(data) {
				if (data == 1) {
					window.location.href = baseUrl+"orders";
					return false;
				}
				if (data == 0) {
					alert('Có lỗi đặt hàng');
				}	
			}
		});
		return false;
	}

	function show_support(){
		$.fancybox({
	       type: 'ajax',
	       href:baseUrl+"supports/show_support/"   
	    });	
	}


	$(document).ready(function(){

		startTime();

		$('.menu_f li,.cate_mn li').hover(function(){
			 $(this).find('ul:first').css({visibility: 'visible',display: 'none'}).show();
			 $(this).parent().prev().addClass('active1');
			 /* -- nếu bỏ display none thì khi hover lại lần thứ 2 thì kg có faceIn -- */
			 },function(){
				 $(this).find('ul:first').css({display: 'none'}).hide();
				 $(this).parent().prev().removeClass('active1');
			 });
			 $('.menu_f li ul li a').each(function(){	 
				 $(this).parent().parent().prev().addClass('active');	
		});
					 


		$('.main_product .item').hover(function(){
			var h=$(this).height();
			$(this).find('.intro').stop().animate({'top':0},400);
		},function(){
			$(this).find('.intro').stop().animate({'top':'100%'},400);
		});

		$('#slider_home').nivoSlider();

		$('.click_toggle').click(function(){
			$(this).parent().parent().find('.sub').toggle();
		})

		$('body').click(function() {
			$('.sub').hide();
		});

		$('.sub,.click_toggle').click(function(event){
				event.stopPropagation();
		});	

		$('.breakcrum div').last().addClass('last-child');


		$('.click_toggle').each(function(){
			if(!$(this).parent().next().find('li').get(0)){
				$(this).remove();
			}

		});


	});	
	
	$(function() {
	    $("img.lazy").lazyload();
	});
