 // jQuery to update modal content dynamically
 $(document).on('click', '.add-visitor', function() {
    let full_name = $(this).data('last_name') + ', ' +$(this).data('first_name');;
    $('#deceased_id').val($(this).data('deceased_id'));
    $('#deceased-name').text(full_name);
});

$(document).on('submit', '#add_visitor', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'post',
        url: '/panel/visitors',
        data: {
            '_token': $('input[name=_token]').val(),
            'fullname': $('input[name=fullname]').val(),
            'address': $('input[name=address]').val(),
            'date_in': $('input[name=date]').val(),
            'time_in': $('input[name=time_in]').val(),
            'deceased_id': $('input[name=deceased_id]').val(),
        },
        success: function(data) {
            //location.reload();
            if (data.success) {
                window.location.href = data.redirect_url; // Redirect to the URL from the server response
            }
        },
        error: function(data){
          const errorContainer = document.getElementById('errors');
          let errors = data.responseJSON.errors;
          let errormessage = '';
          Object.keys(errors).forEach(function(key) {
              errormessage += errors[key] + '<br />'; 
          });
          errorContainer.innerHTML = ` <div class="alert alert-danger" role="alert"> ${errormessage} </div>`;
          errorContainer.hidden = false;
        }

    });
});