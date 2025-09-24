<?php

namespace App\DataTables;

use App\Models\Description;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class DescriptionDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('about_id', fn($model) => Str::limit(strip_tags($model->about_id), 50))
            ->editColumn('about_en', fn($model) => Str::limit(strip_tags($model->about_en), 50))
            ->editColumn('team_id', fn($model) => Str::limit(strip_tags($model->team_id), 50))
            ->editColumn('team_en', fn($model) => Str::limit(strip_tags($model->team_en), 50))
            ->editColumn('career_id', fn($model) => Str::limit(strip_tags($model->career_id), 50))
            ->editColumn('career_en', fn($model) => Str::limit(strip_tags($model->career_en), 50))
            ->editColumn('service_id', fn($model) => Str::limit(strip_tags($model->service_id), 50))
            ->editColumn('service_en', fn($model) => Str::limit(strip_tags($model->service_en), 50))
            ->editColumn('practice_id', fn($model) => Str::limit(strip_tags($model->practice_id), 50))
            ->editColumn('practice_en', fn($model) => Str::limit(strip_tags($model->practice_en), 50))
            ->editColumn('disclaimer_id', fn($model) => Str::limit(strip_tags($model->disclaimer_id), 50))
            ->editColumn('disclaimer_en', fn($model) => Str::limit(strip_tags($model->disclaimer_en), 50))
            ->editColumn('created_at', fn($model) => $model->created_at ? $model->created_at->format('Y-m-d H:i') : '')
            ->editColumn('updated_at', fn($model) => $model->updated_at ? $model->updated_at->format('Y-m-d H:i') : '')
            ->addColumn('action', function ($row) {
                return '<a href="' . route('admin.description.edit', $row->id) . '" class="btn btn-warning btn-sm mx-1" title="Edit"><i class="ri-file-edit-line"></i></a>';
            })
            ->rawColumns(['action']);
    }

    public function query(Description $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('description-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(120),
            Column::make('about_id')->title('About (Indonesia)'),
            Column::make('about_en')->title('About (English)'),
            Column::make('team_id')->title('Team (Indonesia)'),
            Column::make('team_en')->title('Team (English)'),
            Column::make('career_id')->title('Career (Indonesia)'),
            Column::make('career_en')->title('Career (English)'),
            Column::make('service_id')->title('Service (Indonesia)'),
            Column::make('service_en')->title('Service (English)'),
            Column::make('practice_id')->title('Practice (Indonesia)'),
            Column::make('practice_en')->title('Practice (English)'),
            Column::make('disclaimer_id')->title('Disclaimer (Indonesia)'),
            Column::make('disclaimer_en')->title('Disclaimer (English)'),
            Column::make('created_at')->title('Created At')->width(140),
            Column::make('updated_at')->title('Updated At')->width(140),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Description_' . date('YmdHis');
    }
}
