<?php

namespace App\DataTables;

use App\Models\Website;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WebsiteDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('maps', function ($model) {
                $limit = 10; // jumlah karakter yang ditampilkan
                $maps = $model->maps ?? '';
                return strlen($maps) > $limit ? substr($maps, 0, $limit) . '…' : $maps;
            })
            ->addColumn('action', function ($row) {
                $button = '<a href="' . route('admin.website.edit', $row->id) . '" class="btn btn-warning btn-sm mx-1" title="Edit"><i class="ri-file-edit-line"></i></a>';
                return $button;
            })
            ->rawColumns(['action']);
    }

    public function query(Website $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('website-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('maps')->title('Embed Maps'),
            Column::make('phone')->title('Phone'),
            Column::make('email')->title('Email'),
            Column::make('address_id')->title('Address (ID)'),
            Column::make('address_en')->title('Address (EN)'),
            Column::make('facebook')->title('Facebook'),
            Column::make('linkedin')->title('LinkedIn'),
            Column::make('instagram')->title('Instagram'),
            Column::make('x')->title('X'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Website_' . date('YmdHis');
    }
}
