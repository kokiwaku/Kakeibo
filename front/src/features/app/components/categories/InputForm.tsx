'use client'
import { PlusCircleIcon } from '@heroicons/react/16/solid'
import { useState } from 'react'
import { useCategoryContext } from '@/features/app/contexts/categories/CategoryContext'
import { Category } from '@/types/models/category'
import { Event } from '@/types/event'
import { TransactionType } from '@/types/models/transaction'

type InputFormProps = {
  transactionType: TransactionType
  parentCategory?: Category
}
const InputForm: React.FC<InputFormProps> = ({
  transactionType,
  parentCategory,
}) => {
  const { addParentCategory } = useCategoryContext()
  const [category, setCategory] = useState('')

  const handleAddCategory = () => {
    if (category === '') {
      return
    }

    if (!parentCategory) {
      addParentCategory(transactionType, category)
    } else {
      // addParentCategory(transactionType, category)
    }
    setCategory('')
  }
  const handleKeyDown: Event['onKeyDown'] = (e) => {
    if (e.key === 'Enter') {
      handleAddCategory()
    }
  }
  return (
    <>
      <div className="flex gap-3 items-center text-sm">
        <div className="mt-2 ml-3 pl-3 pr-3 py-2 rounded-md outline-1 -outline-offset-1 outline-gray-300">
          <input
            type="text"
            placeholder="新しいカテゴリを登録"
            className="w-full px-2 py-1"
            value={category}
            onChange={(e) => setCategory(e.target.value)}
            onKeyDown={handleKeyDown}
          />
        </div>
        <p>
          <PlusCircleIcon
            className="h-5 w-5 cursor-pointer"
            onClick={handleAddCategory}
          />
        </p>
      </div>
    </>
  )
}
export default InputForm
