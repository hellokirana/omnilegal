<?php

namespace App\DataTables;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TeamDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('status', function ($model) {
                return $model->status == '1' ? 'Active' : 'Inactive';
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at ? $model->created_at->format('Y-m-d H:i') : '';
            })
            ->editColumn('image', function ($model) {
                return $model->image
                    ? '<img src="' . asset('storage/team/' . $model->image) . '" width="50">'
                    : '';
            })
            ->addColumn('action', function ($row) {
                $button = '<a href="' . route('admin.team.edit', $row->id) . '" class="btn btn-warning btn-sm mx-1" title="Edit"><i class="ri-file-edit-line"></i></a>';
                $button .= '<a href="#" data-url_href="' . route('admin.team.destroy', $row->id) . '" class="btn btn-danger btn-sm mx-1 delete-post" title="Delete" data-csrf="' . csrf_token() . '"><i class="ri-delete-bin-2-line"></i></a>';
                return $button;
            })
            ->rawColumns(['action', 'image']);
    }

    public function query(Team $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('team-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(120),
            Column::make('image')->title('Image')->width(60)->orderable(false)->searchable(false),
            Column::make('name')->title('Name'),
            Column::make('position_id')->title('Position (ID)'),
            Column::make('position_en')->title('Position (EN)'),
            Column::make('description_id')->title('Description (ID)'),
            Column::make('description_en')->title('Description (EN)'),
            Column::make('email')->title('Email'),
            Column::make('status')->title('Status')->width(80),
            Column::make('created_at')->title('Created At')->width(140),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Team_' . date('YmdHis');
    }
}
