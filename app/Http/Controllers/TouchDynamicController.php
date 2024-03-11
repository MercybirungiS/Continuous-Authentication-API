<?php

namespace App\Http\Controllers;

use App\Helpers\Globals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\SharedHelper as Helper;
use App\Repositories\PhoneRepository;
use App\Repositories\TouchDynamicRepository;

class TouchDynamicController extends Controller
{

    protected $repository, $phoneRepository;

    public function __construct(TouchDynamicRepository $repository, PhoneRepository $phoneRepository)
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
            'finger_pressure' => ['required', 'numeric'],
            'finger_blocked_area' => ['required', 'numeric'],
            'hold_time' => ['required', 'numeric'],
            'finger_orientation' => ['required', 'string']
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
                    'finger_pressure' => $request->finger_pressure,
                    'finger_blocked_area' => $request->finger_blocked_area,
                    'hold_time' => $request->hold_time,
                    'finger_orientation' => $request->finger_orientation
                ];
                $result = $this->repository->create($data);
                if ($result) {
                    return response()->json(['message' => 'Touch dynamics metrics inserted successfully', 'data' => $data], 200);
                } else {
                    return Helper::sendFailedHttpResponse('System is unable to insert touch dynamics metrics at the moment!');
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
            return response()->json($phone->touchDynamics, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Globals::$STATUS_CODE_FAILED);
        }
    }
}
