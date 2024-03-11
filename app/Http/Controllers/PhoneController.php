<?php

namespace App\Http\Controllers;

use App\Helpers\Globals;
use App\Repositories\PhoneRepository;

class PhoneController extends Controller
{

    protected  $phoneRepository;

    public function __construct(PhoneRepository $phoneRepository)
    {
        $this->phoneRepository = $phoneRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->phoneRepository->get();
            return response()->json($data, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Globals::$STATUS_CODE_FAILED);
        }
    }

    // find phone by device id
    public function getByDeviceId($device_id)
    {
        try {
            $data = $this->phoneRepository->findbyDeviceId($device_id);
            return response()->json($data, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Globals::$STATUS_CODE_FAILED);
        }
    }
}