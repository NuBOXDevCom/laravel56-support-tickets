@extends('layouts.app')

@section('title', 'All Tickets')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-ticket"> Tickets</i>
                </div>

                <div class="panel-body">
                    @if ($tickets->isEmpty())
                        <p>There are currently no tickets.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>User</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th class="text-center" colspan="2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        @foreach ($categories as $category)
                                            @if ($category->id === $ticket->category_id)
                                                {{ $category->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>#{{ $ticket->user->id }} - {{ $ticket->user->name }}</td>
                                    <td>
                                        <a href="{{ route('ticket.show', $ticket->ticket_id) }}">
                                            #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($ticket->status === 'Open')
                                            <span class="badge badge-success">{{ $ticket->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $ticket->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('ticket.show', $ticket->ticket_id) }}"
                                           class="btn btn-primary">Comment</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.ticket.close', $ticket->ticket_id) }}"
                                              method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Close</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $tickets->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection