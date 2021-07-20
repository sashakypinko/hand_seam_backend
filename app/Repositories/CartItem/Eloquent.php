<?php

namespace App\Repositories\CartItem;

use App\Facades\Client;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class Eloquent implements CartItemRepository
{

    /**
     * @var CartItem
     */
    private $model;

    /**
     * Eloquent constructor.
     * @param CartItem $model
     */
    public function __construct(CartItem $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function byId(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function find(array $data)
    {
        return $this->model
            ->where('product_id', $data['product']['id'])
            ->where('size_id', $data['size']['id'])
            ->first();
    }

    public function create(array $data)
    {
        $this->model::create([
            'client_id' => Client::id(),
            'product_id' => $data['product']['id'],
            'size_id' => $data['size']['id'],
            'count' => $data['count']
        ]);
    }

    public function update($cartItem, int $count)
    {
        $cartItem->count = $cartItem->count + $count;
        $cartItem->save();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->model::where('id', $id)->delete();
    }

    /**
     * @return int
     */
    public function getItemsCount(): int
    {
        return $this->model::query()->sum('count');
    }

    /**
     * @return int
     */
    public function getItemsTotalPrice(): int
    {
        $productsPrices = $this->model::select(DB::raw('SUM(cart_items.count) * products.price AS total'))
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->pluck('total');

        return array_sum($productsPrices->toArray());
    }

    /**
     * @param int $id
     * @param int $count
     */
    public function changeCount(int $id, int $count): void
    {
        $item = $this->byId($id);
        $item->count = $count;
        $item->count > 0 ? $item->save() : $item->delete();
    }
}
