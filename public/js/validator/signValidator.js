document.addEventListener("DOMContentLoaded", () => {
    
    
    //Formulaire création de compte
    const firstname = document.querySelector("#firstname");
    const lastname = document.querySelector("#lastname");
    const email = document.querySelector("#email");
    const password1 = document.querySelector("#password");
    const password2 = document.querySelector("#pass");
    const formSign = document.querySelector("#form-sign");
    const globalErr = document.querySelector("#global-error");
    const errors = document.querySelectorAll(".error");
    const regExMail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    const regExPass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[*.!@$%^&(){}[\]]).{8,20}$/gm;
    
   
    formSign.addEventListener("submit", (e) => {
        
        e.preventDefault();
        
        setTimeout(function() {
            errors.forEach(error => {
            error.classList.add("hidden");
        }); }, 5000);
        
        const firstnameVal = firstname.value.trim();
        const lastnameVal = lastname.value.trim();
        const emailVal = email.value;
        const password1Val = password1.value;
        const password2Val = password2.value;
        
        if( firstnameVal == "" || lastnameVal == "" || emailVal == "" || password1Val == "" || password2Val == "" )
        {
            globalErr.classList.remove("hidden");
        }
        
        if( !regExPass.test(password1Val) )
        {
            
            password1.nextElementSibling.classList.remove("hidden");
            
        } else if ( password1Val != password2Val )
        {
            
            password2.nextElementSibling.classList.remove("hidden");
            
            
        } else  if( firstnameVal.length < 2 || firstnameVal > 75 )
        {
            
            firstname.nextElementSibling.classList.remove("hidden");
            
        } else if( lastnameVal.length < 2 || lastnameVal > 75 )
        {
            
            lastname.nextElementSibling.classList.remove("hidden");
            
        } else if( !regExMail.test(emailVal) )
        {
            
            email.nextElementSibling.classList.remove("hidden");
            
        } else
        {
            let xhr = new XMLHttpRequest();
            
            let dataToSend = new FormData();
            dataToSend.set( 'firstname', firstnameVal );
            dataToSend.set( 'lastname', lastnameVal );
            dataToSend.set( 'email', emailVal );
            dataToSend.set( 'password', password1Val );
            dataToSend.set( 'pass', password2Val );
       
            xhr.open('POST', 'index.php?route=newAccount', true);
            xhr.send( dataToSend );
            document.location.href = "index.php?route=home";
        }
        
    });
    
})