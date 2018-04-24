@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                </div>

                <div class="card-body">
                    @include('includes.flash')

                    <div class="ticket-info">
                        <p>{{ $ticket->message }}</p>
                        <p>Category: {{ $category->name }}</p>
                        <p>
                            @if ($ticket->status === 'Open')
                                Status: <span class="badge badge-success">{{ $ticket->status }}</span>
                            @else
                                Status: <span class="badge badge-danger">{{ $ticket->status }}</span>
                            @endif
                        </p>
                        <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <hr>
                    <div class="comments">
                        @foreach ($comments as $comment)
                            <div class="card @if($ticket->user->id === $comment->user_id) bg-light @else bg-danger @endif">
                                <div class="card-header-heading">
                                    {{ $comment->user->name }}
                                    <span class="float-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                                </div>
                                <div class="card-body">
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="comment-form">
                        <form action="{{ route('comment') }}" method="POST">
                            @csrf

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="form-group">
                                <label for="comment">Message</label>
                                <textarea rows="10" id="comment"
                                          class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                          name="comment"></textarea>
                                @if ($errors->has('comment'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection