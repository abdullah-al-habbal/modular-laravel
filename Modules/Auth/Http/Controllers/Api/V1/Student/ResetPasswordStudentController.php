<?php

declare(strict_types=1);

namespace Modules\Auth\Http\Controllers\Api\V1\Student;

use Exception;
use Modules\Auth\Constants\Messages\AuthMessageConstants;
use Modules\Auth\Http\Requests\Api\V1\Student\ResetPasswordStudentRequest;
use Modules\Auth\Services\Student\StudentAuthService;
use Modules\Core\Constants\HttpStatusConstants;
use Modules\Core\Http\Controllers\Api\V1\BaseApiV1Controller;

/**
 * @OA\Post(
 *     path="/auth/student/reset-password",
 *     tags={"Student Auth"},
 *     summary="Reset student's password",
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(ref="#/components/schemas/ResetPasswordStudentRequest")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Password reset successfully",
 *
 *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Invalid token",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Student not found",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
final class ResetPasswordStudentController extends BaseApiV1Controller
{
    public function __construct(
        private readonly StudentAuthService $studentAuthService
    ) {}

    public function __invoke(ResetPasswordStudentRequest $request)
    {
        try {
            $this->studentAuthService->resetPassword($request->toDto());

            return $this->successResponse(
                message: AuthMessageConstants::get(AuthMessageConstants::STUDENT_PASSWORD_RESET_SUCCESS)
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                message: $e->getMessage(),
                statusCode: HttpStatusConstants::HTTP_400_BAD_REQUEST
            );
        }
    }
}
