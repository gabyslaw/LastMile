<?php
namespace App\Services;

use App\Models\Rider;
use App\Traits\UploadAble;

class RiderService {

  use UploadAble;

  protected $rider;

  public function __construct(Rider $rider) {
    $this->rider = $rider;
  }

  public function index() {
    return $this->rider->orderBy('created_at', 'DESC')->paginate(20);
  }

  public function store($request) {
    $riderCode = str_pad(($this->rider->count() + 1), 5, 0, STR_PAD_LEFT);
    return $this->rider->create([
      'riderCode'          => 'ZAPNG'.$riderCode,
      'email'         => $request->email,
      'first_name'         => $request->first_name,
      'last_name'          => $request->last_name,
      'phone_number'       => $request->phone_number,
      'password'           => \Hash::make($request->password),
      'address'            => $request->address,
      'vehicle_reg_number' => $request->vehicle_reg_number,
      'profile_photo'      => $request->has('profile_photo') ? $this->uploadOne($request->profile_photo, 'rider/profile_photo') : NULL,
      'identity_card'      => $request->has('means_of_id') ? $this->uploadOne($request->means_of_id, 'rider/identity') : NULL,
      'status'             => true,
      'isVerified'         => false,
    ]);
  }

  public function findById($id) {
    return $this->rider->find($id);
  }

  public function updateData($request, $id) {
    $rider = $this->findById($id);
    if($rider) {
      $save = $rider->update($request->except('profile_photo'));
      if($save) {
        return $rider;
      }
      return false;
    }
    return false;
  }

  public function deleteData($id) {
    $rider = $this->findById($id);
    if(!$rider) {
      return false;
    }

    $rider->orders->count() > 0 ? $rider->orders()->delete() : null;
    return $rider->delete();
  }
}
