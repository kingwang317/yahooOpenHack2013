$(document).ready(function() {
	if(userId!=0){
		IT4FUN.facebook.css({'background':'url(templates/images/nav/facebook_logout.png)','background-size':'45px'});
		IT4FUN.facebook.attr('href',logoutUrl);
	}else{
		IT4FUN.facebook.css({'background':'url(templates/images/nav/facebook.png)','background-size':'45px'});
		IT4FUN.facebook.attr('href',loginUrl);
	};

	cate=getURLParameter('cate');
	$(function(){
		//.parallax(xPosition, speedFactor, outerHeight) 設定選項:
		//xPosition - 水平位置
		//speedFactor - 滾動速度
		$('#first').parallax("50%", 0.3);
		$('#second').parallax("50%", 0.3);
		$('#third').parallax("50%", 0.3);
		$('div#weather_content div.content div.icon').parallax("50%", 0.3);
	
	});

	win_resize();

	/*window resize*/
	$(window).resize(function(){
		win_resize();
	});	


	IT4FUN.menu.find('li#menu1').css({'background':'url(./templates/images/nav/menu_bg_over.jpg)'});

	//nav event
	IT4FUN.menu.find('li#menu1').on('click',function(){
		//init_btn();
		//$(this).css({'background':'url(./templates/images/nav/menu_bg_over.jpg)'});
		$body.animate({
			scrollTop: 0
		}, 1000);

		var photo_num=$('#third_container .content_box').size();
        for(var i=0;i<photo_num;i++){
			$('#third_container .content_box').eq(i).animate({
			        	   	'opacity': 0},500);
        };

	});

	IT4FUN.menu.find('li#menu2').on('click',function(){
		//init_btn();
		//$(this).css({'background':'url(./templates/images/nav/menu_bg_over.jpg)'});
		$body.animate({
			scrollTop: $('#second').offset().top
		}, 1000);
		
		var photo_num=$('#third_container .content_box').size();
        for(var i=0;i<photo_num;i++){
			$('#third_container .content_box').eq(i).animate({
			        	   	'opacity': 0},500);
        };

		IT4FUN.photo_info.draggable();
		IT4FUN.photo_info.fadeIn();
	});

	IT4FUN.menu.find('li#menu3').on('click',function(){
		//init_btn();
		//$(this).css({'background':'url(./templates/images/nav/menu_bg_over.jpg)'});
		$body.animate({
			scrollTop: $('#third').offset().top
		}, 1000);

		var photo_num=$('#third_container .content_box').size();
        for(var i=0;i<photo_num;i++){
			$('#third_container .content_box').eq(i).animate({
			        	   	'opacity': 1},500*i);
        };

		$('#third_container').imagesLoaded(function(){
	        $('#third_container').masonry({        
	            itemSelector: '.content_box',
	            columnWidth: 347,
	            singleMode: false,
	            animate:true
	        });        
        });
	});

	//first
	// $('ul > li > a').tooltip();

	//First Start 

	$.get( "http://www.reportgenie.net/yahoo_hack/fb_api_ajax.php",
		{ 
			fb_id: getURLParameter('fb_id')
		}, 
		function( fbdata ) {  

			$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
				{ 
					action: "get_weather_detail", 
					lat: fbdata["location"].lat ,
					lon: fbdata["location"].lon ,
					num: 4
				}, 
				function( flickdata ) { 
					 $(".icon").css('background','../images/first/weather/'+ flickdata.img_name  );
					 $(".date").text(flickdata["condition"].date);
				  	 $(".state_str").text(flickdata["condition"].text);
				  	 $(".temperature").text(flickdata["condition"].temp);
				  	 $(".thermometer").text(flickdata["condition"].temp);
				  	 $(".humidity_str").text(flickdata.humidity+'%');
				  	 $(".sunrise_str").text(flickdata["astronomy"].sunrise);
				  	 $(".sunset_str").text(flickdata["astronomy"].sunset);
				  	 $(".wind_str").text(flickdata.wind+'km/h');
				  	 for(var i =0 ;i< 5 ; i++){
				  	 	 var selector = '.day_' + (i + 1);
				  	 	 $(selector).find("div.wicon").find('img').attr("src","./templates/images/first/weather_icon/"+flickdata["forecast"][i].img_name);
					  	 $(selector).find("div.top").text(flickdata["forecast"][i].date);
					  	 $(selector).find("div.min_max").text(flickdata["forecast"][i].low+'-'+flickdata["forecast"][i].high);
				  	 }

				}
			);

			$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
				{ 
					action: "search_life", 
					search_item: fbdata.name 
				}, 
				function( lifedata ) { 
					 // alert(lifedata.tags.length);
					 // $("#header ul").append('<li><a href="/user/messages"><span class="tab">Message Center</span></a></li>');
					for(var i= 0 ; i<lifedata.tags.length ; i++){
						// console.log(lifedata.desc[i]);
						$(".life_list").append('<li><a href="'+ lifedata.links[i] +'" title="' + lifedata.desc[i] + '">'+ lifedata.title[i] +'</a></li>');
					}
					 $('ul > li > a').tooltip(); 
				}
			);

			$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
				{ 
					action: "search_knowledge", 
					search_item: fbdata.name 
				}, 
				function( kmdata ) { 
					 // alert(lifedata.tags.length);
					 // $("#header ul").append('<li><a href="/user/messages"><span class="tab">Message Center</span></a></li>');
					for(var i= 0 ; i<kmdata.tags.length ; i++){
						// console.log(kmdata.desc[i]);
						$(".knowledge_list").append('<li><a href="'+ kmdata.links[i] +'" title="' + kmdata.desc[i] + '">'+ kmdata.title[i] +'</a></li>');
					}
					 $('ul > li > a').tooltip(); 
				}
			);
			 
			$(".location").text(fbdata.name);
		});	

	 //First End

	//second
	IT4FUN.photo_closebtn.on('click',function(){
		IT4FUN.photo_info.fadeOut();
	});

	IT4FUN.photo_visitbtn.on('click',function(){
		window.location.href = $("#photo_info").find('div.visitbtn').attr('link');
	});

	/***************************Where star**************************************************/
	var api_url = 'http://www.reportgenie.net/yahoo_hack/fb_api_ajax.php?fb_id=' + getURLParameter('fb_id');
	$.ajax({
		url: api_url,
		type: 'GET',
		async: true,
		crossDomain: true,
		cache: false,
		success: function(data, textStatus, jqXHR)
		{
			//console.log(data);
			if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) 
				{
					$('#map_map').tinyMap({
						center: {
							x: data.location.lat,
							y: data.location.lon
						},
						scrollwheel:false,
						zoom: 12,
						direction: [{
							from: position.coords.latitude+","+position.coords.longitude,
							to: data.location.lat+","+data.location.lon,
							travel: 'driving'
						}]
					});
					var postData = {
							action:'plan_route', 
							d_lat: data.location.lat,
							d_lon: data.location.lon,
							o_lat: position.coords.latitude,
							o_lon: position.coords.longitude
						};
					$.ajax({
						url: 'http://www.reportgenie.net/yahoo_hack/api_ajax.php',
						type: 'POST',
						async: true,
						crossDomain: true,
						cache: false,
						data: postData,
						success: function(data, textStatus, jqXHR)
						{
							var str = "";
							$("p.star_addr").find('span').text(data.legs[0].start_address);
							$("p.end_addr").find('span').text(data.legs[0].end_address);

							var num = data.legs[0].steps.length;
							var maneuver = 'turn-right';
							for(var i=0; i<num; i++)
							{
								if(data.legs[0].steps[i].maneuver == 'turn-right')
								{

								}
								str += '<div class="map_step">'
								str += '<div class="path"></div><div class="path_text">'+data.legs[0].steps[i].html_instructions+'</div>'
								str += '</div>';
							}

							$(".map_steps").html(str);
							console.log(data);

							var get_photo_detail_url = 'http://www.reportgenie.net/yahoo_hack/fb_photo_api.php?fb_id=' + getURLParameter('fb_id');
							$.ajax({
								url: get_photo_detail_url,
								type: 'GET',
								async: true,
								crossDomain: true,
								cache: false,
								success: function(data, textStatus, jqXHR)
								{
									$("#photo_info").find('div.photo').css('background-image', 'url('+data.images+')');
									$("#photo_info").find('div.visitbtn').attr('link', data.link);
									$("#photo_info").find('div.str1').text(data.name);
								},
								error: function()
								{
									console.log('error');
								}
							});
						},
						error: function()
						{
							console.log('error');
						}
					});
				});
			}
		},
		error: function()
		{
			console.log('error');
		}
	});
	/***************************Where end**************************************************/

	var api_url = 'http://www.reportgenie.net/yahoo_hack/fb_api_ajax.php?fb_id=' + getURLParameter('fb_id');
	$.ajax({
		url: api_url,
		type: 'GET',
		async: true,
		crossDomain: true,
		cache: false,
		success: function(data, textStatus, jqXHR)
		{
			console.log("data1");
			console.log(data);
			var postData = {
					action:'search_photo_for_web', 
					lat: data.location.lat,
					lon: data.location.lon,
					num: 20
				};
				console.log(postData);
			$.ajax({
				url: 'http://www.reportgenie.net/yahoo_hack/api_ajax.php',
				type: 'POST',
				async: true,
				crossDomain: true,
				cache: false,
				data: postData,
				success: function(data, textStatus, jqXHR)
				{
					var str = "";
					console.log("data2");
					console.log(data);
					for(var i=0; i<data.link_medium.length; i++)
					{
						str += '<div class="content_box">';
						str += '<div><img src="'+ data.link_medium[i] + '" class="box photo"></div>';
						str += '<h1>'+data.title[i]+'</h1>';
						str += '<a class="visitbtn" href="'+data.flickr_url[i]+'" target="_blank">VISIT WEBSITE</a>'
						str += '</div>';
					}

					$("#third_container").append(str);
				},
				error: function()
				{
					console.log('error');
				}
			});
		},
		error: function()
		{
			console.log('error');
		}
	});


	// === //

	$( window ).scroll(function() {
		console.log($('#first').offset().top);
		console.log($('#second').offset().top);
		console.log($('#third').offset().top);
		console.log($( window ).scrollTop());
	  	
	  	if($( window ).scrollTop() >= $('#first').offset().top && $( window ).scrollTop() <= $('#second').offset().top ){
	  		init_btn();
	  		IT4FUN.menu.find('li#menu1').css({'background':'url(./templates/images/nav/menu_bg_over.jpg)'});
	  	};

	  	if($( window ).scrollTop() >= $('#second').offset().top && $( window ).scrollTop() <= $('#third').offset().top ){
	  		init_btn();
	  		IT4FUN.menu.find('li#menu2').css({'background':'url(./templates/images/nav/menu_bg_over.jpg)'});
	  	};

	  	if($( window ).scrollTop() >= $('#third').offset().top){
	  		init_btn();
	  		IT4FUN.menu.find('li#menu3').css({'background':'url(./templates/images/nav/menu_bg_over.jpg)'});
	  	
	  		if($('#third').find('.content_box').css('opacity')==0){
	  			IT4FUN.menu.find('li#menu3').click();
	  		};
	  	};

	});


});

$(window).load(function(){
	$body.animate({
			scrollTop: $('#first').offset().top
		}, 1000);

	console.log(cate);
	switch(cate){
		case 'what':
			IT4FUN.menu.find('li#menu1').click();
		break;
		case 'where':
			IT4FUN.menu.find('li#menu2').click();
		break;
		case 'photos':
			IT4FUN.menu.find('li#menu3').click();
		break;
	};
});

function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}