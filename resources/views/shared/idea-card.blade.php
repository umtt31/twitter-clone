<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageUrl() }}"
                    alt="{{ $idea->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}">
                            {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <div>
                @auth()
                    @if (auth()->user()->id === $idea->user_id)
                        <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="mx-2" href="{{ route('ideas.edit', $idea->id) }}"> Edit</a>
                            <button class="ms-1 btn btn-danger btn-sm"> X </button>
                        </form>
                    @endif
                @endauth
                <a href="{{ route('ideas.show', $idea->id) }}"> View </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('ideas.update', $idea->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea['content'] }}
            </p>
        @endif

        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> 100 </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    3-5-2023 </span>
            </div>
        </div>
        @include('shared.comments-box')
    </div>
</div>
