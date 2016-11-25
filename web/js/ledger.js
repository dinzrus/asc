$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var borrower_id = button.data('borrowerid');
    var borrower_name = button.data('name');
    var modal = $(this);

    $('#account-list').find('tr:gt(0)').remove();

    var table = document.getElementById('account-list');
    var ctr = 1;

    // ajax call to get loan details
    $.get('index.php?r=site/loandetails', {id: borrower_id}, function (data) {
        var loan = JSON.parse(data);

        for (var i = 0; i < loan.length; i++) {
            var row = table.insertRow(i + 1);
            var c1 = row.insertCell(0);
            var c2 = row.insertCell(1);
            var c3 = row.insertCell(2);
            var c4 = row.insertCell(3);
            var c5 = row.insertCell(4);
            var c6 = row.insertCell(5);
            var c7 = row.insertCell(6);

            c1.innerHTML = ctr;
            c2.innerHTML = loan[i].loan_no;
            c3.innerHTML = loan[i].release_date;
            c4.innerHTML = loan[i].maturity_date;
            c5.innerHTML = loan[i].loan_type;
            c6.innerHTML = loan[i].unit;
            c7.innerHTML = "<a href='index.php?r=site/ledger&account_id="+ loan[i].id +"'>View</a>";
            
            ctr++;
        }

        if (loan.length == 0) {
            var row = table.insertRow(i + 1);
            var c1 = row.insertCell(0);
            c1.innerHTML = 'No data!';
        }

        //modal . find('#title-text') . text(loan.loan_no);
        //modal . find('#daily') . text(loan.daily);
    });
    // end ajax call 
    modal.find('.modal-title').text('BORROWER: ' + borrower_name.toUpperCase());
})



