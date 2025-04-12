import React, { useCallback, useEffect, useState } from 'react'
import { TransactionType } from '@/types/models/transaction'
import { Category } from '@/types/models/category'
import {
  fetchCategories,
  postParentCategory,
} from '@/features/app/apis/categories'

export const useCategories = () => {
  const [transactionType, setTransactionType] =
    useState<TransactionType>('incomes')
  const [categories, setCategories] = useState<{
    incomes: Category[]
    expenses: Category[]
  }>({
    incomes: [],
    expenses: [],
  })

  const changeTransactionType = useCallback(
    (newTransactionType: TransactionType) => {
      setTransactionType(newTransactionType)
    },
    [],
  )

  // 両方のトランザクションタイプのカテゴリを取得
  const fetchAllCategories = useCallback(async () => {
    try {
      const [incomesResponse, expensesResponse] = await Promise.all([
        fetchCategories('incomes'),
        fetchCategories('expenses'),
      ])

      if (incomesResponse.code !== 200 || expensesResponse.code !== 200) {
        console.error('Failed to fetch categories')
        return
      }

      setCategories({
        incomes: incomesResponse.data ?? [],
        expenses: expensesResponse.data ?? [],
      })
    } catch (error) {
      console.error('Error fetching categories:', error)
    }
  }, [])

  // カテゴリを追加
  const addParentCategory = useCallback(
    async (transactionType: TransactionType, categoryName: string) => {
      const response = await postParentCategory(transactionType, categoryName)
      if (response.code !== 200 || response?.data === null) {
        console.error(response.message)
        return
      }

      const categoryData = response.data as Category
      setCategories((prev) => ({
        ...prev,
        [transactionType]: [
          ...prev[transactionType],
          {
            id: categoryData.id,
            name: categoryName,
          },
        ],
      }))
    },
    [],
  )

  // 初期表示時に両方のカテゴリを取得
  useEffect(() => {
    fetchAllCategories()
  }, [fetchAllCategories])

  return {
    categoryList: categories[transactionType],
    changeTransactionType,
    addParentCategory,
    transactionType,
  }
}
