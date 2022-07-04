document.addEventListener("DOMContentLoaded", function() {
    
    const menuModal = document.querySelector("#menuModal");
    const menu = document.querySelector("#domFlower");

    console.log("Page chargée");
    
    menu.addEventListener("click", () => {
        
        menuModal.classList.toggle("transformMod");
        
        menu.classList.toggle("flowerRotate");
    });
    
    
});