document.addEventListener("DOMContentLoaded", function() {
let x = document.querySelector('.options').style;


    var specifiedElement = document.getElementById('testButton');
    document.addEventListener('click', function(event) {
        var isClickInside = specifiedElement.contains(event.target);
        if (isClickInside) {

            if(x.opacity == 1){
                x.opacity = 0;
                x.height = 0;
              } else if(x.opacity != 1){
                x.opacity = 1;
                x.height = 'auto';
              }

        }
        else {
          if(x.opacity == 1){
                x.opacity = 0;
                x.height = 0;
              }
        }
    });
 let y = document.querySelector('.options');

        for(let i = 0; i<y.childElementCount; i++){
          y.children[i].addEventListener('click', function(){
            y.style.opacity = 0;
            y.style.height = 0;
            document.querySelector('.selectButton').childNodes[0].innerText = this.innerText;

            var hiddenInput = document.querySelector('.options').children[i].children[0].value;

            
          });
        } 

});


// export default  hiddenInput ;