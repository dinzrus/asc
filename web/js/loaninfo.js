$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var loanid = button.data('loanid');
    var modal = $(this);
    
    $.get('index.php?r=site/loaninfo', {loanid: loanid}, function (data) {
        var loaninfo = JSON.parse(data);
        
        $("#accno").text(loaninfo[0].loan_no);
        $("#name").text(loaninfo[0].fullname);
        $("#daily").text((parseInt(loaninfo[0].daily)).toFixed(2));
        $("#contact").text(loaninfo[0].contact_no);
        $("#reldate").text(loaninfo[0].release_date);
        $("#matdate").text(loaninfo[0].maturity_date);
        $("#begbalance").text((loaninfo[0].daily * loaninfo[0].term).toFixed(2));
    });
});

