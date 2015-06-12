$(function() {
  $('#date').datepicker({format: 'yyyy-mm', viewMode: 'months', minViewMode: 'months'}).
    on('changeDate.datepicker.amui', function(event) { 
       window.location="/index.php?action=attendance&month="+(event.date.getMonth()+1)+"&year="+event.date.getFullYear();
    });
});