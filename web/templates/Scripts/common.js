function win_resize(){
	win_w=$(window).width();
	win_h=$(window).height();

	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');

	console.log(win_w);
	console.log(win_h);

	if(win_h<785){
		win_h=785;
	};

	IT4FUN.first.css({'height':win_h-95,'padding':'95px 0 0 0'});
	IT4FUN.second.css({'height':win_h-95,'padding':'95px 0 0 0'});
	IT4FUN.third.css({'height':win_h-95,'padding':'95px 0 0 0'});

	IT4FUN.lifeAndknowledge.css({'height':win_h-345-95});

	IT4FUN.map_desc.css({'height':win_h-95});
	IT4FUN.map_map.css({'width':win_w-380,'height':win_h-95});
	IT4FUN.photo_info.css({'left':(win_w-IT4FUN.photo_info.width())/2,'top':(win_h-IT4FUN.photo_info.height())/2});

	IT4FUN.third_container.css({'height':win_h-95,'width':parseInt(win_w/347)*347+(parseInt(win_w/347)-1)*5+10});

};

function init_btn(){
	IT4FUN.menu.find('li').css({'background':'url(./templates/images/nav/menu_bg.jpg)'});
};