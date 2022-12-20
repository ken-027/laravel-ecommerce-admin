

function sendEmail(){    
   const form =  document.getElementById('lost_psw_form');
   const route = form.getAttribute('action');
   const formData = new FormData(form);  

   $.ajax({
      url : route,
      type : 'post',
      data : formData,
      contentType: false,
      dataType: 'json',
      processData: false,
      error : errorReponse,
      success : function(response){
         Validator.removeErrors();
         successMessage(response.message,"message-wrapper")
      },
           
   })    
}

function resetPassword(){
    const form =  document.getElementById('reset_psw_form');
    const route = form.getAttribute('action');
    const formData = new FormData(form);   
    $.ajax({
       url : route,
       type : 'post',
       data : formData,
       contentType: false,
       dataType: 'json',
       processData: false,
       error : errorReponse,
       success : function(response){
          Validator.removeErrors();
          successMessage(response.message,"message-wrapper")
       },
            
    })   
}

const btnsendLink = document.getElementById('btn-send-email')
if(btnsendLink){
   btnsendLink.onclick = function(e) {
      e.preventDefault();
      sendEmail();
   }
}
const btnresetpassword = document.getElementById('btn-reset-password')
if(btnresetpassword){
    btnresetpassword.onclick = function(e) {
      e.preventDefault();
      resetPassword();
   }
}