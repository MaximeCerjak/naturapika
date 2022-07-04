document.addEventListener("DOMContentLoaded", () => {
    
    const typesOfRecipe = document.querySelectorAll(".menu-option");
    console.log(typesOfRecipe);
    
    typesOfRecipe.forEach( ( type ) => {
        type.addEventListener("click", () => {
           
            type.nextElementSibling.classList.toggle("active-option");   
            
        });
    });
    
})