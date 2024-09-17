// Data Table
$(document).ready( function () {
    $('#alltableinfo').DataTable({
        ordering:  false,
        searching: true,
        paging: true,
        select: true,
        //pageLength: 10
    });
} );




$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Customer photo preview

function readCustomerURL(input) {

    if (input.files && input.files[0]) {
        

        var reader = new FileReader();
        reader.onload = function (e) {

            $('#customer_photo_review')
                .attr('src', e.target.result)
                .width(80)
                .height(80);
        };

        reader.readAsDataURL(input.files[0]);
    
    }
}


// Delete modal
$(document).on("click", "#delete", function () {
    var deleteID = $(this).data('id');
    $(".modal_card #modal_id").val( deleteID );
});


