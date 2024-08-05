<style>
    .product-image {
    max-height: 200px; /* Adjust based on your preference */
    width: auto;
    object-fit: cover; /* Ensures the image covers the container without stretching */
}

.block-4 {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.block-4-text {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.block-4 h3, .block-4 p {
    margin: 0;
    padding: 0.5rem 0;
}

</style>
<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Bé mới ra mắt</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    @foreach ($list->take(6) as $item)
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="{{ Storage::url($item->image) }}" alt="Image placeholder" class="img-fluid product-image">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="{{ route('/.shop-single', $item->id) }}">{{ $item->ten_pet }}</a></h3>
                                    <p class="mb-0">{{ $item->mota }}</p>
                                    <p class="text-primary font-weight-bold">{{ number_format($item->gia_pet, 0, ',' ,'.',) }} VNĐ</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
