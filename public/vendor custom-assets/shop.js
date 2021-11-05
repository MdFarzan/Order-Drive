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
      var data = [];
      for(i=0;i<localStorage.length;i++){
        key = localStorage.key(i);


        data[i] = JSON.parse(localStorage.getItem(key));
        
        
      }

      
      let req_url = window.location.origin;
      

      
    
      $.ajax({
        // url: 'http://localhost:8080/fillCart',
        url: req_url+'/fillCart',
        data: {data: JSON.stringify(data)},
        success: function(res){
                  
                  $('#cart tbody').html(res);

                  
                  // changing quantity and other calculation on cart
                  $(".cart-p-qty").change(function(){
                    changeQuantityOnCart(this)
                  }); 


                  }

                  
      });
    }

    else{
      if($('#cart tbody').length>1){
        $('#place-order').css('display','none');
        $('#cart tbody').html("<tr>Please add few product first.</tr>");

        $('#cart-place-order').css('display', 'none');
      }
    }

    

    if($('#cart tbody').length<2){
      $('#cart-place-order').css('display', 'none');
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
    
    
    q = $(elm).val()
    p_id = $('.single-product-page-btn').attr('data-product-id');
    
    obj = JSON.parse(localStorage.getItem('product-'+p_id));
    

    obj.qty = q;
    obj = JSON.stringify(obj);
    localStorage.setItem('product-'+p_id, obj);
  }


  // removing product from cart
  function removeProduct(){
    
  }


  // calculation on cart page
  function changeQuantityOnCart(elm){

    
    let qty = Number($(elm).val());

    if(qty==0 || qty<1){
      $(elm).val(1)
      alert("Quantity cannot be less than 1!");
      return ;
    }


    let per_rate = Number($(elm).parent().next().find(".amt").html());
    let old_t_rate = Number($(elm).parent().next().next().find(".t-amt").html());

    let per_rate_elm = $(elm).parent().next().find(".amt");
    let old_t_rate_elm = $(elm).parent().next().next().find(".t-amt");

    // changing amount qty * rate of single product
    old_t_rate_elm.html(qty*per_rate);
    
    // changing quantity in local Storage
    let p_id = $(elm).attr('data-product-id');
    
    obj = JSON.parse(localStorage.getItem('product-'+p_id));
    
    // changing quantity in local storage
    obj.qty = qty;
    obj = JSON.stringify(obj);
    localStorage.setItem('product-'+p_id, obj);

    // changing payment amount
    let old_pay_amt = Number($('#payble_amt').html());

    $('#payble_amt').html((old_pay_amt-old_t_rate) + (per_rate*qty))
    

    






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
        addToStorage(id, "1");        
      
    }

    });



    // changing state on reload
    readyToChangeStatus();


    // changing quantity when change
    $('.p-qty-no').change(function(){
      changeQty(this);
    });
    
    
    

    
  });
  
 