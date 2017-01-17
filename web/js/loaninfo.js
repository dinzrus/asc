$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var loanid = button.data('loanid');
    var modal = $(this);
    
    $.get('index.php?r=site/loaninfo', {loanid: loanid}, function (data) {
        var loaninfo = JSON.parse(data);
        
        $("#accno").text(loaninfo[0][0].loan_no);
        $("#name").text(loaninfo[0][0].fullname);
        $("#daily").text((parseInt(loaninfo[0][0].daily)).toFixed(2));
        $("#contact").text(loaninfo[0][0].contact_no);
        $("#reldate").text(loaninfo[0][0].release_date);
        $("#matdate").text(loaninfo[0][0].maturity_date);
        $("#begbalance").text((loaninfo[0][0].daily * loaninfo[0][0].term).toFixed(2));
        $("#canvasser").text(loaninfo[1][0].fullname);
        $("#storetype").text(loaninfo[2]);
        $("#delbalance").text(loaninfo[3][1]);
        $("#penalty").text(loaninfo[3][0]);
        $("#totalbalance").text((loaninfo[3][2]).toFixed(2));
        $("#totalpay").text(loaninfo[3][3]);
        $("#lastpay").text(loaninfo[3][4]);
    });
});

