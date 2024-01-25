<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'product.action')
            ->editColumn('name', function (Product $product) {
                return ucwords($product->name);
            })
            ->editColumn('asset_code', function (Product $product) {
                return ucwords($product->asset_code);
            })->editColumn('consumable', function (Product $product) {
                return view('pages.products.columns._consumable', compact('product'));

            })->editColumn('avatar', function (Product $product) {
                return view('pages.products.columns._products', compact('product'));

            }) 
            ->editColumn('brand_id', function (Product $product) {
                return view('pages.products.columns._brands', compact('product'));
            })
            ->editColumn('category_id', function (Product $product) {
                return view('pages.products.columns._categories', compact('product'));

            })
            ->editColumn('model_id', function (Product $product) {
                return view('pages.products.columns._model', compact('product'));

            })
            ->editColumn('description', function (Product $product) {
                return $product->description;
            })
            ->addColumn('action', function (Product $product) {
                return view('pages.products.columns._actions', compact('product'));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages//products/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')->title('Product Name'),
            Column::make('asset_code')->title('Asset Code'),
            Column::make('consumable')->title('Consumable'),
            Column::make('avatar')->title('Avatar'),
            Column::make('description')->title('Description'),
            Column::make('brand_id')->title('Brand'),
            Column::make('category_id')->title('Category'),
            Column::make('model_id')->title('Model'),
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
        return 'Product_' . date('YmdHis');
    }
}
