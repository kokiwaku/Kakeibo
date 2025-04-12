'use client'

import React, { createContext, ReactNode, useContext } from 'react'
import { Category } from '@/types/models/category'
import { TransactionType } from '@/types/models/transaction'
import { useCategories } from '@/features/app/hooks/categories/useCategories'

export type CategoryContextType = {
  transactionType: TransactionType
  categoryList: Category[]
  changeTransactionType: (transactionType: TransactionType) => void
  addParentCategory: (
    transactionType: TransactionType,
    categoryName: string,
  ) => void
}

// 明示的な型アノテーションを追加
export const CategoryContext = createContext<CategoryContextType>(
  {} as CategoryContextType,
)

type CategoryProviderProps = {
  children: ReactNode
}
export const CategoryProvider: React.FC<CategoryProviderProps> = ({
  children,
}) => {
  const {
    categoryList,
    changeTransactionType,
    addParentCategory,
    transactionType,
  } = useCategories()
  return (
    <CategoryContext.Provider
      value={{
        transactionType,
        categoryList,
        changeTransactionType,
        addParentCategory,
      }}
    >
      {children}
    </CategoryContext.Provider>
  )
}

export const useCategoryContext = () => {
  const context = useContext(CategoryContext)
  if (context === undefined) {
    throw new Error('useCategoryContext must be used within a CategoryContext')
  }
  return context
}
