<?php

namespace App\DataTables;

use App\Models\News;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class NewsDataTable extends DataTable
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
                return $model->image
                    ? '<img src="' . $model->image_url . '" width="50">'
                    : '';
            })
            ->editColumn('status', function ($model) {
                return $model->status_text;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at ? $model->created_at->format('d M Y H:i') : '-';
            })
            ->editColumn('category_id', function ($model) {
                return $model->category ? $model->category->title : '-';
            })
            ->editColumn('content_id', function ($model) {
                return Str::limit(strip_tags($model->content_id), 100);
            })
            ->editColumn('content_en', function ($model) {
                return Str::limit(strip_tags($model->content_en), 100);
            })
            ->addColumn('action', function ($row) {
                $button = '<a href="' . route('admin.news.edit', $row->id) . '" class="btn btn-warning btn-sm mx-1" data-bs-toggle="tooltip" title="Edit"><i class="ri-file-edit-line"></i></a>';
                $button .= '<a href="#" data-url_href="' . route('admin.news.destroy', $row->id) . '" class="btn btn-danger btn-sm mx-1 delete-post" data-bs-toggle="tooltip" title="Delete" data-csrf="' . csrf_token() . '"><i class="ri-delete-bin-2-line"></i></a>';
                return $button;
            })
            ->rawColumns(['image', 'action']);
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(News $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('news-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('created_at')->title('Tanggal Publish'),
            Column::make('image')->title('Gambar')->orderable(false)->searchable(false),
            Column::make('category_id')->title('Kategori'),
            Column::make('title_id')->title('Judul (ID)'),
            Column::make('title_en')->title('Judul (EN)'),
            Column::make('author')->title('Penulis'),
            Column::make('content_id')->title('Konten (ID)')->orderable(false)->searchable(false),
            Column::make('content_en')->title('Konten (EN)')->orderable(false)->searchable(false),
            Column::make('status')->title('Status')->orderable(false)->searchable(false),
            Column::computed('action')
                ->title('Aksi')
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
        return 'News_' . date('YmdHis');
    }
}
