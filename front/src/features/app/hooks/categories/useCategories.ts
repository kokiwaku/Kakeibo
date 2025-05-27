import React, { useCallback, useEffect, useState } from 'react'
import { TransactionType } from '@/types/models/transaction'
import { Category, SubCategory } from '@/types/models/category'
import {
  fetchCategories,
  postParentCategory,
  postChildCategory,
} from '@/features/app/apis/categories'

export const useCategories = () => {
  const [transactionType, setTransactionType] =
    useState<TransactionType>('income')
  const [categories, setCategories] = useState<{
    income: Category[]
    expense: Category[]
  }>({
    income: [],
    expense: [],
  })
  const [loading, setLoading] = useState(true)

  const changeTransactionType = useCallback(
    (newTransactionType: TransactionType) => {
      setTransactionType(newTransactionType)
    },
    [],
  )

  // 両方のトランザクションタイプのカテゴリを取得
  const fetchAllCategories = useCallback(async () => {
    try {
      const [incomeResponse, expenseResponse] = await Promise.all([
        fetchCategories('income'),
        fetchCategories('expense'),
      ])

      if (incomeResponse.code !== 200 || expenseResponse.code !== 200) {
        console.error('Failed to fetch categories')
        return
      }

      setCategories({
        income: incomeResponse.data ?? [],
        expense: expenseResponse.data ?? [],
      })
    } catch (error) {
      console.error('Error fetching categories:', error)
    }
  }, [])

  // 親カテゴリを追加
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

  // 子カテゴリを追加
  const addChildCategory = useCallback(
    async (
      transactionType: TransactionType,
      categoryName: string,
      parentCategoryId: number,
    ) => {
      const response = await postChildCategory(
        transactionType,
        categoryName,
        parentCategoryId,
      )
      if (response.code !== 200 || response?.data === null) {
        console.error(response.message)
        return
      }

      const categoryData = response.data as SubCategory
      setCategories((prev) => {
        const updatedCategories = prev[transactionType].map((category) => {
          if (category.id === parentCategoryId) {
            return {
              ...category,
              subCategory: [...(category.subCategory || []), categoryData],
            }
          }
          return category
        })

        return {
          ...prev,
          [transactionType]: updatedCategories,
        }
      })
    },
    [],
  )
  // 初期表示時に両方のカテゴリを取得
  useEffect(() => {
    fetchAllCategories()
    setLoading(false)
  }, [fetchAllCategories])

  return {
    categoryList: categories[transactionType],
    changeTransactionType,
    addParentCategory,
    addChildCategory,
    transactionType,
    loading,
  }
}
