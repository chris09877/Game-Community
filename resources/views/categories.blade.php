@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<h1 class="text-3xl font-bold text-center mb-4 ml-5">Categories</h1>
<div class="container mx-auto py-8 relative">
    <table id="categoryTable" class="max-w-md mx-auto  p-6 rounded-md shadow-md">
        <thead class="mb-8">
            <tr >
                <th >Categories Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr id="row_{{ $category->id }}">
                <td>
                    <span class="category-name">{{ $category->name }}</span>
                    <input type="text" class="editCategoryInput" style="display:none;">
                    <button
                        class="float-left bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border"
                        id="saveBtn" style="display:none;">Save</button>
                    <button
                        class="float-left bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border"
                        id="cancelBtn" style="display:none;">Cancel</button>
                </td>
                <td class="action">
                    <button
                        class="float-left bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border"
                        data-id="{{ $category->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button class="float-left bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border mt-2 mr-8"
    onclick="window.location='{{ route('faq') }}'">Cancel</button>
    <button class="float-left bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border"
    id="addCategoryButton">
    Add Category
</button>
</div>
{{-- <button class="float-left bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded border"
    onclick="window.location='{{ route('faq') }}'">Cancel</button> --}}
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

       
    </form>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



<script>
    'use strict';
    //delete
    $(document).ready(function () {
    $('.action button:first').click(function() {
        let id = $(this).data('id');
        console.log(`${id}`);
        $.ajax({
            url: "{{ route('category.delete',['id' => " + id + "]) }}",
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    $('#row_' + id).remove();
                }
            }
        });
        console.log(`${id}`);

    });

    // Edit Category Name
    $('.category-name').click(function() {
        let $td = $(this).closest('td');
        $td.find('.category-name').hide();
        $td.find('.editCategoryInput').show().focus();
        $td.find('.saveBtn, .cancelBtn').show();
    });

    // Cancel Edit
    $('#cancelBtn').click(function() {
        let $td = $(this).closest('td');
        $td.find('.category-name').show();
        $td.find('.editCategoryInput').hide();
        $td.find('.saveBtn, .cancelBtn').hide();
    });

    // Update Category Name
    $('#saveBtn').click(function() {
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
            },
            error: function(xhr, status, error) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
        });
    });


   


   
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
                console.log(xhr.responseText);
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