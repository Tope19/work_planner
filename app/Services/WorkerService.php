<?php

namespace App\Services;

use Carbon\Carbon;
use App\Http\Resources\PostResource;
use App\Repositories\WorkerRepository;

class WorkerService
{
    protected $workerRepository;

    public function __construct(WorkerRepository $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }


    public function create(array $data)
    {
        $worker = $this->workerRepository->create($data);
        return $worker;

    }

    public  function getAll()
    {
        try {
            $posts = $this->workerRepository->getAll();
            return response()->json([
                'data' => PostResource::collection($posts),
                'message' => 'Successfully retrieved posts',
                'status' => 200
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function getById($id)
    {
        try {
            $post = $this->workerRepository->getById($id);
            return response()->json([
                'data' => new PostResource($post),
                'message' => 'Retrieved Single Post',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
