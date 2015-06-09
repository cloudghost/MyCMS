var idbox=document.getElementById("id");
var titlebox=document.getElementById("title");
var contentbox=document.getElementById("content");
var btnsub=document.getElementById("submit");
function send(){
    var ajax = new XMLHttpRequest();
	ajax.open("POST","/post/new",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var paramsting="eca_id="+idbox.value+"&notice_title="+escape(titlebox.value)+"&"+"notice_content="+escape(contentbox.value);
	if(document.getElementById("user").value!=false){
		paramsting=paramsting+"&user_sid="+document.getElementById("user").value;
	}
    ajax.send(paramsting);
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
			if(ajax.status==200){
				if(ajax.responseText==true){
					alert("成功");
					window.location = "/post/list";
				}else{
					alert("你真的是eca的管理员吗?");
				}
			}else{
				alert("网络错误，请重试");
			}
        }
    }
}
btnsub.onclick=function(){
	titl();
	conten();
	if((titl())&&(conten())){
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
function conten(){
	contentbox.parentNode.className="am-form-group";
	document.getElementById("lblabstract").innerHTML="摘要("+contentbox.value.length+"/250)";
	if(contentbox.value.length>250){
		contentbox.parentNode.className+=" am-form-error";
		return false;
	}
	if(contentbox.value==""){
		contentbox.parentNode.className+=" am-form-warning";
		return false;
	}
	return true;
}