'use client'

import { useCategoryContext } from '@/features/app/contexts/categories/CategoryContext'
import InputForm from './InputForm'

const CategoriesList = () => {
  const { categoryList } = useCategoryContext()
  return (
    <div className="flex flex-col gap-1 px-5 pt-2 max-h-150 overflow-auto">
      {categoryList.map((category, index) => (
        <div key={index} className="mb-3">
          <p className="bg-gray-100 rounded-md pl-3 py-2">{category.name}</p>
          {category?.subCategory?.map((subCategory, index) => (
            <div
              key={index}
              className="mt-2 ml-3 pl-3 py-2 rounded-md outline-1 -outline-offset-1 outline-gray-300"
            >
              {subCategory.name}
            </div>
          ))}
          <div className="ml-3 w-2/4">
            <InputForm />
          </div>
        </div>
      ))}
      <div className="rounded-md pt-1 pb-5">
        <InputForm />
      </div>
    </div>
  )
}

export default CategoriesList
