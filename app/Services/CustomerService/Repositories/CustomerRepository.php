<?php

namespace App\Services\CustomerService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\CustomerService\Models\Customer;
use Illuminate\Database\Eloquent\Model;

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
     * @param string|null $uuid
     * @return Customer|Model
     */
    public function setAvatar(Customer $customer, string $uuid = null): Customer|Model
    {
        return $this->update($customer, ['avatar' => $uuid]);
    }
}
