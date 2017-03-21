$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var matdate = button.data('maturitydate');
    var loanid = button.data('loanid');
    var modal = $(this);

    $.get('index.php?r=site/loaninfo', {loanid: loanid}, function (data) {
        var loaninfo = JSON.parse(data);

        $("#accno").text(loaninfo[0][0].loan_no);
        $("#name").text(loaninfo[0][0].fullname);
        $("#daily").text((parseInt(loaninfo[0][0].daily)).toFixed(2));
        $("#contact").text(loaninfo[0][0].contact_no);
        $("#reldate").text(loaninfo[0][0].release_date);
        
        if (loaninfo[0][0].maturity_date)
            $("#matdate").text(loaninfo[0][0].maturity_date);
        else
            $("#matdate").text(matdate);
        
        $("#begbalance").text((loaninfo[0][0].daily * loaninfo[0][0].term).toFixed(2));
        $("#canvasser").text(loaninfo[1][0].fullname);
        $("#storetype").text(loaninfo[2]);

        $("#delbalance").text((loaninfo[3][1]).toFixed(2));
        if (parseInt(loaninfo[3][1]) < 0) {
            $("#delbalance").css("color", "red");
        } else {
            $("#delbalance").css("color", "black");
        }

        $("#penalty").text((loaninfo[3][0]).toFixed(2));
        if (parseInt(loaninfo[3][0]) > 0) {
            $("#penalty").css("color", "red");
        } else {
            $("#penalty").css("color", "black");
        }
        $("#totalbalance").text((loaninfo[3][2]).toFixed(2));
        $("#totalpay").text(loaninfo[3][3]);
        $("#lastpay").text(loaninfo[3][4]);

        // daily collection ledger 
        var len = loaninfo[4].length;
        var color = "#F9F9F9";
        var delcolor = "#0f0d0d";
        var pencolor = "#0f0d0d";
        $("#pay-list").empty();
        for (var i = 0; i < len; i++) {

            if (loaninfo[4][i].sunday === true) {
                color = "#E2A3A3";
            }
            if (loaninfo[4][i].jump === true) {
                color = "#9AD4E2";
            }
            if (loaninfo[4][i].delamt < 0) {
                delcolor = "#f41a1a";
            }
            if (loaninfo[4][i].delamt > 0) {
                delcolor = "#0869E0";
            }
            if (loaninfo[4][i].penalty > 0) {
                var pencolor = "#f41a1a";
            }

            $("#pay-list").append("<tr bgcolor='" + color + "'><td>" + loaninfo[4][i].paydate + "</td><td>" + loaninfo[4][i].payamount + "</td><td style='color:" + delcolor + "'>" + (loaninfo[4][i].delamt).toFixed(2) + "</td><td style='color:" + pencolor + "'>" + (loaninfo[4][i].penalty).toFixed(2) + "</td><td>" + 0 + "</td><td>" + (loaninfo[4][i].balance).toFixed(2) + "</td></tr>");

            color = "#F9F9F9";
            delcolor = "#0f0d0d";
            var pencolor = "#0f0d0d";
        }
    });
});

