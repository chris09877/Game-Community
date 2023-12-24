{{-- @extends('layouts.app') <!-- Or your base layout -->

@section('content')
    <h1>Edit FAQ</h1>
    <form id="faqForm" method="POST" action="{{ route('faq.update', $faq->id) }}">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ $faq->title }}" readonly><br>

        <label for="text">Text:</label>
        <textarea name="text" readonly>{{ $faq->text }}</textarea><br>

        <!-- Add more fields here -->

        <button type="button" id="editButton">Edit</button>
        <button type="submit" id="updateButton" style="display: none;">Update</button>
    </form>

    <script>
        // Get form elements
        const form = document.getElementById('faqForm');
        const titleInput = form.querySelector('input[name="title"]');
        const textArea = form.querySelector('textarea[name="text"]');
        const editButton = document.getElementById('editButton');
        const updateButton = document.getElementById('updateButton');

        // Function to enable editing
        function enableEditing() {
            titleInput.readOnly = false;
            textArea.readOnly = false;
            editButton.style.display = 'none';
            updateButton.style.display = 'block';
        }

        // Attach click event listener to the edit button
        editButton.addEventListener('click', enableEditing);
    </script>
@endsection --}}
<h1>{{$categories}}</h1>