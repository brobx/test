<?php


namespace App\Presenters;


use Illuminate\Support\Facades\App;

class LeadPresenter extends Presenter
{
    /**
     * @return string
     */
    public function type()
    {
        $text = '---';
        $class = 'danger';
        
        switch ($this->entity->type) {
            case 'branch': $text = 'Find Branch'; $class = 'primary'; break;
            case 'online': $text = 'Apply Online'; $class = 'info'; break;
            case 'callback': $text = 'Call Back Request'; $class = 'success'; break;
        }

        return "<span class='label label-{$class}'>{$text}</span>";
    }

    /**
     * @return string
     */
    public function textType()
    {
        switch ($this->entity->type) {
            case 'branch': return App::getLocale() == 'en' ? 'Find Branch' : 'ايجاد فرع';
            case 'online': return App::getLocale() == 'en' ? 'Apply Online' : 'التقديم اونلاين';
            case 'callback': return App::getLocale() == 'en' ? 'Call Back Request' : 'طلب اعادة اتصال';
        }

        return '---';
    }
}