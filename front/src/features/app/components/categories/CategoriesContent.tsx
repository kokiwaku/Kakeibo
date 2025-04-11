'use client'

import CategoriesList from './CategoryList'
import TransactionToggleTab from './TransactionToggleTab'

const CategoriesContent = () => {
  return (
    <div className="flex flex-col gap-3 bg-white rounded-md">
      <TransactionToggleTab />
      <CategoriesList />
    </div>
  )
}

export default CategoriesContent
