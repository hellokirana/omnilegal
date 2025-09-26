<?php

namespace App\DataTables;

use App\Models\Career;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CareerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('aplication', function ($model) {
                if ($model->aplication) {
                    $url = asset('storage/' . $model->aplication); // pastikan file tersimpan di storage/public
                    return '<a href="' . $url . '" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-file-download me-1"></i> Download
                        </a>';
                }
                return '-';
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at ? $model->created_at->format('d-m-Y H:i:s') : '';
            })
            ->addColumn('action', function ($model) {
                $button = '<a href="' . route('admin.career.show', $model->id) . '" class="btn btn-primary btn-sm mx-1" data-bs-toggle="tooltip" title="Lihat"><i class="ri-eye-line"></i></a>';
                $button .= '<button type="button" class="btn btn-danger btn-sm mx-1 delete-post" data-bs-toggle="tooltip" title="Hapus" data-url="' . route('admin.career.destroy', $model->id) . '" data-csrf="' . csrf_token() . '"><i class="ri-delete-bin-2-line"></i></button>';
                return $button;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Career $model): QueryBuilder
    {
        return $model->newQuery()->select([
            'id',
            'name',
            'email',
            'subject',
            'message',
            'aplication',
            'created_at',
        ])->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('careers-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('created_at')->title('Tanggal'),
            Column::make('name')->title('Nama'),
            Column::make('email')->title('Email'),
            Column::make('subject')->title('Subjek'),
            Column::make('message')->title('Pesan')->visible(false),
            Column::make('aplication')->title('Aplication'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Career_' . date('YmdHis');
    }
}
