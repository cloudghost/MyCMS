function httpRequest(method,url,param,callback){
    var ajax = new XMLHttpRequest();
    var progress = $.AMUI.progress;
    progress.start();
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
            progress.set(1);
            console.log(ajax.responseText);
            callback(ajax.responseText);
        }
    }

    ajax.open(method,url,true);
    if(method === "POST"){
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.send(param);
    }
    else{
        ajax.send();
    }

}