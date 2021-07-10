<?php

namespace App\Services\Cart;

interface CartServiceInterface
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
    public function createOrUpdate(array $data);

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
