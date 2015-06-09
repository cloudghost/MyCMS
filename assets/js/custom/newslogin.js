function Login(){
    var progress = $.AMUI.progress;
    progress.start();
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==1)
        {
            progress.set(0.2);
        }
        if (ajax.readyState==1)
        {
            progress.set(0.4);
        }
        if (ajax.readyState==2)
        {
            progress.set(0.6);

        }
        if (ajax.readyState==3)
        {
            progress.set(0.8);

        }
        if (ajax.readyState==4)
        {
            if(ajax.responseText == 1) {
                $('#successAlert').modal();
                window.location = "/news/manage";
            }
            else{
                $("#failureAlert").modal();
            }
            progress.set(1);
            progress.finish();
        }
    }
    ajax.open("POST","/news/login",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	if(document.getElementById("remember").checked==true){
		ajax.send("mediaID="+document.getElementById("id").value+"&mediaPassword="+document.getElementById('pas').value+"&remember=true");
	}else{
		ajax.send("mediaID="+document.getElementById("id").value+"&mediaPassword="+document.getElementById('pas').value);
	}
}
