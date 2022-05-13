<div class="me-3 my-auto" x-data="{ isOpen:true }" @click.away="isOpen=false">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="position-relative">
        <input
            wire:model.debounce.500ms="search"
            class="form-control form-control-sm" type="search"
            placeholder="Search"
            aria-label="Search"
            {{-- x-ref="search"
            @keydown.window="
                if (event.KeyCode == 191) {
                    event.preventDefault();
                    $refs.search.focus();
                }
            " --}}
            @focus=" isOpen=true "
            @keydown=" isOpen=true "
            @keydown.escape.window="isOpen = false"
            @keydown.shift.tab="isOpen = false"
        >
        <div wire:loading class="spinner-border spinner-border-sm text-orange position-absolute top-25 end-20" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    @if (strlen($search) >= 2)
    <div x-show.transition.opacity="isOpen">
        @if ($searchResults->count() > 0)
            <ul class="text-sm bg-light rounded list-group-flush p-0 scrollable-menu position-absolute ">
                @foreach ($searchResults as $result)
                <li class="list-group-item">
                    @if ($result['media_type'] == 'movie')
                        <a
                        href="{{ route('movies.show', $result['id']) }}"
                        class="d-flex text-decoration-none"
                            @if ($loop->last) @keydown.tab="isOpen = false"  @endif
                        >
                            @if ($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-10">
                            @else
                                <img src="{{ asset('images/searchImagePlaceholder.png') }}" alt="poster" class="w-10">
                            @endif
                                <span class="ms-3 my-auto">{{ $result['title'] }}</span>
                                <span class="ms-auto my-auto text-muted">movie</span>
                            </a>
                    @elseif($result['media_type'] == 'tv')
                        <a
                            href="{{ route('tv.show', $result['id']) }}"
                            class="d-flex text-decoration-none"
                            @if ($loop->last) @keydown.tab="isOpen = false"  @endif
                        >
                        @if ($result['poster_path'])
                            <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-10">
                        @else
                            <img src="{{ asset('images/searchImagePlaceholder.png') }}" alt="poster" class="w-10">
                        @endif
                        <span class="ms-3 my-auto">{{ $result['name'] }}</span>
                        <span class="ms-auto my-auto text-muted">tv</span>
                        </a>
                    @else
                        <a
                            href="{{ route('actors.show', $result['id']) }}" class="d-flex text-decoration-none"
                            @if ($loop->last) @keydown.tab="isOpen = false"  @endif
                        >
                        @if ($result['profile_path'])
                            <img src="https://image.tmdb.org/t/p/w92/{{ $result['profile_path'] }}" alt="poster" class="w-10">
                        @else
                            <img src="{{ asset('images/searchImagePlaceholder.png') }}" alt="poster" class="w-10">
                        @endif
                        <span class="ms-3 my-auto">{{ $result['name'] }}</span>
                        <span class="ms-auto my-auto text-muted">person</span>
                        </a>
                        @endif
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
    </div>
    @endif
</div>
