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
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ShiftResource;
use Illuminate\Support\Facades\Validator;
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
    // public function store(ShiftRequest $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $day =  Carbon::now()->subHours(24)->format('H:i:s');
    //         $data = $request->validated();
    //         $worker_id = $data['worker_id'];

    //         // check if the created at date of the shift was within the last 24 hours
    //         $check = DB::table('shifts')->where('worker_id', $worker_id)->where('created_at', '>=', $day)->first();
    //         if ($check) {
    //             $message = "You already have a shift today!";
    //             return ApiCustomResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    //         }
    //         $shift = $this->shiftService->create($data);
    //         $message = "Shift created successfully!";
    //         DB::commit();
    //         return ApiCustomResponse::successResponse($message, $shift, Response::HTTP_CREATED);

    //     }
    //     catch (ValidationException $e) {
    //         DB::rollback();
    //         $message = "The given data was invalid.";
    //         return inputErrorResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY, $request, $e);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         $message = 'Something went wrong while processing your request.';
    //         return ApiCustomResponse::errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
    //     }

    // }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'worker_id' => 'required|integer|exists:workers,id',
            'timetable_id' => 'required|integer|exists:timetables,id',
        ]);

        if($validator->fails()){
            $message = $validator->errors()->first();
            return ApiCustomResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {

            $day =  Carbon::now()->subHours(24)->format('H:i:s');

            $worker_id = $data['worker_id'];
            $timetable_id = $data['timetable_id'];

            // Get the start_time and end_time from the selected timetable
            $timetable = DB::table('timetables')
                ->select('start_time', 'end_time')
                ->where('id', $timetable_id)
                ->first();

            $start_time = Carbon::parse($timetable->start_time);
            $end_time = Carbon::parse($timetable->end_time);

            // check if the created at date of the shift was within the last 24 hours
            $check = DB::table('shifts')
                ->join('timetables', 'timetables.id', '=', 'shifts.timetable_id')
                ->where('shifts.worker_id', $worker_id)
                ->whereDate('timetables.start_time', $start_time->toDateString())
                ->first();
            if ($check) {
                $message = "You already have a shift today!";
                return ApiCustomResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Check that the shift is 8 hours long
            if ($start_time->diffInHours($end_time) != 8) {
                $message = "Shift must be 8 hours long!";
                return ApiCustomResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Add the start_time and end_time to the data array
            $data['start_time'] = $start_time->toDateTimeString();
            $data['end_time'] = $end_time->toDateTimeString();

            // Create the shift
            $shift = $this->shiftService->create($data);

            $message = "Shift created successfully!";
            return ApiCustomResponse::successResponse($message, $shift, Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            Log::error($e);
            $message = "The given data was invalid.";
            return inputErrorResponse::errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY, $request, $e);
        } catch (\Exception $e) {
            Log::error($e);
            $message = 'Something went wrong while processing your request.';
            return ApiCustomResponse::errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR);
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
