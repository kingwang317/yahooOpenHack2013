


	var PHOTO=[];
	var list_switch=0;


	var lat,lon,imageName,cityName;
	var o_lat,o_lon;

	function definePHOTO(){
		//定義
		PHOTO.uiScaledThumb=$('div.uiScaledThumb');
		PHOTO._6i9=$('a._6i9');
		PHOTO.photoWrap=$('div.photoWrap');
	};


	function initImg(){
			definePHOTO();
		//初始架構

		var photo_num=PHOTO.uiScaledThumb.size();
		console.log(PHOTO.uiScaledThumb.size() );
		for(var i=0;i<photo_num;i++){
			//console.log(PHOTO.uiScaledThumb.eq(i).find('a'));	
			var cloneIMG=PHOTO.uiScaledThumb.eq(i).find('img').clone();
			console.log(PHOTO.uiScaledThumb.eq(i).find(".it4fun").size() );
			if(PHOTO.uiScaledThumb.eq(i).find(".it4fun").size() > 0){

			}else{


			
			PHOTO.uiScaledThumb.eq(i).append("<div class='it4fun'></div>");
			
			var it4fun=PHOTO.uiScaledThumb.eq(i).children('div.it4fun');
			
			it4fun.prepend("<div class='list_btn'></div>");//list btn
			it4fun.prepend("<a class='link_btn' target='_blank'></a>");
			//link btn

			it4fun.prepend("<div class='weather_top'></div>");
			it4fun.prepend("<div class='weather_bottom'></div>");

			var it4fun_weather_top=it4fun.children('div.weather_top');
			var it4fun_weather_bottom=it4fun.children('div.weather_bottom');
			
			it4fun_weather_bottom.prepend("<div class='weatherIcon_1'></div>");
			it4fun_weather_bottom.prepend("<div class='weatherIcon_2'></div>");
			it4fun_weather_bottom.prepend("<div class='weatherIcon_3'></div>");
			it4fun_weather_bottom.prepend("<div class='weatherIcon_4'></div>");
			it4fun_weather_bottom.prepend("<div class='weatherIcon_5'></div>");
			it4fun_weather_bottom.prepend("<div class='weatherIcon_6'></div>");

			it4fun.prepend("<div class='list_block_1'></div>");
			it4fun.prepend("<div class='list_block_2'></div>");
			it4fun.find('div.list_block_2').append("<p><a class='life_btn' href='#' target='_blank'>Yahoo 生活+</a></p>");
			it4fun.find('div.list_block_2').append("<p><a class='kp_btn' href='#' target='_blank'>Yahoo 知識+</a></p>");

			
	
			//插值
			
			it4fun.prepend("<div class='isload'>"+"false"+"</div>");
			//地名
			it4fun.prepend("<div class='title_1'>"+"Data Loading"+"</div>");
			//地名 + 距離
			it4fun.prepend("<div class='title_2'>"+"Data Loading"+"</div>");
			//氣象 日期
			it4fun_weather_top.prepend(
					"<div class='weather_date'>"+"Data Loading"+"</div>"
				);
			//氣象 溫度
			it4fun_weather_bottom.prepend(
					"<div class='thermometer'>"+"Data Loading"+"<span> c</span></div>"
				);

			//氣象 天氣狀況
			it4fun_weather_bottom.prepend(
					"<div class='weather_state'>"+"Data Loading"+"</div>"
				);

			//氣象 風速
			it4fun_weather_bottom.prepend(
					"<div class='wind'>"+"Data Loading"+" km/h</div>"
				);

			//氣象 濕度
			it4fun_weather_bottom.prepend(
					"<div class='humidity'>"+60.00+"%</div>"
				);

			//氣象 日出
			it4fun_weather_bottom.prepend(
					"<div class='sunrise'>"+'06:00:00'+"</div>"
				);
			//氣象 日落
			it4fun_weather_bottom.prepend(
					"<div class='sunset'>"+'18:00:00'+"</div>"
				);

			//圖片
			//預設十張
			
			for(var x=0;x<4;x++){

				it4fun.find('div.list_block_2').append("<a class='photo_btn' target='_blank'><div class='photos photos_"+x+"' ></div></a>")

			};
			
			//插值 end

			it4fun.prepend(cloneIMG);//複製圖片

			//初始呈現
			var W=PHOTO.uiScaledThumb.eq(i).children('a._6i9').width();
			var H=PHOTO.uiScaledThumb.eq(i).children('a._6i9').height();

			it4fun.css({'width':W+'px','height':H+'px'});
			//it4fun_fill.css({'width':W+'px','height':H+'px'});
			it4fun.children('img').removeAttr('width height');
			it4fun.children('.link_btn').css({'left':it4fun.width()-32-5+'px'});
			
			it4fun.children('.weather_top').css({
				'top':it4fun.height()-155-10+'px',
				'width':it4fun.width()-10,
			});
			it4fun_weather_top.children('div.weather_date').css({
				'width':it4fun_weather_top.width()-10-10,
			});
			it4fun.children('.weather_bottom').css({
				'top':it4fun.height()-116-10+'px',
				'width':it4fun.width()-10,
			});

			it4fun.children('div.title_1').css({'width':W-100+'px'});
			it4fun.children('div.title_2').css({'width':W-100+'px'});

			it4fun.children('div.list_block_2').css({'height':H-5-22-1-5-5+'px'});

			//event				
			PHOTO.uiScaledThumb.eq(i).on('mouseover',function(){
				console.log($(this).find('.isload').text());
				if($(this).find('.isload').text() == 'false'){
					var fbid = getFBID($(this).find('._6i9').attr('href'));
					getFBImageJson(fbid,$(this));

					$(this).find('.isload').text('true');
				}
				
				showDiv($(this));
				//$(this).find('div.title_1').text(imageName);

		
			});

			
			PHOTO.uiScaledThumb.eq(i).on('mouseleave',function(){
				console.log('aaa');
				if($(this).children('div.it4fun').is(':visible')==true)
				{
					$(this).children('div.it4fun').hide();
					var img_w=$(this).width();
					var img_h=$(this).height();
					
					$(this).children('div.it4fun').find('img').animate({
						'width': img_w,
						'height': img_h,
						'top':0,
						'left':0,
						'opacity':0,
					});
				};				
			});

			PHOTO.uiScaledThumb.eq(i).find('div.list_btn').on('click',function(){

				var _father=$(this).parents('div.uiScaledThumb').children('div.it4fun');
				var weatherTop=_father.find('div.weather_top');
				var weatherBottom=_father.find('div.weather_bottom');
				
				var list_block_1=_father.children('div.list_block_1');
				var list_block_2=_father.children('div.list_block_2');
				
				switch(list_switch){
					case 0:
						//list btn
						$(this).animate({'left':parseInt($(this).css('left'))+146-22+'px' });
						//list
						list_block_1.animate({'left':5+'px' });
						list_block_2.animate({'left':5+'px' });
						//天氣close
						weatherTop.animate({'top': _father.height()+'px'});
						weatherBottom.animate({'top': _father.height()+39+'px'});
						
						list_switch=1;
					break;
					case 1:
						//list btn
						$(this).animate({'left':'5px' });
						//list
						list_block_1.animate({'left':-150+'px' });
						list_block_2.animate({'left':-150+'px' });
						//天氣open
						weatherTop.animate({'top': _father.height()-155-10+'px'});
						weatherBottom.animate({'top': _father.height()-116-10+'px'});
						list_switch=0;
					break;
				};
				
			});
		}

		};

		PHOTO._6i9.css({
			 position: "relative"
		});
	}

	$(document).ready(function(){

	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) 
		{
			
			o_lat = position.coords.latitude;
			o_lon = position.coords.longitude;

			
		});
	}
		initImg();

	});

	$(window).scroll(function() {
    if (  (document.documentElement.clientHeight + 
          $(document).scrollTop())*1.05 >= document.body.offsetHeight )
    { 
    	//$( ".it4fun" ).remove();
      	initImg();

    }
});



	/*$('div').mouseover(function () {
    	alert($(this).attr('class'));
	});*/
	//alert(totalImagesWidth);

function showDiv(obj){

	if(obj.children('div.it4fun').is(':visible')==false)
	{
		obj.children('div.it4fun').show();

		var img_w=obj.children('div.it4fun').find('img').width();
		var img_h=obj.children('div.it4fun').find('img').height();
		
		obj.children('div.it4fun').find('img').animate({
			'width': img_w*2,
			'height': img_h*2,
			'top':(0-img_w)/2,
			'left':(0-img_h)/2,
			'opacity':1,						
		});
	}


}

function getFBID(url){

	var sPageURL = url;
	var sURLVariables = sPageURL.split('&');

    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        //alert(sParameterName[0]);
        if (sParameterName[0] == 'https://www.facebook.com/photo.php?fbid')
        {	
            return sParameterName[1];
        }
    }

}
function getFlickrJson(lat,lot,obj){

	/*

	url: http://www.reportgenie.net/yahoo_hack/api_ajax.php
	post data:
    action(required): ‘search_photo_no_header’
    place_id(option): (int)如果有做flickr頁的話，可用照片的place_id搜尋
    lat(option):(float)
    lon(option):(float)
    num(option):(int)

	*/
	
		$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
		{ 
			action: "search_photo_no_header", 
			lat: lat ,
			lon: lot ,
			num: 4
		}, 
		
		function( data ) {
			console.log(data.link_small[0]);
			obj.find('div.photos_0').css('background-image', "url("+data.link_small[0]+")");
			obj.find('div.photos_1').css('background-image', "url("+data.link_small[1]+")");
			obj.find('div.photos_2').css('background-image', "url("+data.link_small[2]+")");
			obj.find('div.photos_3').css('background-image', "url("+data.link_small[3]+")");
		  
		}
	);
	

}
function getWeatherJson(lat,lot,obj){

	/*

	url: http://www.reportgenie.net/yahoo_hack/api_ajax.php
	post data:
    action(required): ‘get_weather'
    lat(option):(float)
    lon(option):(float)

    
    1全太陽(晴天)：30~34
	2太陽加雲加雨(晴時多雲偶陣雨or陣雨)：37~47
	3太陽加雲(晴時多雲)：27~29
	4雲加雨(雨天)：0~18
	5雲(陰天)：19~26


	*/
	$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
		{ 
			action: "get_weather", 
			lat: lat ,
			lon: lot ,
		}, 
		function( data ) {
		  //alert( "Data Loaded: " + data );
		  obj.find('div.thermometer').text(data.condition['temp']);
		  obj.find('div.thermometer').append("<span>c</span>");
		  obj.find('div.weather_date').text(data.condition['date']);
		  obj.find('div.humidity').text(data.humidity+"%");
		  obj.find('div.wind').text(data.wind+"km/h");
		  obj.find('div.sunrise').text(data.astronomy['sunrise']);
		  obj.find('div.sunset').text(data.astronomy['sunset']);
		  if(data.condition['code'] >= 0 && data.condition['code'] <= 18){

		  	obj.find('div.weather_state').text("雨天");
		  	obj.find('div.weatherIcon_2').css('background-image', "url('"+chrome.extension.getURL("/images/4.png")+"')");


		  }else if(data.condition['code'] >= 19 && data.condition['code'] <= 26){

		  	obj.find('div.weather_state').text("陰天");
		  	obj.find('div.weatherIcon_2').css('background-image', "url('"+chrome.extension.getURL("/images/5.png")+"')");


		  }else if(data.condition['code'] >= 27 && data.condition['code'] <= 29){

		  	obj.find('div.weather_state').text("晴時多雲");
		  	obj.find('div.weatherIcon_2').css('background-image', "url('"+chrome.extension.getURL("/images/3.png")+"')");

		  	
		  }else if(data.condition['code'] >= 37 && data.condition['code'] <= 47){

		  	obj.find('div.weather_state').text("晴時多雲偶陣雨、陣雨");
		  	obj.find('div.weatherIcon_2').css('background-image', "url('"+chrome.extension.getURL("/images/2.png")+"')");

		  	
		  }else if(data.condition['code'] >= 30 && data.condition['code'] <= 34){

		  	obj.find('div.weather_state').text("晴天");
		  	obj.find('div.weatherIcon_2').css('background-image', "url('"+chrome.extension.getURL("/images/1.png")+"')");

		  	
		  }
		  
		}
	);
}

function getKPJson(str){
	/*

	url:http://www.reportgenie.net/yahoo_hack/api_ajax.php
	post data:
	    action(required): ‘search_knowledge’
	    search_item(required): (string)
	response:

	*/

	$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
		{ 
			action: "search_knowledge", 
			search_item: str 
		}, 
		function( data ) {
		  //alert( "Data Loaded: " + data );
		}
	);
}


function getLifeJson(str){
	/*

	url:http://www.reportgenie.net/yahoo_hack/api_ajax.php
	post data:
	    action(required): ‘search_life’
	    search_item(required): (string)
	response:

	*/
	$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
		{ 
			action: "search_life", 
			search_item: str 
		}, 
		function( data ) {
		  //alert( "Data Loaded: " + data );
		}
	);
}

function getFBImageJson(fbID,obj){
	/*

	url:http://www.reportgenie.net/yahoo_hack/fb_api_ajax.php?
	post data:
	    fd_id(required): ‘search_life’
	response:

	*/
		
		var loc = new Array();
	
		loc[0] = null;
		loc[1] = null;
		$.get( "http://www.reportgenie.net/yahoo_hack/fb_api_ajax.php",
		{ 
			fb_id: fbID
		}, 
		function( data ) {
			
			if(data.error == '405'){
				console.log(data.error);
				obj.find('div.title_1').text( "請登入後使用套件" );
				obj.find('div.title_2').text( "" );
				obj.find('div.title_2').append("<a href='http://www.reportgenie.net/yahoo_hack/index.php?fb_id="+fbID+"' target='_blank'>點擊登入</a>" );
				
			}else{

			imageName = data.name;
			loc[0] = data.location["lat"];
			loc[1] = data.location["lon"];
			lat = loc[0];
			lon = loc[1];
			obj.find('div.title_1').text( data.location["city"] + " " + data.location["country"] );
			obj.find('div.title_2').text(imageName);
			obj.find('.link_btn').attr('href',"http://www.reportgenie.net/yahoo_hack/index.php?fb_id="+fbID+"&cate=where");
			obj.find('.life_btn').attr('href',"http://www.reportgenie.net/yahoo_hack/index.php?fb_id="+fbID+"&cate=what");
			obj.find('.kp_btn').attr('href',"http://www.reportgenie.net/yahoo_hack/index.php?fb_id="+fbID+"&cate=what");
			obj.find('.photo_btn').attr('href',"http://www.reportgenie.net/yahoo_hack/index.php?fb_id="+fbID+"&cate=photos");
			


			getDistJson(loc[0],loc[1],obj);
			getWeatherJson(loc[0],loc[1],obj);
			getFlickrJson(loc[0],loc[1],obj);

			}
			


		} );	
			
}
function getDistJson(lat,lon,obj){
	/*
	url:http://www.reportgenie.net/yahoo_hack/api_ajax.php
	post data:
    action(required): ‘get_distance’
    o_lat(required): (float)來源lat
    o_lon(required): (float)來源lon
    d_lat(required): (float)目的lat
    d_lon(required): (float)目的lon

    */
    var orgStr = obj.find('div.title_2').text();
    
	console.log("o_lat"+o_lat+"+"+"o_lon"+o_lon);
	console.log("lat"+lat+"+"+"lon"+lon);
	//alert(o_lat,o_lon);
	$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
		{ 
			action: "get_distance", 
			o_lat: o_lat ,
			o_lon: o_lon ,
			d_lat: lat ,
			d_lon: lon ,

		}, 
		function( data ) {
		  //alert( "Data Loaded: " + data );
		  orgStr +=  "距離 "+data.distance['text']+"(約 "+data.duration['text']+"可到達)";
		  obj.find('div.title_2').text(orgStr);

		}
	).fail(function() {
    alert( "error" );
  	});

}






/*豪哥 START*/


/*豪哥 END*/
