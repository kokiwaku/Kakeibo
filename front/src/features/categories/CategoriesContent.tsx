'use client'

import TransactionToggleTab from '@features/categories/components/categoriesContent/TransactionToggleTab'
import CategoriesList from '@/features/categories/components/categoriesContent/CategoryList'

const CategoriesContent = () => {
  return (
    <div className="flex flex-col gap-3">
      <TransactionToggleTab />
      <CategoriesList />
    </div>
  )
}

export default CategoriesContent
