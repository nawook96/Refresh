function atrim(str){
  return str.replace(/\s/g,'');
}
function blankcheck(el,msg){
 if(el.value==""){
  alert(msg+"를(을) 입력해주세요.");
  el.focus();
  return true;
 }
 if(el.value.length != atrim(el.value).length){
  alert(msg+"에는 공백을 허용하지 않습니다.");
  el.focus();
  return true;
 }
}
function doSubmit() {

 console.log("doSubmit");

 if(blankcheck(joinfrm.ad_name,'이름')) {
  return;
 }
 joinfrm.submit();
}
