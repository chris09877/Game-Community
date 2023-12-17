'use strict';

const { event } = require("jquery");
let formPostID = document.getElementById('post-form');
let routeToSubmit = "{{route('submitUser')}}";//formPostID.dataset.route;
console.log("heelo");
$(document).ready(function () {

    console.log("heelo2");

    function showPostModal() {
        console.log("heelo3");

        $("#postModal").dialog("open");
    }

    function submitPostForm() {
        // Perform form submission here or trigger form submission
        // $("post-form").submit(event => {
        //     event.preventDefault();
        console.log("heelo4");

            let data = $('#post-form').serialize();
        console.log(data);
            $.ajax({
                url: "{{route('submitUser')}}",
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                    
                },
                success: function (response) {
                    
                    // show a succes message with a gif si y a moyens avec un timer 
                    console.log('sisi reussi');
                    $(this).dialog("close");
                    window.location.reload(); 
                },
                error: function (xhr, status, error) {
                    console.log('error a zbe');
                    // show error message, essaye d'avoir le error log
                }
            });
        // });
        console.log("heelo5");

    };

    // Initialize modal and hide it initially
    $("#postModal").dialog({
        autoOpen: false,
        modal: true,
        width: 400,
        buttons: {
            "Submit": function () {
                submitPostForm();
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });

    // Attach click event to the post button
    $("#postButton").on("click", function () {
        showPostModal();
    });


});


