//JavaScript Document

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