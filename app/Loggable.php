<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use ReflectionClass;

trait Loggable
{
    /**
     * Boots the loggable trait.
     */
    public static function bootLoggable()
    {
        static::created(function ($model) {
            $model->log('create');
        });

        static::updated(function ($model) {
            $model->log('update');
        });

        static::deleting(function ($model) {
            $model->log('delete');
        });
    }

    /**
     * @return mixed
     */
    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    /**
     * @return mixed
     */
    public function logName()
    {
        return strtolower((new ReflectionClass($this))->getShortName());
    }

    /**
     * @param $name
     * @param $type
     * @return string
     */
    public function logMessage($name, $type)
    {
        $action = '';

        switch ($type) {
            case 'create': $action = 'created'; break;
            case 'update': $action = 'updated'; break;
            case 'delete': $action = 'deleted'; break;
        }

        return "user {$name} {$action} {$this->logName()}";
    }

    /**
     * Creates a log instance for this model.
     * @param $type
     * @return bool
     */
    public function log($type)
    {
        if(auth()->check()) {
            $user = auth()->user();

            return $this->logs()->create([
                'user_id' => $user->id,
                'ip' => request()->ip(),
                'type' => $type,
                'message' => $this->logMessage($user->name, $type)
            ]);
        }

        return true;
    }
}