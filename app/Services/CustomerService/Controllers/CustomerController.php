<?php

namespace App\Services\CustomerService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\CustomerService\Models\Customer;
use App\Services\CustomerService\Repositories\CustomerRepositoryInterface;
use App\Services\CustomerService\Requests\CreateCustomerRequest;
use App\Services\CustomerService\Requests\SetCoverRequest;
use App\Services\CustomerService\Requests\UpdateCustomerRequest;
use App\Services\CustomerService\Requests\UploadFileRequest;
use App\Services\CustomerService\Resources\CustomerCollection;
use App\Services\CustomerService\Resources\CustomerResource;
use App\Services\MediaService\Repositories\MediaRepositoryInterface;
use App\Services\MediaService\Resources\MediaCollection;
use App\Services\ResponseService\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CustomerController extends BaseController
{
    /**
     * @param CustomerRepositoryInterface $customerService
     * @param MediaRepositoryInterface $mediaService
     */
    public function __construct(
        protected CustomerRepositoryInterface $customerService,
        protected MediaRepositoryInterface $mediaService
    )
    {
        //
    }

    /** Admin methods */

    /**
     * Store a new contact record.
     *
     * @param CreateCustomerRequest $request
     * @return JsonResponse
     */
    public function store(CreateCustomerRequest $request): JsonResponse
    {
        $result = $this->customerService->create($request->validated());

        return Response::created(new CustomerResource($result));
    }

    /**
     * @param UpdateCustomerRequest $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        $result = $this->customerService->update($customer, $request->validated());

        return Response::updated(new CustomerResource($result));
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function delete(Customer $customer): JsonResponse
    {
        $result = $this->customerService->destroy($customer);

        if ($result) {
            return Response::deleted(['result' => true]);
        }

        return Response::error(['result' => false]);
    }

    /**
     * Upload file for a specific customer and store to storage.
     *
     * @param UploadFileRequest $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function upload(UploadFileRequest $request, Customer $customer): JsonResponse
    {
        $file = $this->mediaService->upload(
            $request->file('files'),
            Arr::except($request->validated(), 'files'),
            $customer
        );

        $this->customerService->setAvatar($customer, $file->first()->uuid->toString());

        return Response::success(new MediaCollection($file));
    }

    /**
     * Activate the customer record.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function activate(Customer $customer): JsonResponse
    {
        $result = $this->customerService->activate($customer);

        return Response::success(new CustomerResource($result));
    }

    /**
     * Deactivate the customer record.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function deactivate(Customer $customer): JsonResponse
    {
        $result = $this->customerService->deactivate($customer);

        return Response::success(new CustomerResource($result));
    }

    /**
     * Delete file for a specific customer by given UUID.
     *
     * @param Request $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function deleteFile(Request $request, Customer $customer): JsonResponse
    {
        $result = $this->mediaService->deleteFile($request->input('uuid'), $customer);

        if ($result) {

            // Set customer cover to null
            $this->customerService->setAvatar($customer);

            return Response::deleted(['result' => $result]);

        } elseif (is_null($result)) {
            return Response::notFound();
        }

        return Response::error(['result' => $result]);
    }

    /**
     * @param SetCoverRequest $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function setAvatar(SetCoverRequest $request, Customer $customer): JsonResponse
    {
        $result = $this->customerService->setAvatar($customer, $request->input('uuid'));

        return Response::success(new CustomerResource($result));
    }

    /** Panel & Admin methods */

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $result = $this->customerService->list($request->query());

        return Response::paginate(new CustomerCollection($result));
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function show(Customer $customer): JsonResponse
    {
        $result = $this->customerService->show($customer);

        return Response::retrieved(new CustomerResource($result));
    }
}
