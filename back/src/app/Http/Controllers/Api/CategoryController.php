<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\GetCategoryListRequest;
use App\Http\Requests\Category\CreateParentCategoryRequest;
use App\Http\Requests\Category\CreateChildCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\UseCase\Category\GetCategoryListUseCase;
use App\UseCase\Category\GetCategoryListRequest as GetCategoryListUseCaseRequest;
use App\UseCase\Category\CreateParentCategoryUseCase;
use App\UseCase\Category\CreateParentCategoryRequest as CreateParentCategoryUseCaseRequest;
use App\UseCase\Category\CreateChildCategoryUseCase;
use App\UseCase\Category\CreateChildCategoryRequest as CreateChildCategoryUseCaseRequest;
use App\UseCase\Category\UpdateCategoryUseCase;
use App\UseCase\Category\UpdateCategoryRequest as UpdateCategoryUseCaseRequest;
use App\UseCase\Category\DeleteCategoryUseCase;
use App\UseCase\Category\DeleteCategoryRequest as DeleteCategoryUseCaseRequest;
use App\Domain\Category\Model\Value\TransactionType;
use App\Presenter\Category\CategoryListPresenter;
use App\Presenter\Category\CreateParentCategoryPresenter;
use App\Presenter\Category\CreateChildCategoryPresenter;
use App\Presenter\Category\UpdateCategoryPresenter;
use App\Presenter\Category\DeleteCategoryPresenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getList(
        GetCategoryListRequest $request,
        GetCategoryListUseCase $useCase,
        CategoryListPresenter $presenter
    ): JsonResponse {
        $userId = $request->user()->id;
        $transactionType = $request->validated('transactionType');

        $useCaseRequest = new GetCategoryListUseCaseRequest(
            userId: $userId,
            transactionType: TransactionType::fromString($transactionType),
        );
        $response = $useCase->handle($useCaseRequest);

        $categories = $presenter->toResponse($response->parentCategories);

        return response()->json([
            'data' => $categories,
        ]);
    }

    public function createParentCategory(
        CreateParentCategoryRequest $request,
        CreateParentCategoryUseCase $useCase,
        CreateParentCategoryPresenter $presenter
    ): JsonResponse {
        $userId = $request->user()->id;
        $validated = $request->validated();

        $useCaseRequest = new CreateParentCategoryUseCaseRequest(
            userId: $userId,
            transactionType: TransactionType::fromString($validated['transactionType']),
            categoryName: $validated['categoryName'],
        );

        $response = $useCase->handle($useCaseRequest);

        $categoryData = $presenter->toResponse(
            $response->categoryId,
            $validated['categoryName']
        );

        return response()->json([
            'data' => $categoryData,
        ]);
    }

    public function createChildCategory(
        CreateChildCategoryRequest $request,
        CreateChildCategoryUseCase $useCase,
        CreateChildCategoryPresenter $presenter
    ): JsonResponse {
        $userId = $request->user()->id;
        $validated = $request->validated();

        $useCaseRequest = new CreateChildCategoryUseCaseRequest(
            userId: $userId,
            transactionType: TransactionType::fromString($validated['transactionType']),
            categoryName: $validated['categoryName'],
            parentCategoryId: $validated['parentCategoryId'],
        );

        $response = $useCase->handle($useCaseRequest);

        $categoryData = $presenter->toResponse(
            $response->categoryId,
            $validated['categoryName']
        );

        return response()->json([
            'data' => $categoryData,
        ]);
    }

    public function updateCategory(
        UpdateCategoryRequest $request,
        int $id,
        UpdateCategoryUseCase $useCase,
        UpdateCategoryPresenter $presenter
    ): JsonResponse {
        $userId = $request->user()->id;
        $validated = $request->validated();

        $useCaseRequest = new UpdateCategoryUseCaseRequest(
            userId: $userId,
            categoryId: $id,
            categoryName: $validated['categoryName'],
        );

        $response = $useCase->handle($useCaseRequest);

        $categoryData = $presenter->toResponse(
            $response->categoryId,
            $response->categoryName
        );

        return response()->json([
            'data' => $categoryData,
        ]);
    }

    public function deleteCategory(
        Request $request,
        int $id,
        DeleteCategoryUseCase $useCase,
        DeleteCategoryPresenter $presenter
    ): JsonResponse {
        $userId = $request->user()->id;

        $useCaseRequest = new DeleteCategoryUseCaseRequest(
            userId: $userId,
            categoryId: $id,
        );

        $response = $useCase->handle($useCaseRequest);

        $categoryData = $presenter->toResponse($response->categoryId);

        return response()->json([
            'data' => $categoryData,
        ]);
    }
}