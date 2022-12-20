class AppAccount {
    
static submitUpdate(){          
    const form = document.getElementById('form-update-profile');
    const route = form.getAttribute('action');
    const formData = new FormData(form);  
  
    $.ajax({
        url : route,
        type : 'post',
        data : formData,
        contentType: false,
        dataType: 'json',
        processData: false,
        success : function(response){
            successMessage(response.message, 'notify-update-profile')
        },
        error : function(response){
            const errors = [];
            let resErrors =  response.responseJSON.errors      
            if(response.status === 422){            
                for(const key in resErrors) errors.push({ name : key , message  : resErrors[key] })
                errorMessage(errors,'notify-update-profile');
            }
           
        }            
    })
  }  
  
 static submutUpdateAddress(){
    const form = document.getElementById('form-update-address');
    const route = form.getAttribute('action');
    const formData = new FormData(form);  
  
    $.ajax({
        url : route,
        type : 'post',
        data : formData,
        contentType: false,
        dataType: 'json',
        processData: false,
        success : function(response){
            successMessage(response.message, 'notify-update-address')
        },
        error : function(response){
            const errors = [];
            let resErrors =  response.responseJSON.errors      
            if(response.status === 422){            
                for(const key in resErrors) errors.push({ name : key , message  : resErrors[key] })
                errorMessage(errors, 'notify-update-address');
            }
           
        }            
    })
  }
  
  static submitUpdatePassword(){
    const form = document.getElementById('form-update-password');
    const route = form.getAttribute('action');
    const formData = new FormData(form);  
  
    $.ajax({
        url : route,
        type : 'post',
        data : formData,
        contentType: false,
        dataType: 'json',
        processData: false,
        success : function(response){
            successMessage(response.message, 'notify-update-password' )
        },
        error : function(response){
            const errors = [];
            let resErrors =  response.responseJSON.errors      
            if(response.status === 422){            
                for(const key in resErrors) errors.push({ name : key , message  : resErrors[key] })
                errorMessage(errors, 'notify-update-password');
            }
           
        }            
    })
  }

}







const navAccountItem =  document.querySelectorAll('[nav-toggle]')


function navContentRemoveActive()
{
  const navContent = document.querySelectorAll('.nav-content');
  navContent.forEach(element => {
     element.classList.remove('active')
  })
}

navAccountItem.forEach(element => {
  element.onclick = function() {
    navContentRemoveActive();
    const content = document.querySelector(`.${element.getAttribute('target')}`)        
    content.classList.add('active')
  }
})

const btnUpdateProfile = document.getElementById('btn-update-profile');
const btnUpdateAddress = document.getElementById('btn-update-address');
const bntUpdatePassword = document.getElementById('btn-update-password');

if (btnUpdateProfile){
  btnUpdateProfile.onclick = function(e) { 
    e.preventDefault();
    AppAccount.submitUpdate();               
    }
}

if (btnUpdateAddress){
  btnUpdateAddress.onclick = function(e){
    e.preventDefault();
    AppAccount.submutUpdateAddress()
  }
}

if (bntUpdatePassword){
  bntUpdatePassword.onclick = function(e){
    e.preventDefault();
    AppAccount.submitUpdatePassword();
  }
}
