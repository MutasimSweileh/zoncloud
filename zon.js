function getcountry(back){
    $.get("https://ipinfo.io", function(response) {
    console.log(response.city, response.country);
    return back(response);
}, "jsonp");
}
getcountry(function(res){
if(res.country != "EG"){
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

},1000); } });
