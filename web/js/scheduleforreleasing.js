$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('idd');
    var fname = button.data('name');
    var branch = button.data('branch');
    var modal = $(this);

    $.get('index.php?r=site/dailyunits', {id: recipient, branch: branch}, function (data) {
        var jsn = JSON.parse(data);
        // alert(data);
        var d1 = jsn[0];
        var d2 = jsn[1];

        // dropdown for daily and unit 
        var s = $('<select/>');
        var x = $('<select/>');

        s.addClass('form-control daily');
        s.attr('name', 'daily');

        x.addClass('form-control unit');
        x.attr('name', 'unit');

        for (var key in d1) {
            $('<option />', {value: d1[key].id, text: d1[key].daily}).appendTo(s);
        }

        for (var key in d2) {
            $('<option />', {value: d2[key].unit_id, text: d2[key].unit_description}).appendTo(x);
        }

        $('.daily').remove();
        s.appendTo('#daily');

        $('.unit').remove();
        x.appendTo('#unit');

    });

    modal.find('.modal-title').text('Schedule: ' + fname);
    modal.find('.clnts_id').val(recipient);
    //modal.find('.modal-body input').val(recipient);
}
);

// this function adds parameters to the url of the submit button in the modal
function addURL(element)
{
    $(element).attr('href', function () {
        return this.href + '&id=' + $('input[name=id]').val() + '&loantype=' + $('select[name=loantype]').val() + '&daily=' + $('select[name=daily]').val() + '&unit=' + $('select[name=unit]').val();
    });
}
