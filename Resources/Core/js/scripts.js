//JavaScript Document

var Selector = new selector;
var Cookie = new cookie;
var Dialog = new dialog;
var Page = new page;
var Variable = new variable;

var lastAjax = "Not set";

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
	  	//console.log(xmlhttp.responseText);
		lastAjax = xmlhttp.responseText;
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
		
		if (group == "settings") {
			if (id == "settings") {
				this.counter[0] = "users"
			}

			if (id == "users") {
				this.counter[0] = "settings"
			}
		}

		for (var i = this.counter.length - 1; i >= 0; i--) {
			this.turnOn(id);
			this.turnOff(this.counter[i]);
			this.show(id);
			this.hide(this.counter[i]);
		}
	}

	this.turnOff = function(id) {
		document.getElementById(id+'Button').setAttribute("class", "deselected");
	}

	this.turnOn = function(id) {
		document.getElementById(id+'Button').setAttribute("class", "selected");
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

function page() {
	this.write = function(id, column) {
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

	this.remove = function(id) {
		var query = "DELETE FROM `pages` WHERE `id` = "+id;
		//console.log(query);
		ajax("query", query);
		delay('ajax("pages", "")', 200);
		delay("document.getElementById('pagestable').innerHTML = lastAjax", 1600);
	}
}

function variable() {
	this.write = function(id) {
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

	this.remove = function(id) {
		var query = "DELETE FROM `variables` WHERE `id` = "+id;
		//console.log(query);
		ajax("query", query);
		delay('ajax("variables", "")', 200);
		delay("document.getElementById('variablestable').innerHTML = lastAjax", 1600);
	}
	
	this.addDialog = function() {
		Dialog.open("Add Variable", "Please Wait...");
		Dialog.setContent('addvariable.php');
	}
	
	this.add = function() {
		var name = document.getElementById('newvariablename').value;
		var value = document.getElementById('newvariablevalue').value;
		var type = document.getElementById('newvariableselector').value;
		var query = "INVALID";
		if (type == 0) {
			query = "INSERT INTO `variables` (`name`, `type`, `num`, `text`, `location`, `zone`, `boolean`, `id`) VALUES ('"+name+"', '0', '"+value+"', NULL, NULL, NULL, NULL, NULL);";
		} else if (type == 1) {
			query = "INSERT INTO `variables` (`name`, `type`, `num`, `text`, `location`, `zone`, `boolean`, `id`) VALUES ('"+name+"', '1', NULL, '"+value+"', NULL, NULL, NULL, NULL);";
		} else if (type == 2) {
			query = "INSERT INTO `variables` (`name`, `type`, `num`, `text`, `location`, `zone`, `boolean`, `id`) VALUES ('"+name+"', '2', NULL, NULL, '"+value+"', NULL, NULL, NULL);";
		} else if (type == 3) {
			query = "INSERT INTO `variables` (`name`, `type`, `num`, `text`, `location`, `zone`, `boolean`, `id`) VALUES ('"+name+"', '3', NULL, NULL, NULL, '"+value+"', NULL, NULL);";
		} else if (type == 4) {
			query = "INSERT INTO `variables` (`name`, `type`, `num`, `text`, `location`, `zone`, `boolean`, `id`) VALUES ('"+name+"', '4', NULL, NULL, NULL, NULL, '"+value+"', NULL);";
		}
		ajax("query", query);
		delay('ajax("variables", "")', 200);
		delay("document.getElementById('variablestable').innerHTML = lastAjax", 1600);
		Dialog.close();
	}
	
	this.setAddFormType = function() {
		var type = document.getElementById('newvariableselector').value;
		if (type == 0) {
			document.getElementById('newvariablevalue').type = "number";
		} else if (type == 1) {
			document.getElementById('newvariablevalue').type = "text";
		} else if (type == 2) {
			document.getElementById('newvariablevalue').type = "text";
		} else if (type == 3) {
			document.getElementById('newvariablevalue').type = "text";
		} else if (type == 4) {
			document.getElementById('newvariablevalue').type = "number";
		}
	}
	
	this.enlarge = function(id) {
		var context = document.getElementById(id+'varvalue');
		var text = context.value;
		Dialog.open('Edit variable', '<form><textarea id="variabledetail" style="width: 400px; height: 150px; margin: 0px; resize: vertical;">'+text+'</textarea><input type="button" onClick="Variable.writeDetail('+id+')" value="Submit Changes" /></form>');
	}
	
	this.writeDetail = function(id) {
		document.getElementById(id+'varvalue').value = document.getElementById('variabledetail').value;
		this.write(id);
		Dialog.close();
	}
}

function dialog() {
	this.open = function(title, content) {
		document.getElementById('dialog').style.display = "block";
		document.getElementById('dialogTitle').innerHTML = title;
		document.getElementById('dialogContent').innerHTML = content;
	}
	
	this.setContent = function(page) {
		ajax("content", page);
		delay("document.getElementById('dialogContent').innerHTML = lastAjax",1600);
	}

	this.close = function() {
		document.getElementById('dialog').style.display = "none";
	}
}

function is_int(value){ 
  if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
      return true;
  } else { 
      return false;
  } 
}