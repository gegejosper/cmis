$(document).ready(function() {
    $('#blocks_list').DataTable({
        "pageLength": 20, // Set the default number of rows per page
        "initComplete": function() {
            // Add the 'form-control' class to the page length dropdown
            $('select[name="blocks_list_length"]').addClass('mx-2');
        }
    });
    $(document).on('click', '.add_deceased', function(e) {
        $('#block_id').val($(this).data('block_id'));
        $('#graveyard_id').val($(this).data('graveyard_id'));
        $('#add-deceased-modal').modal('show');
    }); 
    $(document).on('click', '#add_block', function(e) {
        $('#graveyard_block_id').val($(this).data('graveyard_id'));
        $('#add-block-modal').modal('show');
    }); 
    $(document).on('submit', '#add_deceased', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/panel/deceaseds',
            data: {
                '_token': $('input[name=_token]').val(),
                'first_name': $('input[name=first_name]').val(),
                'last_name': $('input[name=last_name]').val(),
                'dob': $('input[name=dob]').val(),
                'block_id': $('input[name=block_id]').val(),
                'graveyard_id': $('input[name=graveyard_id]').val(),
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
    $(document).on('submit', '#add_block', function(e) {
        e.preventDefault();
        console.log($('input[name=graveyardblockid]').val() + 'sss');
        $.ajax({
            type: 'post',
            url: '/panel/blocks',
            data: {
                '_token': $('input[name=_token]').val(),
                'block_name': $('input[name=block_name]').val(),
                'graveyard_id': $('input[name=graveyardblockid]').val(),
                'status': $('input[name=status]').val(),
            },
            success: function(data) {
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
});
