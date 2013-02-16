(function(a){
    a.fn.webwidget_vertical_menu=function(p){
        var p=p||{};

//        var f=p&&p.menu_text_size?p.menu_text_size:"12";
//        var g=p&&p.menu_text_color?p.menu_text_color:"blue";
//        var h=p&&p.menu_border_size?p.menu_border_size:"1";
//        var i=p&&p.menu_background_color?p.menu_background_color:"#FFF";
//        var j=p&&p.menu_border_color?p.menu_border_color:"blue";
//        var k=p&&p.menu_border_style?p.menu_border_style:"solid";
//        var l=p&&p.menu_width?p.menu_width:"250";
//        var n=p&&p.menu_height?p.menu_height:"30";
//        var r=p&&p.menu_margin?p.menu_margin:"5";
//        var v=p&&p.menu_background_hover_color?p.menu_background_hover_color:"red";
        var m=p&&p.directory?p.directory:"";
        var w=a(this);
//        f += 'px';
//        n += 'px';
//        r += 'px';
        if(w.children("ul").length==0||w.find("li").length==0){
            dom.append("Require menu content");
            return null
        }
        init();
        function init(){
            w.children("ul").find("a").css("display","block");
            w.children("ul").children("li");
            w.find("li").children("ul");
            w.find("li");
            w.find("li:has(ul)").addClass("webwidget_vertical_menu_down_drop");
//            w.find("li:has(ul)").css("background-image","url("+m+"/down_drop_icon.gif)");
//            w.children("ul").children("li").find("ul").css("top","0px");
        }
//        s_sub_l(w.find("ul").children("li").children("ul").children("li").children("ul"),h);
        w.find("li").hover(function(){
            $(this).addClass("on_hover");
            $(this).children("ul").show()
            },function(){
            $(this).removeClass("on_hover");
            $(this).children("ul").hide()
            });



            function s_u_t(a){
            l_t_b_s=a.outerHeight(true)-a.css("border-top-width").replace("px","")*2+"px";
            a.children("ul").css("top",l_t_b_s);
            a.children("ul").css("left","-"+a.css("border-top-width"));
            li_hieght = w.children("ul").children("li").outerHeight(true);
            //li_width = w.children("ul").children("li").outerWidth(true);
            a.children("ul").find("a").css("line-height",li_hieght+"px");
            //a.children("ul").find("li").width(li_width);
            }
            function s_sub_l(a,b){
            boder_width=b.replace("px","");
            a.css("left",a.parent("li").parent("ul").outerWidth(true)-boder_width*2);
            a.css("top","-"+b)
            }
        }
})(jQuery);