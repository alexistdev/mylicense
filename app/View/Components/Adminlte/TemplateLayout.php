<?php

namespace App\View\Components\Adminlte;

use Illuminate\View\Component;

class TemplateLayout extends Component
{
    /**
     * Mylicense v.1.0
     * created: 18-12-2021
     * Author: AlexistDev
     * Email: Alexistdev@gmail.com
     * phone: 0813-7982-3241
     */

    public $tagSubMenu;
    public $title;

    public function __construct($tagSubMenu,$title)
    {
        $this->tagSubMenu = $tagSubMenu;
        $this->title = $title;
    }


    public function render()
    {
        return view('components.adminlte.template-layout');
    }
}
