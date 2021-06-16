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
    private $default_sucess_message = "Okay";

    /**
     * The default error message
     *
     * @var string
     */
    private $default_error_message = "Sorry, something went wrong";

    /**
     * Returns a sucess response
     *
     * @param object|array $data
     * @param integer $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sucess_response($data, int $code = 200, string $message = null)
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

    /**
     * Returns a error response
     *
     * @param string $message
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function error_response(string $message = null, int $code = 500)
    {
        try {
            return response()->json([
                    "data"      => [],
                    "message"   => $message ?? $this->default_error_message,
                    "status"    => $code,
                ], $code);
        } catch(\Exception $e) {
            if(config('app.debug')) {
                throw new \Exception($e->getMessage());
            } else {
                return response()->json([
                    "data"      => [],
                    "message"   => $this->default_error_message,
                    "status"    => $code,
                ], $code);
            }
        }
    }
}
