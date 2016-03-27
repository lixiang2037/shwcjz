/*!
 * jQuery showDialog
 * befen.net
 * Date: 2013.02.08
*/

function detectMacXFF() {
	var userAgent = navigator.userAgent.toLowerCase();
	if(userAgent.indexOf("mac") != -1 && userAgent.indexOf("firefox") != -1) {
		return true;
	}
}

function in_array(needle, haystack) {
	if(typeof needle == "string" || typeof needle == "number") {
		for(var i in haystack) {
			if(haystack[i] == needle) {
				return true;
			}
		}
	}
	return false;
}

function sd_load(sd_width) {
	if(sd_width) {
		$("#SD_window").css("width", sd_width + "px");
	}
	var sd_top = ($(window).height() - $("#SD_window").height()) / 2 + $(document).scrollTop();
	if(sd_top < 0) {
		sd_top = 0;
	}
	var sd_left = ($(window).width() - $("#SD_window").width()) / 2;
	if(sd_left < 0) {
		sd_left = 0;
	}
	$("#SD_window").css("top", sd_top);
	$("#SD_window").css("left", sd_left);
}

function sd_remove() {
	$("#SD_close,#SD_cancel,#SD_confirm").unbind("click");
	$("#SD_window,#SD_overlay,#SD_HideSelect").remove();
	if(typeof document.body.style.maxHeight == "undefined") {
		$("body","html").css({height: "auto", width: "auto"});
	}
}

function showDialog(mode, msg, t, sd_width) {
	var sd_width = sd_width ? sd_width : 400;
	var mode = in_array(mode, ['confirm', 'window', 'info', 'loading']) ? mode : 'alert';
	var t = t ? t : "提示信息";
	var msg = msg ? msg : "";
	var confirmtxt = confirmtxt ? confirmtxt : "确定";
	var canceltxt = canceltxt ? canceltxt : "取消";
	sd_remove();
	try {
		if(typeof document.body.style.maxHeight === "undefined") {
			$("body","html").css({height: "100%", width: "100%"});
			if(document.getElementById("SD_HideSelect") === null) {
				$("body").append("<iframe id='SD_HideSelect'></iframe><div id='SD_overlay'></div>");
			}
		} else {
			if(document.getElementById("SD_overlay") === null) {
				$("body").append("<div id='SD_overlay'></div>");
			}
		}
		if(mode == "alert") {
			if(detectMacXFF()) {
				$("#SD_overlay").addClass("SD_overlayMacFFBGHack");
			} else {
				$("#SD_overlay").addClass("SD_overlayBG");
			}
		} else {
			if(detectMacXFF()) {
				$("#SD_overlay").addClass("SD_overlayMacFFBGHack2");
			} else {
				$("#SD_overlay").addClass("SD_overlayBG2");
			}
		}
		$("body").append("<div id='SD_window' class='layer'></div>");
		var SD_html;
		SD_html = "";
		SD_html += "<div class='layer_wrap'>";
		SD_html += "<div class='layer_title' id='SD_container'><h3>"+ t +"</h3><i class='close' id='SD_close' title='关闭'></i></div>";
		SD_html += "<div class='layer_contain' id='SD_body'><form method='post' name='dialogForm' id='dialogForm'>" + msg + "</form></div>";
		SD_html += "<div class='con_footer clear' id='SD_button'>";
		SD_html += "<div class='con_footer_wrap'><a id='SD_cancel' href='javascript:void(0);' class='btn btn_bigger'>" + canceltxt + "</a>";
		SD_html += "<a id='SD_confirm' href='javascript:void(0);' class='btn btn_blue btn_bigger'>" + confirmtxt + "</a></div>";
		SD_html += "</div>";
		SD_html += "</div>";
		$("#SD_window").append(SD_html);
		$("#SD_cancel,#SD_close").bind("click", function(){

			sd_remove();
		});
		if(mode == "info" || mode == "alert") {
			$("#SD_cancel").hide();
			$("#SD_button").show();
		}
		if(mode == "window") {
			$("#SD_close").show();
		}
		if(mode == "confirm") {
			$("#SD_button").show();
		}
		var sd_move = false;
		var sd_x, sd_y;
		$("#SD_container > h3").click(function(){}).mousedown(function(e){
			sd_move = true;
			sd_x = e.pageX - parseInt($("#SD_window").css("left"));
			sd_y = e.pageY - parseInt($("#SD_window").css("top"));
		});
		$(document).mousemove(function(e){
			if(sd_move){
				var x = e.pageX - sd_x;
				var y = e.pageY - sd_y;
				$("#SD_window").css({left:x, top:y});
			}
		}).mouseup(function(){
			sd_move = false;
		});
		$("#SD_body").width(sd_width - 50);
		sd_load(sd_width);
		$("#SD_window").show();
		$("#SD_window").focus();
	} catch(e) {
		alert("System Error !");
	}
}

function showInfo(msg, fn, timeout) {
	showDialog("info", msg);
	$("#SD_confirm").unbind("click");
	if(fn && timeout) {
		st = setTimeout(function(){
			sd_remove();
			fn();
		}, timeout * 1000);
	}
	$("#SD_confirm").bind("click", function(){
		if(timeout) {
			clearTimeout(st);
		}
		sd_remove();
		if(fn) {
			fn();
		}
	});
}

function showWindow(title, the_url, sd_width) {
	
	var sd_width = sd_width ? sd_width : 400;
	$.ajax({
		type		: "GET",
		dataType	: "html",
		cache		: false,
		timeout		: 10000,
		url			: the_url,
		data		: "isajax=1",
		success		: function(data){
			showDialog("window", data, title, sd_width);
		},
		error		: function(data){
			showDialog("alert", "读取数据失败");
		},
		beforeSend	: function(data){
			showDialog("loading", "正在读取数据...");
			showDialog("loading", "正在读取数据...");
		}
	});
}

function showConfirm(msg, fn) {
	showDialog("confirm", msg);
	$("#SD_confirm").unbind("click");
	$("#SD_confirm").bind("click", function(){
		if(fn) {
			fn();
		}
	});
}