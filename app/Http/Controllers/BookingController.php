<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\BookingTransaction;
use App\Models\Workshop;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function booking(Workshop $workshop){
        return view('booking.booking', compact('workshop'));
    }

    public function bookingStore(StoreBookingRequest $request, Workshop $workshop)
    {
        $validated = $request->validated();
        $validated ['workshop_id'] = $workshop->id;

        try {
            $this->bookingService->storeBooking($validated);
            return redirect()->route('front.payment');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to create booking. Please try again.']);
        }
    }

    public function payment()
{
    // Periksa apakah sesi booking tersedia
    if (!$this->bookingService->isBookingSessionAvailable()) {
        return redirect()->route('front.index')->with('error', 'Sesi booking tidak tersedia.');
    }

    // Ambil detail booking dari service
    $data = $this->bookingService->getBookingDetails();

    // Validasi jika data booking kosong
    if (!$data || empty($data)) {
        return redirect()->route('front.index')->with('error', 'Detail booking tidak tersedia.');
    }

    // Validasi data pembayaran, misalnya total harga dan metode pembayaran
    if (empty($data['payment']) || !isset($data['payment']['total_price'])) {
        return redirect()->route('front.index')->with('error', 'Data pembayaran tidak valid.');
    }

    // Kirim data booking ke tampilan pembayaran
    return view('booking.payment', compact('data'));
}

    public function paymentStore(StorePaymentRequest $request)
    {
        $validated = $request->validated();

        try {
            $bookingTransactionId = $this->bookingService->finalizeBookingAndPayment($validated);
            return redirect()->route('front.booking_finished', $bookingTransactionId);
        } catch (\Exception $e) {
            Log :: error('Payment storage failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Unable to store payment details. Please try again.' . $e->getMessage
            ()]);
        }
    }
    public function bookingFinished(BookingTransaction $bookingTransaction)
    {

    return view( 'booking. booking_finished', compact('bookingTransaction'));
    }

    public function checkBooking(){
        return view('booking.my_booking');
    }

    public function checkBookingDetails(StoreCheckBookingRequest $request)
    {
        $validated = $request->validated();

        $myBookingDetails = $this->bookingService->getMyBookingDetails($validated);

        if ($myBookingDetails) {
        return view('booking.my_booking_details', compact('myBookingDetails'));
        }
        
        return redirect()->route('front.check_booking')->withErrors(['error' => 'Transaction not found']);
    }

}
