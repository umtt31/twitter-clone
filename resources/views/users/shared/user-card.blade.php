<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageUrl() }}"
                    alt="Mario Avatar">
                <div>
                    <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                        </a></h3>
                    <span class="fs-6 text-muted">{{ $user->email }}</span>
                </div>
            </div>
            @auth()
                @can('update', $user)
                    <a href="{{ route('users.edit', $user->id) }}">edit</a>
                @endcan
            @endauth
        </div>
    </div>
    <div class="card-body">
        <h5 class="fs-5"> Bio : </h5>
        <p class="fs-6 fw-light">
            {{ $user->bio }}
        </p>
        @include('users.shared.user-stats')
        <div class="mt-3">
            @auth()
                @if (Auth::id() !== $user->id)
                    @if (Auth::user()->follows($user))
                        <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"> Unfollow </button>
                        </form>
                    @else
                        <form action="{{ route('users.follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>
