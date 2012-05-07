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