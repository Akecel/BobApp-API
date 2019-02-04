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
            'data'    => $result,
            'meta' => [
                'success' => true,
                'message' => $message
            ],
        ];
        return response()->json($response, 200);
    }

    /**
     * Set the success no content responses of the API.
     */

    public function apiResponse204()
    {
        return response()->json(null, 204);
    }

    public function apiResponse200()
    {
        return response()->json(null, 200);
    }

    /**
     * Set the error response of the API.
     */

    public function apiResponseError($error, $msgError = [], $code = 404)
    {
      $response = [
          'error'=> [
            'status' => $code,
            'title' => $error,
            'source' => [
                'pointer' => url()->current()
            ],
          ],
          'meta'=> [
            'success' => false
          ]
            
        ];
        if(!empty($msgError)){
            $response['data'] = $msgError;
        }
        return response()->json($response, $code);
    }

}
