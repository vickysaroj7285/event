<?php

namespace App\Http\Controllers\Api;

use App\Events\PodcastProcessed;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class AuthenticationController extends Controller
{


    /**
     * @OA\Post(
     * path="/register",
     * operationId="Register",
     * tags={"Register"},
     * summary="User Register",
     * description="User Register here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="password", type="password"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function register(RegisterRequest $request)
    {

        // 'name' => [
        //     'required',
        //     'string',
        //     'max:255',
        //     // Custom validation rule to ensure unique decoded name
        //     function ($attribute, $value, $fail) {
        //         $exists = DB::table('users')
        //             ->whereRaw('FROM_BASE64(name) = ?', [$value])
        //             ->exists();
        //         if ($exists) {
        //             $fail('The name has already been taken.');
        //         }
        //     },
        // ],
        // 
        // (1)
        $encryptionKey = env('AES_ENCRYPTION_KEY');
        $escapedName = addslashes($request->name);
        DB::table('users')->insert([
            'name' => DB::raw("TO_BASE64(AES_ENCRYPT('{$escapedName}', '{$encryptionKey}'))"),
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $decryptedUsers = DB::table(DB::raw(
            "(SELECT AES_DECRYPT(FROM_BASE64(name), '{$encryptionKey}') AS decrypted_name, email FROM users) AS decrypted_users"
        ))
            ->get();
        return $decryptedUsers;
    }


    /**
     * @OA\Post(
     * path="/login",
     * operationId="Login",
     * tags={"Register"},
     * summary="User Register",
     * description="User Register here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Register Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function login(Request $request)
    {
        $searchTerm = "%" . addslashes($request->name) . "%";
        // // Term to search in decrypted names
        $encryptionKey = env('AES_ENCRYPTION_KEY'); // Encryption key
        $decryptedUsers = DB::table(DB::raw(
            "(SELECT AES_DECRYPT(FROM_BASE64(name), '{$encryptionKey}') AS decrypted_name, email FROM users) AS decrypted_users"
        ))
            ->whereRaw("decrypted_name LIKE ?", [$searchTerm])
            ->get();
        return $decryptedUsers;
    }
    /**
     *  @OA\Post(path="/gettext", summary="image to get text", tags={"Image"},description="",security={{ "BearerAuth"={} }},
     *     @OA\RequestBody(required=true,
     *         @OA\MediaType(mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="image", type="string",format="binary"),
     *                 required={"image"}
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Success",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(response="400", description="Bad Request",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(response="422", description="Validation error",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *  )
     */
    public function ImageUpload(Request $request)
    {
        // Log::info('Enter in text detection function -- '.print_r($request->all(),1));
		$image = request('image');
	
    }
}
