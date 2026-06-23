<?php

namespace EscolaLms\TopicTypeProject\Http\Controllers\Admin\Swagger;

use EscolaLms\TopicTypeProject\Http\Requests\Admin\AdminDeleteProjectSolutionRequest;
use EscolaLms\TopicTypeProject\Http\Requests\Admin\AdminGradeProjectSolutionRequest;
use EscolaLms\TopicTypeProject\Http\Requests\Admin\AdminListProjectSolutionRequest;
use Illuminate\Http\JsonResponse;

interface ProjectSolutionApiAdminSwagger
{
    /**
     * @OA\Get(
     *      path="/api/admin/topic-project-solutions",
     *      summary="Get a listing of the project solutions",
     *      tags={"Admin Project Solution"},
     *      description="Get all project solutions",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="order_by",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              enum={"created_at", "id", "user_id", "topic_id"}
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="order",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              enum={"ASC", "DESC"}
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          description="Pagination Page Number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number",
     *               default=1,
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="per_page",
     *          description="Pagination Per Page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number",
     *               default=15,
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="topic_id",
     *          description="topic id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number",
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="course_id",
     *          description="course id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number",
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
     *          description="user id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json"
     *          ),
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/ProjectSolutionResource")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(AdminListProjectSolutionRequest $request): JsonResponse;

    /**
     * @OA\Delete(
     *      path="/api/admin/topic-project-solutions/{id}",
     *      summary="Remove the specified Project Solution",
     *      tags={"Admin Project Solution"},
     *      description="Delete Project Solution",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="ID",
     *          @OA\Schema(
     *             type="integer",
     *         ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json"
     *          ),
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function delete(AdminDeleteProjectSolutionRequest $request): JsonResponse;

    /**
     * @OA\Patch(
     *      path="/api/admin/topic-project-solutions/{id}/grade",
     *      summary="Grade the specified Project Solution",
     *      tags={"Admin Project Solution"},
     *      description="Set score and max_score for a Project Solution",
     *      security={
     *          {"passport": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="ID",
     *          @OA\Schema(
     *             type="integer",
     *         ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/AdminGradeProjectSolutionRequest")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json"
     *          ),
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/ProjectSolutionResource"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function grade(AdminGradeProjectSolutionRequest $request): JsonResponse;
}
