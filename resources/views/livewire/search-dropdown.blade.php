<div class="me-3 my-auto">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="position-relative">
        <input wire:model.debounce.500ms="search" class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search">
        <div wire:loading class="spinner-border spinner-border-sm text-orange position-absolute top-25 end-20" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @if (strlen($search) > 2)
        @if ($searchResults->count() > 0)
            <ul class="text-sm bg-light rounded list-group-flush p-0 scrollable-menu position-absolute ">
                @foreach ($searchResults as $result)
                <li class="list-group-item">
                    <a href="{{ route('movies.show', $result['id']) }}" class="d-flex">
                        @if ($result['poster_path'])
                            <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-10">
                        @else
                            <img src="{{ asset('images/searchImagePlaceholder.png') }}" alt="poster" class="w-10">
                        @endif
                        <span class="ms-3 my-auto">{{ $result['title'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            @else
            <ul class="text-sm bg-light rounded list-group-flush p-0 scrollable-menu position-absolute">
                <li class="list-group-item">
                    No Results for "{{ $search }}"
                </li>
            </ul>
        @endif
    @endif
</div>
