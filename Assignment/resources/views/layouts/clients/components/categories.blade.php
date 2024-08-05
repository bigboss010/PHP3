<style>
   .category-image {
    width: 100%;
    height: 200px; /* Adjust based on your preference */
    object-fit: cover; /* Ensures the image covers the container without stretching */
}

.block-2-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    text-align: center;
    width: 100%; /* Ensure it takes full width */
}

.block-2-item .text {
    padding: 1rem;
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    width: 100%; /* Ensure it takes full width */
}

.block-2-item h3, .block-2-item p {
    margin: 0;
    padding: 0.5rem 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 100%; /* Ensure it takes full width */
}

.block-2-item h3 {
    max-width: 100%; /* Ensure it takes full width */
}

.block-2-item p {
    max-width: 100%; /* Ensure it takes full width */
}
</style>
<div class="site-section site-blocks-2">
    <div class="container">
        <div class="row">
            @foreach ($danhMucs->take(2) as $item)
            <div class="col-sm-12 col-md-6 col-lg-6 mb-4 mb-lg-0 d-flex flex-column align-items-center" data-aos="fade" data-aos-delay="">
                <a class="block-2-item d-flex flex-column align-items-center" href="{{ route('/.shopDanhMuc', $item->id) }}">
                    <figure class="image mb-3">
                        <img src="{{ Storage::url($item->hinh_anh) }}" alt="" class="img-fluid category-image">
                    </figure>
                    <div class="text">
                        <h3 class="text-truncate">{{ $item->ten_danh_muc }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>


