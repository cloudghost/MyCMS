$("#submit").click(function(){
    var progress = $.AMUI.progress;
    progress.start();
    var text = $('form').serialize();
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
                window.location = "/";
            }else{
                $("#failureAlert").modal();
				window.location = "/";
            }
            progress.set(1);
            progress.finish();
        }
    }
    ajax.open("POST","/register/user",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send(text);

})
