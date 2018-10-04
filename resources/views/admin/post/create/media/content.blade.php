<ul class="list-inline mb-0">
    @foreach ($files as $file)
        <li class="list-inline-item mb-2 mr-2">
            <div class="selectedMediaFile">
                <img src="{{ asset($file->url) }}" alt="No Image" style="width: 140px; height: 140px" class="adminMediaImages" file-name="{{ $file->name }}">
                <i class="fas fa-check d-none adminMediaImageCheckBoxIcon" style="font-size: 1.5rem;"></i>
            </div>
        </li>
    @endforeach
</ul>
