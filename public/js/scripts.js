//--------  DELETE CONFIRMATION  --------//


$(".delete-form").submit(function (event) {
    event.preventDefault(); // stops submit
    swal({
        title: "Are you sure?",
        text: "It's going to be deleted",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $(this).off('submit').submit(); // if agreed - continue submit
        }
    });
});




//--------  SEARCH CUSTOMER  --------//


$("#searchCustomers").submit(function(event){

    event.preventDefault(); // stops submit

    var page_name = $("input[name=page_name]").val();
    var token = $("input[name=_token]").val();
    var first_name = $("input[name=first_name]").val();
    var last_name = $("input[name=last_name]").val();
    var phone = $("input[name=phone]").val();
    var id_number = $("input[name=id_number]").val();

    $.ajax({
        url: BASE_URL + "/search_customers",
        type: 'post',
        data: {
            "_token": token,
            "first_name": first_name,
            "last_name": last_name,
            "phone": phone,
            "id_number": id_number,
        },
        success: function(data) {

            if (!$.isEmptyObject(data.empty)) { // if form fields are empty

                $(".search-errors").html(''); // deletes previous errors from html
                $(".search-errors").removeClass('mt-5');
                $(".search-errors").addClass('mt-3');
                $(".search-errors").append(data.empty);

            } else if ($.isEmptyObject(data.error)) { // if no errors

                $(".search-errors").html(''); // deletes previous errors from html

                var customer;

                if ((data.customers).length == 1) { // if only 1 result

                    var customer = data.customers[0];

                    if (page_name == 'new ticket') { // if it's on new ticket page

                        swal('Customer found', '', "success");

                        $(".search-errors").html(''); // deletes previous errors from html
                        $("input[name=customer_id]").val(customer.id);
                        $("input[name=first_name]").val(customer.first_name);
                        $("input[name=last_name]").val(customer.last_name);
                        $("input[name=phone]").val(customer.phone);
                        $("input[name=id_number]").val(customer.id_number);

                    } else if (page_name == 'dashboard') { // if it's on dashboard page

                        window.location.href = BASE_URL + '/customers/' + customer.id; // redirects to customer file page

                    }

                } else { // if more than 1 result

                    $(".customers-results").modal('show');
                    $(".customers-results tbody").html(''); // deletes any previous results

                    if (page_name == 'new ticket') { // if it's on new ticket page

                        for (customer of data.customers) { // runs over results and push them into a list

                            $(".customers-results tbody").append(
                                '<tr style="cursor: pointer" onclick="chosenCustomer(' + "'" + customer['id'] + "', '" + customer['first_name'] + "', '" + customer['last_name'] + "', '" + customer['id_number'] + "', '" + customer['phone'] + "'" + ')">'
                                + '<td class="text-capitalize">' + customer['first_name'] + '</td>'
                                + '<td class="text-capitalize">' + customer['last_name'] + '</td>'
                                + '<td>' + customer['id_number'] + '</td>'
                                + '<td>' + customer['email'] + '</td>'
                                + '<td>' + customer['phone'] + '</td>'
                                + '</tr>'
                            );

                        }

                    } else if (page_name == 'dashboard') { // if it's on dashboard page

                        for (customer of data.customers) { // runs over results and push them into a list

                            $(".customers-results tbody").append(
                                '<tr style="cursor: pointer" onclick="location.href=' + "'" + BASE_URL + '/customers/' + customer['id'] + "'" + '">' // on click redirect to customer file page
                                + '<td class="text-capitalize">' + customer['first_name'] + '</td>'
                                + '<td class="text-capitalize">' + customer['last_name'] + '</td>'
                                + '<td>' + customer['id_number'] + '</td>'
                                + '<td>' + customer['email'] + '</td>'
                                + '<td>' + customer['phone'] + '</td>'
                                + '</tr>'
                            );

                        }

                    }

                };

            } else { // if there is any error
                printErrorMsg(data.error); // calling next function for printing errors
            }
        }
    }).done(function() { // ends loading spinner
        setTimeout(function(){
            $("#overlay").fadeOut(0);
        },500);
    });

    function printErrorMsg (msg) { //function for printing errors
        $(".search-errors").html('');
        $(".search-errors").removeClass('mt-5');
        $(".search-errors").addClass('mt-3');
        $(".search-errors").append(msg[0]);
    };

});


function chosenCustomer(id, first_name, last_name, id_number, phone) { // push customer values to form
    $(".customers-results").modal('hide'); // close modal windows
    $("input[name=customer_id]").val(id);
    $("input[name=first_name]").val(first_name);
    $("input[name=last_name]").val(last_name);
    $("input[name=phone]").val(phone);
    $("input[name=id_number]").val(id_number);
};

$("#clearCustomer").click(function() { // clear customer values
    $(".search-errors").html(''); // deletes previous errors from html
    $(".search-errors").addClass('mt-5');
    $("input[name=customer_id]").val('');
    $("input[name=first_name]").val('');
    $("input[name=last_name]").val('');
    $("input[name=phone]").val('');
    $("input[name=id_number]").val('');
});





//-------- Data Filters --------//


// keep dropdown select by query string

$(document).ready(function() {
    var url = window.location.href;
        queries = {};

        page_name = url.split("?")[0].split(BASE_URL)[1];
        hashes = url.split("?")[1];

    if (hashes) {
        var hash = hashes.split('&');

        for (var i = 0; i < hash.length; i++) {
            params = hash[i].split("=");
            queries[params[0]] = params[1];
        }

        if ( queries['status'] ) {
            var status_filter = queries['status'];
            $('select[name=status_filter]').val(status_filter);
        }

        if ( queries['role'] ) {
            var role_filter = queries['role'];
            $('select[name=role_filter]').val(role_filter);
        }

        if ( queries['created_at'] ) {
            var created_at = queries['created_at'];
            $('select[name=created_at]').val(created_at);
        }

        if ( queries['updated_at'] ) {
            var updated_at = queries['updated_at'];
            $('select[name=updated_at]').val(updated_at);
        }
    }

});

// on filter change - move to URL with queries

$(document).on('change','select[name=status_filter]',function(){
    var status_filter = $(this).val();
    document.location.href = BASE_URL + page_name + '?status=' + status_filter;
});

$(document).on('change','select[name=role_filter]',function(){
    var role_filter = $(this).val();
    document.location.href = BASE_URL + page_name + '?role=' + role_filter;
});

$(document).on('change','select[name=created_at]',function(){
    var created_at = $(this).val();
    document.location.href = BASE_URL + page_name + '?created_at=' + created_at;
});

$(document).on('change','select[name=updated_at]',function(){
    var updated_at = $(this).val();
    document.location.href = BASE_URL + page_name + '?updated_at=' + updated_at;
});


//-------- Add class to feather SVG icons --------//

feather.replace({ class: 'feather-icon'});


//-------- Invisible buttons --------//

$('.invisible-line').hover(function(){
    $(this).find('.invisible-btns').toggleClass('invisible-lg');
});


//-------- loading spinner on ajax calls --------//

$(document).ajaxSend(function() {
    $("#overlay").fadeIn(300);　
});
