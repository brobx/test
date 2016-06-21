<?php

namespace App;

use App\Calculators\BankingCalculator;

use App\Presenters\Contracts\IPresentable;
use App\Presenters\ListingPresenter;
use App\Presenters\Traits\PresentableTrait;
use App\Traits\OwnsPhotos;
use App\Traits\RequiresManagerApproval;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Listing extends Model implements IPresentable
{
    use Translatable, RequiresManagerApproval, OwnsPhotos, Loggable, PresentableTrait;

    /**
     * @var
     */
    protected $presenter = ListingPresenter::class;

    /**
     * @var array
     */
    protected $callTime = [
        1 => '9 a.m. - 12 p.m',
        2 => '12 p.m. - 3 p.m',
        3 => '3 a.m. - 6 p.m',
        4 => '6 a.m. - 9 p.m',
    ];

    /**
     * @var
     */
    private $averageRating;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'overview',
        'offers',
        'details',
        'benefits',
        'eligibility',
        'documents',
        'url',
        'corporate_id'
    ];

    /**
     * @var
     */
    private $calculator;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields()
    {
        return $this->belongsToMany(ListingField::class, 'listing_listing_field')->withPivot('value');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Gets the listing transactions.
     *
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'comparisons');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporate()
    {
        return $this->belongsTo(Corporate::class);
    }

    /**
     * @param $fieldName
     * @return string
     */
    public function getFieldValue($fieldName)
    {
        $field = $this->getField($fieldName);

        return $field ? $field->pivot->value : '';
    }

    /**
     * @param $fieldName
     * @return mixed
     */
    public function getField($fieldName)
    {
        $field = $this->fields->where('name', $fieldName)->first();

        if(! $field) {
            $field = $this->service->listingFields()->where('name', $fieldName)->first();
        }

        return $field;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * @param $query
     * @param $filter
     * @return mixed
     */
    public function scopeFilter($query, $filter)
    {
        return $filter->apply($query);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * @param $query
     * @param $corporateId
     * @return mixed
     */
    public function scopeOwnedByCorporate($query, $corporateId)
    {
        return $query->where('corporate_id', $corporateId);
    }

    /**
     * Gets the highlights of this listing.
     *
     * @return mixed
     */
    public function highlights()
    {
        return $this->fields()->highlights()->limit(5);
    }

    /**
     * @return string
     */
    public function getIncluded()
    {
        $flight = $this->checkInclude('Flight Included') ? trans('main.flight') . ', ' : '';
        $transportation = $this->checkInclude('Transportation Included') ? trans('main.transportation') . ', ' : '';
        $taxes = $this->checkInclude('Taxes Included') ? trans('main.transportation') . ', ' : '';

        $notLast = $flight || $taxes || $transportation;

        $food = $this->fields->where('name', 'Food & Beverage')
                             ->first()
                             ->options()
                             ->where('name', 'Not Included')->first(['id'])->id == $this->getFieldValue('Food & Beverage') ?
            '' : ($notLast ? trans('main.and') : '') . $this->getField('Food & Beverage')->value;

        return trim("{$flight}{$transportation}{$taxes}{$food}", " ,");
    }

    /**
     * @param $fieldName
     * @return bool
     */
    protected function checkInclude($fieldName)
    {
        return $this->fields->where('name', 'Transportation Included')
                            ->first()
                            ->options()
                            ->where('name', 'Yes')
                            ->first(['id'])->id == $this->getFieldValue($fieldName);
    }

    /**
     * @return BankingCalculator
     */
    public function calculate()
    {
       if(! $this->calculator) {
           $this->calculator = new BankingCalculator($this);
       }

        return $this->calculator;
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function apply(Request $request)
    {
        if($request->has('phone')) {
            $request->user()->update(['phone' => $request->get('phone')]);
        }
        $time = null;

        if ($request->has('prefferedCallTime')) {
            if (array_key_exists($request->get('prefferedCallTime'), $this->callTime)) {
                $time = $this->callTime[$request->get('prefferedCallTime')];
            }
        }

        return $this->leads()->create([
            'ip_address' => $request->ip(),
            'user_id' => $request->user()->id,
            'type' => $request->get('type'),
            'preffered_call_time' => $time,
            'language' => $request->segment(1) == 'en' ? 'English' : 'Arabic'
        ]);
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function buy(Request $request)
    {
        return $this->leads()->create([
            'ip_address' => $request->ip(),
            'user_id' => $request->user()->id,
            'type' => 'purchase',
            'language' => $request->segment(1) == 'en' ? 'English' : 'Arabic'
        ]);
    }

    /**
     * @param Lead $lead
     * @param $rating
     * @return Model
     */
    public function review(Lead $lead, $rating)
    {
        return $this->reviews()->create([
            'user_id' => auth()->user()->id,
            'lead_id' => $lead->id,
            'rating' => $rating
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return mixed
     */
    public function getAverageRatingAttribute()
    {
        if (! isset($this->averageRating)) {
            $this->averageRating = $this->reviews()->avg('rating');
        }

        return (int)$this->averageRating;
    }

    /**
     * Sets the scope to the listing which belong to unsuspended corporates.
     * @param  $query
     * @return mixed
     */
    public function scopeUnsuspended($query)
    {
        return $query->whereHas('corporate', function ($q) {
            $q->active();
        });
    }
}
