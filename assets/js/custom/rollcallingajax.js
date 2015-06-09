function update(){
    var id = document.getElementById("id").value;
    var ajax = new XMLHttpRequest();
	ajax.open("POST","/rollcalling",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send("id="+id);
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
			if(ajax.status==200){
				var result = JSON.parse(ajax.responseText);
				var i;
				document.getElementById("listsid").innerHTML="";
				var num = document.getElementById("attendnum");
				num.innerHTML="已签到人数："+result.length;
				for(i=0;i<result.length;i++){
					insertEle(result[i]);
				}
			}else{
				alert("服务器连接失败，5秒后重试连接。不想等待请刷新网页。");
			}
        }
    }
}
function insertEle(value) { 
	var box = document.getElementById("listsid");
	var newrow = document.createElement("tr");
	var newcol = document.createElement("td");
	newcol.innerHTML = value;  
	box.appendChild(newrow);
	newrow.appendChild(newcol);
	newrow.className += "am-success";
}
function imgresponse(){
	var val;
	var img= document.getElementById("qrcode");
	if(document.body.clientWidth>document.body.clientHeight){
		val= document.body.clientHeight*0.8;
	}else{
		val=document.body.clientWidth*0.8;
	}
	resizeTo(img,val);
}
function resizeTo(img,imgSize){
  img.width=imgSize; 
  img.height=imgSize;
}
if((document.getElementById("id").value)&&(document.getElementById("id").value!="")){
	window.setInterval("update()",5000);
}
window.onload = starter;
