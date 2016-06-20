<?php

namespace App\Helpers\Renderers;

use App\Destination;
use App\ListingField;
use Collective\Html\FormFacade as Form;

class FilterFieldRenderer
{
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
        'numeric',
        'rangeslider',
        'starselector',
        'date'
    ];

    /**
     * @param ListingField $field
     * @param string $value
     * @param bool $wrapped
     * @param bool $labeled
     * @return string
     */
    public static function render(ListingField $field, $value = '', $wrapped = true, $labeled = true)
    {
        $dependency = static::checkDependency($field);
        $html = $wrapped ? "<div class='form-group' {$dependency}>" : "";

        switch ($field->type) {
            case 'checkbox': $html .= static::renderCheckbox($field, $value, $labeled); break;
            case 'radio': $html .= static::renderRadio($field, $value, $labeled); break;
            case 'commentsbox': $html .= static::renderCommentBox($field, $value, $labeled); break;
            case 'dropmenu': $html .= static::renderDropMenu($field, $value, $labeled); break;
            case 'rangeslider': $html .= static::renderSlider($field, $value, $labeled); break;
            case 'selectionslider': $html .= static::renderDropMenu($field, $value, $labeled); break;
            case 'date': $html .= static::renderDatePicker($field, $value, $labeled); break;
            case 'numeric': $html .= static::renderNumeric($field, $value, $labeled); break;
            case 'starselector': $html .= static::renderStarInput($field, $value, $labeled); break;
            case 'egyptiancities': $html .= static::renderEgyptianCities($field, $value, $labeled); break;
            case 'internationalcities': $html .= static::renderInternationalCities($field, $value, $labeled); break;

            case 'textbox':
            default: $html .= static::renderTextBox($field, $value, $labeled); break;
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
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderTextBox(ListingField $field, $value, $labeled)
    {
        $comma = '';
        if($field->settings && array_has($field->settings, 'validation') && str_contains($field->settings['validation'], 'numeric')) {
            $comma = 'v-comma';
        }

        $name = static::getInputName($field);
        $label = static::getLabelText($field);
        $fieldDependency = '';

        $html = $labeled ? "<label for='field-{$name}'>{$label}</label>" : '';

        return $html . "<input {$comma} type='text' id='field-{$name}' name='{$name}' value='$value' class='form-control' $fieldDependency>";
    }

    /**
     * @param ListingField $field
     * @param $value
     * @return string
     */
    protected static function renderCommentBox(ListingField $field, $value, $labeled)
    {
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $html = $labeled ? "<label for='field-{$name}'>{$label}</label>" : '';

        return $html . "<textarea id='field-{$name}' name='{$name}' class='form-control'>{$value}</textarea>";
    }

    /**
     * @param ListingField $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderSharia(ListingField $field, $value, $labeled)
    {
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $html = $labeled ? "<label for='{$name}'>{$label}</label>" : '';

        $options = $field->options()->with('translations')->where('name', 'Yes')->get(['name', 'id']);
        $list = [];

        foreach ($options as $option) {
            $list[$option->id] = $option->translate()->name;
        }

        $list[''] = trans('main.showAll');

        return $html . Form::select("$name", $list, $value, ['class' => 'form-control']);
    }

    /**
     * @param ListingField $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderDropMenu(ListingField $field, $value, $labeled)
    {
        if($field->name == 'Sharia Compliant') {
            return static::renderSharia($field, $value, $labeled);
        }

        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $html = $labeled ? "<label for='{$name}'>{$label}</label>" : '';

        $options = $field->options()->with('translations')->get(['name', 'id']);
        $list = [];

        foreach ($options as $option) {
            $list[$option->id] = $option->translate()->name;
        }

        return $html . Form::select("$name", $list, $value, ['class' => 'form-control']);
    }

    /**
     * @param ListingField $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderRadio(ListingField $field, $value, $labeled)
    {
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $html = $labeled ? "<label for='field-{$name}'>{$label}</label><br>" : "";
        foreach ($field->options as $index => $option) {
            $checked =  $value == $option->id ? 'checked' : '';
            $html .= "<div class=\"radio\"><label><input type=\"radio\" id='field-{$name}_{$index}' name=\"{$name}\" value=\"{$option->id}\" {$checked}> {$option->translate()->name}</label></div>";
        }

        return $html;
    }

    /**
     * @param ListingField $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderCheckbox(ListingField $field, $value, $labeled)
    {
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $html = $labeled ? "<label for='field-{$field->id}'>{$label}</label><br>" : '';
        foreach ($field->options as $index => $option) {
            $checked = is_array($value) && in_array($option->id, $value) ? 'checked' : '';
            $html .= "<div class=\"checkbox\"><label><input type=\"checkbox\" id='field-{$name}_{$index}' name=\"{$name}[]\" value=\"{$option->id}\" {$checked}> {$option->translate()->name}</label></div>";
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
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $direction = (config('app.locale') == 'ar') ? 'rtl' : 'ltr';

        return "<div class=\"row\">
					<div class=\"col-md-12\">
						<p class='filter-label to-slider'>{$label} <span id='field-{$name}-span' class='slider-value'>{$value}</span></p>
					</div>
					<div class=\"col-md-12\">
					    <input type='hidden' name='{$name}' id='field-{$name}'>
                        <div v-slider
                           :min='{$field->settings['min']}'
                           :max='{$field->settings['max']}'
                           :step='{$field->settings['step']}'
                           :value='{$value}'
                           units='{$field->unit}'
                           direction='$direction'
                           input-id='field-{$name}'
                           span-id='field-{$name}-span'
                           ></div>
					</div>
				</div>";
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderSelectionSlider($field, $value, $labeled)
    {
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $options = trim(implode(',', $field->options->lists('name')->toArray()), ',');

        return "<div class=\"row\">
					<div class=\"col-md-12\">
						<div class=\"text-center\">
							<input type='text' name='{$name}' id='field-{$name}' class='slider-input'>
						</div>
					</div>
					<div class=\"col-md-3\">
						<p class='filter-label'>{$label}</p>
					</div>
					<div class=\"col-md-9\">
                        <div v-selection-slider
                           :value='{$value}'
                           :values='[{$options}]'
                           input-id='field-{$name}'

                           ></div>
					</div>
				</div>";
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderDatePicker($field, $value, $labeled)
    {
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $html = $labeled ? "<label for='field-{$field->id}'>{$label}</label><br>" : '';

        return $html . "<div class=\"datepicker\"><input type='text' id='field-{$field->id}' name='{$name}' value='{$value}' class='form-control' v-date-picker></div>";
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    protected static function renderNumeric($field, $value, $labeled)
    {
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $html = $labeled ? "<label for='field-{$field->id}'>{$label}</label><br>" : '';

        return $html . "<input type='number' id='field-{$field->id}' name='{$name}' min='1' max='99' value='{$value}' class='form-control'>";
    }


    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return string
     */
    private static function renderStarInput($field, $value, $labeled)
    {
        $name = static::getInputName($field);
        $label = static::getLabelText($field);

        $html = $labeled ? "<label for='field-{$field->id}'>{$label}</label><br>" : '';
        $html .= "<input type='number' id='field-{$field->id}' name='{$name}' min='1' max='5' data-step='1' data-size='xs' value='{$value}' class='rating' v-star>";

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
        $label = static::getLabelText($field);
        $name = static::getInputName($field);

        $html = $labeled ? "<label for='{$name}'>{$label}</label>" : '';
        $cities = [];
        $destinations = Destination::domestic()->get(['name', 'id']);

        foreach ($destinations as $destination) {
            $cities[$destination->id] = $destination->translate()->name;
        }

        return $html . Form::select("{$name}", $cities, $value, ['class' => 'form-control']);
    }

    /**
     * @param ListingField $field
     * @return mixed
     */
    public static function getInputName(ListingField $field)
    {
        return snake_case(str_replace(['.', '/'], '', $field->name));
    }

    /**
     * @param $field
     * @return string
     */
    protected static function checkDependency($field)
    {
        $name = static::getInputName($field);
        $fieldDependency = '';

        if($name == 'monthly_fees' && ($field->service && in_array($field->service->name, ['Data Plans', 'Voice Plans']))) {
            $value = ListingField::where([
                'name' => 'Postpaid / Prepaid',
                'service_id' => $field->service_id
            ])->first()->options()->where('name', 'Prepaid')->first()->id;
            $fieldDependency = "v-show-where field-name='postpaid_prepaid' where-value='{$value}'";
        }
        else if($name == 'minute_rate' && ($field->service && in_array($field->service->name, ['Data Plans', 'Voice Plans']))) {
            $value = ListingField::where([
                'name' => 'Postpaid / Prepaid',
                'service_id' => $field->service_id
            ])->first()->options()->where('name', 'Postpaid')->first()->id;
            $fieldDependency = "v-show-where field-name='postpaid_prepaid' where-value='{$value}'";
        }
        else if($name == 'employer_type' && ($field->service && in_array($field->service->name, ['Personal Loans', 'Car Loans', 'Home Loans', 'Credit Card']))) {
            $value = ListingField::where([
                'name' => 'Employment Status',
                'service_id' => $field->service_id
            ])->first()->options()->where('name', 'Salaried')->first()->id;
            $fieldDependency = "v-show-where field-name='employment_status' where-value='{$value}'";
        }
        else if($name == 'business_type' && ($field->service && in_array($field->service->name, ['Personal Loans', 'Car Loans', 'Home Loans', 'Credit Card']))) {
            $value = ListingField::where([
                'name' => 'Employment Status',
                'service_id' => $field->service_id
            ])->first()->options()->where('name', 'Self-employed')->first()->id;
            $fieldDependency = "v-show-where field-name='employment_status' where-value='{$value}'";
        }

        return $fieldDependency;
    }

    /**
     * @param $field
     * @return mixed
     */
    private static function getLabelText($field)
    {
        if ($field->settings && array_has($field->settings, 'label')) {
            return $field->settings['label'];
        }

        return $field->translate()->name;
    }

    /**
     * @param $field
     * @param $value
     * @param $labeled
     * @return mixed
     */
    private static function renderInternationalCities($field, $value, $labeled)
    {
        $name = static::getInputName($field);

        $appId = config('services.yahoo.id');
        $html = $labeled ? "<label for='field-{$name}'>{$field->translate()->name}</label>" : '';
        $html .= "<input v-autocomplete api-key='{$appId}' type='text' id='field-{$name}' name='{$name}' value='$value' class='form-control'>";

        return $html;
    }
}
