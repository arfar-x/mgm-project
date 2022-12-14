<?php

namespace App\Services\ContactService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\ContactService\Models\Contact;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    /**
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }
}