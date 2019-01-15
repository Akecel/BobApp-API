<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Set the success response of the API.
     */

    public function apiResponseSuccess($result, $message)
    {
      $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * Set the error response of the API.
     */

    public function apiResponseError($error, $msgError = [], $code = 404)
    {
      $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($msgError)){
            $response['data'] = $msgError;
        }
        return response()->json($response, $code);
    }
}
