<?php

namespace App\Exports;

use App\Models\ProductAttributte;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductAttributeExport implements FromCollection, WithHeadings, ShouldQueue
{
    use Exportable;

    public function headings(): array
    {
        return [
            "product_id", "name", "size", "style", "colorWay", "price"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = collect();
        $productAttrs = ProductAttributte::chunk(2000, function ($productAttrs) use ($products) {
            foreach ($productAttrs as $productAttr) {
                $product = [];
                $product["product_id"] = $productAttr->sku;
                $product["name"] = $productAttr->product->name;
                $product["size"] = $productAttr->lowestAskSize;
                $product["style"] = $productAttr->styleId;
                $product["colorWay"] = $productAttr->colorWays;
                $product["price"] = $productAttr->lowestAsk;
                $products->push($product);
            }
        });

        return $products;
    }
}
