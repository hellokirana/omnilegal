<?php

namespace App\DataTables;

use App\Models\Disclaimer;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class DisclaimerDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('description_id', function ($model) {
                return Str::limit(strip_tags($model->description_id), 50);
            })
            ->editColumn('description_en', function ($model) {
                return Str::limit(strip_tags($model->description_en), 50);
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at ? $model->created_at->format('Y-m-d H:i') : '';
            })
            ->editColumn('updated_at', function ($model) {
                return $model->updated_at ? $model->updated_at->format('Y-m-d H:i') : '';
            })
            ->addColumn('action', function ($row) {
                $button = '<a href="' . route('admin.disclaimer.edit', $row->id) . '" class="btn btn-warning btn-sm mx-1" title="Edit"><i class="ri-file-edit-line"></i></a>';
                return $button;
            })
            ->rawColumns(['action']);
    }

    public function query(Disclaimer $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('disclaimer-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(120),
            Column::make('description_id')->title('Deskripsi (Indonesia)'),
            Column::make('description_en')->title('Deskripsi (English)'),
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
        return 'Disclaimer_' . date('YmdHis');
    }
}
