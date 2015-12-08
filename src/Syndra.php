<?php
/**
 * Class Syndra
 *
 * @author Mario Basic
 */

namespace Laravelista\Syndra;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class Syndra
 *
 * This package returns generic (predefined) JSON responses for common API actions like creating,
 * updating, destroying, indexing and showing a resource.
 *
 * It can be easily extended and modified.
 *
 * It can be used anywhere in your application (controllers, routes etc...)
 *
 * ### Examples
 *
 * #### OK Response
 *
 * <code>
 * return $this->syndra->respondOk('post_deleted');
 * </code>
 *
 * #### Respond with a JSON validation error.
 *
 * <code>
 * return Syndra::respondValidationError($errors);
 * </code>
 *
 * @see  ...
 * @link https://github.com/laravelista/Syndra/wiki
 */
class Syndra
{

    /**
     * Default is (200).
     *
     * @var int
     */
    protected $statusCode = Response::HTTP_OK;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return mixed
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Responds with JSON, status code and headers.
     *
     * @param array $data
     * @return JsonResponse
     */
    public function respond(array $data)
    {
        return new JsonResponse($data, $this->getStatusCode(), $this->getHeaders());
    }

    /**
     * Use this for responding with messages.
     *
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithMessage($message='OK', array $data = [])
    {
        return $this->respond([
            'success'     => true,
            'message'     => $message,
            'status_code' => $this->getStatusCode(),
            'data'        => $data
        ]);
    }

    /**
     * Use this for responding with error messages.
     *
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message='Error', array $data = [])
    {
        return $this->respond([
            'success'     => false,
            'error' => [
                'message'     => $message,
                'status_code' => $this->getStatusCode()
            ],
            'data'        => $data
        ]);
    }


    /**
     * Use this to respond with a message (200).
     *
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondOk($message='OK', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_OK)
            ->respondWithMessage($message, $data);
    }

    /**
     * Use this when a resource has been created (201).
     *
     * @param $message
     * @param array $data
     * @return mixed
     */
    public function respondCreated($message='Created', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_CREATED)
            ->respondWithMessage($message, $data);
    }

    /**
     * Use this when a resource has been updated (202).
     *
     * @param $message
     * @param array $data
     * @return mixed
     */
    public function respondUpdated($message='Updated', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_ACCEPTED)
            ->respondWithMessage($message, $data);
    }


    /**
     * Use this when the user needs to be authorized to do something (401).
     *
     * @param $message
     * @param array $data
     * @return mixed
     */
    public function respondUnauthorized($message='Unauthorized', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)
            ->respondWithError($message, $data);
    }

    /**
     * Use this when the user does not have permission to do something (403).
     *
     * @param string $message
     * @param array $data
     * @return mixed
     */
    public function respondForbidden($message='Forbidden', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)
            ->respondWithError($message, $data);
    }

    /**
     * Use this when a resource is not found (404).
     *
     * @param string $message
     * @param array $data
     * @return mixed
     */
    public function respondNotFound($message='Not Found', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)
            ->respondWithError($message, $data);
    }

    /**
     * Use this when the validation fails (422).
     *
     * @param string $message
     * @param array $data
     * @return mixed
     */
    public function respondValidationError($message='Validation Error', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->respondWithError($message, $data);
    }


    /**
     * Use this for general server errors (500).
     *
     * @param string $message
     * @param array $data
     * @return mixed
     */
    public function respondInternalError($message='Internal Error', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message, $data);
    }

    /**
     * Use this for HTTP not implemented errors (501).
     *
     * @param string $message
     * @param array $data
     * @return mixed
     */
    public function respondNotImplemented($message='Not Implemented', array $data = [])
    {
        return $this->setStatusCode(Response::HTTP_NOT_IMPLEMENTED)
            ->respondWithError($message, $data);
    }
}
