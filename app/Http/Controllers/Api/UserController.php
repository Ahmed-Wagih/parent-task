<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * The index function retrieves users and their details for display in a view, with the option
     * for an API request.
     *
     * @param Request request  is an instance of the Request class, which contains all the data
     * that was sent with the HTTP request. It can be used to retrieve input data, files, cookies,
     * headers, and more. In this function, it is used to retrieve data from the HTTP request and pass
     * it to other methods
     *
     * @return a json, either the users json, depending on
     * whether the request is an HTTP request.
     */

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider' => ['nullable', 'in:DataProviderX,DataProviderY'],
            'statusCode' => ['nullable', 'in:authorised,decline,refunded'],
            'status' => ['nullable', 'in:authorised,decline,refunded'],
            'balanceMin' => ['nullable', 'integer'],
            'balanceMax' => ['nullable', 'integer'],
            'currency' => ['nullable']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $this->userService->index($request);
        return response()->json($data, 200);
    }
}
