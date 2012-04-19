//JavaScript Document

function load() {
	document.getElementById('splashcontinue').style.display = "block";
}

function unveil() {
	document.getElementById('splashcontinue').className = "unveil";
	document.getElementById('splashtext').className = "unveil";
	delay('document.getElementById("splashcontinue").style.right = "100%";',950);
	delay('document.getElementById("splashtext").style.right = "100%";',950);
}

function delay(command, time) {
	setTimeout(command, time);
}