$.textMetrics = function(el) {
    var h = 0, w = 0;
    var div = document.createElement('div');
    document.body.appendChild(div);
    $(div).css({
        position: 'absolute',
        left: -1000,
        top: -1000,
        display: 'none'
    });
    $(div).html($(el).html());
    var styles = ['font-size',
                  'font-style',
                  'font-weight',
                  'font-family',
                  'line-height',
                  'text-transform',
                  'letter-spacing'];
    $(styles).each(function() {
        var s = this.toString();
        $(div).css({s: $(el).css(s)})});
    h = $(div).outerHeight();
    w = $(div).outerWidth();
    $(div).remove();
    return {
        height: h,
        width: w
    };
}

var base = {};
    base.form = {};
    base.html = {};

base.html.getWidth = function(item,outer){
    var wl,wr;
    wl = parseInt($(item).css(outer+'Left'),10);
    wr = parseInt($(item).css(outer+'Right'),10);
    return wl+wr;
};

/////////////////////////////////////////////////

base.html.resetNavbar = function(id){
    var nav      = $("#"+id);
    if (nav.length == 0) {
        return;
    }
    var navWidth = nav.width(),
        lis      = nav.find('li'),
        liSize   = lis.length,
        items    = {},
        realWidth= 0,
        defWidth = 0,
        li,p,m,delta;
    $.each(lis, function(k,v){
        p = base.html.getWidth($(v),'padding');
        m = base.html.getWidth($(v),'margin');
        items[k]={
            item  : $(v),
            text  : $(v).text(),
            length: $(v).text().length,
            size  : $.textMetrics($(v))}
        realWidth += $.textMetrics($(this)).width+(p+m);
        $(v).find('a').css({width:'auto'})});
    $.each(items, function(k,v){
        delta = navWidth-realWidth;
        v.item.css({width : Math.floor(v.size.width+delta/liSize)});
        defWidth += Math.floor(v.size.width+delta/liSize)});
    li = items[liSize-1].item;
    p = base.html.getWidth(li,'padding');
    m = base.html.getWidth(li,'margin');
    li.css({width : navWidth-defWidth+Math.floor(items[liSize-1].size.width+delta/liSize)-(p+m)*liSize});
    nav.show();
};



base.html.loadMenu = {
   loadedMenus: [],
   load:function(menuid)
   {
       if ($("#"+menuid).length !== 0 && this.loadedMenus[menuid] == undefined) {
            this.loadedMenus[menuid]= 1;
            base.html.resetNavbar(menuid);
        }
    },
	loadLeftMenu:function(menuid){
		if( $("#"+menuid).length !== 0 && this.loadedMenus[menuid] == undefined){
		  $("#"+menuid).webwidget_vertical_menu({
                    directory: "images/template_{/literal}{$template}{literal}"
           });
			this.loadedMenus[menuid]= 1;
		}

	}
};