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
                @if(@$service_type == 'voice plans')
                <div class="listing-feedback">
                    @if( strtolower($listing->getField('Postpaid / Prepaid')->present()->value) == 'postpaid' )
                        <div class="feed">
                            <span>
                                <b>{{ explode(' ', $listing->getField('Monthly Fees')->translate()->name)['0'] }}</b>
                                <br><small>{{ implode(' ', array_slice(explode(' ', $listing->getField('Monthly Fees')->translate()->name), 1)) }}</small>
                            </span>
                            <span>{{ $listing->getField($listing->getField('Monthly Fees')->name)->value }}</span>
                        </div>
                    @else
                        <div class="feed">
                            <span>
                                <b>{{ explode(' ', $listing->getField('Minute Rate')->translate()->name)['0'] }}</b>
                                <br><small>{{ implode(' ', array_slice(explode(' ', $listing->getField('Minute Rate')->translate()->name), 1)) }}</small>
                            </span>
                            <span>{{ $listing->getField($listing->getField('Minute Rate')->name)->value }}</span>
                        </div>
                    @endif
                    @foreach($highlights->whereIn('name', [
                            'Minutes (same operator)',
                            'Minutes (any operator)',
                            'SMS (same operator)',
                            'SMS (any operator)',
                        ]) as $highlight)
                    <div class="feed">
                        <span>
                            <b>{{ explode(' ', $highlight->translate()->name)['0'] }}</b>
                            <br><small>{{ implode(' ', array_slice(explode(' ', $highlight->translate()->name), 1)) }}</small>
                        </span>
                        <span>{{ $listing->getField($highlight->name)->value }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="more-info">
                    <div class="row">
                        @foreach($highlights->whereIn('name', [
                            'Postpaid / Prepaid',
                            'Monthly Data Quota',
                            'Additional MBs',
                            'Data Device Sharing',
                        ]) as $highlight)
                        <div class="col-md-6">
                            <b>{{$highlight->translate()->name}}:</b> 
                                {{ $listing->getField($highlight->name)->present()->value }}
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="listing-feedback">
                    @foreach($highlights as $highlight)
                        <div class="feed">
                            <span><b>{{ $highlight->translate()->name }}</b></span>
                            <span>{{ $listing->getField($highlight->name)->present()->value }}</span>
                        </div>
                    @endforeach
                </div>
                @endif

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
        <div class="listing-rating">
            @for($i = 0; $i < $listing->averageRating; $i++)
                <i class="fa fa-star fa-2x"></i>
            @endfor
            @for($i = 0; $i < 5 - $listing->averageRating; $i++)
                <i class="fa fa-star-o fa-2x"></i>
            @endfor
        </div>
        <div class="listing-actions">
            <a href="{{ route('listing.getApply', $listing->id) }}" class="btn btn-trans green">{{ trans('main.applyNow') }}</a>
            <a href="#" class="btn btn-trans"
               @click.prevent="$broadcast('addedListing', {{ $listing->id }}, '{{ $listing->translate()->name }}','/uploads/{{ $listing->corporate->details->logo }}')"
            >{{ trans('main.compare') }}</a>
            <a href="{{ route('listing.show', $listing->id) }}" class="btn btn-trans light-orange">{{ trans('main.moreDetails') }}</a>
        </div>
    </div>
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