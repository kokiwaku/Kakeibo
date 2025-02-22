'use client'

import MonthYearPicker from '@components/MonthYearPicker'
import { useModalContext } from '@/features/expenses/contexts/ModalContext'

const ExpenseHeader = () => {
  const { openModal } = useModalContext()

  return (
    <div className="flex gap-10">
      <h1 className="text-2xl font-bold">支出一覧</h1>
      <MonthYearPicker />
      <button
        className="bg-blue-500 text-white hover:bg-blue-200 rounded-md px-4 py-2 cursor-pointer"
        onClick={() => openModal('create')}
      >
        支出を追加
      </button>
    </div>
  )
}

export default ExpenseHeader
