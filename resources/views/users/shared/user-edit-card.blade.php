<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageUrl() }}"
                        alt="Mario Avatar">
                    <div>
                        <input name="name" value="{{ $user->name }}" class="form-control" type="text">
                        @error('name')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @auth()
                    @if (Auth::id() === $user->id)
                        <a href="{{ route('users.show', $user->id) }}">View</a>
                    @endif
                @endauth

            </div>
            <div class="mt-4">
                <label for="image">Profile Picture</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <div class="mb-3">
                    <textarea name="bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
                    @error('bio')
                        <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                    @enderror
                </div>
                <button class="btn btn-dark btn-sm mb-3">Save</button>
                @include('users.shared.user-stats')
            </div>
        </form>
    </div>
</div>
