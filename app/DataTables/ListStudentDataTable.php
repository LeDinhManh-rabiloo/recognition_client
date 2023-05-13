<?php

namespace App\DataTables;

use App\Models\Checked;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ListStudentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('name', 'pages.students.name')
            ->rawColumns(['name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Checked $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Checked $model)
    {
        if ($this->courseId != 0) {
            return $model->newQuery()
                ->where('courseId', $this->courseId);
        } else {
            return $model->newQuery();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('ListStudent-dt')
            ->addTableClass('table table-hover table-bordered table-striped')
            ->stateSave(true)
            ->columns($this->getColumns())
            ->responsive(true)
            ->minifiedAjax()
            ->lengthMenu([20, 50, 100, 200])
            ->pageLength(100)
            ->orderBy(0)
            ->domBs4()
            ->buttons([
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
            Column::make('name')
                ->title('Họ tên')
                ->exportable(true),
            Column::make('days')
                ->title('Đi học')
                ->exportable(true),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ListStudent_' . date('YmdHis');
    }
}
