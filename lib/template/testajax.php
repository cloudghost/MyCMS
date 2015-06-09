<?php get_header_raw();?>
<button onclick="getAjax()">ajax</button>
<script>
    function getAjax() {
        var progress = $.AMUI.progress;
        progress.start();
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "http://cms.com/ajax", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if(ajax.readyState == 0){
                progress.set(0.2);
            }
            if(ajax.readyState == 1){
                progress.set(0.4);
            }
            if(ajax.readyState == 2){
                progress.set(0.6);
            }
            if(ajax.readyState == 3){
                progress.set(0.8);
            }
            if(ajax.readyState == 4){
                progress.set(1);

                alert(ajax.responseText);
            }
        }
    }
</script>
<div class="abcu"></div>
<?php get_footer();?>