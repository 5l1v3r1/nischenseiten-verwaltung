<?php

namespace app\Composers;

use Illuminate\View\View;
use App\Option;

class ApiComposer
{
    /**
     * The optiontable repository implementation.
     *
     * @var Option
     */
    protected $option;

    /**
     * Create a new profile composer.
     *
     * @param Option $option
     */
    public function __construct(Option $option)
    {
        // Dependencies automatically resolved by service container...
        $this->option = $option;
    }

    /**
     * Bind data with ID 1 (apimetrics key) to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $api = $this->option->find(1);
        $view->with('api', $api);
    }
}
