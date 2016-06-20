<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    //
    /**
     * Adds http if no protocol was specified.
     * @param string $parameterName
     * @return array
     */
    protected function addHttpToInput($parameterName = 'url')
    {
        $url = $this->get($parameterName);
        if(! $url) {
            return array_replace_recursive($this->input(), $this->allFiles());
        }

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $this->request->set($parameterName, "http://" . $url);
        }

        return array_replace_recursive($this->input(), $this->allFiles());
    }
}
