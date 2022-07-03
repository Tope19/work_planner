<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Services\WorkerService;
use App\Helpers\ApiCustomResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\WorkerRequest;
use App\Http\Resources\WorkerResource;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class WorkerController extends Controller
{
    protected $workerService;

    public function __construct(WorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  try {
            $workers = $this->workerService->getAll();
            $message = 'Workers retrieved successfully';
            return ApiCustomResponse::successResponse($message, WorkerResource::collection($workers), Response::HTTP_OK);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiCustomResponse::errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkerRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $worker = $this->workerService->create($data);
            $message = "Worker created successfully!";
            DB::commit();
            return ApiCustomResponse::successResponse($message, new WorkerResource($worker), Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            DB::rollback();
            $message = "The given data was invalid.";
            return inputErrorResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY, $request, $e);
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return ApiCustomResponse::errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $worker = $this->workerService->getById($id);
            if(!$worker) {
                $message = 'Worker not found';
                return ApiCustomResponse::errorResponse($message, Response::HTTP_OK);
            }
            $message = 'Worker retrieved successfully';
            return ApiCustomResponse::successResponse($message, new WorkerResource($worker), Response::HTTP_OK);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiCustomResponse::errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

}
