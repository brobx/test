<?php


namespace App\Helpers\Renderers;


use App\Destination;
use App\ListingField;
use Collective\Html\FormFacade as Form;

class FieldRenderer
{
    /**
     * @var
     */
    protected static $errors;

    /**
     * @var array
     */
    protected static $availableTypes = [
        'textbox',
        'checkbox',
        'radio',
        'commentsbox',
        'dropmenu',
        'selectionslider',
        'rangeslider',
        'date',
        'starselector',
        'numeric',
        'egyptiancities'
    ];

    /**
     * @param $errors
     */
    public static function renderErrors($errors)
    {
        static::$errors = $errors;
    }

    /**
     * @param ListingField $field
     * @param string $value
     * @param bool $wrapped
     * @param bool $labeled
     * @return string
     */
    public static function render(ListingField $field, $value = '', $wrapped = true, $labeled = true)
    {
        $hasError = static::$errors && static::$errors->has('fields.' . $field->id) ? ' has-error' : null;
        $position = $field->type === 'date' ? 'style="position: relative;"' : '';

        $html = $wrapped ? "<div class='form-group{$hasError}' $position>" : "";

        switch ($field->type) {
            case 'checkbox': $html .= static::renderCheckbox($field, $value, $labeled); break;
            case 'radio': $html .= static::renderRadio($field, $value, $labeled); break;
            case 'commentsbox': $html .= static::renderCommentBox($field, $value, $labeled); break;
            case 'dropmenu': $html .= static::renderDropMenu($field, $value, $labeled); break;
            case 'rangeslider': $html .= static::renderSlider($field, $value, $labeled); break;
            case 'selectionslider': $html .= static::renderSelectionSlider($field, $value, $labeled); break;
            case 'date': $html .= static::renderDatePicker($field, $value, $labeled); break;
            case 'numeric': $html .= static::renderNumeric($field, $value, $labeled); break;
            case 'starselector': $html .= static::renderStarInput($field, $value, $labeled); break;
            case 'egyptiancities': $html .= static::renderEgyptianCities($field, $value, $labeled); break;
            case 'internationalcities': $html .= static::renderInternationalCities($field, $value, $labeled); break;

            case 'textbox':
            default: $html .= static::renderTextBox($field, $value, $labeled); break;
        }

        if($hasError) {
            $html .= static::renderError($field);
        }

        $html .= $wrapped ? "</div>" : '';

        return $html;
    }

    /**
     * @param $field
     * @param string $value
     * @return string
     */
    public static function renderPlain($field, $value = '')
    {
        return static::render($field, $value, false, false);
    }

    /**
     * @param ListingField $field
     * @return string
     */
    public static function renderError(ListingField $field)
    {
        $message = static::$errors->first('fields.' . $field->id);
        $html = "<span class=\"help-block\">
                    <strong>{$message}</strong>
                 </span>";

        return $html;
    }

    /**
     * @param ListingField $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderTextBox(ListingField $field, $value, $labeled)
    {
        $comma = '';
        if(str_contains($field->settings['validation'], 'numeric')) {
            $comma = 'v-comma';
        }

        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label>" : '';

        // return $html . "<input $comma type='text' id='field-{$field->id}' placeholder='{$field->unit}' name='fields[{$field->id}]' value='$value' class='form-control'>";
        return $html . Form::text("fields[{$field->id}]", $value, ['id'=>"field-{$field->id}", 'placeholder'=>"{$field->unit}", 'class'=>'form-control', ($comma ?: null)]);
    }

    /**
     * @param ListingField $field
     * @param $value
     * @return string
     */
    protected static function renderCommentBox(ListingField $field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label>" : '';

        return $html . "<textarea id='field-{$field->id}' name='fields[{$field->id}]' class='form-control'>{$value}</textarea>";
    }

    /**
     * @param ListingField $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderDropMenu(ListingField $field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label>" : '';

        return $html . Form::select("fields[{$field->id}]", $field->options()->lists('name', 'id'), $value, ['class' => 'form-control']);
    }

    /**
     * @param ListingField $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderRadio(ListingField $field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label><br>" : "";
        foreach ($field->options as $option) {
            $checked =  $value == $option->id ? 'checked' : '';
            // $html .= "<input type=\"radio\" id='field-{$field->id}' name=\"fields[{$field->id}]\" value=\"{$option->id}\" {$checked}> {$option->name}<br>";
            $html .= Form::radio("fields[{$field->id}]", "{$option->id}", $checked, ['id'=>"field-{$field->id}"]) ." {$option->name}<br>";
        }

        return $html;
    }

    /**
     * @param ListingField $field
     * @param $value
     * @return string
     */
    protected static function renderCheckbox(ListingField $field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label><br>" : '';
        foreach ($field->options as $option) {
            $checked =  $value == $option->id ? 'checked' : '';
            // $html .= "<input type=\"checkbox\" id='field-{$field->id}' name=\"fields[{$field->id}][]\" value=\"{$option->id}\" {$checked}> {$option->name}<br>";
            $html .= Form::checkbox("fields[{$field->id}][]", "{$option->id}", $checked, ['id'=>"field-{$field->id}"]) ." {$option->name}<br>";
        }

        return $html;
    }

    /**
     * @param ListingField $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderSlider(ListingField $field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label><br>" : '';
        $html .= "<input type='text' v-slider data-slider-id=\"blue\" name='fields[{$field->id}]' id='field-{$field->id}'
                         :min=\"{$field->settings['min']}\"
                         :max=\"{$field->settings['max']}\"
                         :step=\"{$field->settings['step']}\"
                         data-slider-value=\"{$value}\"
                   >";

        return $html;
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderSelectionSlider($field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label><br>" : '';
        $html .= "<input type='text' v-slider data-slider-id=\"blue\" name='fields[{$field->id}]' id='field-{$field->id}'
                         data-slider-value=\"{$value}\"
                         data-slider-ticks-labels='[{$field->options}]'
                         data-slider-ticks='[{$field->options}]'>";

        return $html;
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderDatePicker($field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label><br>" : '';

        // return $html . "<input type='text' id='field-{$field->id}' name='fields[{$field->id}]' value='$value' class='form-control' v-date-picker>";
        return $html . Form::text("fields[{$field->id}]", $value, ['id'=>"field-{$field->id}", 'placeholder'=>"{$field->unit}", 'class'=>'form-control', 'v-date-picker']);
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderNumeric($field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label><br>" : '';

        return $html . "<input type='number' id='field-{$field->id}' name='fields[{$field->id}]' min='1' max='99' value='$value' class='form-control'>";
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    private static function renderStarInput($field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label><br>" : '';
        $html .= "<input type='number' id='field-{$field->id}' name='fields[{$field->id}]' min='1' max='5' data-step='1' data-size='xs' value='{$value}' class='rating' v-star>";

        return $html;
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    private static function renderEgyptianCities($field, $value, $labeled)
    {
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label>" : '';

        return $html . Form::select("fields[{$field->id}]", Destination::domestic()->lists('name', 'id')->toArray(), $value, ['class' => 'form-control']);
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return mixed
     */
    private static function renderInternationalCities($field, $value, $labeled)
    {
        $appId = config('services.yahoo.id');
        $html = $labeled ? "<label for='field-{$field->id}'>{$field->name}</label>" : '';
        $html .= "<input v-autocomplete api-key='{$appId}' type='text' id='field-{$field->id}' name='fields[{$field->id}]' value='$value' class='form-control'>";

        return $html;
    }
}
