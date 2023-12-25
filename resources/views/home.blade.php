@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($allPosts->isEmpty() )
                        <h1>y a R</h1>
                        
                    @else
                      <div>
                         @foreach($allPosts as $post)
                            <div>
                                <div>
                                    <img src="{{ $post->{'images/videos'} }}" alt="Post Image">                                </div>
                                
                                <div>
                                    <h2>{{ $post->title }}</h2>
                                    <p>{{ $post->content }}</p>
                                    <p>{{ $post->created_at }}</p>
                                 </div>
                            </div>
                          @endforeach
                        </div>
                    @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
