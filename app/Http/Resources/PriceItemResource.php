<?php

namespace App\Http\Resources;
 
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $currency = strtoupper($request->query('currency', 'RUB'));
        $price = $this->price;

        switch ($currency) {
            case 'USD':
                $converted = $price / 90;
                $formatted = '$' . number_format($converted, 2);
                break;
            case 'EUR':
                $converted = $price / 100;
                $formatted = '€' . number_format($converted, 2);
                break;
            case 'RUB':
            default:
                $formatted = number_format($price, 0, '', ' ') . ' ₽';
                break;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $formatted,
        ];
    }
}
