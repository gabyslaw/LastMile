<?php
namespace App\Services;

use App\Models\Company;
use App\Traits\UploadAble;

class CompanyService {

  use UploadAble;

  protected $company;

  public function __construct(Company $company) {
    $this->company = $company;
  }

  public function index() {
    return $this->company->orderBy('created_at', 'DESC')->paginate(20);
  }

  public function store($request) {
    return $this->company->create([
      'email'         => $request->email,
      'name'         => $request->name,
      'phone_number'       => $request->phone_number,
      'password'           => \Hash::make($request->password),
      'address'            => $request->address,
      'city' => $request->city,
      'logo'      => $request->has('logo') ? $this->uploadOne($request->logo, 'rider/profile_photo') : NULL,
      'status'             => true,
      'isVerified'         => false,
    ]);
  }

  public function findById($id) {
    return $this->company->find($id);
  }

  public function updateData($request, $id) {
    $company = $this->findById($id);
    if($company) {
      $save = $company->update($request->except('profile_photo'));
      if($save) {
        return $company;
      }
      return false;
    }
    return false;
  }

  public function deleteData($id) {
    $company = $this->findById($id);
    if(!$company) {
      return false;
    }

    $company->orders->count() > 0 ? $company->orders()->delete() : null;
    return $company->delete();
  }
}
