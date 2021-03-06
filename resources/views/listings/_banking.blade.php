<div class="listing-box border-bottom{{ isset($featured) && $featured ? ' highlighted' : '' }}">
    <div class="col-md-9">
        @if(isset($featured) && $featured)
            <span class="text-danger">{{ trans('main.sponsored') }}</span>
        @endif
        <div class="row">
            <div class="col-md-3">
                <a href="#" class="listing-title-anchor">
                    <a href="{{ route('listing.show', $listing->id) }}" class="listing-title-anchor">
                        <h2 class="listing-title">{{ $listing->translate()->name }}</h2>
                    </a>
                </a>
            </div>
            <div class="col-md-9">
                <div class="listing-feedback">
                    @foreach($highlights as $highlight)
                        <div class="feed">
                            <span><b>{{ $highlight->translate()->name }}</b></span>
                            <span>{{ $listing->getField($highlight->name)->present()->value }}</span>
                        </div>
                    @endforeach
                    @if(in_array($service->name, ['Personal Loans', 'Car Loans', 'Home Loans', 'SME Finance']))
                        <div class="feed">
                            <span><b>{{ trans('main.monthlyIns') }}</b></span>
                            <span>{{ $listing->calculate()->monthlyInstallment }}</span>
                        </div>
                        <div class="feed">
                            <span><b>{{ trans('main.totalCost') }}</b></span>
                            <span>{{ $listing->calculate()->totalCostOfCredit }}</span>
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
                <!-- <p>{{ str_limit($listing->translate()->overview, 75) }}</p> -->
                <p class="overviewMore">{{ $listing->translate()->overview }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php
            $tempRews = $reviews[$listing->id];
            $average = 0;
            $count = 0;
            $tempRatings =[];
            foreach ($tempRews as $rew) {
                foreach ($rew as $item) {
                    $tempRatings[str_replace('_', ' ', $item->type)] = $item->sum_rating;
                    $average += (int)$item->sum_rating;
                    $count++;
                }
            }
            if ($average) {
                $average = $average / $count;
            }

        ?>


        <div class="listing-rating">
            @for($i = 0; $i < $average; $i++)
                <i class="fa fa-star fa-2x"></i>
            @endfor
            @for($i = 0; $i < 5 - $average; $i++)
                <i class="fa fa-star-o fa-2x"></i>
            @endfor
            @if(!empty($tempRatings))
                <div class="blockRatingShow">
                    <i class="fa fa-caret-left carretRate" aria-hidden="true"></i>
                    <ul>
                        @foreach($tempRatings as $k => $v)
                            <li><div>{{$k}}</div>
                                <div>
                                    @for($i = 0; $i < $v; $i++)
                                        <i class="fa fa-star fa-2x"></i>
                                    @endfor
                                    @for($i = 0; $i < 5 - $v; $i++)
                                        <i class="fa fa-star-o fa-2x"></i>
                                    @endfor
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="listing-actions">
            <a href="{{ route('listing.getApply', $listing->id) }}"
               class="btn btn-trans green">{{ trans('main.applyNow') }}</a>
            <a href="#" class="btn btn-trans"
               @click.prevent="$broadcast('addedListing', {{ $listing->id }}, '{{ $listing->translate()->name }}','/uploads/{{ $listing->corporate->details->logo }}')"
            >{{ trans('main.compare') }}</a>
            <a href="{{ route('listing.show', $listing->id) }}"
               class="btn btn-trans light-orange">{{ trans('main.moreDetails') }}</a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "@lang('main.showMore')";
    var lesstext = "@lang('main.showLess')";


    $('.overviewMore').each(function() {
        var content = $(this).html();

        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="overviewMoreContent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
@endsection
