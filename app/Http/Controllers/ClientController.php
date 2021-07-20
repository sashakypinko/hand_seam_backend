<?php

namespace App\Http\Controllers;

use App\Facades\Client;
use App\Repositories\Client\ClientRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $client;

    /**
     * ClientController constructor.
     * @param ClientRepository $client
     */
    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
    }

    /**
     * @return JsonResponse
     */
    public function getClient(): JsonResponse
    {
        return new JsonResponse(Client::get(), JsonResponse::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeLanguage(Request $request): JsonResponse
    {
        $this->client->updateLanguage($request->get('language'));

        return new JsonResponse(['status' => 'OK'], JsonResponse::HTTP_OK);
    }
}
