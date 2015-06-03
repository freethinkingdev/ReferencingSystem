/**
 * User: Marcin
 * Date: 16/11/2012
 * Time: 20:35
 */
//<![CDATA[
$(function(){

    jQuery("#tabs").tabs();

    $("form[name='add_ref_book']").validate();
    $("form[name='add_ref_newspaper']").validate();
    $("form[name='add_ref_website']").validate();
    $("form[name='add_ref_journal']").validate();

    /*Adding a datepicker to a newspaper input field. By adding date picker, i present some validation with javascript*/
    $("input[name='date_and_month']").datepicker({ dateFormat: 'yy-mm-dd' });
    $("input[name='date_accessed']").datepicker({ dateFormat: 'yy-mm-dd' });

    /* This makes sure that only numeric values can be entered*/
    $("input[name='page_numbers']").numeric();
    $("input[name='volume_number']").numeric();

    /*This is javascript picker staff. When the user types in letter, a hint is being shown */
    var letters = ["A","B","C","D","E","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    $("input[name='initial_of_author']").autocomplete({
        source: letters
    });


    $("table[id='table']").click(function(){

    });




});

//]]