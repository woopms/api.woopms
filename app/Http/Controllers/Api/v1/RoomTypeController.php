<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Services\Interfaces\RoomTypeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use  App\User;
use  App\RoomType;
use  App\Repositories\RoomTypeRepository;
use App\Validators\RoomTypeStoreValidator;

class RoomTypeController extends Controller
{

    private $roomTypeService;

    public function __construct(RoomTypeServiceInterface $roomTypeService)
    {
        $this->roomTypeService  =   $roomTypeService;
    }

    /**
     * Create a new Room Type
     * @param $property_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create($property_id, Request $request) {

        try {
            return response()->json(
                [
                    'data'      => $this->roomTypeService->create_room_type($property_id, $request),
                    'message'   => 'CREATED'
                ],
                201);
        } catch( \Exception $e) {
            return response()->json(['message' => 'Room Type Creation Failed!'], 409);
        }

    }

    /**
     * Update an existing room type
     * @param $property_id
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($property_id, $id, Request $request) {

        try {
            return response()->json(
                [
                'data' => $this->roomTypeService->update_room_type($property_id, $id, $request),
                'message' => 'UPDATED'
                ],
                201);
        } catch( \Exception $e) {
            return response()->json(['message' => 'Room Type Update Failed!'], 409);
        }


    }

    /**
     * Get a single or a list of Room Types
     * @param $property_id
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($property_id, $id = null) {

        $roomTypes    =   $this->roomTypeService->get_room_types($property_id, $id);

        return response()->json(['data' => $roomTypes, 'message' => 'GET'], 201);

    }

    /**
     * Delete a single room type
     * @param $property_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($property_id, $id) {

        try {

            if ( $this->roomTypeService->delete_room_type($property_id, $id) )
                return response()->json(['message' => 'DELETED'], 201);
        } catch( ModelNotFoundException $e) {
            // empty on purpose
        }
        return response()->json(['message' => 'Room Type delete Failed!'], 409);

    }

}
