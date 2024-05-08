@extends('layout.layout')

@section('title', 'ADMIN')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Ideas</h1>
            @include('shared.success-message')


            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>USER</th>
                        <th>CONTENT</th>
                        <th>CREATED AT</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ideas as $idea)
                        <tr>
                            <td>{{ $idea->id }}</td>
                            <td><a href="{{ route('users.show', $idea->user_id) }}">{{ $idea->user->name }}</a></td>
                            <td>{{ $idea->content }}</td>
                            <td>{{ $idea->created_at->toDateString() }}</td>
                            <td>
                                <a href="{{ route('ideas.show', $idea->user_id) }}">VIEW</a>
                                <a href="{{ route('ideas.edit', $idea->user_id) }}">EDIT</a>
                                <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">DELETE</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $ideas->links() }}
            </div>
        </div>
    </div>
@endsection
