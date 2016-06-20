<?php

namespace App;

use App\Analytics\Corporate\Stats;
use App\Billing\Billable;
use App\Billing\Contracts\Billable as BillableContract;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class Corporate extends Model implements BillableContract
{
    use Translatable, Billable, Loggable;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'type_id'
    ];

    /**
     * Caches the corporate average rating.
     */
    protected $avgRating;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CorporateType::class);
    }

    /**
     * Gets the corporate transactions.
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Listing::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function servicesWithCommission()
    {
        return $this->belongsToMany(Service::class, 'commissions')->withPivot('commission');
    }

    /**
     * @param Service $service
     * @return mixed
     */
    public function getCommission(Service $service)
    {
        return $this->servicesWithCommission->find($service->id)->pivot->commission;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('suspended', false);
    }

    /**
     * Gets the users in this corporation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Gets the manager.
     *
     * @return mixed
     */
    public function manager()
    {
        return $this->hasOne(User::class)->where('corporate_role_id', 1);
    }

    /**
     * Adds a user to the corporate.
     *
     * @param User $user
     * @return Model
     */
    public function add(User $user)
    {
        return $this->users()->save($user);
    }

    /**
     * Adds the initial user.
     *
     * @param $attributes
     * @return Model
     */
    public function addInitialUser($attributes)
    {
        $user = new User($attributes);
        $user->role_id = 2;
        $user->corporate_role_id = 1;

        return $this->add($user);
    }

    /**
     * Toggles suspension status for the corporate and its users.
     */
    public function toggleSuspension()
    {
        $this->suspended = ! $this->suspended;
        $this->save();

        $this->users()->update(['suspended' => $this->suspended]);

        return $this->suspended;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function details()
    {
        return $this->hasOne(CorporateDetails::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branches()
    {
        return $this->hasMany(CorporateBranch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sliders()
    {
        return $this->hasMany(CorporateSlider::class, 'corporate_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pendingData()
    {
        return $this->hasMany(PendingData::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function leads()
    {
        return $this->hasManyThrough(Lead::class, Listing::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithLogo($query)
    {
        return $query->whereHas('details', function ($q) {
            $q->whereNotNull('logo');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    /**
     * @return mixed
     */
    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Listing::class);
    }

    /**
     * [getRatingAttribute description]
     * @return [type] [description]
     */
    public function getRatingAttribute()
    {
        if(! $this->avgRating) {
            $this->avgRating = $this->stats()->rating();
        }

        return $this->avgRating;
    }

    /**
     * @return Stats
     */
    public function stats()
    {
        return new Stats($this);
    }
}
