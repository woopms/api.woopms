<?php

namespace App\Interfaces;
use App\Room;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

interface RoomTypeInterface {

    /**
     * @param Integer $property_id
     * @param Request $request
     * @return mixed
     */
    public function create( Array $params);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @param Array $params
     * @return mixed
     */
    public function update(Integer $property_id, Integer $room_type_id, Array $params);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @return mixed
     */
    public function delete(Integer $property_id, Integer $room_type_id);

    /**
     * @param Integer $property_id
     * @param Integer $room_type_id
     * @return mixed
     */
    public function get(Integer $property_id,  $room_type_id);
}
