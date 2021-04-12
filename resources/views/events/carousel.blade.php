<div class="container">
    <div class="row justify-content-center">
        <div id="carousel" class="carousel slide mb-4 w-100" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ($i = 0; $i < $carouselsCount; $i++) <li data-target="#carousel" data-slide-to="{{ $i }}"
                    @if($i==0) class="active" @endif>
                    </li>
                    @endfor
            </ol>
            <div class="carousel-inner">
                @forelse ($carousels as $carousel)
                <div class="carousel-item @if($loop->index == 0) active @endif">
                    <img src="{{ asset(Storage::url($carousel->path)) }}" class="d-block w-100">
                </div>
                @empty
                <div class="carousel-item active">
                    <img src="http://fakeimg.pl/1999x664/" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="http://fakeimg.pl/1999x664/" class="d-block w-100">
                </div>
                @endforelse
            </div>

            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
