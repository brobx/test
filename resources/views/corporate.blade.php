@extends('master')

@section('page.title')
@lang('main.corporate')
@stop

@section('content')
    <section class="intro corporate slide">
        <div class="section-wrapper">
            <div class="container table">
                <div class="intro-content">
                    <div class="row">
                        <div class="col-md-7 intro-left">
                            <div class="product-slide" id="slides">
                                <div class="slide-item">
                                    <div class="slide-caption">
                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                @foreach($corporate->sliders as $index => $slide)
                                                    <div class="item {{ ! $index ? 'active' : '' }}">
                                                        <img src="{{ imagePath($slide->image) }}"
                                                             class="img-responsive">
                                                        <div class="slide-text">
                                                            <!-- <h3>{{ trans('main.sliderTitle') }}</h3> -->
                                                            <p>{{ $slide->translate()->description }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="arrows">
                                            <a href="#carousel-example-generic"
                                               class="next-arrow right carousel-control" role="button"
                                               data-slide="next">
                                                <img src="/assets/img/arrow-right.png" class="img-responsive">
                                                <span class="sr-only">Next</span>
                                            </a>
                                            <a href="#carousel-example-generic" class="prev-arrow left carousel-control"
                                               role="button" data-slide="prev">
                                                <img src="/assets/img/arrow-left.png" class="img-responsive">
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 intro-right">
                            <div class="corporate-box">
                                <img src="/uploads/{{ $corporate->details->logo }}">
                                <h3>{{ $corporate->translate()->name }}</h3>
                                <div class="corporate-rating">
                                    @for($i = 0; $i < $corporate->stats()->rating(); $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for($i = 0; $i < 5 - $corporate->stats()->rating(); $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-corporate">
        <div class="container">
            <p>
                {{ $corporate->details->translate()->description }}
            </p>
        </div>
    </section>

    <section class="corporate-info gray acc">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="corporate-services box-white">
                        <h2 class="section-title">{{trans('main.services')}}</h2>
                        @foreach($corporate->type->services as $service)
                            <div class="panel-group" id="accordion-{{ $service->id }}">
                                <div class="panel panel-default">
                                    <a class="accordion-toggle" data-toggle="collapse"
                                       data-parent="#accordion-{{ $service->id }}"
                                       href="#collapseOne-{{ $service->id }}">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                {{ $service->translate()->name }}
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseOne-{{ $service->id }}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="alt">
                                                @foreach($service->listings as $listing)
                                                    <li>
                                                        <a href="{{ route('listing.show', $listing->id) }}">
                                                            <p>{{ $listing->translate()->name }}</p>
                                                            @foreach($service->getComparisonFields() as $field)
                                                                <p>
                                                                    <b>{{ $field->translate()->name }}:</b>
                                                                    {{ @$listing->getField($field->name)->value }}
                                                                </p>
                                                            @endforeach
                                                            <p><b>@lang('main.serviceRating'): </b><input type='number' name='{$name}' min='1'
                                                                      max='5' data-step='1' data-size='xs'
                                                                      value='{{ rand(1, 5) }}' class='rating'
                                                                      v-star :display-only="true"
                                                                >
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="corporate-branches box-white">
                        <h2 class="section-title">{{trans('main.branches')}}</h2>
                        <div id="map"></div>
                        <ul>
                            {{--@foreach($corporate->branches as $branch)
                                <a href="#" data-remodal-target="modal">
                                    <li>
                                        <h4>{{ $branch->translate()->name }}</h4>
                                        <p>{{ $branch->translate()->address }}</p>
                                        <p>{{ $branch->phone }}</p>
                                        <p>{{ $branch->working_hours }}</p>
                                    </li>
                                </a>
                            @endforeach--}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="remodal" data-remodal-id="modal"
                 data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
                <button data-remodal-action="close" class="remodal-close"></button>
                <div id="map"></div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var map;
        var infowindow;

        var userPosition = navigator.geolocation.getCurrentPosition(function(position) {
            console.log(position)
                var latitude = position.coords.latitude,
                    longitude = position.coords.longitude,
                    pyrmont = {lat: latitude, lng: longitude},
                    objToSearch = '{{ $corporate->translate()->name }}';
            console.log(objToSearch)
            initMap(pyrmont, objToSearch)
        })
        //console.log(userPosition)


        function initMap(pyrmont, objToSearch) {
            //var pyrmont = {lat: 30.046111, lng: 31.223102};

            map = new google.maps.Map(document.getElementById('map'), {
                center: pyrmont,
                zoom: 11
            });

            infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
                location: pyrmont,
                radius: 15000,
                type: ['bank'],
                name: objToSearch
            }, callback);
        }

        function callback(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        }

        function createMarker(place) {
            var placeLoc = place.geometry.location;
            var marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC96hIBgmfXda-mTT8vL2KMvPBZn2WF0wc&libraries=places" async defer></script>
<script>
    $('.collapse').collapse("hide");
</script>

@endsection
