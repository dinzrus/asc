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

    // DEMO ONLY //
    $('#activate-step-2').on('click', function (e) {
        if ($('#borrower-last_name').val() && $('#borrower-first_name').val() && $('#borrower-gender').val() && $('#borrower-civil_status').val() && $('#borrower-contact_no').val() && $('#borrower-address_province_id').val() && $('#borrower-address_city_municipality_id').val() && $('#borrower-address_barangay_id').val() && $('#borrower-address_street_house_no').val()) {
            $('#newcanvass').yiiActiveForm('validate', true);
            $('ul.setup-panel li:eq(1)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-2"]').trigger('click');
            $(this).remove();
        }
        $('#newcanvass').yiiActiveForm('validate', true);
    })
});
