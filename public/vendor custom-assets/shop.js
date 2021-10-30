// to change button after click on add-to-cart
  function changeButtonStatus(elm){
    elm.html('Added')
    elm.attr('disabled', 'disabled');
  }

  // add into local storage
  function addToStorage(pid){
    localStorage.setItem(pid, pid);
  }


  // getting local storage product from database
  function getProductForCart(){
    if(localStorage.length>0){
      var keys = [];
      for(i=0;i<localStorage.length;i++){
        keys[i] = localStorage.key(i);
        
      }


      let req_url = window.location.origin;
      

      
    
      $.ajax({
        // url: 'http://localhost:8080/fillCart',
        url: req_url+'/fillCart',
        data: {data: JSON.stringify(keys)},
        success: function(res){
                  console.log(res);
                  $('#cart tbody').html(res);
                  }
      });
    }

    else{
      $('#place-order').css('display','none');
      $('#cart tbody').html("<tr>Please add few product first.</tr>");

    }

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