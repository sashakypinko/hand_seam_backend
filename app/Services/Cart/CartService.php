<?php

namespace App\Services\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartService implements CartServiceInterface
{

    /**
     * @var Cart
     */
    private $model;

    /**
     * CartService constructor.
     * @param Cart $model
     */
    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

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
     * @return mixed|void
     */
    public function createOrUpdate(array $data)
    {
        $cartItem = $this->getCartItem($data);

        if ($cartItem) {
            $this->updateCartItem($cartItem, $data['count']);
        } else {
            $this->createCartItem($data);
        }
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->model::where('id', $id)->delete();
    }

    public function getItemsCount(): int
    {
        return $this->model::query()->sum('count');
    }

    public function getItemsTotalPrice(): int
    {
        $productsPrices = $this->model::select(DB::raw('SUM(carts.count) * products.price AS total'))
            ->join('products', 'carts.product_id', '=', 'products.id')
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

    /**
     * @param array $data
     * @return mixed
     */
    private function getCartItem(array $data)
    {
        return $this->model
            ->where('product_id', $data['product']['id'])
            ->where('size_id', $data['size']['id'])
            ->first();
    }

    /**
     * @param array $data
     * @return mixed|void
     */
    private function createCartItem(array $data)
    {
        $this->model::create([
            'visitor_id' => auth()->id(),
            'product_id' => $data['product']['id'],
            'size_id' => $data['size']['id'],
            'count' => $data['count']
        ]);
    }

    /**
     * @param Cart $cartItem
     * @param int $count
     */
    private function updateCartItem(Cart $cartItem, int $count)
    {

        $cartItem->count = $cartItem->count + $count;
        $cartItem->save();
    }

}
