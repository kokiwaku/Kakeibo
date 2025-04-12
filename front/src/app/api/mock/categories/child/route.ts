import { NextRequest, NextResponse } from 'next/server'
import { Response } from '@/types/api'
import { Category, SubCategory } from '@/types/models/category'
import { TransactionType } from '@/types/models/transaction'
import { incomeCategories } from '@/mocks/categories/incomeCategories'
import { expenseCategories } from '@/mocks/categories/expenseCategories'

// カテゴリーごとのサブカテゴリーのカウントを管理
const lastIdMap = {
  expenses: expenseCategories.map((category) => {
    return {
      id: category.id,
      count: category.subCategory?.length,
    }
  }),
  incomes: incomeCategories.map((category) => {
    return {
      id: category.id,
      count: category.subCategory?.length,
    }
  }),
}

export async function POST(request: NextRequest) {
  const body = await request.json()
  const transactionType = body.transactionType as TransactionType
  const categoryName = body.categoryName as string
  const parentCategoryId = body.parentCategoryId as number

  if (!transactionType || !categoryName || !parentCategoryId) {
    const result: Response<Category | null> = {
      code: 400,
      data: null,
      message: [
        'Transaction type and category name and parent category id are required.',
      ],
    }
    return NextResponse.json(result)
  }

  // 次のIDを生成
  const nextId =
    lastIdMap[transactionType].find((v) => v.id === parentCategoryId)?.count + 1
  // マッピング用のカウントを更新
  lastIdMap[transactionType].map((v) => {
    if (v.id === parentCategoryId) {
      v.count = nextId
    }
    return v
  })

  const result: Response<SubCategory> = {
    code: 200,
    data: {
      id: nextId,
      name: categoryName,
    },
  }
  return NextResponse.json(result)
}
