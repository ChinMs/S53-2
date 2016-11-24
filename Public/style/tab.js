function tab (mod,cursor,n){
	for(i=1;i<=n;i++){
		var nav=document.getElementById(mod+i);
		var cont=document.getElementById(mod+"_"+"cont"+i);
		nav.className=(i==cursor)?"current":"";
		cont.style.display=(i==cursor)?"block":"none";
	}
}

function copyToClipBoard(maintext)
{
 if (window.clipboardData) 
   {
   window.clipboardData.setData("Text", maintext);
   }
   else if (window.netscape) 
   { 
		try {
		netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
		} catch (e) {
		alert("您的firefox安全限制限制您进行剪贴板操作，请打开'about:config'将signed.applets.codebase_principal_support'设置为true'之后重试");
		return false;
		}
   var clip = Components.classes['@mozilla.org/widget/clipboard;1']
                 .createInstance(Components.interfaces.nsIClipboard);
   if (!clip) return;
   var trans = Components.classes['@mozilla.org/widget/transferable;1']
                  .createInstance(Components.interfaces.nsITransferable);
   if (!trans) return;
   trans.addDataFlavor('text/unicode');
   var str = new Object();
   var len = new Object();
   var str = Components.classes["@mozilla.org/supports-string;1"]
                .createInstance(Components.interfaces.nsISupportsString);
   var copytext=maintext;
   str.data=copytext;
   trans.setTransferData("text/unicode",str,copytext.length*2);
   var clipid=Components.interfaces.nsIClipboard;
   if (!clip) return false;
   clip.setData(trans,null,clipid.kGlobalClipboard);
   }
   alert("复制成功！");
   return false;
}

function submitSearch(o)
{
	if(o.key.value == '' || o.key.value == '输入书名或作者名' || o.key.value.match(/^\s+$/)){
		alert('请输入关键字');
		o.key.focus();
		return false;
	}
	return true;
}
function addHjpage(title) {
                     var url=parent.location.href;
                     if (window.sidebar) { 
                            window.sidebar.addPanel(title, url,""); 
                     } else if( document.all ) {
                     window.external.AddFavorite( url, title);
                     } else if( window.opera && window.print ) {
                     return true;
                     }
}