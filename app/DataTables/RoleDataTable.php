<?php

namespace App\DataTables;

use App\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'pages.roles.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('role-dt')
            ->addTableClass('table table-hover table-bordered table-striped')
            ->stateSave(true)
            ->columns($this->getColumns())
            ->responsive(true)
            // ->select(['style' => 'os', 'items' => 'row'])
            ->minifiedAjax()
            ->lengthMenu([20, 50, 100, 200])
            ->pageLength(100)
            ->orderBy(0)
            ->domBs4()
            ->buttons([
                // Button::make('create'),
                Button::make('pageLength'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // Column::checkbox(''),
            Column::make('id'),
            Column::make('name'),
            Column::make('created_at')->type('date'),
            Column::make('updated_at')->type('date'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'roles_' . date('YmdHis');
    }
}
