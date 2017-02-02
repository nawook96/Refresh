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
function doLogIn() {

 console.log("doSubmit");

 if(blankcheck(joinfrm.m_id,'아이디') || joinfrm.id_ch.value == false) {
  return;
 }

 if(blankcheck(joinfrm.m_pass,'비밀번호') || joinfrm.pass_ch.value == false) {
  return;
 }
 joinfrm.submit();
}
