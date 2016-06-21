 <div class="listing-box border-bottom{{ isset($featured) && $featured ? ' highlighted' : '' }}">
        <div class="col-md-9">
            @if(isset($featured) && $featured)
                <span class="text-danger">{{ trans('main.sponsored') }}</span>
            @endif
            <div class="row">
                <div class="col-md-3">
                    <a href="#" class="listing-title-anchor">
                        <h2 class="listing-title">{{ $listing->translate()->name }}</h2>
                    </a>
                </div>
                <div class="col-md-9 no-padding">
                    <div class="listing-feedback">
                        <div class="feed">
                            <span><b>{{ $listing->getField('Destination 1')->value }} </b>({{ $listing->getField('No. of Nights (Destination 1)')->value }} Nights)</span>
                            <span>{{ $listing->getField('Hotel 1')->value }}<br>({{ $listing->getField('Hotel 1 Stars')->value }} {{ trans('main.stars') }})</span>
                        </div>
                        <div class="feed">
                            <span><b>{{ $listing->getField('Destination 2')->value }} </b>({{ $listing->getField('No. of Nights (Destination 2)')->value }} Nights)</span>
                            <span>{{ $listing->getField('Hotel 2')->value }}<br>({{ $listing->getField('Hotel 2 Stars')->value }} {{ trans('main.stars') }})</span>
                        </div>
                        @if($service->id != 16)
                            <div class="feed">
                                <span><b>{{ $listing->getField('Destination 3')->value }} </b>({{ $listing->getField('No. of Nights (Destination 3)')->value }} Nights)</span>
                                <span>{{ $listing->getField('Hotel 3')->value }}<br>({{ $listing->getField('Hotel 3 Stars')->value }} {{ trans('main.stars') }})</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="listing-info">
                <div class="col-md-3 no-padding">
                    <a href="#">
                        <div class="corporate-logo">
                            <img src="/uploads/{{ $listing->corporate->details->logo }}" class="img-responsive">
                        </div>
                    </a>
                    <div class="listing-rating corporate">
                         @for($i = 0; $i < $listing->corporate->rating; $i++)
                             <i class="fa fa-star"></i>
                         @endfor
                         @for($i = 0; $i < 5 - $listing->corporate->rating; $i++)
                             <i class="fa fa-star-o"></i>
                         @endfor
                    </div>
                </div>
                <div class="col-md-9 corporate-overview">
                    <div class="travel-info">
                        <span><b>{{ $listing->getField('Departure Date')->translate()->name }}</b> {{ $listing->getField('Departure Date')->value }}</span>
                        <span>|</span>
                        <span><b>{{ $listing->getField('Return Date')->translate()->name }}</b> {{ $listing->getField('Return Date')->value }}</span>
                        <p><b>{{ $listing->getField('Airline')->value }}</b> {{ $listing->getField('Seat Class')->value }}</p>
                        @if($listing->getIncluded())
                            <p><b>{{ trans('main.includes') }}</b> {{ $listing->getIncluded() }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="listing-rating text-center">
                @for($i = 0; $i < $listing->averageRating; $i++)
                    <i class="fa fa-star fa-2x"></i>
                @endfor
                @for($i = 0; $i < 5 - $listing->averageRating; $i++)
                    <i class="fa fa-star-o fa-2x"></i>
                @endfor
            </div>
            <div class="singleListing-sidebar">
                <div class="singleListing-slider">
                    @if($listing->photos->count())
                    <div id="listing-carousel-{{ $listing->id }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="{{ imagePath($listing->photos->first()->name) }}" alt="{{ $listing->photos->first()->translate()->caption }}">
                            </div>
                            @foreach($listing->photos->slice(1) as $photo)
                                <div class="item">
                                    <img src="{{ imagePath($photo->name) }}" alt="{{ $photo->translate()->caption }}">
                                </div>
                            @endforeach
                        </div>
                        <a class="left carousel-control" href="#listing-carousel-{{ $listing->id }}" role="button" data-slide="prev">
                            <img src="/assets/img/arrow-left.png" class="img-responsive" id="img-left">
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#listing-carousel-{{ $listing->id }}" role="button" data-slide="next">
                            <img src="/assets/img/arrow-right.png" class="img-responsive" id="img-right">
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Package price and buy button -->
            <div class="col-md-6 no-padding package-price">
                <p>{{ $listing->getField('Price (Package)')->value }} {{ trans('main.egp') }} ({{ $listing->getField('No. of Guests')->value }} {{ trans('main.guests') }})</p>
            </div>
            <div class="col-md-6 no-padding package-price-buy">
                <a href="{{ route('listing.pay', $listing->id) }}" class="btn btn-trans">{{ trans('main.bookNow') }}</a>
            </div>
        </div>
     <div class="clearfix"></div>
    </div>

@section('scripts')
    <script>
        $('.package-price-buy .btn-trans').css('height',$('.package-price').outerHeight());
    </script>
@endsection
