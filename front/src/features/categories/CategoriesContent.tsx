'use client'

import TransactionToggleTab from '@/features/categories/components/categoriesContent/TransactionToggleTab'
import CategoriesList from '@/features/categories/components/categoriesContent/CategoryList'

const CategoriesContent = () => {
  return (
    <div className="flex flex-col gap-3 bg-white rounded-md">
      <TransactionToggleTab />
      <CategoriesList />
    </div>
  )
}

export default CategoriesContent
