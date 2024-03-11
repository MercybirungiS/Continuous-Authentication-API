<?php

namespace App\Http\Controllers;

use App\Helpers\Globals;
use App\Repositories\BatteryMetricRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\SharedHelper as Helper;
use App\Repositories\PhoneRepository;

class BatteryMetricController extends Controller
{

    protected $repository, $phoneRepository;

    public function __construct(BatteryMetricRepository $repository, PhoneRepository $phoneRepository)
    {
        $this->repository = $repository;
        $this->phoneRepository = $phoneRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->repository->get();
            return response()->json($data, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Globals::$STATUS_CODE_FAILED);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|string',
            'android_version' => 'required|string',
            'voltage' => ['required', 'numeric'],
            'current' => ['required', 'numeric']
        ]);

        try {

            if ($validator->fails()) {
                $message = $validator->errors()->all();
                return Helper::sendFailedHttpResponse($message);
            } else {

                $device_id = $request->input('device_id');
                $android_version = $request->input('android_version');
                $phone = $this->phoneRepository->getOrCreatePhone($device_id, $android_version);

                $data = [
                    'phone_id' => $phone->id,
                    'voltage' => $request->voltage,
                    'current' => $request->current
                ];
                $result = $this->repository->create($data);
                if ($result) {
                    return response()->json(['message' => 'Battery metrics inserted successfully', 'data' => $data], 200);
                } else {
                    return Helper::sendFailedHttpResponse('System is unable to insert battery metrics at the moment!');
                }
            }
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Globals::$STATUS_CODE_FAILED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->repository->find($id);
            return response()->json($data, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Globals::$STATUS_CODE_FAILED);
        }
    }

    public function findbyDeviceId($device_id)
    {
        try {
            $phone = $this->phoneRepository->findbyDeviceId($device_id);
            if (!$phone) {
                return null;
            }
            return response()->json($phone->batteryMetrics, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Globals::$STATUS_CODE_FAILED);
        }
    }
}
