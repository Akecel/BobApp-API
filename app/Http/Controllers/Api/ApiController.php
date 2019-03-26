<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    /**
     * Response of the API with 200
     *
     * @param  $result
     * @return array
     */

    public function apiResponse200($result)
    {
        return response()->json($result, 200);
    }

    /**
     * Response of the API with 201
     *
     * @param  $result
     * @return array
     */

    public function apiResponse201($result)
    {
        return response()->json($result, 201);
    }

    /**
     * Response of the API with 202
     *
     * @param  $result
     * @return array
     */

    public function apiResponse202($result)
    {
        return response()->json($result, 202);
    }

    /**
     * Response of the API with 204
     *
     * @param  $result
     * @return array
     */

    public function apiResponse204()
    {
        return response()->json(null, 204);
    }

    /**
     * Response of the API with 403
     *
     * @param  $error $msgError $code
     * @return array
     */

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

    /**
     * Response of the API with 404
     *
     * @param  $error $msgError $code
     * @return array
     */

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

    /**
     * Response of the API with 409
     *
     * @param  $error $msgError $code
     * @return array
     */

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
