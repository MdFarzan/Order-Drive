// to change button after click on add-to-cart
  function changeButtonStatus(elm){
    
    elm.html('Added')
    elm.attr('disabled', 'disabled');
  }

  // add into local storage
  function addToStorage(pid,pqty){
    
    obj = {
      id: pid,
      qty: pqty
    }

    obj = JSON.stringify(obj);
    localStorage.setItem('product-'+pid, obj);
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



  // changing button status on reload
  function readyToChangeStatus(){
      
    for(i=0; i<localStorage.length; i++){
      key = localStorage.key(i);
        obj = JSON.parse(localStorage.getItem(key));
      
        

      changeButtonStatus($('[data-product-id="' + obj.id +'"]'));
      // now changing given quantity if exist
      if($('#qty-'+obj.id).length>0){

        // getting quantity
        $('#qty-'+obj.id).val(obj.qty);
        
        
      }
      
    }

  }


  // increasing/decreasing qty when qty changed
  function changeQty(elm){
    
    alert();
    q = $(elm).val()
    p_id = $('.single-product-page-btn').attr('data-product-id');
    
    obj = JSON.parse(localStorage.getItem('product-'+p_id));
    

    obj.qty = q;
    obj = JSON.stringify(obj);
    localStorage.setItem('product-'+p_id, obj);
  }


  // function calling starts
  $(document).ready(function(){


    // added to cart functionality without quantity
    $('.add-to-cart').click(function(){

    var id = $(this).attr('data-product-id');
    
    changeButtonStatus($(this));

    // if product carted with quantity
    if($('#qty-'+id).length>0){

      // getting quantity
      p_qty = $('#qty-'+id).val();
      addToStorage(id, p_qty);        
      
    }

    // and if product carted without quantity
      else{
        addToStorage(id, 1);        
      
    }

    });



    // changing state on reload
    readyToChangeStatus();


    // changing quantity when change
    $('.p-qty-no').change(function(){
      changeQty(this);
    });
    
    
  });
  
 