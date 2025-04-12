import { NextRequest, NextResponse } from 'next/server'
import { expenseCategories } from '@/mocks/categories/expenseCategories'
import { incomeCategories } from '@/mocks/categories/incomeCategories'
import { Response } from '@/types/api'
import { TransactionType } from '@/types/models/transaction'
import { Category } from '@/types/models/category'

export async function GET(request: NextRequest) {
  const searchParams = request.nextUrl.searchParams
  const transactionType = searchParams.get('transactionType') as TransactionType

  if (!transactionType) {
    const result: Response = {
      code: 400,
      message: ['Transaction type is required.'],
    }
    return NextResponse.json(result)
  }

  const data =
    transactionType === 'expenses' ? expenseCategories : incomeCategories

  const result: Response<Category[]> = {
    code: 200,
    data: data,
  }
  return NextResponse.json(result)
}
