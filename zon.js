function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function addScript( src ) {
    var s = document.createElement( 'script' );
    s.setAttribute( 'src', "//native.propellerclick.com/1?z="+src );
    s.setAttribute( 'data-cfasync', false );
    s.setAttribute( 'async', "async" );
    document.body.appendChild( s );
}
function addZons(){
var ar = [3103584,3104338,3103597];
for(var i=0;i<ar.length;i++){
    var zonid = ar[i];
      addScript(zonid);

    }
}
function getcountry(back){
    $.get("https://ipinfo.io", function(response) {
    console.log(response.city, response.country);
    return back(response);
}, "jsonp");
}
getcountry(function(res){
//if(res.country != "EG"){
var inr = setInterval(function(){
var ar = [3103584,3104338];
for(var i=0;i<ar.length;i++){
    var zonid = ar[i];
if($("#_lz3htw_"+zonid).length > 0)
clearInterval(inr);
if(getCookie("_lz3htw_"+zonid)){
$("#_lz3htw_"+zonid).removeClass("_lz3htw_3104338");
}else{
$("#_lz3htw_"+zonid).attr("class","_lz3htw_3104338");
$('*').on("click",function(event) {
         var el = $(this);
         var cel = el.closest("div[id^=_lz3htw_]");
         cel.removeClass("_lz3htw_3104338");
         setCookie(""+cel.attr("id"),true,1);

}); }
   }
console.log("setInterval");

},1000); 
//} 
           });
addZons();
console.log("zloaded !!");
