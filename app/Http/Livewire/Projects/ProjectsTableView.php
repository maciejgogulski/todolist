<?php

namespace App\Http\Livewire\Projects;

use App\Http\Livewire\Projects\Actions\AddUserToProjectAction;
use App\Http\Livewire\Projects\Actions\EditProjectAction;
use App\Http\Livewire\Projects\Actions\SoftDeleteProjectAction;
use App\Http\Livewire\Projects\Filters\HasTasksFilter;
use App\Http\Livewire\Projects\Filters\ManagerAssignedFilter;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;


class ProjectsTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Project::class;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

//    public $buttons = [
//        'create' => [
//            'route' => 'projects.create',
//            'label' => 'projects.create',
//        ],
//    ];

    public function repository():Builder
    {
        return Project::query()->withTrashed();
    }
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('projects.attributes.name'))->sortBy('name'),
            Header::title(__('projects.attributes.manager'))->sortBy('user'),
            Header::title(__('projects.attributes.number_of_tasks')),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->user->name ?? '',
            $model->tasks->count(),
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    protected function actionsByRow(): array
    {
        return [
            new EditProjectAction('projects.edit', __('translation.edit')),
            new AddUserToProjectAction,
            new SoftDeleteProjectAction,
        ];
    }

    protected function filters()
    {
        return [
            new ManagerAssignedFilter,
            new HasTasksFilter,
        ];
    }
}
