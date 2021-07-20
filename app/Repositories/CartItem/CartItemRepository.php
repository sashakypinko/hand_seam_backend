<?php

namespace App\Repositories\CartItem;

interface CartItemRepository
{

    /**
     * @param int $id
     * @return mixed
     */
    public function byId(int $id);

    /**
     * @return mixed
     */
    public function get();

    /**
     * @param array $data
     * @return mixed
     */
    public function find(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $cartItem
     * @param array $data
     * @return mixed
     */
    public function update($cartItem, int $count);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @return int
     */
    public function getItemsCount(): int;

    /**
     * @return int
     */
    public function getItemsTotalPrice(): int;

    /**
     * @param int $id
     * @param int $count
     */
    public function changeCount(int $id, int $count): void;
}
