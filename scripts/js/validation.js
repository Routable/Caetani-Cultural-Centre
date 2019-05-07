function validateEditArtist(){
  var saveBtn = document.getElementById("saveButton");
  saveBtn.disabled = true;
  var afn = document.getElementById("firstName").value;
  var afnEr = document.getElementById("arFName-error");
  afnEr.style.display='none';
  var aln = document.getElementById("lastName").value;
  var alnEr = document.getElementById("arLName-error");
  alnEr.style.display='none';
  var ad = document.getElementById("artistBio").value;
  var adEr = document.getElementById("arDesc-error");
  adEr.style.display='none';
  
  var valid = true;
  
  if(isEmpty(afn)){
      afnEr.style.display='inherit';
      valid = false;
  }
  if(isEmpty(aln)){
      alnEr.style.display='inherit';
      valid = false;
  }
  if(isEmpty(ad)){
      adEr.style.display='inherit';
      valid = false;
  }
  
  if(valid){
      saveBtn.disabled = false;      
  }
}

function validateEditExhibit(){
  var saveBtn = document.getElementById("saveButton");
  saveBtn.disabled = true;
  var et = document.getElementById("exhibitTitle").value;
  var etEr = document.getElementById("exTitle-error");
  etEr.style.display='none';
  var ed = document.getElementById("exhibitDesc").value;
  var edEr = document.getElementById("exDesc-error");
  edEr.style.display='none';
  var ofn = document.getElementById("fieldName").value;
  var ofc = document.getElementById("fieldContent").value;
  var ofcEr = document.getElementById("ofCont-error");
  ofcEr.style.display='none';
  var afn = document.getElementById("artistFName").value;
  var afnEr = document.getElementById("arFName-error");
  afnEr.style.display='none';
  var aln = document.getElementById("artistLName").value;
  var alnEr = document.getElementById("arLName-error");
  alnEr.style.display='none';
  var ad = document.getElementById("artistBio").value;
  var adEr = document.getElementById("arDesc-error");
  adEr.style.display='none';
  var cn = document.getElementById("catName").value;
  var cnEr = document.getElementById("catName-error");
  cnEr.style.display='none';
  
  var as = document.getElementById("artistSelect").value;
  var cs = document.getElementById("categorySelect").value;
  var valid = true;
  
  if(isEmpty(et)){
      etEr.style.display='inherit';
      valid = false;
  }
  if(isEmpty(ed)){
      edEr.style.display='inherit';
      valid = false;
  }
  if(!isEmpty(ofn)){      
      if(isEmpty(ofc)){
          ofcEr.style.display='inherit';
          valid = false;
      }
  }
  if(as == "addnew"){
      if(isEmpty(afn)){
          afnEr.style.display='inherit';
          valid = false;
      }
      if(isEmpty(aln)){
          alnEr.style.display='inherit';
          valid = false;
      }
      if(isEmpty(ad)){
          adEr.style.display='inherit';
          valid = false;
      }
  }
  if(cs == "addnew"){
      if(isEmpty(cn)){
          cnEr.style.display='inherit';
          valid = false;
      }
  }
  
  if(valid){
      saveBtn.disabled = false;      
  }
}

function validateCreateExhibit(){
  var addBtn = document.getElementById("addBtn");
  addBtn.disabled = true;
  var et = document.getElementById("exTitle").value;
  var etEr = document.getElementById("exTitle-error");
  etEr.style.display='none';
  var ed = document.getElementById("exDesc").value;
  var edEr = document.getElementById("exDesc-error");
  edEr.style.display='none';
  var ofn = document.getElementById("ofName").value;
  var ofnEr = document.getElementById("ofName-error");
  ofnEr.style.display='none';
  var ofc = document.getElementById("ofCont").value;
  var ofcEr = document.getElementById("ofCont-error");
  ofcEr.style.display='none';
  var afn = document.getElementById("arFName").value;
  var afnEr = document.getElementById("arFName-error");
  afnEr.style.display='none';
  var aln = document.getElementById("arLName").value;
  var alnEr = document.getElementById("arLName-error");
  alnEr.style.display='none';
  var ad = document.getElementById("arDesc").value;
  var adEr = document.getElementById("arDesc-error");
  adEr.style.display='none';
  var cn = document.getElementById("catName").value;
  var cnEr = document.getElementById("catName-error");
  cnEr.style.display='none';
  var fs = document.getElementById("fieldSelect").value;
  var as = document.getElementById("artistSelect").value;
  var cs = document.getElementById("categorySelect").value;
  var valid = true;
  
  if(isEmpty(et)){
      etEr.style.display='inherit';
      valid = false;
  }
  if(isEmpty(ed)){
      edEr.style.display='inherit';
      valid = false;
  }
  if(fs == "addnew"){
      if(isEmpty(ofn)){
          ofnEr.style.display='inherit';
          valid = false;
      }
      if(isEmpty(ofc)){
          ofcEr.style.display='inherit';
          valid = false;
      }
  }
  if(as == "addnew"){
      if(isEmpty(afn)){
          afnEr.style.display='inherit';
          valid = false;
      }
      if(isEmpty(aln)){
          alnEr.style.display='inherit';
          valid = false;
      }
      if(isEmpty(ad)){
          adEr.style.display='inherit';
          valid = false;
      }
  }
  if(cs == "addnew"){
      if(isEmpty(cn)){
          cnEr.style.display='inherit';
          valid = false;
      }
  }
  
  if(valid){
      addBtn.disabled = false;      
  }
}

function validateCreateUser() {
  var e1 = document.forms["createUser"]["email"].value;
  var e2 = document.forms["createUser"]["emailconfirm"].value;
  var fN = document.forms["createUser"]["firstname"].value;
  var lN = document.forms["createUser"]["lastname"].value;
  var r = document.forms["createUser"]["role"].value;
  var crtBtn = document.getElementById("createButton");
  var ceEr = document.getElementById("cemail-error");
  var eEr = document.getElementById("email-error");
  var valid = true;
  ceEr.style.display='none';  
  eEr.style.display='none';
  crtBtn.disabled = true;
  
  if(!validateEmail(e1)){      
      eEr.style.display='inherit';
      valid = false;
  }
  if(e1 != e2){
      ceEr.style.display='inherit';
      valid = false;
  }    
  if (isEmpty(e1) || isEmpty(e2) || isEmpty(fN) || isEmpty(lN) || isEmpty(r)) {
      valid = false;
      
  }    
  if(valid){
      crtBtn.disabled = false;      
  }
  
}

function validateUpdatePassword() {
  var cP = document.forms["updatePassword"]["currentPassword"].value;
  var nP = document.forms["updatePassword"]["newPassword"].value;
  var cNP = document.forms["updatePassword"]["passwordConfirm"].value;
  var upPwBtn = document.getElementById("updatePass");
  var cpEr = document.getElementById("cpass-error");
  var pEr = document.getElementById("pass-error");
  var valid = true;
  upPwBtn.disabled = true; 
  cpEr.style.display='none';
  pEr.style.display='none';
  
  if(!validatePassword(nP)){
      pEr.style.display='inherit';
      valid = false;
  }
  if(cNP != nP){      
      cpEr.style.display='inherit';
      valid = false;
  }  
  if (isEmpty(cP) || isEmpty(nP) || isEmpty(cNP)) {
       valid = false;            
  }
  if (valid){
      upPwBtn.disabled = false;
      
  }
}


function validateUpdateEmail() {
  
  var pw = document.forms["updateEmail"]["currentPassword"].value;
  var nE = document.forms["updateEmail"]["newEmail"].value;
  var cNE = document.forms["updateEmail"]["emailConfirm"].value;
  var upEBtn = document.getElementById("updateEmail");
  var ceEr = document.getElementById("ucemail-error");
  var eEr = document.getElementById("uemail-error");
  var valid = true;
  ceEr.style.display='none';  
  eEr.style.display='none';
  upEBtn.disabled = true;
  
  if(!validateEmail(nE)){      
      eEr.style.display='inherit';      
      valid = false;
  }
  if(nE != cNE){        
      ceEr.style.display='inherit';
      valid = false;
  } 
  if (isEmpty(pw) || isEmpty(nE) || isEmpty(cNE)) {
      valid = false;                   
  }
  if(valid){        
      upEBtn.disabled = false;
      ceEr.style.display='none';
      eEr.style.display='none';
  }
}

function validateDisableAccount() {
  var a = document.forms["deactivateUser"]["accountSelect"].value;
  var cfChk = document.getElementById("confChk");
  var deBtn = document.getElementById("deactBtn");
  
  if (a != "select" && cfChk.checked) {
      deBtn.disabled = false;
      
  }
  else{
      deBtn.disabled = true;
  }
}

function isEmpty(s){
  if(s.trim().length === 0){
      return true;
  }
  else{
      return false;
  }
}

function validateEmail(email){
  var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  return emailPattern.test(email);
}

function validatePassword(pw){
  var pwPattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,50}/;
  return pwPattern.test(pw);
}