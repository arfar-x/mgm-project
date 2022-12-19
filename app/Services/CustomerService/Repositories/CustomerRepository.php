<?php

namespace App\Services\CustomerService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\CustomerService\Models\Customer;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    /**
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Customer $customer
     * @param string $uuid
     * @return void
     */
    public function setAvatar(Customer $customer, string $uuid = null): Customer
    {
        $customer = $this->update($customer, ['avatar' => $uuid]);

        return $customer;
    }
}
