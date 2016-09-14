<?php

namespace App\Composers;

use Illuminate\View\View;
use App\Option;

class ApiComposer
{

    /**
     * The user repository implementation.
     *
     * @var Projects
     */
    protected $option;

    /**
     * Create a new profile composer.
     *
     * @param  Project $projects
     * @return void
     */
    public function __construct(Option $option)
    {
        // Dependencies automatically resolved by service container...
        $this->option = $option;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $api = $this->option->find(1);
        $view->with('api', $api);
    }

}
