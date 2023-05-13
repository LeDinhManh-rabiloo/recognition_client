<?php

namespace App\DataTables;

use App\Models\ClassCourse;
use App\Models\ClassList;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClassListDataTable extends DataTable
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
            ->addColumn('action', 'classlist.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ClassCourse $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ClassCourse $model)
    {
        if (Auth::user()->hasRole("Teachers")) {
            return $model->newQuery()
                ->where('teacherId', Auth::user()->id);
        } elseif (Auth::user()->hasRole("Administrators")) {
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
            ->setTableId('Class-dt')
            ->addTableClass('table table-hover table-bordered table-striped')
            ->stateSave(true)
            ->columns($this->getColumns())
            ->responsive(false)
            ->minifiedAjax()
            ->lengthMenu([20, 50, 100, 200])
            ->pageLength(100)
            ->orderBy(0)
            ->domBs4()
            ->buttons(
                Button::make('pageLength'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
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
            Column::make('courseId')->title('Mã lớp'),
            Column::make('name')->title("Tên lớp"),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ClassList_' . date('YmdHis');
    }
}
