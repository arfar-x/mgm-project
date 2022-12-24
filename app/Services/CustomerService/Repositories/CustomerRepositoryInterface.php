<?php

namespace App\Services\CustomerService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\CustomerService\Models\Customer;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Customer $customer
     * @param string $uuid
     * @return void
     */
    public function setAvatar(Customer $customer, string $uuid = null): Customer;
}
