<?php

declare(strict_types=1);

namespace Modules\Teacher\Http\Controllers\Api\V1\Teacher;

use Exception;
use Illuminate\Http\JsonResponse;
use Modules\Core\Constants\HttpStatusConstants;
use Modules\Core\Http\Controllers\Api\V1\BaseApiV1Controller;
use Modules\Teacher\Http\Requests\Api\V1\UpdateTeacherRequest;
use Modules\Teacher\Http\Resources\Api\V1\TeacherResource;
use Modules\Teacher\Services\TeacherService;

/**
 * Controller for updating a teacher.
 * 
 * @group Teachers
 * 
 * @subgroup Teacher Management
 */
final class UpdateTeacherController extends BaseApiV1Controller
{
    public function __construct(
        private readonly TeacherService $teacherService
    ) {}

    /**
     * Update a teacher
     * 
     * Update an existing teacher with the provided data.
     *
     * @urlParam id integer required The ID of the teacher to update. Example: 1
     * @bodyParam first_name string required The first name of the teacher. Example: John
     * @bodyParam last_name string required The last name of the teacher. Example: Doe
     * @bodyParam phone string required The phone number of the teacher. Example: +1234567890
     * @bodyParam address string required The address of the teacher. Example: 123 Main St
     * @bodyParam city string required The city of the teacher. Example: New York
     * @bodyParam state string required The state of the teacher. Example: NY
     * @bodyParam zip string required The ZIP code of the teacher. Example: 10001
     * @bodyParam country_id integer required The ID of the teacher's country. Example: 1
     * 
     * @response 200 {
     *     "success": true,
     *     "message": "Teacher updated successfully",
     *     "data": {
     *         "id": 1,
     *         "first_name": "John",
     *         "last_name": "Doe",
     *         "full_name": "John Doe",
     *         "phone_number": "+1234567890",
     *         "address": "123 Main St",
     *         "city": "New York",
     *         "state": "NY",
     *         "zip": "10001",
     *         "country_id": 1,
     *         "user_id": 1,
     *         "created_at": "2024-02-20T12:00:00Z",
     *         "updated_at": "2024-02-20T12:00:00Z",
     *         "deleted_at": null,
     *         "user": {
     *             "id": 1,
     *             "email": "john.doe@example.com",
     *             "type": "teacher",
     *             "email_verified_at": "2024-02-20T12:00:00Z"
     *         },
     *         "country": {
     *             "id": 1,
     *             "name": "United States",
     *             "code": "US",
     *             "flag": "us.png"
     *         }
     *     },
     *     "timestamp": "2024-02-20T12:00:00Z"
     * }
     * 
     * @response 404 {
     *     "success": false,
     *     "message": "Teacher not found",
     *     "timestamp": "2024-02-20T12:00:00Z"
     * }
     * 
     * @response 422 {
     *     "success": false,
     *     "message": "The given data was invalid",
     *     "errors": {
     *         "first_name": ["The first name field is required."],
     *         "last_name": ["The last name field is required."]
     *     },
     *     "timestamp": "2024-02-20T12:00:00Z"
     * }
     */
    public function __invoke(UpdateTeacherRequest $request, int $id): JsonResponse
    {
        try {
            $teacher = $this->teacherService->updateTeacher($id, $request->toDto());
            $teacher->load(['user', 'country']);

            return $this->successResponse(
                data: new TeacherResource($teacher),
                message: 'Teacher updated successfully'
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                message: $e->getMessage(),
                statusCode: HttpStatusConstants::HTTP_404_NOT_FOUND
            );
        }
    }
}
