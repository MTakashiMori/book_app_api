<?php

namespace App\Http\Controllers;

use App\Services\AbstractService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AbstractController extends Controller
{

    /**
     * @var array $response
     */
    public $response = [
        'message' => '',
        'data' => '',
        'code' => ''
    ];

    /**
     * @var AbstractService $service
     */
    protected $service;

    /**
     * ResourcesController constructor.
     * @param AbstractService $service
     */
    public function __construct(AbstractService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $response = $this->response;
        try {
            $data = $this->service->all($request->all());

            $response['message'] = $data['message'];
            $response['data'] = $data['data'];
            $response['code'] = $data['code'];
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            $response['data'] = null;
            $response['code'] = is_numeric($e->getCode()) ? $e->getCode() : 500;
        }

        return response()->json([
            'message' => $response['message'],
            'data' => $response['data']
        ], $response['code']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $response = $this->response;
        try {
            $data = $this->service->find($id);

            $response['message'] = $data['message'];
            $response['data'] = $data['data'];
            $response['code'] = $data['code'];
        } catch (Exception $e) {
            dd($e);
            $response['message'] = $e->getMessage();
            $response['data'] = null;
            $response['code'] = is_numeric($e->getCode()) ? $e->getCode() : 500;
        }

        return response()->json([
            'message' => $response['message'],
            'data' => $response['data']
        ], $response['code']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $response = $this->response;
        try {
            $data = $this->service->destroy($id);

            $response['message'] = $data['message'];
            $response['data'] = $data['data'];
            $response['code'] = $data['code'];
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            $response['data'] = null;
            $response['code'] = is_numeric($e->getCode()) ? $e->getCode() : 500;
        }

        return response()->json([
            'message' => $response['message'],
            'data' => $response['data']
        ], $response['code']);
    }

}
