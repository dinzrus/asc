// Activate Next Step

$(document).ready(function () {

    var navListItems = $('ul.setup-panel li a'),
            allWells = $('.setup-content');
    allWells.hide();
    navListItems.click(function (e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this).closest('li');
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    $('ul.setup-panel li.active a').trigger('click');
    // Activate step 2
    $('#activate-step-2').on('click', function (e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();

    })
    // Activate step 3
    $('#activate-step-3').on('click', function (e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    })
    // Activate step 4
    $('#activate-step-4').on('click', function (e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $(this).remove();
    })

    $('#loan-daily').change(function () {
        // get loan_info from database
        $.get('index.php?r=borrower/getloaninfo', {daily_id: $(this).val()}, function (data) {
            var loaninfo = JSON.parse(data);

            $('#gross_amt').html('<strong>' + (parseInt(loaninfo[0].gross_amt)).toFixed(2) + '</strong>');
            $('#interest').text((parseInt(loaninfo[0].interest)).toFixed(2));
            $('#processing_admin').text((parseInt(loaninfo[0].gas) + 325).toFixed(2));
            $('#notary').text((parseInt(loaninfo[0].notary_fee)).toFixed(2));
            $('#gas').text((parseInt(loaninfo[0].gas)).toFixed(2));
            $('#docs').text((parseInt(loaninfo[0].doc_stamp)).toFixed(2));
            $('#netproceeds').html('<strong>' + (parseInt(loaninfo[0].net_proceeds)).toFixed(2) + '</strong>');
            $('#no_days').text(loaninfo[0].term);

        });
    });
    
});