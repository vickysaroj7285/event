<?php

namespace App\Http\Controllers;

/**
 *  @OpenAPI(
 *      @OA\Server(url=SERVER_V1, description="Server v1")
 *  ),
 *  @OpenAPI(
 *      @OA\Server(url=SERVER_V2, description="Server v2")
 *  )
 *
 * @OA\Info(
 *    title=APP_NAME,
 *    version="1.0.0",
 * )
 *  @OA\SecurityScheme(type="http", securityScheme="BearerAuth", scheme="bearer", bearerFormat="JWT"),
 */
abstract class Controller
{
    
}
