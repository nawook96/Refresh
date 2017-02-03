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

 if(blankcheck(joinfrm.m_id,'아이디') || joinfrm.id_ch.value == false) {
  return;
 }

 if(blankcheck(joinfrm.m_pass,'비밀번호') || joinfrm.pass_ch.value == false) {
  return;
 }

 if(blankcheck(joinfrm.m_pass_ch,'비밀번호'))
  return;

 if(blankcheck(joinfrm.m_name,'이름'))
  return;

 if(blankcheck(joinfrm.m_year,'년도'))
  return;

 if(blankcheck(joinfrm.m_tel1,'전화'))
  return;
 if(blankcheck(joinfrm.m_tel2,'전화'))
  return;
 if(blankcheck(joinfrm.m_tel3,'전화'))
  return;
 joinfrm.m_tel.value = joinfrm.m_tel1.value+"-"+joinfrm.m_tel2.value+"-"+joinfrm.m_tel3.value;
 if(blankcheck(joinfrm.m_gender,'성별'))
  return;

 if(blankcheck(joinfrm.m_email,'이메일' || joinfrm.email_ch.value == false))
  return;
 joinfrm.submit();
}

$(document).ready(function() {
 var check_Eng= /[a-z]|[A-Z]/;
 var check_Num= /[0-9]/;
 var check_Num_Eng= /[0-9]|[a-z]|[A-Z]/;
 var check_kor = /([^가-힣ㄱ-ㅎㅏ-ㅣ\x20])/i;
 var check_year = /[1900-2020]/;
 var check_email = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
 $("#m_id").change(function(){
  joinfrm.id_ch.value = false;
  console.log('1. '+joinfrm.id_ch.value);
  var id = joinfrm.m_id.value;
  var id_flag = false;
  if(id.match(check_Num_Eng) == null || id.match(check_Eng) == null){
   $("#info_id1").css("color","red");
   id_flag = true;
  }else{$("#info_id1").css("color","blue");}

  if(id.length<5 || id.length >13){
   $("#info_id2").css("color","red");
   id_flag = true;
  }else{$("#info_id2").css("color","blue");}
  if(id_flag){
   joinfrm.m_id.focus();
   return;
  }
  joinfrm.id_ch.value = true;
  console.log('2. '+joinfrm.id_ch.value);
 });

 $("#m_pass").change(function(){
  joinfrm.pass_ch.value = false;
  var pass = joinfrm.m_pass.value;
  var pass_flag = false;
  if(pass.match(check_Num_Eng) == null || pass.match(check_Num) == null || pass.match(check_Eng) == null){
   $("#info_pass1").css("color","red");
   pass_flag = true;
  }else{$("#info_pass1").css("color","blue");}
  if(pass.length<8){
   $("#info_pass2").css("color","red");
   pass_flag = true;
  }else{$("#info_pass2").css("color","blue");}
  if(pass_flag){
   joinfrm.m_pass.focus();
   return;
  }
  joinfrm.pass_ch.value = true;
  console.log(pass);

 });

 $("#m_pass_ch").change(function() {
  joinfrm.pass_ch.value = false;
  if(joinfrm.m_pass_ch.value != joinfrm.m_pass.value){
   alert("비밀번호가 일치하지 않습니다.");
   $("#pass_ch_notice").css("display","block");
   joinfrm.m_pass_ch.focus();
   return;
  }
  alert("비밀번호가 일치합니다.");
  $("#pass_ch_notice").css("display","none");
  joinfrm.pass_ch.value = true;
 });

 $("#m_email").change(function(){
  joinfrm.email_ch.value = false;
  if(!joinfrm.m_email.value.match(check_email)){
   $("#email_notice").css("display","block");
   joinfrm.m_email.focus();
   return;
  }
  $("#email_notice").css("display","none");
  joinfrm.email_ch.value = true;
 });
});
