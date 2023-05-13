<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Product::query()
            ->where('id', $this->id)
            ->select('path', 'name', 'code', 'price', 'sale_price');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'path',
            'name',
            'code',
            'price',
            'sale-price'
        ];
    }
}
