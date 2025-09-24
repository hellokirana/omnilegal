<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                $button = '<a href="' . route('admin.category.edit', $row->id) . '" class="btn btn-warning btn-sm mx-1" title="Edit"><i class="ri-file-edit-line"></i></a>';
                $button .= '<a href="#" data-url_href="' . route('admin.category.destroy', $row->id) . '" class="btn btn-danger btn-sm mx-1 delete-post" title="Delete" data-csrf="' . csrf_token() . '"><i class="ri-delete-bin-2-line"></i></a>';

                return $button;
            })
            ->rawColumns(['action']);
    }

    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(120),
            Column::make('title_id')->title('Nama Kategori (Indonesia)'),
            Column::make('title_en')->title('Nama Kategori (English)'),
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
        return 'Category_' . date('YmdHis');
    }
}
