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
//$('#newcanvass').yiiActiveForm('validate', true);
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
        $('#newcanvass').yiiActiveForm('validate', true);
    })
    // Activate step 3
    $('#activate-step-3').on('click', function (e) {
//$('#newcanvass').yiiActiveForm('validate', true);
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
        $('#newcanvass').yiiActiveForm('validate', true);
    })
    // Activate step 4
    $('#activate-step-4').on('click', function (e) {
//$('#newcanvass').yiiActiveForm('validate', true);
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $(this).remove();
        $('#loan_info').yiiActiveForm('validate', true);
    })
    
    $('#w1').change(function () {
        // get loan_info from database
        
    });

})