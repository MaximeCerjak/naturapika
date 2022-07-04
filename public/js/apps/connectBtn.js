let btnLog;
let signLink;
let formSign;
let formLog;
let formBlockLog;
let formBlockSign;
let closeSign;
let closeLog;
let menu;
let menuModal;

document.addEventListener("DOMContentLoaded", function(){
    
    console.log('OK');
    
    menuModal = document.querySelector("#menuModal");
    menu = document.querySelector("#domFlower");
    formBlockSign = document.querySelector("#form-block-sign");
    formBlockLog = document.querySelector("#form-block-log");
    btnLog = document.querySelector("#btn-userRoute");
    signLink = document.querySelector("#sign-in");
    closeSign = document.querySelector('#close-form-sign');
    closeLog = document.querySelector('#close-form-log');
    formSign = document.querySelector('#form-sign');
    formLog = document.querySelector("#form-log");
    
    btnLog.addEventListener("click", () => {
        
        if( menuModal.classList.contains("transformMod") && menu.classList.contains("flowerRotate") )
        {
            menuModal.classList.remove("transformMod");
            menu.classList.remove("flowerRotate");
        }
        
        if( formBlockSign.classList.contains("form-active") )
        {
            formBlockSign.classList.remove("form-active");
        }
       
        formBlockLog.classList.toggle("form-active");
        
    });
    
    if( signLink != null)
    {
        signLink.addEventListener("click", () => {
        
            formBlockLog.classList.remove("form-active");
            formBlockSign.classList.add("form-active");
            
        });  
    }
    
    
    closeSign.addEventListener("click", () => {
       
       formBlockSign.classList.remove("form-active");
       
    });
    
    closeLog.addEventListener("click", () => {
       
       formBlockLog.classList.remove("form-active");
       
    });
    
    
    
    /*MENU-FLOWER*/
    
    menu.addEventListener("click", () => {
        
        menuModal.classList.toggle("transformMod");
        
        menu.classList.toggle("flowerRotate");
        
        if( formBlockLog.classList.contains("form-active") )
        {
            formBlockLog.classList.remove("form-active");
        }
        else if( formBlockSign.classList.contains("form-active") )
        {
            formBlockSign.classList.remove("form-active");
        }
    });
    
    
})