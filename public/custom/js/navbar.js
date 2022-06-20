$(document).ready(function() {
    //the trigger on hover when cursor directed to this class
    $(".toggle-t").hover(
        function() {
            //i used the parent ul to show submenu
            $(this).children('ul').stop(true, false).slideDown('fast');
        },
        //when the cursor away 
        function() {
            $('ul', this).stop(true, false).slideUp('fast');
        });
    //this feature only show on 600px device width
});
/** credit:@rafonzoo 
http://rafonzo.blogspot.co.id/ **/
