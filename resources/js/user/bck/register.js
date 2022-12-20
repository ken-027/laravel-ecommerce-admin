$('#btn-signup').click(function(e) {
    e.preventDefault();  
    signup();
})

function signup(e){    
    const form =  document.getElementById('signup_form');
    const route = form.getAttribute('action');
    const formData = new FormData(form);  
    Validator.removeErrors();
    $.ajax({
        url : route,
        type : 'post',
        data : formData,
        contentType: false,
        dataType: 'json',
        processData: false,
        success : redirectResponse,
        error : errorReponse,     
    })    
}
