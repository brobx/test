<?php

namespace App;

class Settings
{
    /**
     * @var array
     */
    protected $allowed = [
        'opt_in_application_updates',
        'opt_in_news_and_updates',
        'opt_in_special_offers',
        'opt_in_third_party_offers',
        'notification_channel_sms',
        'notification_channel_email',
        'notification_channel_social'
    ];

    /**
     * @var User
     */
    protected $user;

    /**
     * @var mixed
     */
    protected $settings = [];

    /**
     * Settings constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        if($user == null) {
            return;
        }

        $this->settings = $user->settings;

        if (!$this->settings || !count($this->settings)) {
            $this->initialize();
        }
    }

    /**
     * @param $attributes
     * @return bool|int
     */
    public function merge($attributes)
    {
        $this->settings = array_merge(
            $this->settings,
            array_only($attributes, $this->allowed)
        );

        return $this->save();
    }

    /**
     * @param $attributes
     */
    public function sync($attributes)
    {
        $this->settings = array_merge(array_fill_keys($this->allowed, false), array_only($attributes, $this->allowed));
        $this->save();
    }

    /**
     * Gets the settings value.
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return array_get($this->settings, $key);
    }

    /**
     * Sets a settings.
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        if (!in_array($key, $this->allowed)) {
            $this->allowed[] = $key;
        }

        $this->settings[$key] = $value;
        $this->save();
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->settings;
    }

    /**
     * @return bool|int
     */
    public function save()
    {
        return $this->user->update(['settings' => $this->settings]);
    }

    /**
     * Checks if settings has a key.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->settings) && $this->settings[$key];
    }

    /**
     * Initializes the settings with the allowed values.
     */
    protected function initialize()
    {
        $this->settings = array_fill_keys($this->allowed, 0);
        $this->save();
    }
}