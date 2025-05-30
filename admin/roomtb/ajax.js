

function fetch_room(val) {
    $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
            room_type: ''
        },
        success: function (response) {
            $('#room_no').html(response);

        }
    });
}



$(document).on('click', '#cutomerDetails', function (e) {
    e.preventDefault();

    var room_id = $(this).data('id');
    // alert(room_id);
    console.log(room_id);

    $.ajax({
        type: 'post',
        url: 'ajax.php',
        dataType: 'JSON',
        data: {
            room_id: room_id,
            cutomerDetails: ''
        },
        success: function (response) {


            if (response.done == true) {


                $('#customer_name').html(response.customer_name);
                $('#customer_contact_no').html(response.contact_no);
                $('#customer_email').html(response.email);
                $('#customer_id_card_type').html(response.id_card_type_id);
                $('#customer_id_card_number').html(response.id_card_no);
                $('#customer_address').html(response.address);
                $('#remaining_price').html(response.remaining_price);

            } else {


                $('.edit_response').html('<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
            }
        }
    });

});

$(document).on('click', '#checkInRoom', function (e) {
    e.preventDefault();

    var room_id = $(this).data('id');

    $.ajax({
        type: 'post',
        url: 'ajax.php',
        dataType: 'JSON',
        data: {
            room_id: room_id,
            booked_room: ''
        },
        success: function (response) {
            if (response.done == true) {
                $('#room_id').val(room_id);
                $('#getCustomerName').html(response.name);
                $('#getRoomType').html(response.room_type);
                $('#getRoomNo').html(response.room_no);
                $('#getCheckIn').html(response.check_in);
                $('#getCheckOut').html(response.check_out);
                $('#getTotalPrice').html(response.total_price + '/-');
                $('#getBookingID').val(response.booking_id);
                $('#checkIn').modal('show');
            } else {
                alert(response.data);
            }
        }
    });

});

$('#advancePayment').submit(function () {

    var booking_id = $('#getBookingID').val();
    var advance_payment = $('#advance_payment').val();

    $.ajax({
        type: 'post',
        url: 'ajax.php',
        dataType: 'JSON',
        data: {
            booking_id: booking_id,
            advance_payment: advance_payment,
            check_in_room:''
        },
        success: function (response) {
            if (response.done == true) {
                $('#checkIn').modal('hide');
                window.location.href = 'index.php?room_mang';
            } else {
                $('.payment-response').html('<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
            }
        }
    });

    return false;
});

$(document).on('click', '#checkOutRoom', function (e) {
    e.preventDefault();

    var room_id = $(this).data('id');

    $.ajax({
        type: 'post',
        url: 'ajax.php',
        dataType: 'JSON',
        data: {
            room_id: room_id,
            booked_room: ''
        },
        success: function (response) {
            if (response.done == true) {
                $('#getCustomerName_n').html(response.name);
                $('#getRoomType_n').html(response.room_type);
                $('#getRoomNo_n').html(response.room_no);
                $('#getCheckIn_n').html(response.check_in);
                $('#getCheckOut_n').html(response.check_out);
                $('#getTotalPrice_n').html(response.total_price + '/-');
                $('#getRemainingPrice_n').html(response.remaining_price + '/-');
                $('#getBookingId_n').val(response.booking_id);
                $('#checkOut').modal('show');
            } else {
                alert(response.data);
            }
        }
    });

});

$('#checkOutRoom_n').submit(function () {
    var booking_id = $('#getBookingId_n').val();
    var remaining_amount = $('#remaining_amount').val();

    console.log(booking_id);

    $.ajax({
        type: 'post',
        url: 'ajax.php',
        dataType: 'JSON',
        data: {
            booking_id: booking_id,
            remaining_amount: remaining_amount,
            check_out_room:''
        },
        success: function (response) {
            if (response.done == true) {
                $('#checkIn').modal('hide');
                window.location.href = 'index.php?room_mang';
            } else {
                $('.checkout-response').html('<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
            }
        }
    });

    return false;

});

$('#addEmployee').submit(function () {

    var staff_type = $('#staff_type').val();
    var shift = $('#shift').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var contact_no = $('#contact_no').val();
    var id_card_id = $('#id_card_id').val();
    var id_card_no = $('#id_card_no').val();
    var address = $('#address').val();
    var salary =$('#salary').val();

    console.log(staff_type+shift);
    $.ajax({
        type: 'post',
        url: 'ajax.php',
        dataType: 'JSON',
        data: {
            staff_type:staff_type,
            shift:shift,
            first_name:first_name,
            last_name:last_name,
            contact_no:contact_no,
            id_card_id:id_card_id,
            id_card_no:id_card_no,
            address:address,
            salary:salary,
            add_employee:''

        },
        success: function (response) {
            if (response.done == true){
                document.getElementById("addEmployee").reset();
                $('.emp-response').html('<div class="alert bg-success alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>Employee Successfully Added</div>');
            }else{
                $('.emp-response').html('<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
            }
        }
    });

    return false;
});

$('#edit_employee').submit(function () {

    var staff_type = $('#staff_type').val();
    var shift = $('#shift').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var contact_no = $('#contact_no').val();
    var id_card_id = $('#id_card_id').val();
    var id_card_no = $('#id_card_no').val();
    var joining_date = $('#joining_date').val();
    var address = $('#address').val();
    var salary =$('#salary').val();

//alert(first_name);
    $.ajax({
        type: 'post',
        url: 'ajax.php',
        dataType: 'JSON',
        data: {
            staff_type:staff_type,
            shift:shift,
            first_name:first_name,
            last_name:last_name,
            contact_no:contact_no,
            id_card_id:id_card_id,
            id_card_no:id_card_no,
            joining_date:joining_date,
            address:address,
            salary:salary,
            add_employee:'',

        },
        success: function (response) {
            alert("Employee Added Successfully");
            document.getElementById("add_employee").reset();
            /* if (response.done == true) {
             $('#getCustomerName').html(first_name+' '+last_name);
             $('#getRoomType').html(room_type);
             $('#getRoomNo').html(room_no);
             $('#getCheckIn').html(check_in_date);
             $('#getCheckOut').html(check_out_date);
             $('#getTotalPrice').html(total_price);
             $('#getPaymentStaus').html("Unpaid");
             $('#bookingConfirm').modal('show');
             document.getElementById("booking").reset();
             } else {
             $('.response').html('<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' + response.data + '</div>');
             }*/

        }
    });

    return false;
});

$(document).on('click', '#complaint', function (e) {
    e.preventDefault();

    var complaint_id = $(this).data('id');
    console.log(complaint_id);
    $('#complaint_id').val(complaint_id);

});

$(document).on('click', '#change_shift', function (e) {
    e.preventDefault();

    var emp_id = $(this).data('id');
    console.log(emp_id);
    $('#getEmpId').val(emp_id);

});








