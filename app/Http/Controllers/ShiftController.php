<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Services\ShiftService;
use App\Helpers\ApiCustomResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ShiftRequest;
use App\Http\Resources\ShiftResource;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ShiftController extends Controller
{
    protected $shiftService;

    public function __construct(ShiftService $shiftService)
    {
        $this->shiftService = $shiftService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  try {
            $shifts = $this->shiftService->getAll();
            $message = 'Shifts retrieved successfully';
            return ApiCustomResponse::successResponse($message, ShiftResource::collection($shifts), Response::HTTP_OK);
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
    public function store(ShiftRequest $request)
    {
        DB::beginTransaction();
        try {
            $day =  Carbon::now()->subHours(24)->format('H:i:s');
            $data = $request->validated();

            $worker_id = $data['worker_id'];
            // check if the created at date of the shift was within the last 24 hours
            $check = DB::table('shifts')->where('worker_id', $worker_id)->where('created_at', '>=', $day)->first();
            if ($check) {
                $message = "You already have a shift today!";
                return ApiCustomResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $shift = $this->shiftService->create($data);
            $message = "Shift created successfully!";
            DB::commit();
            return ApiCustomResponse::successResponse($message, $shift, Response::HTTP_CREATED);

        }
        catch (ValidationException $e) {
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
            $shift = $this->shiftService->getById($id);
            if(!$shift) {
                $message = 'Shift not found';
                return ApiCustomResponse::errorResponse($message, Response::HTTP_OK);
            }
            $message = 'Shift retrieved successfully';
            return ApiCustomResponse::successResponse($message, new ShiftResource($shift), Response::HTTP_OK);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return ApiCustomResponse::errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

}
