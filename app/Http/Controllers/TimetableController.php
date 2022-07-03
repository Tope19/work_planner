<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TimetableService;
use App\Helpers\ApiCustomResponse;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use App\Http\Requests\TimetableRequest;
use App\Http\Resources\TimetableResource;
use Symfony\Component\HttpFoundation\Response;

class TimetableController extends Controller
{
    protected $timeService;

    public function __construct(TimetableService $timeService)
    {
        $this->timeService = $timeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $time = $this->timeService->getAll();
            $message = 'Timetable retrieved successfully';
            return ApiCustomResponse::successResponse($message, TimetableResource::collection($time), Response::HTTP_OK);
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
    public function store(TimetableRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $time = $this->timeService->create($data);
            $message = "Timetable created successfully!";
            DB::commit();
            return ApiCustomResponse::successResponse($message, new TimetableResource($time), Response::HTTP_CREATED);
        } catch (InvalidArgumentException $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ApiCustomResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY, $e);
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return ApiCustomResponse::errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $time = $this->timeService->getById($id);
            if(!$time) {
                $message = 'Timetable not found';
                return ApiCustomResponse::errorResponse($message, Response::HTTP_OK);
            }
            $message = 'Timetable retrieved successfully';
            return ApiCustomResponse::successResponse($message, new TimetableResource($time), Response::HTTP_OK);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiCustomResponse::errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
