function doAlert() {
    alert("df");
}
$(function () {
    $('#changeContactBtn').on('click', function () {
        $('#changeContact').modal({
            relatedTarget: this,
            onConfirm: function (e) {
                if (e.data == null) {
                    alert("不能为空");
                }
                else {
					var ecaId = document.getElementById("ecaid").value;
                    var param = "contact=" + escape(e.data[0]) + "&place=" + escape(e.data[1]) + "&moment=" + escape(e.data[2]) + "&ecaId=" + ecaId;
                    var result = httpRequest("POST", "/eca/api/updateContact", param, function (response) {
                        if (response == "1") {
                            $("#changeDescriptionSuccessAlert").modal();
							location.reload();
                        }
                        else {
							alert(response);
                            $("#failureAlert").modal();
                        }
                    });

                }
            }
        });
    });
});
$(function () {
    $('#changeDescriptionBtn').on('click', function () {
        $('#changeDescription').modal({
            relatedTarget: this,
            onConfirm: function (e) {
                if (e.data == null) {
                    alert("不能为空");
                }
                else {
                    var ecaId = $('#changeDescriptionBtn').data("ecaId");
                    var param = "description=" + e.data + "&ecaId=" + ecaId;
                    var result = httpRequest("POST", "/eca/api/updateDescription", param, function (response) {
                        if (response == "1") {
                            $("#changeDescriptionSuccessAlert").modal();
                            $("#ecaDescriptionText").html(e.data);
                        }
                        else {
                            document.write(response);
                            $("#failureAlert").modal();
                        }
                    });

                }
            }
        });
    });
});
var object=document.getElementsByName("changeRoleBtn");
$(document).ready(function(){
	for(var i=0;i<object.length;i++){
    object[i].onclick= function () {
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
    $("#deleteEcaBtn").on('click',function(){
        $('#confirmDelete').modal({
            relatedTarget: this,
            onConfirm: function(options) {
                var confirmString = prompt("你确定要删除ECA？如果是，请在这里输入‘确定’二字");
                if(confirmString === "确定"){
                    var ecaId = $('#changeDescriptionBtn').data("ecaId");
                    var paramString = "ecaId=" + ecaId;
                    $("#loadingAlert").modal();
                    httpRequest("POST","/eca/api/deleteEca", paramString,function(response){
                        $("#loadingAlert").modal('close');
                        document.write(response);
                        if(response == 1){
                            $("#deleteEcaSuccessAlert").modal();
                            window.location = "/eca";

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