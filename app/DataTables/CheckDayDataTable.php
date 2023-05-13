<?php

namespace App\DataTables;

use App\Models\CheckDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CheckDayDataTable extends DataTable
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
            ->addColumn('cover', 'pages.checked.cover')
            ->addColumn('checkd', 'pages.checked.check')
            ->addColumn('class', 'pages.checked.class')
            ->rawColumns(['cover', 'checkd', 'class']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CheckDay $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CheckDay $model)
    {
        return $model->newQuery()
            ->where('teacherId', Auth::user()->id)
            ->where('classId', $this->classId)
            ->whereDate('created_at', Carbon::today());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('user-dt')
            ->addTableClass('table table-hover table-bordered table-striped')
            ->stateSave(true)
            ->columns($this->getColumns())
            ->responsive(false)
            // ->select(['style' => 'os', 'items' => 'row'])
            ->minifiedAjax()
            ->lengthMenu([20, 50, 100, 200])
            ->pageLength(100)
            ->orderBy(0)
            ->domBs4()
            ->buttons(
            // Button::make('create'),
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
            Column::make('masv')->title('masv')
                ->addClass('text-center'),
            Column::make('name')->title('Họ tên')
                ->addClass('text-center'),
            Column::make('class')->title('Lớp')
                ->addClass('text-center'),
            Column::make('cover')
                ->title('Ảnh')
                ->type('html')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center cover'),
            Column::make('checkd')
                ->title('Kiểm tra')
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
        return 'CheckDay_' . date('YmdHis');
    }
}
