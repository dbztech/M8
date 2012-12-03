// JavaScript Document

var TimeToFade = 500.0;
var navSlideshowPics = new Array("/images/Slideshow/slideshow1.png","/images/Slideshow/slideshow2.png","/images/Slideshow/slideshow3.png","/images/Slideshow/slideshow4.png","/images/Slideshow/slideshow5.png");
var footerSlideshowPics = new Array("/images/Slideshow/slideshow1.png","/images/Slideshow/slideshow2.png","/images/Slideshow/slideshow3.png","/images/Slideshow/slideshow4.png","/images/Slideshow/slideshow5.png");

var navTimer = new Timer(4000, "navSlideshow.slide()");
var footerTimer = new Timer(10000, "footerSlideshow.slide()");
var navSlideshow = new Slideshow("navTimer", "headerimg1", navSlideshowPics, false, "");
var footerSlideshow = new Slideshow("footerTimer", "footer", footerSlideshowPics, false, "");


function load() {
	if (true) {
		navTimer.fire();
		//footerTimer.fire();
	}
	//articleSelect('Join the MPArors at our <i>FIRST</i> competition','/images/Regional.png','/Competition','article1');
}

function redirect(input) {
	window.location = input;
}

//Timer Code
function Timer (interval, command) {
    this.interval = interval;
    
    this.fire = function() {
        //Function to call
        setTimeout(command,this.interval);
    };
    this.rearm = function() {
        //Function to call
        this.fire();
    };
}

////////////////////
///Slideshow Code///
////////////////////

function Slideshow (timer, frame, files, buttons, buttonId) {
    this.frame = frame;
    this.files = files;
    this.totalSlides = this.files.length-1;
    
    this.timer = timer;
    this.currentSlide = 0;
    
    this.buttons = buttons;
    this.buttonGroup = buttonId;
    
    this.slide = function() {
        //Fade the slide
        this.currentSlide++;
        if (this.currentSlide > this.totalSlides) {
        	this.currentSlide = 0;
        }
        //console.log(this.currentSlide);
        setTimeout(this.timer+".rearm()",1);
        command = "document.getElementById('"+this.frame+"').style.background = 'url("+this.files[this.currentSlide]+")'";
        commandTwo = "fade('"+this.frame+"')";
        fade(this.frame);
        setTimeout(command,500);
        setTimeout(commandTwo,500);
    };
}


//Interactive Code
function interactiveArrow(idPrefix,targetSlide,currentSlide) {
    document.getElementById(idPrefix+currentSlide).style.display = "none";
    document.getElementById(idPrefix+targetSlide).style.display = "block";
}


////////////////////
//System Functions//
////////////////////

function delay(command, time) {
	setTimeout(command, time);
}


function fade(eid) {
  var element = document.getElementById(eid);
  if(element == null)
    return;
   
  if(element.FadeState == null) {
    if(element.style.opacity == null 
        || element.style.opacity == '' 
        || element.style.opacity == '1') {
      element.FadeState = 2;
    }
    else {
      element.FadeState = -2;
    }
  }
    
  if(element.FadeState == 1 || element.FadeState == -1) {
    element.FadeState = element.FadeState == 1 ? -1 : 1;
    element.FadeTimeLeft = TimeToFade - element.FadeTimeLeft;
  }
  else {
    element.FadeState = element.FadeState == 2 ? -1 : 1;
    element.FadeTimeLeft = TimeToFade;
    setTimeout("animateFade(" + new Date().getTime() + ",'" + eid + "')", 33);
  }  
}

function animateFade(lastTick, eid) {  
  var curTick = new Date().getTime();
  var elapsedTicks = curTick - lastTick;
  
  var element = document.getElementById(eid);
 
  if(element.FadeTimeLeft <= elapsedTicks) {
    element.style.opacity = element.FadeState == 1 ? '1' : '0';
    element.style.filter = 'alpha(opacity = ' 
        + (element.FadeState == 1 ? '100' : '0') + ')';
    element.FadeState = element.FadeState == 1 ? 2 : -2;
    return;
  }
 
  element.FadeTimeLeft -= elapsedTicks;
  var newOpVal = element.FadeTimeLeft/TimeToFade;
  if(element.FadeState == 1)
    newOpVal = 1 - newOpVal;

  element.style.opacity = newOpVal;
  element.style.filter = 'alpha(opacity = ' + (newOpVal*100) + ')';
  
  setTimeout("animateFade(" + curTick + ",'" + eid + "')", 33);
}

function switchvideo(video) {
	if (video == 1) {
		document.getElementById('video2').style.display = 'none';
		//document.getElementById('video2').src = 'http://www.youtube.com/embed/vYuOKb3gO7E';
		document.getElementById('video1').style.display = "block";
		video2.videoembed2.pause();
	}
	if (video == 2) {
		document.getElementById('video1').style.display = 'none';
		document.getElementById('video2').style.display = "block";
		//document.getElementById('video1').src = 'http://www.youtube.com/embed/i1QyM9WTF18';
		video1.videoembed1.pause();
	}
}

function boxClose() {
	document.getElementById('box').style.display = 'none';
	document.getElementById('box').style.width = 0;
	document.getElementById('box').style.height = 0;	
	//document.getElementById('video1').src = 'http://www.youtube.com/embed/i1QyM9WTF18';
	//document.getElementById('video2').src = 'http://www.youtube.com/embed/vYuOKb3gO7E';
	video1.videoembed1.pause();
	video2.videoembed2.pause();
}

function articleSelect(articleText, articleImage, articleLink, articleId) {
	document.getElementById('article1').style.background = "";
	document.getElementById('article2').style.background = "";
	document.getElementById('article3').style.background = "";
	document.getElementById('article4').style.background = "";
	document.getElementById('article5').style.background = "";
	document.getElementById('article6').style.background = "";
	document.getElementById('article7').style.background = "";
	document.getElementById('article8').style.background = "";
	document.getElementById('articleText').innerHTML = articleText;
	document.getElementById('newsFeed').style.background = 'url("'+articleImage+'")';
	document.getElementById('articleLink').href = articleLink;
	document.getElementById(articleId).style.background = '#78A600';
}