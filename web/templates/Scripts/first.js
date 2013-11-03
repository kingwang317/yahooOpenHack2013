
 
function getFlickrJson(lat,lot){
	
		$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
		{ 
			action: "search_photo_no_header", 
			lat: lat ,
			lon: lot ,
			num: 4
		}, 
		function( data ) {
			//alert(data);
			 return data;
		  
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

	*/
	$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
		{ 
			action: "get_weather", 
			lat: lat ,
			lon: lot ,
		}, 
		function( data ) {
		  //alert( "Data Loaded: " + data );
		  obj.find('div.thermometer').text(data.condition['temp']+"c");
		  obj.find('div.weather_date').text(data.condition['date']);
		  obj.find('div.humidity').text(data.humidity+"%");
		  obj.find('div.wind').text(data.wind+"km/h");
		  obj.find('div.sunrise').text(data.astronomy['sunrise']);
		  obj.find('div.sunset').text(data.astronomy['sunset']);
		  
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

function getFBImageJson(fbID){
 
		// alert(fbID);
		var loc = new Array();
	
		loc[0] = null;
		loc[1] = null;
		// alert(fbID);
		$.get( "http://www.reportgenie.net/yahoo_hack/fb_api_ajax.php",
		{ 
			fb_id: fbID
		}, 
		function( data ) {
			// alert(data.location["lat"]);
			// alert(data);
			// imageName = data.name;
			// loc[0] = data.location["lat"];
			// loc[1] = data.location["lon"];
			// lat = loc[0];
			// lon = loc[1]; 
			return data;

		}).done(function() {
	    	// alert( "second success" );
	    })
	    .fail(function(e) {
	        // alert( "error" + e);
	    })
	    .always(function() {
	        // alert( "finished" );
	    });	
			
}

function getDistJson(lat,lon){
 
	$.post( "http://www.reportgenie.net/yahoo_hack/api_ajax.php",
		{ 
			action: "‘get_distance’", 
			o_lat: o_lat ,
			o_lon: o_lon ,
			d_lat: lat ,
			d_lon: lon ,

		}, 
		function( data ) {
		  //alert( "Data Loaded: " + data );
		}
	) .fail(function(e) {
	        alert( "error" + e);
	    });

}