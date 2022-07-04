document.addEventListener( "DOMContentLoaded", () => {
  
  
  tinymce.init({
    selector: "textarea",
    valid_elements: "p,br,b,i,strong,em, ul, li, ol, span",
    toolbar: [
    { name: 'history', items: [ 'undo', 'redo' ] },
    { name: 'formatting', items: [ 'bold', 'italic' ] },
    { name: 'alignment', items: [ 'alignleft', 'aligncenter', 'alignright', 'alignjustify' ] },
    { name: 'indentation', items: [ 'outdent', 'indent' ] }
  ]
  });

  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".sidebarBtn");
  let deleteLink = document.querySelectorAll(".delete-link");
  let confirmModal = document.querySelector("#confirm-modal");
  let closeBtn = document.querySelector("#close-btn");
  let validBtn = document.querySelector("#valid-btn");
  let cancelBtn = document.querySelector("#cancel-btn");
  let dbTable = document.querySelector("#db-table");
  
  
  sidebarBtn.addEventListener( "click", () => {
    
    sidebar.classList.toggle("active");
    
    if(sidebar.classList.contains("active"))
    {
      sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
    }
    else if( confirmModal != null )
    {
      if( confirmModal.classList.contains("confirm-active") )
      {
        confirmModal.classList.remove("confirm-active");  
      }
    }
    else
    {
      sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");  
    }
  });
    
  
  
  deleteLink.forEach( (link) => {
    link.addEventListener("click" , () => {
      
      confirmModal.classList.add("confirm-active");
      
      let linkValue = link.value;
      validBtn.value = linkValue;
      
    });
  });
  
  if( closeBtn != null)
  {
    closeBtn.addEventListener( "click", () => {
    
      confirmModal.classList.remove("confirm-active");
      
    });  
  }
  
  
  if( cancelBtn != null)
  {
    cancelBtn.addEventListener( "click", () => {
      
      confirmModal.classList.remove("confirm-active");
      
    });
  }  
  
  if( validBtn != null )
  {
    validBtn.addEventListener( "click", () => {
      
      let dbTableValue = dbTable.value;
      let elementId = dbTableValue.toLowerCase() + "ID";
      
      let validBtnValue = validBtn.value;
      console.log(elementId);
      
      let xhr = new XMLHttpRequest();
      
      xhr.open( 'GET', `index.php?route=delete${ dbTableValue }&${ elementId }=${ validBtnValue }`);
      xhr.send();
      
      document.location.href = "index.php?route=backoff";
      
    });
  }  
  
});

