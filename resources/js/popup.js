'use strict';

const { event } = require("jquery");
let routeToSubmit = "{{route('submitPost')}}";

$(document).ready(function () {
    function showPostModal() {
        $("#postModal").dialog("open");
    }

    function submitPostForm() {
        // Perform form submission here or trigger form submission
        // $("post-form").submit(event => {
        //     event.preventDefault();
            let data = $(this).serialize();

            $.ajax({
                url: routeToSubmit,
                type: 'POST',
                data: data,
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


