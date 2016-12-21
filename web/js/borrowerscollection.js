

$(window).load(function () {
    //$('#myModal').modal('show');
});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
        return false;
    }
    return true;
}

function calculateTotal(amount, eid, ttamt) {

    var money_cnt = $(eid).val();
    total = money_cnt * amount;
    $(ttamt).val(parseFloat(total).toFixed(2));

    var ttotal = 0;
    var m1000 = $('#money-total_1000').val() || 0;
    var m500 = $('#money-total_500').val() || 0;
    var m200 = $('#money-total_200').val() || 0;
    var m100 = $('#money-total_100').val() || 0;
    var m50 = $('#money-total_50').val() || 0;
    var m20 = $('#money-total_20').val() || 0;
    var mcoin = $('#money-money_coin').val() || 0;

    ttotal = parseInt(m1000) + parseFloat(m500) + parseFloat(m200) + parseFloat(m100) + parseFloat(m50) + parseFloat(m20) + parseFloat(mcoin);
    $('#money-money_total_amount').val(parseFloat(ttotal).toFixed(2));

}

// this function adds parameters to the url of the submit button in the modal
function addURL(element)
{
    $(element).attr('href', function () {
        return this.href + '&collection_date=' + $('input[name=collection_date-money-collection_date]').val() + '&branch_id=' + $('#money-branch_id').val() + '&unit_id=' + $('#money-unit_id').val();
    });
}