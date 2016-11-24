function setCookietest(name,value,days,path) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
 		if(path==undefined || path ==null || path==""){path="/";}
        document.cookie = name+"="+value+expires+";domain=.sodu.cc;path="+path;
}
 //复制页面
 function CopyToClipBoard(){
	window.clipboardData.setData("Text", document.title + '\r\nhttp://' + document.location.host + '/');
	alert("复制成功，请粘贴到你的QQ/MSN上推荐给你的好友，谢谢！");
}

function setCookie1(name, value, expire)
{
	var Days = expire; 
	var exp = new Date();
	exp.setTime(exp.getTime() + Days*24*60*60*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();		
}
function getCookie1(name)
{
	var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
	if(arr != null){
		return unescape(arr[2]); 
	}
	return null;
}
function WriteBg()
{
	var a=["#f3f4ff","#ffffed","#eefaee","#fcefff","#ffffff","#efefef"]
	var b=["blue","yellow","green","purple","red","black"]

	var j='';
	var bgColor1 = getCookie1('iwmsContBg');
	for(var i=0;i<a.length;i++){
		j  = i+1;
		document.write("<span id=\"theme"+j+"\" class=\""+(bgColor1==a[i] ?'current':(i==0?'current':''))+"\" alt='"+(i==a.length-1?"默认":b[i])+"' onclick='ContentBg(\""+(i==a.length?"":a[i])+"\","+j+","+a.length+")'>"+b[i]+"</span>");//,"+fcolor[i]+"
		
	}
	//var aaa = document.getElementById['theme1'].innerText;
	//alert(aaa);
}
function ContentBg(color,id,idlength)
{
	//alert(a.length);,fcolor
	//alert(fcolor);
	//alert(color);
	var obj=document.getElementById("bodyTd");
	obj.style.backgroundColor=color;
	//alert(arguments.length);
	if (arguments.length==3){
		setCookie1("iwmsContBg",color,color.length==0?-1:1);
		setCookie1("bgid",id,color.length==0?-1:1);
		setCookie1("bgidl",idlength,color.length==0?-1:1);
	}
	for(var i=1;i<=idlength;i++){
		if(i!=id){
			document.getElementById("theme"+i).className = '';
		}else{
		    document.getElementById("theme"+i).className = 'current';	
		}
		
	}
	//WriteBg();
}
