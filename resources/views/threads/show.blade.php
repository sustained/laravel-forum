@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-primary border-dark text-white mb-3">
                <div class="card-header mt-2">
                    <form method="POST" action="/favourites/thread/{{ $thread->id }}">
                        @csrf

                    @if ($thread->isFavourited())
                        {{ method_field('DELETE') }}
                    @endif
                        
                        <button class="btn btn-sm float-right {{ $thread->isFavourited() ? 'btn-secondary' : 'btn-tertiary' }}">
                            {{ $thread->favourites_count >= 1 ? '⭐ ' . $thread->favourites_count : '⭐' }}
                        </button>
                    </form>

                    <h4>{{ $thread->title }}</h4>
                </div>

                <div class="card-body">
                    <h5 class="card-title mb-2 text-white">
                        <a class="text-dark" href="/profiles/{{ $thread->author->name }}">{{ $thread->author->name }} said...</a>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-dark">{{ $thread->created_at->diffForHumans() }}</h6>

                    {{ $thread->body }}
                </div>
            </div>

        @foreach($replies as $reply)

            @include('threads.reply')

        @endforeach

        {{ $replies->links() }}

        @auth
            @include('threads.create_reply')
        @endif

        @guest
            <div class="alert alert-info text-center" role="alert">
                Please <a href="{{ route('login') }}">sign in</a> to participate.
            </div>
        @endif
        </div>

        <div class="col-md-4">
            <div class="card bg-dark text-white border-dark mb-3">
                <div class="card-header mt-2">
                    <h4>Thread Details</h4>
                </div>

                <div class="card-body">
                    <p><strong>Published:</strong> {{ $thread->created_at->diffForHumans() }}</p>
                    <p><strong>Last Updated:</strong> {{ $thread->updated_at->diffForHumans() }}</p>
                    <p><strong>Created By:</strong> {{ $thread->author->name }}</p>
                    <p><strong>Reply Count:</strong> {{ $thread->replies_count }}</p>

                @can('update', $thread)
                    <form action="{{ $thread->path() }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="btn-group" role="group">
                            <a href="{{ $thread->path() }}/edit" class="btn btn-primary">Edit</a>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                @endcan
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
