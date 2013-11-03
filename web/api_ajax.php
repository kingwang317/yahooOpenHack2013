<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');
	define("FLICKR_CONSUMER_KEY", "cb864100d08962c6b2f36a57a5b0ec90");

	if(session_id() == "") 
		session_start();

	if(isset($_SESSION['flickr_header']))
	{
		$header = $_SESSION['flickr_header'];
	}
	else
	{
        $params = array(
            'oauth_callback' => 'http://www.reportgenie.net/yahoo_hack/test4.php',
            'oauth_consumer_key' => FLICKR_CONSUMER_KEY,
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0',
        );


        $h   = array();
        $h[] = 'Authorization: OAuth realm=""';
        foreach ($params as $name => $value) {
            if (strncmp($name, 'oauth_', 6) == 0 || strncmp($name, 'xoauth_', 7) == 0) {
                $h[] = $name.'="'.$value.'"';
            }
        }
        $hs = implode(', ', $h);
        $header[] = $hs;
	}

	$action_name = isset($_POST['action'])?$_POST['action']:"";

	switch($action_name)
	{
		case 'get_geo':
			$result = get_geo($header);
			echo $result;
			die();
		case 'search_photo':
			$result = search_photo($header);
			echo $result;
			die();
		case 'get_size':
			$result = get_size($header);
			echo $result;
			die();
		case 'search_photo_no_header':
			$result = search_photo_no_header($header);
			echo json_encode($result);
			die();
		case 'search_photo_for_web':
			$result = search_photo_for_web($header);
			echo json_encode($result);
			die();
		case 'get_weather':
			$result = get_weather();
			echo json_encode($result);
			die();
		case 'get_weather_detail':
			$result = get_weather_detail();
			echo json_encode($result);
			die();
		case 'search_life':
			$result = search_life();
			echo json_encode($result);
			die();
		case 'search_knowledge':
			$result = search_knowledge();
			echo json_encode($result);
			die();
		case 'plan_route':
			$result = plan_route();
			echo json_encode($result);
			die();
		case 'get_distance':
			$result = get_distance();
			echo json_encode($result);
			die();
	}

    function get_geo($header)
    {
        $photo_id = isset($_POST['photo_id'])?$_POST['photo_id']:"";
        $params = array(    
            'format' => 'json', 
            'nojsoncallback' => 1,    
            'method' => 'flickr.photos.geo.getLocation', 
            'photo_id' => $photo_id
        );

        $encoded_params = array();
        foreach ($params as $name => $value) {
            $encoded_params[] = urlencode($name).'='.urlencode($value); 
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,  $header);
        curl_setopt($ch, CURLOPT_URL,             'http://api.flickr.com/services/rest/?'.implode('&', $encoded_params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER,          false);
        curl_setopt($ch, CURLOPT_TIMEOUT,         30);

        $txt = curl_exec($ch);

        return $txt;
    }

    function search_photo($header)
    {
    	$place_id = isset($_POST['place_id'])?$_POST['place_id']:"";
    	$lat = isset($_POST['lat'])?$_POST['lat']:"";
    	$lon = isset($_POST['lon'])?$_POST['lon']:"";

    	if($place_id != "")
    	{
	        $params = array(    
	            'format' => 'json', 
	            'nojsoncallback' => 1,    
	            'method' => 'flickr.photos.search', 
	            'place_id' => $place_id,
	            'per_page' => 10
	        );

	        $encoded_params = array();
	        foreach ($params as $name => $value) {
	            $encoded_params[] = urlencode($name).'='.urlencode($value); 
	        }

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_HTTPHEADER,  $header);
	        curl_setopt($ch, CURLOPT_URL,             'http://api.flickr.com/services/rest/?'.implode('&', $encoded_params));
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_HEADER,          false);
	        curl_setopt($ch, CURLOPT_TIMEOUT,         30);

	        $txt = curl_exec($ch);

	        return $txt;
    	}
    	else if($lat != "" && $lon != "")
    	{
	        $params = array(    
	            'format' => 'json', 
	            'nojsoncallback' => 1,    
	            'method' => 'flickr.photos.search', 
	            'lat' => $lat,
	            'lon' => $lon,
	            'per_page' => 10
	        );

	        $encoded_params = array();
	        foreach ($params as $name => $value) {
	            $encoded_params[] = urlencode($name).'='.urlencode($value); 
	        }

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_HTTPHEADER,  $header);
	        curl_setopt($ch, CURLOPT_URL,             'http://api.flickr.com/services/rest/?'.implode('&', $encoded_params));
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_HEADER,          false);
	        curl_setopt($ch, CURLOPT_TIMEOUT,         30);

	        $txt = curl_exec($ch);

	        return $txt;
    	}

    }

    function get_size($header)
    {
        $photo_id = isset($_POST['photo_id'])?$_POST['photo_id']:"";
        $params = array(    
            'format' => 'json', 
            'nojsoncallback' => 1,    
            'method' => 'flickr.photos.getSizes', 
            'photo_id' => $photo_id
        );

        $encoded_params = array();
        foreach ($params as $name => $value) {
            $encoded_params[] = urlencode($name).'='.urlencode($value); 
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,  $header);
        curl_setopt($ch, CURLOPT_URL,             'http://api.flickr.com/services/rest/?'.implode('&', $encoded_params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER,          false);
        curl_setopt($ch, CURLOPT_TIMEOUT,         30);

        $txt = curl_exec($ch);

        return $txt;
    }

    function get_weather()
    {
    	$lat = isset($_POST['lat'])?$_POST['lat']:"";
    	$lon = isset($_POST['lon'])?$_POST['lon']:"";
    	if($lat == "")
    	{
    		$result['status'] = 'miss parameter';
    	}
    	else
    	{
			$yql_base_url = "http://query.yahooapis.com/v1/public/yql"; 
			$yql_query = "select * from weather.forecast where woeid in (select woeid from geo.placefinder where text='".$lat.",".$lon."' and gflags='R') and u='c' "; 
			$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
			$yql_query_url .= "&format=json&diagnostics=true&callback=";

			$session = curl_init($yql_query_url);
			curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
			$json = curl_exec($session);

			$result = array();

			$d = json_decode($json);

			$code = $d->query->results->channel->item->condition->code;
			$img_name = "1.png";

			if($code >= 30 && $code <= 34)
			{
				$img_name = "1.png";
			}
			elseif($code >=37 && $code <= 47)
			{
				$img_name = "2.png";
			}
			elseif($code >= 27 && $code <= 29)
			{
				$img_name = "3.png";
			}
			elseif($code >= 0 && $code <= 18)
			{
				$img_name = "4.png";
			}
			else
			{
				$img_name = "5.png";
			}

			$result['create_time'] = $d->query->created;
			$result['condition'] = $d->query->results->channel->item->condition;
			$result['img_name'] = $img_name;
			$result['wind'] = $d->query->results->channel->wind->speed;
			$result['humidity'] = $d->query->results->channel->atmosphere->humidity;
			$result['astronomy'] = $d->query->results->channel->astronomy;
    	}


		return $result;
    }

    function get_weather_detail()
    {
    	$lat = isset($_POST['lat'])?$_POST['lat']:"";
    	$lon = isset($_POST['lon'])?$_POST['lon']:"";
    	if($lat == "")
    	{
    		$result['status'] = 'miss parameter';
    	}
    	else
    	{
			$yql_base_url = "http://query.yahooapis.com/v1/public/yql"; 
			$yql_query = "select * from weather.forecast where woeid in (select woeid from geo.placefinder where text='".$lat.",".$lon."' and gflags='R') and u='c' "; 
			$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
			$yql_query_url .= "&format=json&diagnostics=true&callback=";

			$session = curl_init($yql_query_url);
			curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
			$json = curl_exec($session);

			$result = array();

			$d = json_decode($json);

			$code = $d->query->results->channel->item->condition->code;
			$img_name = "1.png";

			if($code >= 30 && $code <= 34)
			{
				$img_name = "1.png";
			}
			elseif($code >=37 && $code <= 47)
			{
				$img_name = "2.png";
			}
			elseif($code >= 27 && $code <= 29)
			{
				$img_name = "3.png";
			}
			elseif($code >= 0 && $code <= 18)
			{
				$img_name = "4.png";
			}
			else
			{
				$img_name = "5.png";
			}

			$result['create_time'] = $d->query->created;
			$result['condition'] = $d->query->results->channel->item->condition;
			$result['img_name'] = $img_name;
			$result['wind'] = $d->query->results->channel->wind->speed;
			$result['humidity'] = $d->query->results->channel->atmosphere->humidity;
			$result['astronomy'] = $d->query->results->channel->astronomy;
			for($i=0; $i<count($d->query->results->channel->item->forecast); $i++)
			{
				$code = $d->query->results->channel->item->forecast[$i]->code;
				if($code >= 30 && $code <= 34)
				{
					$img_name = "1.png";
				}
				elseif($code >=37 && $code <= 47)
				{
					$img_name = "2.png";
				}
				elseif($code >= 27 && $code <= 29)
				{
					$img_name = "3.png";
				}
				elseif($code >= 0 && $code <= 18)
				{
					$img_name = "4.png";
				}
				else
				{
					$img_name = "5.png";
				}
				$d->query->results->channel->item->forecast[$i]->img_name = $img_name;
			}
			$result['forecast'] = $d->query->results->channel->item->forecast;
    	}


		return $result;
    }

    function search_photo_no_header($header)
    {	
    	$place_id = isset($_POST['place_id'])?$_POST['place_id']:"";
    	$lat = isset($_POST['lat'])?$_POST['lat']:"";
    	$lon = isset($_POST['lon'])?$_POST['lon']:"";
    	$num = isset($_POST['num'])?$_POST['num']:10;

		$yql_base_url = "http://query.yahooapis.com/v1/public/yql"; 
		$yql_query = "select * from flickr.photos.search(0,".$num.") where lat='".$lat."' and lon='".$lon."' and api_key='".FLICKR_CONSUMER_KEY."'"; 
		$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
		$yql_query_url .= "&format=json&diagnostics=true".urlencode("&env=store://datatables.org/alltableswithkeys")."&callback=";

		$session = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		$json = curl_exec($session);

		$d = json_decode($json);
		$photos = $d->query->results->photo;
		$len = count($photos);
		$ids = array();
		for($i=0; $i<$len; $i++)
		{
			$ids['ids'][$i] = $photos[$i]->id;
			$ids['title'][$i] = $photos[$i]->title;
		}

		for($j=0; $j<$len; $j++)
		{
	        $params = array(    
	            'format' => 'json', 
	            'nojsoncallback' => 1,    
	            'method' => 'flickr.photos.getSizes', 
	            'photo_id' => $ids['ids'][$j]
	        );

	        $encoded_params = array();
	        foreach ($params as $name => $value) {
	            $encoded_params[] = urlencode($name).'='.urlencode($value); 
	        }

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_HTTPHEADER,  $header);
	        curl_setopt($ch, CURLOPT_URL,             'http://api.flickr.com/services/rest/?'.implode('&', $encoded_params));
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_HEADER,          false);
	        curl_setopt($ch, CURLOPT_TIMEOUT,         30);

	        $txt = curl_exec($ch);
	        $d = json_decode($txt);
	        $size_count = count($d->sizes->size) - 1;
	        //$ids['link'][$j] = $d->sizes->size[$size_count]->source;
	        $ids['link_small'][$j] = $d->sizes->size[1]->source;
		}

		return $ids;
    }

    function search_photo_for_web($header)
    {	
    	$place_id = isset($_POST['place_id'])?$_POST['place_id']:"";
    	$lat = isset($_POST['lat'])?$_POST['lat']:"";
    	$lon = isset($_POST['lon'])?$_POST['lon']:"";
    	$num = isset($_POST['num'])?$_POST['num']:10;

		$yql_base_url = "http://query.yahooapis.com/v1/public/yql"; 
		$yql_query = "select * from flickr.photos.search(0,".$num.") where lat='".$lat."' and lon='".$lon."' and api_key='".FLICKR_CONSUMER_KEY."'"; 
		$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
		$yql_query_url .= "&format=json&diagnostics=true".urlencode("&env=store://datatables.org/alltableswithkeys")."&callback=";

		$session = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		$json = curl_exec($session);

		$d = json_decode($json);
		$photos = $d->query->results->photo;
		$len = count($photos);
		$ids = array();
		for($i=0; $i<$len; $i++)
		{
			$ids['ids'][$i] = $photos[$i]->id;
			$ids['title'][$i] = $photos[$i]->title;
			$ids['flickr_url'][$i] = 'http://www.flickr.com/'.$photos[$i]->owner.'/'.$photos[$i]->id;
		}

		for($j=0; $j<$len; $j++)
		{
	        $params = array(    
	            'format' => 'json', 
	            'nojsoncallback' => 1,    
	            'method' => 'flickr.photos.getSizes', 
	            'photo_id' => $ids['ids'][$j]
	        );

	        $encoded_params = array();
	        foreach ($params as $name => $value) {
	            $encoded_params[] = urlencode($name).'='.urlencode($value); 
	        }

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_HTTPHEADER,  $header);
	        curl_setopt($ch, CURLOPT_URL,             'http://api.flickr.com/services/rest/?'.implode('&', $encoded_params));
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_HEADER,          false);
	        curl_setopt($ch, CURLOPT_TIMEOUT,         30);

	        $txt = curl_exec($ch);
	        $d = json_decode($txt);
	        $size_count = count($d->sizes->size) - 1;
	        $ids['link_small'][$j] = $d->sizes->size[1]->source;
	        $ids['link_medium'][$j] = $d->sizes->size[4]->source;
	        $ids['link_large'][$j] = $d->sizes->size[5]->source;
		}

		return $ids;
    }

    function search_life()
    {
    	$result = array();
    	$search_item = isset($_POST['search_item'])?$_POST['search_item']:"";
    	$search_item = urlencode($search_item);

    	$search_url = "http://tw.blog.search.yahoo.com/search;_ylt=A3eg.8oSIHJSoVoAkEzXrYlQ?&p=".$search_item."&fr2=piv-answers&fr=yfp";
		$txt = file_get_contents($search_url);

		$txt = str_replace ("abstr", "sm-abs", $txt);
	
		$regexp = "<a\sclass=\"yschttl\sspt\"\shref=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		if(preg_match_all("/$regexp/siU", $txt, $matches)) {

			for($i=0; $i<count($matches[0]); $i++)
			{
				$result["tags"][$i] = $matches[0][$i];
				$result["links"][$i] = $matches[2][$i];
				$result["title"][$i] = $matches[3][$i];
			}
		}

		$regexp_desc = "<div\sclass=\"sm-abs\">(.*)<\/div>";
		if(preg_match_all("/$regexp_desc/siU", $txt, $matches)) {

			for($i=0; $i<count($matches[1]); $i++)
			{
				$result["desc"][$i] = strip_tags($matches[1][$i]);
			}
		}

		//$json = json_encode($result);

		return $result;   
    }

    function search_knowledge()
    {
    	$result = array();
    	$search_item = isset($_POST['search_item'])?$_POST['search_item']:"";
    	$search_item = urlencode($search_item);

    	$search_url = "http://tw.knowledge.search.yahoo.com/search;_ylt=A3eg.8nkVHJSAxwAfYoi2At.?&p=".$search_item."&fr2=piv-blog&fr=yfp";
		$txt = file_get_contents($search_url);
	
		$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1\sclass=\"yschttl\sspt\"\s[^>]*>(.*)<\/a>";
		if(preg_match_all("/$regexp/siU", $txt, $matches)) {

			for($i=0; $i<count($matches[0]); $i++)
			{
				$result["tags"][$i] = $matches[0][$i];
				$result["links"][$i] = $matches[2][$i];
				$result["title"][$i] = $matches[3][$i];
			}
		}

		$regexp_desc = "<div\s[^>]*class=\"article_description\"[^>]*>(.*)<\/div>";
		if(preg_match_all("/$regexp_desc/siU", $txt, $matches)) {

			for($i=0; $i<count($matches[1]); $i++)
			{
				$result["desc"][$i] = strip_tags($matches[1][$i]);
			}
		}

		//$json = json_encode($result);

		return $result;   
    }

    function plan_route()
    {
    	$result = array();
    	$o_lat = isset($_POST['o_lat'])?$_POST['o_lat']:"";
    	$o_lon = isset($_POST['o_lon'])?$_POST['o_lon']:"";

    	$d_lat = isset($_POST['d_lat'])?$_POST['d_lat']:"";
    	$d_lon = isset($_POST['d_lon'])?$_POST['d_lon']:"";

    	$result = array();

    	$map_api = "http://maps.googleapis.com/maps/api/directions/json?origin=".$o_lat.",".$o_lon."&destination=".$d_lat.",".$d_lon."&sensor=false&mode=driving&language=zh-tw";
        $d_result = file_get_contents($map_api);
        $data_json = json_decode($d_result);

        $result['legs'] = $data_json->routes[0]->legs;

        return $result;
    }

    function get_distance()
    {
    	$result = array();
    	$o_lat = isset($_POST['o_lat'])?$_POST['o_lat']:"";
    	$o_lon = isset($_POST['o_lon'])?$_POST['o_lon']:"";

    	$d_lat = isset($_POST['d_lat'])?$_POST['d_lat']:"";
    	$d_lon = isset($_POST['d_lon'])?$_POST['d_lon']:"";

    	$result = array();

    	$map_api = "http://maps.googleapis.com/maps/api/directions/json?origin=".$o_lat.",".$o_lon."&destination=".$d_lat.",".$d_lon."&sensor=false&mode=driving&language=zh-tw";
        $d_result = file_get_contents($map_api);
        $data_json = json_decode($d_result);

        $result['distance'] = $data_json->routes[0]->legs[0]->distance;
        $result['duration'] = $data_json->routes[0]->legs[0]->duration;


        return $result;
    }
?>
