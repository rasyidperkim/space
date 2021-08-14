@extends('layouts.app')

@section('content')
<div class="container">
    <x-space></x-space>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            @foreach ($spaces as $space)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $space->title }}
                        @if ($space->user_id == Auth::user()->id)
                        <form action="{{ route('space.destroy', $space->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type='submit' class="btn btn-danger float-right" onclick="return confirm('Are You Sure ?')"><i class="fas fa-trash"></i>  Delete</button>

                            <a href="{{ route('space.edit', $space->id) }}" class="btn btn-info float-right text-white mr-2"><i class="fas fa-edit"></i>  Edit</a>
                        </form>                           
                        @endif
                    </h5>
                    <h6 class="card-subtitle">
                        {{ $space->address }}
                    </h6>
                    <p class="card-text">
                        {{ $space->description}}
                    </p>
                    <a href="#" onclick="openDirection({{ $space->latitude }}, {{ $space->longitude }}, {{ $space->id }})" class="card-link" )><i class="fas fa-directions"></i>Direction</a>
                </div>
            </div>                
            @endforeach

        </div>
    </div>
    <div class="row justify-content-center">
        {{ $spaces->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
