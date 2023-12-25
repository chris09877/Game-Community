@extends('layouts.app')
@section('content')
<h1>Categories</h1>
<table id="categoryTable">
    <thead>
        <tr>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr id="row_{{ $category->id }}">
            <td>
                <span class="category-name">{{ $category->name }}</span>
                <input type="text" class="editCategoryInput" style="display:none;">
                <button class="saveBtn" style="display:none;">Save</button>
                <button class="cancelBtn" style="display:none;">Cancel</button>
            </td>
            <td>
                <button class="deleteBtn" data-id="{{ $category->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<button onclick="window.location='{{ route('faq') }}'">Cancel</button>
<!-- Add Category Modal -->
<div id="addCategoryModal" title="Add Category" class="mt-6">
    <form id="category-form" method="POST">
        @csrf
        <div class="mb-4">
            <label for="categoryName" class="block text-gray-700 text-sm font-bold mb-2" style="display: none;">Category
                Name:</label>
            <input type="text" id="categoryName" name="categoryName" class="border rounded-md py-2 px-3 w-full"
                style="display: none;">

        </div>

        <button type="button" id="addCategoryButton"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Category
        </button>
    </form>
</div>
@endsection
<!-- Script Section -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    'use strict';
    $('.deleteBtn').click(function() {
        let id = $(this).data('id');
        $.ajax({
            url: "{{ route('category.delete',['id' => " + id + "]) }}",
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    $('#row_' + id).remove();
                }
            }
        });
    });

    // Edit Category Name
    $('.category-name').click(function() {
        let $td = $(this).closest('td');
        $td.find('.category-name').hide();
        $td.find('.editCategoryInput').show().focus();
        $td.find('.saveBtn, .cancelBtn').show();
    });

    // Cancel Edit
    $('.cancelBtn').click(function() {
        let $td = $(this).closest('td');
        $td.find('.category-name').show();
        $td.find('.editCategoryInput').hide();
        $td.find('.saveBtn, .cancelBtn').hide();
    });

    // Update Category Name
    $('.saveBtn').click(function() {
        let $td = $(this).closest('td');
        let id = $td.closest('tr').attr('id').replace('row_', '');
        let newName = $td.find('.editCategoryInput').val();

        $.ajax({
            url: "{{ route('category.update',['id' => " + id + "]) }}",
            type: 'POST',
            data: { name: newName },
            success: function(response) {
                if (response.success) {
                    $td.find('.category-name').text(newName).show();
                    $td.find('.editCategoryInput').hide();
                    $td.find('.saveBtn, .cancelBtn').hide();
                }
            }
        });
    });


   

$(document).ready(function () {
   
        $("#addCategoryModal").on("click", function () {
    // Show the category name label and input field
    $("#categoryName").show();
    $("label[for='categoryName']").show();
    showAddCategoryModal();
    });
    

    function submitCategoryForm() {
        let data = $('#category-form').serialize();
        $.ajax({
            url: "{{ route('category.store') }}",
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
            },
            success: function (response) {
                console.log('Category added successfully');
                $("#addCategoryModal").dialog("close");
                // You can update the UI to display the newly added category without reloading the page
            },
            error: function (xhr, status, error) {
                console.log('Error adding category');
            }
        });
    };

    // Initialize modal and hide it initially
    $("#addCategoryModal").dialog({
        autoOpen: false,
        modal: true,
        width: 400,
        buttons: {
            "Add Category": function () {
                submitCategoryForm();
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });

    
});

</script>