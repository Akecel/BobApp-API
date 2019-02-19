<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    /**
     * Response of the API
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     
    // 200 Ok

    public function apiResponse200($result)
    {
        return response()->json($result, 200);
    }

    // 201 Created

    public function apiResponse201($result)
    {
        return response()->json($result, 201);
    }

    // 202 Accepted

    public function apiResponse202($result)
    {
        return response()->json($result, 202);
    }

    // 204 No Content

    public function apiResponse204()
    {
        return response()->json(null, 204);
    }

    // 403 Forbidden

    public function apiResponse403($error, $msgError = [], $code = 403)
    {
        $response = [
            'error'=> [
              'status' => $code,
              'title' => $error,
              'source' => [
                  'pointer' => url()->current()
              ],
            ]    
          ];
          if(!empty($msgError)){
              $response['data'] = $msgError;
          }
          return response()->json($response, $code);
    }

    // 404 Not Found

    public function apiResponse404($error, $msgError = [], $code = 404)
    {
      $response = [
          'error'=> [
            'status' => $code,
            'title' => $error,
            'source' => [
                'pointer' => url()->current()
            ],
          ],   
        ];
        if(!empty($msgError)){
            $response['data'] = $msgError;
        }
        return response()->json($response, $code);
    }

    // 409 Conflict

    public function apiResponse409($error, $msgError = [], $code = 409)
    {
      $response = [
          'error'=> [
            'status' => $code,
            'title' => $error,
            'source' => [
                'pointer' => url()->current()
            ],
          ], 
        ];
        if(!empty($msgError)){
            $response['data'] = $msgError;
        }
        return response()->json($response, $code);
    }

}
