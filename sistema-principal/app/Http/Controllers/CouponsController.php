<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function applyCoupon(Request $request)
{
    $coupon = Coupons::where('code', $request->coupon_code)
                     ->where('expiration_date', '>=', now())
                     ->first();

    if (!$coupon) {
        return response()->json(['success' => false, 'message' => 'Cupom inválido ou expirado.'], 400);
    }

    // Calcula o total com desconto
    $total = $request->total;
    $discountedTotal = $total - ($total * ($coupon->discount_percent / 100));

    return response()->json(['success' => true, 'discountedTotal' => $discountedTotal]);
}

}
