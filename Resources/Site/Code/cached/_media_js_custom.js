$(document).ready(function(){

    //base.html.resetNavbar('navigation');
    //base.html.resetNavbar('navigation_top');
    
	
    $('.group').jcarousel({
        scroll: 1
    });
    $('.top_list').jcarousel({
        scroll: 1,
        auto: 4,
        wrap: 'last'
    });

    //////////

    var e = window.location.pathname;
    var ul = $("#navigation");

    if (e == "/") {
        ul.find("li:first a").addClass("active");
    }
    else {
        $.each(ul.find("li a"), function(){
            if ("/"+$(this).attr("href")==e) {
                $(this).addClass("active");
            }
        });
    }

    //////////

});


    $(function() {

    // set effect from select menu value
    $( ".all_categories" ).click(function() {
        $( "#category_popup" ).slideToggle(200);
        $( ".all_categories" ).toggleClass("all_categories_on");
        return false;
    });

    $('body').click(function(event) {
        if (!$(event.target).closest('#category_popup').length) {
            $('#category_popup').slideUp(200);
           $( ".all_categories" ).removeClass("all_categories_on");
        };
    });

  });

    //////////
/*
    $(function() {
        $( "#accordion" ).accordion({ header: 'h4', collapsible: true, autoHeight: false });
    });
*/
    //////////
/*	
         $(function(){
             $('.slide-out-div').tabSlideOut({
                 tabHandle: '.handle',
                 pathToTabImage: 'http://cs6292.userapi.com/u165554321/docs/001cc1a56e8c/toolbar.gif',
                 imageHeight: '100px',
                 imageWidth: '26px',
                 tabLocation: 'left',
                 speed: 300,
                 action: 'click',
                 topPos: '250px',
                 fixedPosition: true
             });
         });
*/

    //////////

    $(document).ready(function() {
         $(".product_info").hover(function() {
            $(this).addClass("product_hover");
                        }, function() {
            $(this).removeClass("product_hover");
         })
		 
		//////////
		 
    });