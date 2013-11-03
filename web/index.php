<?php 
	include_once('fblogin.php');
	
	if(isset($_GET['func']) && $_GET['func']=='logout'){
		unset($_SESSION["fb_207332529439206_code"]);
		unset($_SESSION["fb_207332529439206_access_token"]);
		unset($_SESSION["fb_207332529439206_user_id"]); 
	};
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>IT4FUN</title>
<link href="templates/css/reset.css" media="all" rel="stylesheet">
<link rel="stylesheet" href="templates/css/ui-lightness/jquery-ui-1.10.1.custom.min.css" />
<link href="templates/css/it4fun.css" media="all" rel="stylesheet">
<script type="text/javascript" src="templates/Scripts/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="templates/Scripts/lib/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="templates/Scripts/lib/jquery.mousewheel.js"></script>
<script type="text/javascript" src="templates/Scripts/lib/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="templates/Scripts/lib/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="templates/Scripts/lib/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="templates/Scripts/lib/jquery.masonry.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="templates/Scripts/jquery.tinyMap-2.5.2.min.js"></script>
<script type="text/javascript" >
	var loginUrl="<?php echo $_SESSION['loginUrl']; ?>";
	var logoutUrl="<?php echo $_SESSION['logoutUrl']; ?>";
	var userId="<?php echo $userId; ?>";
</script>
</head>
<body>
	<div id="first">
		<div id='weather_content'>
			<div class='content'>
				<div class='icon'></div>
				<div class='info'>
					<div class='location'></div>
					<div class='date'></div>
					<div class='thermometericon'></div>
					<div class='thermometer'></div>
					<div class='c'></div>
					<div class='state'></div>
					<div class='wind'></div>
					<div class='humidity'></div>
					<div class='sunrise'></div>
					<div class='sunset'></div>
					<div class='state_str'></div>
					<div class='wind_str'>km/h</div>
					<div class='humidity_str'>%</div>
					<div class='sunrise_str'></div>
					<div class='sunset_str'></div>

					<!-- 5 day -->
					<div class='day day_1'>
						<div class='top'></div>
						<div class='bottom'>
							<div class='wicon'><img src='./templates/images/first/weather_icon/1.png'></div>
							<div class='min_max'></div>
						</div>
					</div>
					<div class='day day_2'>
						<div class='top'></div>
						<div class='bottom'>
							<div class='wicon'><img src='./templates/images/first/weather_icon/1.png'></div>
							<div class='min_max'></div>
						</div>
					</div>
					<div class='day day_3'>
						<div class='top'></div>
						<div class='bottom'>
							<div class='wicon'><img src='./templates/images/first/weather_icon/1.png'></div>
							<div class='min_max'></div>
						</div>
					</div>
					<div class='day day_4'>
						<div class='top'></div>
						<div class='bottom'>
							<div class='wicon'><img src='./templates/images/first/weather_icon/1.png'></div>
							<div class='min_max'></div>
						</div>
					</div>
					<div class='day day_5'>
						<div class='top'></div>
						<div class='bottom'>
							<div class='wicon'><img src='./templates/images/first/weather_icon/1.png'></div>
							<div class='min_max'></div>
						</div>
					</div>
					<!-- 5 day end -->
				</div>
			</div>
		</div>
		<div id='lifeAndknowledge'>
			<div class='line'></div>
			<div id='lifeAndknowledgeContent'>
				<div class='life_t'></div>
				<div class='knowledge_t'></div>
				<ul class='life_list'>
				 
				</ul>

				<ul class='knowledge_list'>
					
				</ul>
			</div>
		</div>
	</div> 
	<!-- /// -->
	<div id="second">
		<div id='map_desc' style="color:#666">
			<p class="star_addr">FROM:<span></span></p>
			<p class="end_addr">TO:<span></span></p>
			<div class="map_steps">
				<div class="map_step">
					<div class="path"></div><div class="path_text"></div>
				</div>
			</div>
		</div>
		<div id='map_map'>
			
		</div>
		<div id='photo_info'>
			<div class='photo'></div>
			<div class='info'>
				<div class='str1'>暫無描述</div>
				<div class='str2'>
				</div>
				<div class='visitbtn'>VISIT WEBSITE</div>
				<div class='closebtn'>X</div>
			</div>
		</div>
	</div> 
	<!-- /// -->
	<div id="third">
		<div id='third_container'>
			
		</div>
	</div> 
	<!-- /// -->

	<div id='nav'>
		<div id='nav_container'>
			<div id='logo'></div>
			<div id='weather_info'>
				<div class='temperature'></div>
				<div class='date'></div>
				<div class='location'></div>
			</div>
			<ul id='menu'>
				<li id='menu1'><p>What</p></li>
				<li id='menu2'><p>Where</p></li>
				<li id='menu3'><p>Photos</p></li>
			</ul>
			<a href='#' id='facebook'></a>
		</div>
	</div>
</body>
<script type="text/javascript" src="templates/Scripts/define.js"></script>
<script type="text/javascript" src="templates/Scripts/common.js"></script>
<script type="text/javascript" src="templates/Scripts/it4fun.js"></script>
</html>
