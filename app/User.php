<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'corporate_id',
        'corporate_role_id',
        'phone',
        'city',
        'gender',
        'birth_date',
        'address',
        'settings'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'birth_date'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'settings' => 'json'
    ];

    /**
     * @param $value
     */
    public function setBirthDateAttribute($value)
    {
        if($value) {
            $this->attributes['birth_date'] = Carbon::createFromFormat('d-m-Y', $value);
        }
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Creates a transaction assoicated with the user.
     * @param $amount
     * @param $attributes
     * @return Transaction
     */
    public function charge($amount, $attributes)
    {
        return $this->transactions()->create(array_merge($attributes, ['amount' => $amount]));
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'comparisons');
    }

    /**
     * @param $role
     * @return bool
     */
    public function is($role)
    {
        if (is_array($role)) {
            return in_array($this->role->title, $role);
        }

        return $this->role->title === str_slug($role);
    }

    /**
     * @param $role
     * @return bool
     */
    public function is_corporate($role)
    {
        if (is_array($role)) {
            return in_array($this->corporateRole->title, $role);
        }

        return $this->corporateRole->title === str_slug($role);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporate()
    {
        return $this->belongsTo(Corporate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporateRole()
    {
        return $this->belongsTo(CorporateRole::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @param Listing $listing
     * @return boolean
     */
    public function hasApplied(Listing $listing)
    {
        return $listing->leads()->pending()->where('user_id', $this->id)->exists();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * @param $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function notify($attributes)
    {
        return $this->notifications()
                    ->create($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leads()
    {
        return $this->hasMany(Lead::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function interests()
    {
        return $this->belongsToMany(Service::class, 'interests');
    }

    /**
     * @return Settings
     */
    public function settings()
    {
        return new Settings($this);
    }
}
