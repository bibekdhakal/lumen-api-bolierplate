<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * Default response has status true with status code 200
     *
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @param bool $status
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond( $data = [], string $message = "", int $statusCode = 200, bool $status = true, $errors = [])
    {
        $response = ['status' => $status, 'message' => $message, 'data' => $data, 'errors' => $errors];
        return response()->json($response, $statusCode);
    }

    /**
     * Respond with success.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondSuccess($data, $message = "Action Successful")
    {
        return $this->respond($data, $message);
    }

    /**
     * Respond with created.
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($data, $message)
    {
        return $this->respond($data, $message, 201);
    }

    /**
     * Respond with no content.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNoContent($message)
    {
        return $this->respond([], $message, 204, false);
    }

    /**
     * Respond with error.
     *
     * @param $message
     * @param $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondError($message, $errors = [], $statusCode = 500)
    {
        return $this->respond([], $message, $statusCode, false, $errors);
    }

    /**
     * Respond with unauthorized.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->respond([], $message, 401, false);
    }

    /**
     * Respond with forbidden.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->respond([], $message, 403, false);
    }

    /**
     * Respond with not found.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNotFound($message = 'Not Found')
    {
        return $this->respond([], $message, 404, false);
    }
}
