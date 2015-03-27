<?php
use App\Http\Requests\Request;
use Response;

class BookingRequest extends Request {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'kitType' => 'required',
			'n_booking_start' => 'required|date',
			'n_booking_end' => 'required|date',
		];
	}
}
