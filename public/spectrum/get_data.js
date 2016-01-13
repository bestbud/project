var xmlHttp

function getdata(int)
{
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 } 
var url="get_data.php"
url=url+"?sid="+int
url=url+"&sidd="+Math.random()
xmlHttp.onreadystatechange=callback
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
} 

function callback(){
    if (this.readyState==4 || this.readyState=="complete"){
        if(this.status==200){
            if(this.responseXML !=null){
                 xmlDoc=this.responseXML;
                 document.getElementById("f0").innerHTML=
                 xmlDoc.getElementsByTagName("f0")[0].childNodes[0].nodeValue;
                 document.getElementById("bw").innerHTML=
                 xmlDoc.getElementsByTagName("bw")[0].childNodes[0].nodeValue;
                 document.getElementById("g").innerHTML=
                 xmlDoc.getElementsByTagName("g")[0].childNodes[0].nodeValue;
                 document.getElementById("nfft").innerHTML=
                 xmlDoc.getElementsByTagName("nfft")[0].childNodes[0].nodeValue;
                 document.getElementById("data").innerHTML=
                 xmlDoc.getElementsByTagName("data")[0].childNodes[0].nodeValue;
                 document.getElementById("create_time").innerHTML=
                 xmlDoc.getElementsByTagName("create_time")[0].childNodes[0].nodeValue;
            }else alert("Ajax error:未收到数据！"); 
        }else alert("Ajax error:"+this.statusText);
    }
}

function GetXmlHttpObject()
{ 
    var objXMLHttp=null
    if (window.XMLHttpRequest)
     {
     objXMLHttp=new XMLHttpRequest()
     }
    else if (window.ActiveXObject)
     {
     objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
     }
    return objXMLHttp
}
