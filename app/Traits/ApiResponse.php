<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait ApiResponse
{
    /**
     * The default sucess message
     *
     * @var string
     */
    private $default_sucess_message = "";

    /**
     * Returns a response
     *
     * @param object|array $data
     * @param integer $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($data, string $message = null, int $code = 200)
    {
        try {
            return response()->json([
                    "data"      => $data,
                    "message"   => $message ?? $this->default_sucess_message,
                    "status"    => $code,
                ], $code);
        } catch (\Exception $e) {
            if(config('app.debug')) {
                throw new \Exception($e->getMessage());
            } else {
                return $this->error_response($e->getMessage());
            }
        }
    }
}
