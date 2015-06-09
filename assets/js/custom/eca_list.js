function search(){
    var searchText = document.getElementById("searchText").value;
    window.location = "/eca/list/" + searchText;
    return false;
}

function join(caller){
    var ecaId = caller.dataset.ecaId;

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
                $("#successAlert").modal();
            }
            else if(ajax.responseText == 2){
                $("#registeredAlert").modal();
            }
            else{
                $("#failureAlert").modal();
            }
        }
    }
}