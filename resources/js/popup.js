'use strict';
// Bootstrap JS -->
{/* <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> */}
// resources/js/post-modal.js

$(document).ready(function() {
    // function showPostModal() {
    //     $("#postModal").dialog("open");
    // }

    // function submitPostForm() {
    //     // Perform form submission here or trigger form submission
    //     $("form").submit();
    // }

    // // Initialize modal and hide it initially
    // $("#postModal").dialog({
    //     autoOpen: false,
    //     modal: true,
    //     width: 400,
    //     buttons: {
    //         "Submit": function() {
    //             submitPostForm();
    //         },
    //         "Cancel": function() {
    //             $(this).dialog("close");
    //         }
    //     }
    // });
    // // let button = document.getElementById('postButton');
    // // button.addEventListener('click', ()=>{
    // //     showPostModal();
    // // })
    // // Attach click event to the post button
    // $("#postButton").on("click", function() {
    //     showPostModal();
    // });

    
    function showPostModal() {
        $('#postModal').modal('show');
    }

    function submitPostForm() {
        // Perform form submission here or trigger form submission
        $("form").submit();
    }

    $(document).ready(function() {
        // Attach click event to the post button
        $("#postButton").on("click", function() {
            showPostModal();
        });
    });

});


