'use client'

import { useCategoryContext } from '@features/categories/contexts/CategoryContext'

const CategoriesList = () => {
  const { categoryList } = useCategoryContext()
  return (
    <div className="flex flex-col gap-1 p-5 max-h-90 overflow-auto bg-gray-100 rounded-md">
      {categoryList.map((category, index) => (
        <div key={index} className="">
          {category.name}
          {category?.subCategory?.map((subCategory, index) => (
            <div key={index} className="ml-3">
              {subCategory.name}
            </div>
          ))}
        </div>
      ))}
    </div>
  )
}

export default CategoriesList
