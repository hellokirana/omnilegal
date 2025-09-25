<?php

namespace App\DataTables;

use App\Models\Stat;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StatDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
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
                    ? '<img src="' . $model->image_url . '" width="50">'
                    : '';
            })
            ->addColumn('action', function ($row) {
                $button = '<a href="' . route('admin.stat.edit', $row->id) . '" class="btn btn-warning btn-sm mx-1" title="Edit"><i class="ri-file-edit-line"></i></a>';
                $button .= '<a href="#" data-url_href="' . route('admin.stat.destroy', $row->id) . '" class="btn btn-danger btn-sm mx-1 delete-post" title="Delete" data-csrf="' . csrf_token() . '"><i class="ri-delete-bin-2-line"></i></a>';
                return $button;
            })
            ->rawColumns(['action', 'image']);
    }

    public function query(Stat $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('stat-table')
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
            Column::make('label_id')->title('Label (Indonesia)'),
            Column::make('label_en')->title('Label (English)'),
            Column::make('value')->title('Value'),
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
        return 'Stat_' . date('YmdHis');
    }
}
