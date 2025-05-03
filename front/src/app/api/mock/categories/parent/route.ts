import { NextRequest, NextResponse } from 'next/server'
import { Response } from '@/types/api'
import { Category } from '@/types/models/category'
import { TransactionType } from '@/types/models/transaction'
import { incomeCategories } from '@/mocks/categories/incomeCategories'
import { expenseCategories } from '@/mocks/categories/expenseCategories'

// 既存のカテゴリから最後のIDを取得
const lastIdMap = {
  expenses: expenseCategories[expenseCategories.length - 1].id,
  incomes: incomeCategories[incomeCategories.length - 1].id,
}

export async function POST(request: NextRequest) {
  const body = await request.json()
  const transactionType = body.transactionType as TransactionType
  const categoryName = body.categoryName as string

  if (!transactionType || !categoryName) {
    const result: Response<Category | null> = {
      code: 400,
      data: null,
      message: ['Transaction type and category name are required.'],
    }
    return NextResponse.json(result)
  }

  // 次のIDを生成
  const nextId = lastIdMap[transactionType] + 1
  lastIdMap[transactionType] = nextId

  const result: Response<Category> = {
    code: 200,
    data: {
      id: nextId,
      name: categoryName,
      subCategory: [],
    },
  }
  return NextResponse.json(result)
}
