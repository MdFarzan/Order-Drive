// to change button after click on add-to-cart
  function changeButtonStatus(elm){
    elm.html('Added')
    elm.attr('disabled', 'disabled');
  }

  // add into local storage
  function addToStorage(pid){
    localStorage.setItem(pid, pid);
  }

  $(document).ready(function(){


    // added to cart functionality
    $('.add-to-cart').click(function(){

    let = id = $(this).attr('data-product-id');
    changeButtonStatus($(this));
    addToStorage($(this).attr('data-product-id'));

    });

    
    readyToChangeStatus();

  });
  
  function readyToChangeStatus(){
      
      for(i=0; i<localStorage.length; i++){
        key = localStorage.key(i);
        changeButtonStatus($('[data-product-id="' + key +'"]'));
        
      }

    }