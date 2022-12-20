const btnsign = document.getElementById('btn-login')
if(btnsign){
   btnsign.onclick = function(e) {
      e.preventDefault();
      submit()      
    }
}
function submit(){    
   const form = document.getElementById('login_form');
   const formdata = new FormData(form);
   $.ajax({
      url : form.getAttribute('action'),
      type : 'post',
      data : formdata,
      contentType: false,
      dataType: 'json',
      processData: false,
      sync:false,
      success : successResponse,
      error : errorReponse,
   });
}
function successResponse(response){
   Validator.removeErrors();
   if (response.is_auth) return window.location.href = response.url;
   errorMessage('Invalid credentials','error-wrapper')      
}

function errorReponse(xhr){
   const errors = [];
   const resErrors = xhr.responseJSON.errors;  
   for(const key in resErrors) errors.push({name : key, message : resErrors[key][0] }) 
   Validator.showErrors(errors)    
}

function redirectResponse(response){  
   window.location.href = response.url
}
