
var btns=document.getElementsByName("onoffswitch");
$(document).ready(function(){
	for(var i=0;i<btns.length;i++){
    btns[i].onclick= function () {
		var id = this.parentNode.id;
        $('#changeRole').modal({
            relatedTarget: this,
            onConfirm: function (e) {
                if (e.data[0] == "") {
                    alert("不能为空");
                }
                else {
                    var ecaId = document.getElementById("ecaid").value;
                    var param = "role=" + e.data[0] + "&authority=" + e.data[1] + "&ecaId=" + ecaId+"&userid=" + id;
                    var result = httpRequest("POST", "/eca/api/changeRole", param, function (response) {
						if (response == "1") {
                            $("#successAlert").modal();
                            location.reload();
                        }
                        else {
                            document.write(response);
                            $("#failureAlert").modal();
                        }
					});
				}
			}
        });
    }
}});
var del=document.getElementsByName("kickBtn");
$(document).ready(function(){
for(var i=0;i<del.length;i++)
{
    del[i].onclick= function(){
		var id = this.parentNode.id;
		var confirmString = prompt("你确定要移除他/她？如果是，请在这里输入‘确定’二字");
                if(confirmString === "确定"){
                    var paramString = "eca=" + document.getElementById('ecaid').value+"&user="+id;
                    $("#loadingAlert").modal();
                    httpRequest("POST","/eca/exit", paramString,function(response){
                        $("#loadingAlert").modal('close');
                        if(response == 1){
                            location.reload();  
                        }
                        else{
                            $("#failureAlert").modal();
                        }
                    });
                }
                else{
                    $("#failureAlert").modal();
                }
		}
}});
$(function () {
    $("#submit").on('click',function(){
        $('#confirmSubmit').modal({
            relatedTarget: this,
            onConfirm: function(options) {
                var btns=document.getElementsByName("onoffswitch");
				attendance=new Object();
				for(var i=0;i<btns.length;i++){
					eval("attendance.s"+btns[i].id+"="+btns[i].checked);
				}
				var post=new Object();
				post.attendance=attendance;
				post.eca_id=document.getElementById("ecaid").value;
				post.rollcall_id=document.getElementById("rollcallid").value;
				var param=JSON.stringify(post);
				var result = httpRequest("POST", "/eca/api/updateAttendance", "post="+param, function (response) {
					if (response == "1") {
						alert("操作成功！");
						location.reload();
					}else if(response == "0"){
						alert("数据库连接故障，请联系管理人员！");
					}
					else {
						alert("操作失败，请检查你的权限！");
					}
				});
            }
        });
    })
});
$(function () {
    $("#exitEcaBtn").on('click',function(){
                var confirmString = prompt("你确定要退出ECA？如果是，请在这里输入‘确定’二字");
                if(confirmString === "确定"){
                    var paramString = "eca=" + document.getElementById('ecaid').value+"&user="+document.getElementById('sid').value;
                    $("#loadingAlert").modal();
                    httpRequest("POST","/eca/exit", paramString,function(response){
                        $("#loadingAlert").modal('close');
                        if(response == 1){
                            location.reload();  
                        }
                        else{
                            $("#failureAlert").modal();
                        }
                    });
                }
                else{
                    $("#failureAlert").modal();
                }
    })
});
$(function () {
    $("#joinBtn").on('click',function(){
	var ecaId = document.getElementById('ecaid').value;
    var string = "/eca/join/" + ecaId;
    var ajax = new XMLHttpRequest();
    var progress = $.AMUI.progress;
    progress.start();
    ajax.open("GET",string,true);
    ajax.send();
    ajax.onreadystatechange = function(){
        if(ajax.readyState ==0){
            progress.set(0.2);
        }
        else if(ajax.readyState ==1){
            progress.set(0.4);
        }
        else if(ajax.readyState ==2){
            progress.set(0.6);
        }
        else if(ajax.readyState ==3){
            progress.set(0.8);
        }
        else if(ajax.readyState ==4){
            progress.set(1);
            if(ajax.responseText ==1){
                $("#successregAlert").modal();
				location.reload();
            }
            else if(ajax.responseText == 2){
                $("#registeredAlert").modal();
            }
            else{
                $("#failureAlert").modal();
            }
        }
    }
    })
});