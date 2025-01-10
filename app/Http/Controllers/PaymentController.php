<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        if (!session()->has('registration_fee')) {
            $registrationFee = rand(100000, 125000);

            session(['registration_fee' => $registrationFee]);
        } else {
            $registrationFee = session('registration_fee');
        }

        return view('payment.index', compact('registrationFee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_amount' => 'required|numeric',
        ]);

        $fee = session('registration_fee');
        $amount = $request->input('payment_amount');

        if ($amount < $fee) {
            $underpaid = $fee - $amount;
            return response()->json([
                'status' => 'underpaid',
                'message' => "You are still underpaid $underpaid.",
                'underpaid' => $underpaid,
            ]);
        }

        if ($amount > $fee) {
            $overpaid = $amount - $fee;
            return response()->json([
                'status' => 'overpaid',
                'message' => "Sorry you overpaid $overpaid, would you like to enter a balance?",
                'overpaid' => $overpaid,
            ]);
        }

        session()->forget('registration_fee');
        return response()->json([
            'status' => 'success',
            'message' => 'Registration completed successfully!',
        ]);
    }

    public function confirmOverpayment(Request $request)
    {
        $overpaid = $request->input('overpaid');
        $request->user()->increment('wallet', $overpaid);

        session()->forget('registration_fee');
        return response()->json([
            'status' => 'success',
            'message' => 'Overpaid amount added to your wallet. Registration completed successfully!',
        ]);
    }
}
