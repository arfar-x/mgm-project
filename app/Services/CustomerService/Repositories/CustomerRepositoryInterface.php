<?php

namespace App\Services\CustomerService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\CustomerService\Models\Customer;
use Illuminate\Database\Eloquent\Model;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Customer $customer
     * @param string|null $uuid
     * @return Customer|Model
     */
    public function setAvatar(Customer $customer, string $uuid = null): Customer|Model;
}
