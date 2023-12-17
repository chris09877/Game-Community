@section('content')
    <h1>Edit FAQ</h1>
    <form id="faqForm" method="POST" action="{{ route('faq.update', $faq->id) }}">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ $faq->title }}" ><br>

        <label for="text">Text:</label>
        <textarea name="text" >{{ $faq->text }}</textarea><br>

        <label for="categories">Select Category:</label>
    <select name="categories">
        @foreach($categories as $value)
            <option value="{{ $value }}" {{ $faq->categories === $value ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>

        <button onclick="window.location = '{{route('faq')}}'" id="editButton">Edit</button>
        <input type="submit" >Save</button>
    </form>

    
@endsection