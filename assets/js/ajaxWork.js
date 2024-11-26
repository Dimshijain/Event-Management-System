

function showProductItems() {
    console.log("Before AJAX request");
    $.ajax({
        url: "./adminView/viewAllProducts.php",
        method: "post",
        data: { record: 1 },
        success: function(data) {
            console.log("Data received from server:", data);
            $('.allContent-section').html(data);
            console.log("Content updated successfully");
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Error fetching product items. See console for details.');
        }
    });
}


function showCustomers(){
    $.ajax({
        url:"./adminView/viewCustomers.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showVendor(){
    $.ajax({
        url:"./adminView/viewVendor.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showVendorOrder(){
    $.ajax({
        url:"./vendor_order.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function showOrders(){
    $.ajax({
        url:"./adminView/viewAllOrders.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showfeedback(){
    $.ajax({
        url:"./show_feedback.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    })
}
function showbilling(){
    $.ajax({
        url:"./show_billing.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    })
}



function ChangePay(id){
    $.ajax({
       url:"./controller/updatePayStatus.php",
       method:"post",
       data:{record:id},
       success:function(data){
           alert('Payment Status updated successfully');
           $('form').trigger('reset');
           showOrders();
       }
   });
}


//add product data
function addItems() {
    console.log('addItems function is called');
    var p_name = $('#name').val();
    var p_desc = $('#desc').val();
    var file = $('#file_upload')[0].files[0];
    var p_price = $('#price').val();

    var fd = new FormData();
    fd.append('name', p_name);
    fd.append('desc', p_desc);
    fd.append('upload', file);
    fd.append('price', p_price);

    $.ajax({
        url: "./controller/addItemController.php",
        method: "post",
        data: fd,
        processData: false,
        contentType: false,
        success: function(data) {
            console.log('Success:', data);  // Log success response
            alert('Product Added successfully.');
            $('form').trigger('reset');
            location.reload(true);
        },
        
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Error adding product. See console for details.');

            // Log additional details for debugging
            console.log('XHR:', xhr);
            console.log('Status:', status);
        }
    });
}



//edit product data
function itemEditForm(id){
    $.ajax({
        url:"./adminView/editItemForm.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

//update product after submit
function updateItems() {
    var product_id = $('#E_id').val();
    var p_name = $('#p_name').val();
    var p_desc = $('#p_desc').val();
    var existingImage = $('#existingImage').val();
    var newImage = $('#newImage')[0].files[0];
    var p_price = $('#p_price').val();
   
    var fd = new FormData();
    fd.append('E_id', product_id);
    fd.append('p_name', p_name);
    fd.append('p_desc', p_desc);
    fd.append('p_price', p_price);

    if (newImage) {
        console.log('New Image:', newImage);
        fd.append('newImage', newImage);
    }

    $.ajax({
        url: './controller/updateItemController.php',
        method: 'post',
        data: fd,
        processData: false,
        contentType: false,
        success: function(data) {
            alert('Data Update Success.');
            $('form').trigger('reset');
            showProductItems();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Error updating product. See console for details.');
        }
    });
}



//delete product data
function itemDelete(id){
    $.ajax({
        url:"./controller/deleteItemController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Items Successfully deleted');
            $('form').trigger('reset');
            showProductItems();
        }
    });
}








