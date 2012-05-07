//JavaScript Document

var Selector = new selector;

function load() {
	document.getElementById('splashcontinue').style.display = "block";
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

function ajax(type, query) {
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
	  	console.log("Query failed");
	    return(false);
	  }
	}
	xmlhttp.open("GET","Resources/Core/ajax.php?type="+type+"&query="+query,true);
	xmlhttp.send();
}

function selector() {
	this.setCurrent = function(id, group) {
		this.onColor = "#FFF";
		this.offColor = "#33B5E5";

		if (group == "overview") {
			if (id == "info") {
				document.getElementById(id+'Button').style.color = "#FFF";
				document.getElementById('statusButton').style.color = "#33B5E5";

				document.getElementById(id).style.display = "block";
				document.getElementById('status').style.display = "none";
			}

			if (id == "status") {
				document.getElementById(id+'Button').style.color = "#FFF";
				document.getElementById('infoButton').style.color = "#33B5E5";

				document.getElementById(id).style.display = "block";
				document.getElementById('info').style.display = "none";
			}
		}

		if (group == "variables") {
			if (id == "editVariables") {
				this.turnOn(id);
				this.turnOff('searchButton');
				this.show(id);
				this.hide('search');
			}

			if (id == "search") {
				this.turnOn(id);
				this.turnOff('editVariablesButton');
				this.show(id);
				this.hide('editVariables');
			}
		}
	}

	this.turnOff = function(id) {
		document.getElementById(id).style.color = this.offColor;
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