<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('image', function ($model) {
                return '<img src="' . $model->image_url . '" class="img-fluid" style="max-height:60px;">';
            })
            ->editColumn('status', function ($model) {
                return $model->status_text;
            })
            ->addColumn('action', function ($row) {
                $button = '<a href="' . route('slider.edit', $row->id) . '" class="btn btn-warning btn-sm mx-1" data-bs-toggle="tooltip" title="Edit"><i class="ri-file-edit-line"></i></a>';
                $button .= '<a href="#" data-url_href="' . route('slider.destroy', $row->id) . '" class="btn btn-danger btn-sm mx-1 delete-post" data-bs-toggle="tooltip" title="Delete" data-csrf="' . csrf_token() . '"><i class="ri-delete-bin-2-line"></i></a>';
                return $button;
            })
            ->rawColumns(['image', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        // Ambil semua field yang ada di migration
        return $model->newQuery()->select([
            'id',
            'queue',
            'title_id',
            'title_en',
            'description_id',
            'description_en',
            'image',
            'link',
            'link_caption_id',
            'link_caption_en',
            'status',
            'created_at',
            'updated_at',
        ])->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
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
            Column::make('queue')->title('Queue')->width(50),
            Column::make('image')->title('Image')->width(60)->orderable(false)->searchable(false),
            Column::make('title_id')->title('Title (ID)'),
            Column::make('title_en')->title('Title (EN)'),
            Column::make('description_id')->title('Description (ID)')->visible(false),
            Column::make('description_en')->title('Description (EN)')->visible(false),
            Column::make('link')->title('Link'),
            Column::make('link_caption_id')->title('Caption (ID)'),
            Column::make('link_caption_en')->title('Caption (EN)'),
            Column::make('status')->title('Status')->width(80)->orderable(false)->searchable(false),
            Column::make('created_at')->title('Created At')->visible(false),
            Column::make('updated_at')->title('Updated At')->visible(false),
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
        return 'Slider_' . date('YmdHis');
    }
}
