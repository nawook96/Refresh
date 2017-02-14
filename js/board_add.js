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

if(blankcheck(joinfrm.c_name,'카테고리 이름') || joinfrm.name_ch.value == false) {
 return;
 }
 joinfrm.submit();
}


$(document).ready(function() {
 var check_kor = /([^가-힣ㄱ-ㅎㅏ-ㅣ\x20])/i;
 $("#c_name").change(function(){
  joinfrm.name_ch.value = false;
  console.log('1. '+joinfrm.name_ch.value);
  var name = joinfrm.c_name.value;
  var name_flag = false;
  if(check_kor.test(name)){
   $("#info_name1").css("color","red");}
   else{$("#info_name1").css("color","blue");
name_flag = true;
}

  if(name.length<2 || name.length >8){
   $("#info_name2").css("color","red");
   name_flag = true;
 }else{$("#info_name2").css("color","blue");}
  if(name_flag){
   joinfrm.c_name.focus();
   return;
  }
  joinfrm.name_ch.value = true;
  console.log('2. '+joinfrm.name_ch.value);
 });

});
