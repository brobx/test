<?php


namespace App\Traits;

use App\PendingData;

trait RequiresManagerApproval
{
    /**
     * @param $attributes
     * @return mixed
     */
    public static function requestCreate($attributes)
    {
        $user = auth()->user();

        return PendingData::forceCreate([
            'user_id' => $user->id,
            'corporate_id' => $user->corporate_id,
            'pending_type' => static::class,
            'type' => 'create',
            'attributes' => json_encode($attributes)
        ]);
    }

    public function requestUpdate($attributes)
    {
        $user = auth()->user();

        return $this->pendingData()->create([
            'corporate_id' => $user->corporate_id,
            'user_id' => $user->id,
            'type' => 'update',
            'attributes' => json_encode($attributes)
        ]);
    }

    /**
     * @return mixed
     */
    public function requestDelete()
    {
        $user = auth()->user();

        return $this->pendingData()->create([
            'corporate_id' => $user->corporate_id,
            'user_id' => $user->id,
            'type' => 'delete',
        ]);
    }

    /**
     * @return mixed
     */
    public function pendingData()
    {
        return $this->morphMany(PendingData::class, 'pending')->with('user');
    }
}