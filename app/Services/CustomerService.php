<?php
namespace App\Services;

use App\Models\Customer;
use App\Traits\UploadAble;

class CustomerService {

  use UploadAble;

  protected $customer;

  public function __construct(Customer $customer) {
    $this->customer = $customer;
  }

  public function index() {
    return $this->customer->orderBy('created_at', 'DESC')->paginate(20);
  }

  public function store($request) {
    return $this->customer->create([
      'name' => $request->name,
      'email' => $request->email,
    //   'first_name' => $request->first_name,
    //   'last_name' => $request->last_name,
      'phone_number' => $request->phone_number,
      'password' => \Hash::make($request->password),
    //   'profile_photo' => $request->has('profile_photo') ? $this->uploadOne($request->profile_photo, 'customer/profile_photo') : NULL,
      'status' => true,
      'isVerified' => false,
    ]);
  }

  public function findById($id) {
    return $this->customer->find($id);
  }

  public function updateData($request, $id) {
    $customer = $this->findById($id);
    if($customer) {
      $save = $customer->update($request->except('profile_photo'));
      if($save) {
        return $customer;
      }
      return false;
    }
    return false;
  }

  public function deleteData($id) {
    $customer = $this->findById($id);
    if(!$customer) {
      return false;
    }
    $customer->orders->count() > 0 ? $customer->orders()->delete() : null;
    return $customer->delete();
  }
}
