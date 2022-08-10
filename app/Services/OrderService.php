<?php
namespace App\Services;

use App\Models\Order;
use App\Models\Customer;
use App\Traits\UploadAble;

class OrderService {

  use UploadAble;

  protected $order;
  protected $customer;

  public function __construct(Order $order, Customer $customer) {
    $this->order = $order;
    $this->customer = $customer;
  }

  public function index() {
    return $this->order->orderBy('created_at', 'DESC')->paginate(20);
  }

  public function store($request) {
    $order = $this->order->create([
        'customer_id' => $request->customer_id,
        'company_id' => $request->company_id,
        'total' => $request->total,
        'shipping_charge' => $request->delivery_charge,
        'discount' => 0,
        'rider-assigned' => false,
        'company_accepted' => false,
        'payment_status' => 'PENDING',
        'delivery_status' => 'PENDING',
    ]);
    $orderCode = str_pad($this->order->count(), 5, 0, STR_PAD_LEFT);
    $order->update(['orderCode' => $orderCode]);
    return $order;
  }

  public function findById($id) {
    return $this->order->find($id);
  }

  public function updateData($request, $id) {
    $order = $this->findById($id);
    if($order) {
      $save = $order->update($request->except('_token'));
      if($save) {
        return $order;
      }
      return false;
    }
    return false;
  }

  public function deleteData($id) {
    $order = $this->findById($id);
    if(!$order) {
      return false;
    }
    return $order->delete();
  }
}
