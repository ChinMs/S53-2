function shuqian(){
 	var jtop=$(document).scrollTop()+document.documentElement.clientHeight-500-document.getElementById ("shuqianDiv").offsetHeight;
	var jleft=$(document).scrollLeft()+document.documentElement.clientWidth-0-document.getElementById ("shuqianDiv").offsetWidth;
	$("#shuqianDiv").css("top",jtop+"px");
	$("#shuqianDiv").css("right","-20px");
}
window.onload=shuqian;

//œ‘ æ“˛≤ÿ≤„¿‡
function LeeHover(a,b){
b.css("display","none");
function hideObj(obj){
obj.hide();
}
var t;
a.hover(
function(){clearTimeout(t);b.show();},
function(){t=setTimeout(function(){hideObj(b)},500);}
);
b.hover(
function(){clearTimeout(t);},
function(){t=setTimeout(function(){hideObj(b)},500);}
);
}

//≤‡±ﬂ


$(function(){

//µº∫Ω
LeeHover($("#m_member"),$("#mm_member"));
LeeHover($("#m_channel"),$("#channel_list"));
LeeHover($("#m_channel2"),$("#channel_list2"));

var fontColor=$.cookie("fontColor");
var fontSize=$.cookie("fontSize");
var side=$.cookie("side");
if(fontColor)$("body").css("background",fontColor);
if(fontSize)$("#content").css("fontSize",fontSize);


$("#fontColor span").click(function(){
  var v=$(this).attr("v");
  $("body").css("background",v);
  $.cookie("fontColor",v,{expires:30});
});
$("#fontSize span").click(function(){
  var v=$(this).attr("v");
  $("#content").css("fontSize",v);
  $.cookie("fontSize",v,{expires:30});
});
loginBox();
window.onscroll=loginBox;
window.onresize=loginBox;
});


function loginBox(){
  var top=$(document).scrollTop()+document.documentElement.clientHeight-30;
  $("#login").css("top",top+"px");
    shuqian();
}

var speed = 5;
var currentpos=1;
var timer;

function killErrors() { 
	return true; 
} 
window.onerror = killErrors;

function setCookies(cookieName,cookieValue, expirehours)
{
  var today = new Date();
  var expire = new Date();
  expire.setTime(today.getTime() + 3600000 * 356 * 24);
  document.cookie = cookieName+'='+escape(cookieValue)+ ';expires='+expire.toGMTString();
}
function ReadCookies(cookieName)
{
	var theCookie=''+document.cookie;
	var ind=theCookie.indexOf(cookieName);
	if (ind==-1 || cookieName=='') return ''; 
	var ind1=theCookie.indexOf(';',ind);
	if (ind1==-1) ind1=theCookie.length;
	return unescape(theCookie.substring(ind+cookieName.length+1,ind1));
}
function saveSet()
{
setCookies("scrollspeed",booktexts.scrollspeed.options[booktexts.scrollspeed.selectedIndex].value);
}
function stopScroll()
{
    clearInterval(timer);
}
function beginScroll()
{
	timer=setInterval("scrolling()",300/speed);
}

function setSpeed()
{
	speed = parseInt(document.booktexts.scrollspeed.options[document.booktexts.scrollspeed.selectedIndex].value);
	if (speed < 1 || speed > 10){
	   speed=5;
	   document.booktexts.scrollspeed.selectedIndex = 5;
	}
}
function scrolling()
{
	currentpos=document.documentElement.scrollTop;
    window.scroll(0,++currentpos);
    if(currentpos!=document.documentElement.scrollTop) clearInterval(timer);
}

function loadSet()
{
	var tmpstr;		
    tmpstr = ReadCookies("scrollspeed");
	if (tmpstr != "")
	{
	 for (var i=0;i<document.booktexts.scrollspeed.length;i++)
		{
			if (document.booktexts.scrollspeed.options[i].value == tmpstr)
			{
				document.booktexts.scrollspeed.selectedIndex = i;
				break;
			}
		}
      setSpeed();
	}
}
function getx(e){ 
  var l=e.offsetLeft; 
  while(e=e.offsetParent){ 
    l+=e.offsetLeft; 
  } 
  return(l+'px'); 
} 
function gety(e){ 
  var l=e.offsetTop; 
  while(e=e.offsetParent){ 
    l+=e.offsetTop; 
  } 
  return(l+'px'); 
} 

document.onmousedown=stopScroll;
document.ondblclick=beginScroll;
loadSet();