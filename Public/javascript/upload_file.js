(function( $, window, undefined ) {
  $.uploadFile = $.extend( {}, {
    
    addLog: function(id, status, str){
      var d = new Date();
      var li = $('<li />', {'class': 'demo-' + status});
       
      var message = '[' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds() + '] ';
      
      message += str;
     
      li.html(message);
      
      $(id).prepend(li);
    },
    
    addFile: function(id, i, file){
		var template = '<tr id="file_info' + i + '"><td width="100">'+file.name+'</td><td>'+$.uploadFile.humanizeSize(file.size)+'</td><td><div class="task_status"><a href="javascript:void(0);" class="task_running"><em class="percent_bar" style="width:0%;">正在运行</em></a><span class="percent">0%</span></div></td><td><a href="javascript:void(0);" class="del_upload_file" onclick="del_uploadfile('+i+')">删除</a></td></tr>';			       
		var i = $(id).attr('file-counter');
		if (!i){
			$(id).empty();
			i = 0;
		}
		
		i++;
		$(id).attr('file-counter', i);
		$(id).append(template);
	},
	
	updateFileStatus: function(i, status, message){
		$('#file_info' + i).find('span.demo-file-status').html(message).addClass('demo-file-status-' + status);
	},
	
	updateFileProgress: function(i, percent){
		$('#file_info' + i).find('em.percent_bar').width(percent);
		$('#file_info' + i).find('span.percent').html(percent+ 'completed');
	},
	
	humanizeSize: function(size) {
      var i = Math.floor( Math.log(size) / Math.log(1024) );
      return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    }

  }, $.uploadFile);
})(jQuery, this);

/**
 * 删除上传的文件
 *
 **/
function del_uploadfile(i)
{
	var obj = document.getElementById('file_info'+i);
	$.upload.remove(i);
	obj.remove();
}
function getFileLenth()
{
	return $.upload.queue.length;
}