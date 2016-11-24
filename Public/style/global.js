function ContentSize(size)
{
	var obj=document.getElementById("fontsize");
	obj.style.fontSize=size>0 ? size+"px" : "";
	if (arguments.length==1){
		setCookie1("iwmsFontSize",size,size==0?-1:1);
	}
	
	if(size==14 || size == null){
		document.getElementById('current2').className='';
		document.getElementById('current3').className='';		
		document.getElementById('current1').className='current';

	}else if(size==16){
		document.getElementById('current1').className='';
		document.getElementById('current3').className='';		
		document.getElementById('current2').className='current';
		
	}else if(size==18){
        document.getElementById('current2').className='';
		document.getElementById('current1').className='';
		document.getElementById('current3').className='current';
	}
	
}  

  
//ÉèÖÃ±³¾°ÑÕÉ«ºÍ×ÖºÅ
var bgColor = getCookie1('iwmsContBg');
var bgid = getCookie1('bgid');
var bgidl = getCookie1('bgidl');
var fontSize = getCookie1('iwmsFontSize');

if(bgColor != null){
	ContentBg(bgColor,bgid,bgidl);
}

if(fontSize != null){
	ContentSize(fontSize);
}
	if(fontSize==14 || fontSize == null){
		document.getElementById('current2').className='';
		document.getElementById('current3').className='';		
		document.getElementById('current1').className='current';

	}else if(fontSize==16){
		document.getElementById('current1').className='';
		document.getElementById('current3').className='';		
		document.getElementById('current2').className='current';
		
	}else if(fontSize==18){
        document.getElementById('current2').className='';
		document.getElementById('current1').className='';
		document.getElementById('current3').className='current';
	}

window.onload = function(){
	for(i=1;i<3;i++){
		(function(){
		var name=document.getElementById("pull"+i);
		var tt=document.getElementById("pulltxt"+i);
		name.onmouseover=function(){tt.style.display="block";}
		name.onmouseout=function(){tt.style.display="none";}
		})();
	}
	init();
};