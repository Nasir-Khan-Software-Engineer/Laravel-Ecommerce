
$(document).ready(function(){

  // call order notification
  find_order_notification();
  setInterval(find_order_notification, 600000);

   // call review notificaton
   find_review_notification();
   setInterval(find_review_notification, 600000);

   //email
   find_email_notification();
   setInterval(find_email_notification, 600000);

}) // end jquery



function find_order_notification(){

  

  $.ajax({
   type:'POST',
   url:'/admin/order_notification',
   data:{id:1},
   success:function(data){
    show_order_notification_function(data);
  }
});
} // end


function show_order_notification_function(data){
  // show badge
  var total_unseen_order = data.total_notification;
  $("#total_order_notification").html(total_unseen_order);
  var list = '';

  var show_order_notification = 5;
  var count = 0;

  $.each(data.orders, function(key,order){
    count++;

    var url = window.location.origin;
    url = url+'/admin/order/show/'+order.id;

    list += `
    <a target="_blank" class="dropdown-item" href="`+url+`">
    
    <div class="dropdown-message">`+order.order_code+`</div>
    <div class="dropdown-divider"></div>
    </a>
    `;

    

  });
  $('#order_notification_list').html(
    `
    <h6 class="dropdown-header"><a class="dropdown-item small" href="{{route('admin.orders')}}">New Orders: `+total_unseen_order+`</a></h6>
    <div class="dropdown-divider"></div>
    `+list+`
    <div class="dropdown-divider"></div>
    <a class="dropdown-item small" href="{{route('admin.orders')}}">View all</a>
    `
    );
}// end




// review notification 


function find_review_notification(){
  $.ajax({
   type:'POST',
   url:'/admin/review_notification',
   data:{id:1},
   success:function(data){
    show_review_notification_function(data);
  }
});
}



function show_review_notification_function(data){
  // show badge
  var total_unseen_review = data.total_notification;
  $("#total_review_notification").html(total_unseen_review);
  var list = '';

  

  $.each(data.reviews, function(key,review){
    

    var url = window.location.origin;
    url = url+'/admin/review/show/'+review.id;

    list += `
    <a target="_blank" class="dropdown-item" href="`+url+`">
    
    <div class="dropdown-message">`+review.name+`</div>
    <div class="dropdown-divider"></div>
    </a>
    `;

    
  });

  // show list
  $('#review_notification_list').html(
    `
    <h6 class="dropdown-header"><a class="dropdown-item small" href="{{route('admin.reviews')}}">New Reviews: `+total_unseen_review+`</a></h6>

    <div class="dropdown-divider"></div>
    `+list+`
    <div class="dropdown-divider"></div>
    
    `
    );

}// end




// email notification 


function find_email_notification(){
  $.ajax({
   type:'POST',
   url:'/admin/email_notification',
   data:{id:1},
   success:function(data){
    show_email_notification_function(data);
  }
});
} // end




function show_email_notification_function(data){
  // show badge
  var total_unseen_emails = data.total_notification;
  $("#total_email_notification").html(total_unseen_emails);
  var list = '';

  

  $.each(data.emails, function(key,email){
    

    var url = window.location.origin;
    url = url+'/admin/email/show/'+email.id;

    list += `
    <a target="_blank" class="dropdown-item" href="`+url+`">
    
    <div class="dropdown-message">`+email.subject+`</div>
    <div class="dropdown-divider"></div>
    </a>
    `;

    
  });

  // show list
  $('#email_notification_list').html(
    `
    <h6 class="dropdown-header"><a class="dropdown-item small" href="{{route('admin.emails')}}">New Emails: `+total_unseen_emails+`</a></h6>

    <div class="dropdown-divider"></div>
    `+list+`
    <div class="dropdown-divider"></div>
    
    `
    );

}// end