<?php

namespace App\Presenters\Traits;

use App\Presenters\Exceptions\PresenterException;

trait PresentableTrait
{
    protected $presenterInstance;

    public function present()
    {
        if(! $this->presenter or ! class_exists($this->presenter))
        {
            throw new PresenterException('Please set the presenter property to your presenter path.');
        }

        if(! isset($this->presenterInstance))
        {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}