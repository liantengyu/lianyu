<?php




?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="../../public/js/jquery.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../../public/css/simple-calendar.css" />
	<script type="text/javascript" src="../../public/js/simple-calendar.js"></script>

</head>
<body>
	<h1>签到系统</h1>
	<div id='container'></div>
	<div >
		<p>请使用火狐打开</p>
		<p>点击数字签到</p>
		<p>用户：<span id="userinfo">***</span></p>
		<p>金币＄：<span id="money">0</span></p>
		<p>本月连续签到：<span id="signday">0</span></p>
	</div>
	
</body>

<script>
	// alert(1234);
    var myCalendar = new SimpleCalendar('#container');

</script>



<script>
	
	$(document).ready(function($) {

		$.ajax({
            url: 'index.php?r=calendar/auto',
            type: 'get',
            dataType:'json',
            success:function(daa){
               $('#userinfo').html(daa.user)   
               $('#money').html(daa.user_money)   
               $('#signday').html(daa.days)   
            }
        })			

	});

	$(document).on('click', '.day', function(){

		var this_class = $(this).parent().attr('class')
		this_class_ = this_class.split(' ')	

		var myDate = new Date();
		var year = $('.sc-select-year').val()
		var month = $('.sc-select-month').val()
		var day = $(this).html()
		var date = year+'-'+month+'-'+day

		var now_year = myDate.getFullYear();
		var now_month = myDate.getMonth()+1;
		var now_day = myDate.getDate();
		var now_date = now_year+'-'+now_month+'-'+now_day

		var date_ = parseInt(Date.parse(new Date(date)))/1000;
		var now_date_ = parseInt(Date.parse(new Date(now_date)))/1000;


		if ($.inArray('sc-today', this_class_) > 0) {
			alert('已经签到')
			return false
		}

		if ($(this).parent().attr('dateclick')) {

				alert('已经签到')
				return false

		}

		if (date_ == now_date_) {

				$(this).parent().css('background', 'orange');
				$(this).parent().attr('dateclick', '1');

		        $.ajax({
		            url: 'index.php?r=calendar/sign',
		            type: 'get',
		            dataType:'json',
		            data:{date:date_},
		            success:function(daa){
		                $('#money').html(daa.user_money)   
               			$('#signday').html(daa.days) 
		             
		            }
		        })			
		}

		// 补签
		
		if (date_ < now_date_) {

			var obj = $(this)
			var hint = '您确认要补签吗\r\n'+'需扣除5金币'
			if (confirm(hint)) {

				$.ajax({
		            url: 'index.php?r=calendar/signed',
		            type: 'get',
		            dataType:'json',
		            data:{date:date_},
		            success:function(daa){
		              if (daa) {
		              	obj.parent().css('background', 'orange');
						obj.parent().attr('dateclick', '1');
						$('#money').html(daa.user_money)   
               			$('#signday').html(daa.days)
		              }else{
		              	alert('签到失败\r\n'+'金币不足')
		              }
		             
		            }
		        })	

			}else{
				return false
			}

		}
		
		if (date_ > now_date_) {
			alert('时间未到不能签到')
		}	
		
	})

</script>
</html>