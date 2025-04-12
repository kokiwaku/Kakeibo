'use client'

import { useCategoryContext } from '../../contexts/categories/CategoryContext'
import CategoriesList from './CategoryList'
import TransactionToggleTab from './TransactionToggleTab'

const CategoriesContent = () => {
  const { loading } = useCategoryContext()
  return (
    <div className="flex flex-col gap-3 bg-white rounded-md">
      {loading ? (
        <div className="flex justify-center items-center h-full">
          <div className="animate-spin rounded-full h-50 w-50 border-t-2 border-b-2 border-gray-900 m-5"></div>
        </div>
      ) : (
        <>
          <TransactionToggleTab />
          <CategoriesList />
        </>
      )}
    </div>
  )
}

export default CategoriesContent
