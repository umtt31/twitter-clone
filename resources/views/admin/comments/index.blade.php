@extends('layout.layout')

@section('title', 'ADMIN')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Comments</h1>
            @include('shared.success-message')

            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>USER</th>
                        <th>IDEA ID</th>
                        <th>CONTENT</th>
                        <th>CREATED AT</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td><a href="{{ route('users.show', $comment->user_id) }}">{{ $comment->user->name }}</a></td>
                            <td><a href="{{ route('ideas.show', $comment->idea_id) }}">{{ $comment->idea_id }}</a></td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->created_at->toDateString() }}</td>
                            <td>
                                <a href="{{ route('ideas.show', $comment->idea_id) }}">VIEW</a>
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">DELETE</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
