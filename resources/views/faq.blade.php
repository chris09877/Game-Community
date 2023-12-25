@extends('layouts.layout')
@section('content')

<h1>FAQ</h1>
<button onclick="window.location = '{{route('faq.create')}}'"
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Create Question
</button>
@if($user->admin)
<button onclick="window.location = '{{route('category')}}'"
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Categories
</button>
@endif
<h2>Themes</h2>
@foreach($categories as $category)
<h3>{{$category->name}}</h3>
@foreach($allFaqs as $faq)
@if($faq->category_id === $category->id)
@if($user->admin)
{{-- meetre href to page where u can update the faq --}}
<a href="{{ route('faq.show', ['id' => $faq->id]) }}">
    <div>
        <form action="{{ route('faq.destroy', ['id' => $faq->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete FAQ</button>
        </form>
        <p>{{$faq->title}}</p>
        <p>{{$faq->text}}</p>
    </div>
</a>
@else
<p>{{$faq->title}}</p>
<p>{{$faq->text}}</p>

@endif
@else
<p>There are no questions related to the theme {{$category->name}}.</p>
@endif
@endforeach
@endforeach








{{-- <h3>Bugs on website</h3>
@if($bugFaqs->isEmpty())
<p>There are no questions asked related to bugs on our website.</p>
@else
@foreach($bugFaqs as $bf)
@if($user->admin)
<div>
    <form action="{{ route('faq.destroy', ['id' => $bf->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete FAQ</button>
    </form>
    <p>{{$bf->title}}</p>
    <p>{{$bf->text}}</p>
    <p>{{$bf->userID}}</p>
</div>
@else
<p>{{$bf->title}}</p>
<p>{{$bf->text}}</p>
<p>{{$bf->userID}}</p>
@endif
@endforeach
@endif
<h3>Updates of website</h3>
@if($updateFaqs->isEmpty())
<p>There are no questions asked related to updates on our website.</p>
@else
@foreach($updateFaqs as $uf)
@if($user->admin)
<div>
    <form action="{{ route('faq.destroy', ['id' => $uf->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete FAQ</button>
    </form>
    <p>{{$uf->title}}</p>
    <p>{{$uf->text}}</p>
    <p>{{$uf->userID}}</p>
</div>
@else
<p>{{$uf->title}}</p>
<p>{{$uf->text}}</p>
<p>{{$uf->userID}}</p>
@endif
@endforeach
@endif
<h3>Contact us</h3>
@if($contactFaqs->isEmpty())
<p>There are no questions asked related to contacting us.</p>
@else
@foreach($contactFaqs as $cf)
@if($user->admin)
<div>
    <form action="{{ route('faq.destroy', ['id' => $cf->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete FAQ</button>
    </form>
    <p>{{$cf->title}}</p>
    <p>{{$cf->text}}</p>
    <p>{{$cf->userID}}</p>
</div>
@else
<p>{{$cf->title}}</p>
<p>{{$cf->text}}</p>
<p>{{$cf->userID}}</p>
@endif
@endforeach
@endif
<h3>Donation</h3>
@if($donationFaqs->isEmpty())
<p>There are no questions asked related to donations to our team.</p>
@else
@foreach($donationFaqs as $df)
@if($user->admin)
<div>
    <form action="{{ route('faq.destroy', ['id' => $df->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete FAQ</button>
    </form>
    <p>{{$df->title}}</p>
    <p>{{$df->text}}</p>
    <p>{{$df->userID}}</p>
</div>
@else
<p>{{$df->title}}</p>
<p>{{$df->text}}</p>
<p>{{$df->userID}}</p>
@endif
@endforeach
@endif --}}
@endsection