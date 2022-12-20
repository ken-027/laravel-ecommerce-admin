

function errorMessage(msg, wrapper){
    const errorwrapper =  document.getElementById(`${wrapper}`)
    errorwrapper.innerHTML =   `<div class="alert alert-danger mt-1 mb-1">
                          <div class="space-between">
                                <label class="message margin-0">${msg}</label>
                                <span class="closebtn" onclick="errorClose(this)"><i class="fas fa-times"></i></span>
                          </div> 
                       </div>`
}

function errorsMessage(errors, wrapper){    
    const errorWrapper = document.getElementById(`${wrapper}`)
    errorWrapper.innerHTML = ''
    if(errors.length == 0) return errorWrapper.innerHTML = ''  
    errors.forEach(error => {
        errorWrapper.innerHTML +=  `<div class="alert alert-danger mb-2">
                    <div class="space-between">
                            <label class="message margin-0">${error.message}</label>
                            <span class="closebtn" onclick="errorClose(this)"><i class="fas fa-times"></i></span>
                    </div> 
                </div>`            
    })    
}



function successMessage(message, wrapper) {  
    const errorWrapper = document.getElementById(`${wrapper}`)
    errorWrapper.innerHTML += `<div class="alert alert-success mb-2">
                                            <div class="space-between">
                                                <label class="message margin-0">${message}</label>
                                                <span class="closebtn" onclick="errorClose(this)"><i class="fas fa-times"></i></span>
                                            </div> 
                                        </div>`
}

function errorClose(e){
  let alert = e.closest('.alert')
  alert.remove();
}
