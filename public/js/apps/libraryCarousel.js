let items;
let arrowLeft;
let arrowRight;
let nbrItems;
let count = -1;


document.addEventListener('DOMContentLoaded', function(){
    
    console.log('Salut!');
    
    
    items = document.querySelectorAll('.card-plant');
    
    arrowLeft = document.querySelector('#arrow-left');
    
    arrowRight = document.querySelector('#arrow-right');
    
    nbrItems = items.length - 1;
    
    console.log(arrowLeft);
    
    
    
    arrowRight.onclick = function() {
        
         if( count == nbrItems )
        {
            count = -1;
            items[nbrItems].classList.remove('display-card');
        }
        else if ( count == -1 )
        {
            count++;
            items[count].classList.add('display-card');
        }
        else 
        {
            count++;
            console.log(count);
            items[count].classList.add('display-card');
            items[count - 1].classList.remove('display-card');

        }
        
    };
    
    arrowLeft.onclick = function() {
        
         if( count == 0 )
        {
            count = -1;
            items[0].classList.remove('display-card');
        } 
        else if (count == -1)
        {
            count = nbrItems; 
            items[nbrItems].classList.add('display-card');
        }
        else
        {
            count--;
            console.log(count);
            items[count].classList.add('display-card');
            items[count + 1].classList.remove('display-card');

        }
        
    };
    
    
})