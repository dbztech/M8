//JavaScript Document

var Selector = new selector;
var Cookie = new cookie;

function load() {
	document.getElementById('splashcontinue').style.display = "block";
	//dragResizeLoad();
}

function unveil() {
	document.getElementById('splashtext').className = 'unveil';
	delay("document.getElementById('splashcontinue').className = 'unveil'",250);
	delay("document.getElementById('splashtext').style.right = '100%'",950);
	delay("document.getElementById('splashcontinue').style.right = '100%'",1200);
	delay("document.getElementById('splash').style.display = 'none'",1200);
	delay("showContent()",1200);
}

function showContent() {
	document.getElementById('content').style.display = 'block';
	document.getElementById('leftnav').style.display = 'block';
}

function delay(command, time) {
	setTimeout(command, time);
}

function logout() {
	var username = Cookie.getCookie("username");
	ajax("logout", username);
	Cookie.setCookie("sessionhash","0");
	Cookie.setCookie("username","0");
	delay('window.location.reload()',1500);
}

function ajax(type, query) {
	var verify = Cookie.getCookie('sessionhash');
	var username = Cookie.getCookie('username');
	var xmlhttp;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	} else {
		// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  	console.log("Query successful");
	  	console.log(xmlhttp.responseText);
	    return(true);
	  } else {
	  	//console.log("Query failed");
	    return(false);
	  }
	}
	xmlhttp.open("GET","Resources/Core/ajax.php?type="+type+"&query="+query+"&verify="+verify+"&username="+username,true);
	xmlhttp.send();
}

function selector() {
	this.setCurrent = function(id, group) {
		this.onColor = "#FFF";
		this.offColor = "#33B5E5";
		this.counter = new Array();

		if (group == "overview") {
			if (id == "info") {
				this.counter[0] = "status"
			}

			if (id == "status") {
				this.counter[0] = "info"
			}
		}

		if (group == "variables") {
			if (id == "editVariables") {
				this.counter[0] = "search"
			}

			if (id == "search") {
				this.counter[0] = "editVariables"
			}
		}

		for (var i = this.counter.length - 1; i >= 0; i--) {
			this.turnOn(id);
			this.turnOff(this.counter[0]);
			this.show(id);
			this.hide(this.counter[0]);
		}
	}

	this.turnOff = function(id) {
		document.getElementById(id+'Button').style.color = this.offColor;
	}

	this.turnOn = function(id) {
		document.getElementById(id+'Button').style.color = this.onColor;
	}

	this.show = function(id) {
		document.getElementById(id).style.display = "block";
	}

	this.hide = function(id) {
		document.getElementById(id).style.display = "none";
	}
}

function cookie() {
	this.getCookie = function(c_name) {
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++) {
	 		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	  		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	  		x=x.replace(/^\s+|\s+$/g,"");
		  	if (x==c_name) {
		  		return unescape(y);
		  	}
	 	}
	}

	this.setCookie = function(c_name,value,exdays) {
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
	}
}

function pagewrite(id, column) {
	//name = 0
	//title = 1
	//description = 2
	//location = 3
	var value = "ERROR";
	var query;
	var columnname;
	if (column == 0) {
		value = document.getElementById(id+'name').value;
		columnname = "name";
	} else if (column == 1) {
		value = document.getElementById(id+'title').value;
		columnname = "title";
	} else if (column == 2) {
		value = document.getElementById(id+'description').value;
		columnname = "description";
	} else if (column == 3) {
		value = document.getElementById(id+'location').value;
		columnname = "location";
	}
	if (value != "ERROR") {
		query = "UPDATE `pages` SET `"+columnname+"` = '"+value+"' WHERE `pages`.`id` = "+id+";";
		ajax("query",query);
	}

}

function variablewrite(id) {
	var value = "ERROR";
	var name = "ERROR";
	var query;
	var columnname;
	value = document.getElementById(id+'varvalue').value;
	name = document.getElementById(id+'varname').value;
	if (value != "ERROR" && name != "ERROR") {
		query = "UPDATE `variables` SET `name` = '"+name+"', `text` = '"+value+"' WHERE `variables`.`id` = "+id+";";
		//console.log(query);
		ajax("query",query);
	}

}

function dialog() {
	this.open = function(title, content) {
		document.getElementById('dialog').style.display = "block";
		document.getElementById('dialogTitle').innerHTML = "block";
		document.getElementById('dialogContent').innerHTML = "block";
	}

	this.setCookie = function() {
		document.getElementById('dialog').style.display = "none";
	}
}

////////////////////////
////////////////////////
////////////////////////
////////////////////////
////////////////////////
////////////////////////
////////////////////////
//3rd Party JavaScript//
////////////////////////
////////////////////////
////////////////////////
////////////////////////
////////////////////////
////////////////////////
////////////////////////


function dragResizeLoad() {
	//<![CDATA[

	// Using DragResize is simple!
	// You first declare a new DragResize() object, passing its own name and an object
	// whose keys constitute optional parameters/settings:

	var dragresize = new DragResize('dragresize',
	 { minWidth: 50, minHeight: 50, minLeft: 20, minTop: 20, maxLeft: 600, maxTop: 600 });

	// Optional settings/properties of the DragResize object are:
	//  enabled: Toggle whether the object is active.
	//  handles[]: An array of drag handles to use (see the .JS file).
	//  minWidth, minHeight: Minimum size to which elements are resized (in pixels).
	//  minLeft, maxLeft, minTop, maxTop: Bounding box (in pixels).

	// Next, you must define two functions, isElement and isHandle. These are passed
	// a given DOM element, and must "return true" if the element in question is a
	// draggable element or draggable handle. Here, I'm checking for the CSS classname
	// of the elements, but you have have any combination of conditions you like:

	dragresize.isElement = function(elm)
	{
	 if (elm.className && elm.className.indexOf('drsElement') > -1) return true;
	};
	dragresize.isHandle = function(elm)
	{
	 if (elm.className && elm.className.indexOf('drsMoveHandle') > -1) return true;
	};

	// You can define optional functions that are called as elements are dragged/resized.
	// Some are passed true if the source event was a resize, or false if it's a drag.
	// The focus/blur events are called as handles are added/removed from an object,
	// and the others are called as users drag, move and release the object's handles.
	// You might use these to examine the properties of the DragResize object to sync
	// other page elements, etc.

	dragresize.ondragfocus = function() { };
	dragresize.ondragstart = function(isResize) { };
	dragresize.ondragmove = function(isResize) { };
	dragresize.ondragend = function(isResize) { };
	dragresize.ondragblur = function() { };

	// Finally, you must apply() your DragResize object to a DOM node; all children of this
	// node will then be made draggable. Here, I'm applying to the entire document.
	dragresize.apply(document);

	//]]>
}