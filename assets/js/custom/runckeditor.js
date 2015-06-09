var idbox=document.getElementById("id");
var titlebox=document.getElementById("title");
var abstractbox=document.getElementById("abstract");
var contentbox=document.getElementById("content");
var btnsub=document.getElementById("submit");
titlebox.value=unescape(titlebox.value);
abstractbox.value=unescape(abstractbox.value);
contentbox.value=unescape(contentbox.value);
var editor = CKEDITOR.replace('content');
editor.on( 'change', function( evt ){conten();});
function send(){
    var ajax = new XMLHttpRequest();
	ajax.open("POST","/news/edit",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var data = escape(CKEDITOR.instances.content.getData());
    ajax.send("news_id="+idbox.value+"&"+"news_title="+escape(titlebox.value)+"&"+"news_description="+escape(abstractbox.value)+"&"+"news_content="+data);
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
			if(ajax.status==200){
				if(ajax.responseText==true){
					alert("成功");
					window.location = "/news/list";
				}else{
					alert("网络错误，请再次提交"+ajax.responseText);
				}
			}else{
				alert("服务器连接失败，稍后重试连接。不想等待请刷新网页。");
			}
        }
    }
}
btnsub.onclick=function(){
	titl();
	abstrac();
	conten();
	if((titl())&&(abstrac())&&(conten())){
		send();
	}else{
		alert("请检查您的填写")
	}
}
function titl(){
	titlebox.parentNode.className="am-form-group";
	document.getElementById("lbltitle").innerHTML="标题("+titlebox.value.length+"/35)";
	if(titlebox.value.length>35){
		titlebox.parentNode.className+=" am-form-error";
		return false;
	}
	if(titlebox.value==""){
		titlebox.parentNode.className+=" am-form-warning";
		return false;
	}
	return true;
}
function abstrac(){
	abstractbox.parentNode.className="am-form-group";
	document.getElementById("lblabstract").innerHTML="摘要("+abstractbox.value.length+"/250)";
	if(abstractbox.value.length>250){
		abstractbox.parentNode.className+=" am-form-error";
		return false;
	}
	if(abstractbox.value==""){
		abstractbox.parentNode.className+=" am-form-warning";
		return false;
	}
	return true;
}
function conten(){
	var data = CKEDITOR.instances.content.getData();
	contentbox.parentNode.className="am-form-group";
	document.getElementById("lblcontent").innerHTML="内容("+data.length+"/60000)";
	if(data.length>60000){
		contentbox.parentNode.className+=" am-form-error";
		return false;
	}
	if(data==""){
		contentbox.parentNode.className+=" am-form-warning";
		return false;
	}
	return true;
}