<?php
use App\Settings;

/**
 * Returns active class if the request ends with or contains the specified string.
 *
 * @param $name
 * @param string $className
 * @return string
 */
function is_active($name, $className = 'active')
{
    return \Request::is("*$name*") ? $className : '';
}

/**
 * Returns image path.
 *
 * @param $name
 * @return string
 */
function imagePath($name)
{
    if(! $name) {
        return '';
    }

    return '/uploads/' . $name;
}

/**
 * Checks if the current language is arabic.
 *
 * @return bool
 */
function isArabic()
{
    return \Request::segment(1) === 'ar';
}

function currentDirection()
{
    return (config('app.locale') == 'ar') ? 'rtl' : 'ltr';
}

/**
 * Prefixes the the locale to the requested url (always absolute).
 *
 * @param $url
 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
 */
function locale_url($url)
{
    // Make sure no extra slashes.
    $url = trim($url, '/');

    return url(config('app.locale') . '/' . $url);
}

function switchLangUrl() {
    $segments = Request::segments();
    if( config('app.locale') == "en" ) {
        $segments[0] = 'ar';
    }else{
        $segments[0] = 'en';
    }
    $url = '/'.implode('/', $segments);
    return $url;
}

/**
 * @param $name
 * @param $text
 * @return string
 */
function link_to_sort($name, $text)
{
    $params = \Request::input();
    $params['order_by'] = $name;
    $params['order'] = \Request::get('order', 'DESC');
    $direction = 'down';

    // Flip order.
    if(\Request::get('order_by') == $name) {
        $order = \Request::get('order');
        $params['order'] = $order == 'DESC' ? 'ASC' : 'DESC';
        $direction = $order == 'DESC' ? 'down' : 'up';
    }

    $route = route('services.listings', array_merge(['services' => \Request::route('services')->id], $params));

    return "<a href='{$route}'><i class=\"fa fa-caret-{$direction} sort-icon\"></i> {$text}</a>";
}

/**
 * @return \Illuminate\Foundation\Application|mixed
 */
function settings()
{
    return app(Settings::class);
}

function getYoutubeId($url)
{
    $youtube_id = '';
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
      $youtube_id = $id[1];
    } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
      $youtube_id = $id[1];
    } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
      $youtube_id = $id[1];
    } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
      $youtube_id = $id[1];
    } else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
        $youtube_id = $id[1];
    }

    return $youtube_id;
}

/**
 * Gets the form value in the backend.
 * @param  [type] $field [description]
 * @return [type]        [description]
 */
function getFieldFormValue($field)
{
    $oldValue = old('fields.' . $field->id);
    if(is_array($oldValue)) {
        return $oldValue[0];
    }

    if($oldValue) {
        return $oldValue;
    }

    if($field->pivot) {
        return $field->pivot->value;
    }

    return '';
}
