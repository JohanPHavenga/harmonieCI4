$(function () {
    $('#inputDateTo').datepicker({
        format: 'yyyy-mm-dd',
    }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });
    
    $('#inputDateFrom').datepicker({
        format: 'yyyy-mm-dd',
    }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });
});

