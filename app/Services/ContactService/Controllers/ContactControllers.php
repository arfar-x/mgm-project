<?php

namespace App\Services\ContactService\Controllers;

use App\Services\ContactService\Models\Contact;
use App\Http\Controllers\Controller as BaseController;
use App\Services\ContactService\Repositories\ContactRepositoryInterface;
use App\Services\ContactService\Requests\Panel\CreateContactRequest;
use App\Services\ContactService\Requests\Admin\UpdateContactRequest;
use App\Services\ContactService\Resources\ContactCollection;
use App\Services\ContactService\Resources\ContactResource;
use App\Services\ResponseService\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactControllers extends BaseController
{
    /**
     * @param ContactRepositoryInterface $contactService
     */
    public function __construct(protected ContactRepositoryInterface $contactService)
    {
        //
    }

    /** Admin methods */

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $result = $this->settingService->list($request->query());

        return Response::paginate(new ContactCollection($result));
    }

    /**
     * @param Contact $contact
     * @return JsonResponse
     */
    public function show(Contact $contact): JsonResponse
    {
        $result = $this->contactService->show($contact);

        return Response::retrieved(new ContactResource($result));
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return JsonResponse
     */
    public function update(UpdateContactRequest $request, Contact $contact): JsonResponse
    {
        $result = $this->settingService->update($contact, $request->validated());

        return Response::updated(new ContactResource($result));
    }

    /**
     * @param Contact $contact
     * @return JsonResponse
     */
    public function delete(Contact $contact): JsonResponse
    {
        $result = $this->contactService->destroy($contact);

        if ($result) {
            return Response::deleted(['result' => $result]);
        }

        return Response::error(['result' => $result]);
    }

    /** Panel methods */

    /**
     * Store a new contact record.
     *
     * @return JsonResponse
     */
    public function store(CreateContactRequest $request)
    {
        $result = $this->contactService->create($request->validated());

        return Response::created(new ContactResource($result));
    }
}