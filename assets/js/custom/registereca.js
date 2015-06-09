$("#submit").click(function(){
    var $btn = $("#submit");
    $btn.button('loading');
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
            }
            else if(ajax.responseText == 3) {
                $btn.button('reset');
                $('#emptyAlert').modal();
            }
            else if(ajax.responseText == 4) {
                $btn.button('reset');
                $('#registeredAlert').modal();
            }
            else if(ajax.responseText == 5) {
                $btn.button('reset');
                $('#nameRegisteredAlert').modal();
            }
            else{
                $btn.button('reset');
                $("#failureAlert").modal();
            }
            progress.set(1);
            progress.finish();
        }
    }
    ajax.open("POST","/register/eca",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send(text);

})
