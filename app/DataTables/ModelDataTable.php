<?php

namespace App\DataTables;

use App\Models\Model;
use App\Models\ModelSystem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ModelDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'model.action')
            ->editColumn('code', function (ModelSystem $modelSystem) {
                return $modelSystem->code;
            })
            ->editColumn('name', function (ModelSystem $modelSystem) {
                return ucwords($modelSystem->name);
            })
            ->editColumn('description', function (ModelSystem $modelSystem) {
                return $modelSystem->description;
            })
            ->addColumn('action', function (ModelSystem $modelSystem) {
                return view('pages.models.columns._actions', compact('modelSystem'));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ModelSystem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('model-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
                    ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
                    ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
                    ->orderBy(2)
                    ->drawCallback("function() {" . file_get_contents(resource_path('views/pages//models/columns/_draw-scripts.js')) . "}");
            }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('code')->addClass('d-flex align-items-center')->name('code'),
            Column::make('name')->title('Model Name'),
            Column::make('description')->title('Description')->addClass('text-nowrap'),
            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(60)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Model_' . date('YmdHis');
    }
}
