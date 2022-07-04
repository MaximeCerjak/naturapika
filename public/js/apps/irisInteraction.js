document.addEventListener("DOMContentLoaded", () => {
    
    const skinZone = document.querySelector("#skin-zone");
    const lymphZone = document.querySelector("#lymph-zone");
    const gastricZone = document.querySelector("#gastric-zone");
    const intestinalZone = document.querySelector("#intestinal-zone");
    const colarZone = document.querySelector("#colar-zone");
    const endocrineZone = document.querySelector("#endocrine-zone");
    const organsZone = document.querySelector("#organs-zone");
    const organsNode = document.querySelectorAll(".m-o");
    const endocrineNode = document.querySelectorAll(".e-r");
    const intestinalNode = document.querySelectorAll(".i-r");
    const colarElement = document.querySelector("#c-r");
    const skinElement = document.querySelector("#s-r");
    const lymphElement = document.querySelector("#l-r");
    const gastricElement = document.querySelector("#g-r");
    
    skinZone.addEventListener('click', () => {
        skinElement.classList.toggle('legend-active');
    });
    
    lymphZone.addEventListener('click', () => {
        lymphElement.classList.toggle('legend-active');
    });
    
    gastricZone.addEventListener('click', () => {
        gastricElement.classList.toggle('legend-active');
    });
    
    intestinalZone.addEventListener('click', () => {
        intestinalNode.forEach( el => {
            el.classList.toggle('legend-active');
        });
    });
    
    colarZone.addEventListener('click', () => {
        colarElement.classList.toggle('legend-active');
    });
    
    organsZone.addEventListener('click', () => {
        organsNode.forEach( el => {
            el.classList.toggle('legend-active');
        });
    });
    
    endocrineZone.addEventListener('click', () => {
        endocrineNode.forEach( el => {
            el.classList.toggle('legend-active');
        });
    });
    
})