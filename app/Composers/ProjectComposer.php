<?php

namespace app\Composers;

use Illuminate\View\View;
use App\Project;

class ProjectComposer
{
    /**
     * The project repository implementation.
     *
     * @var Projects
     */
    protected $projects;

    /**
     * Create a new profile composer.
     *
     * @param Project $projects
     */
    public function __construct(Project $projects)
    {
        // Dependencies automatically resolved by service container...
        $this->projects = $projects;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('projects', $this->projects);
    }
}
