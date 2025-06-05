'use client'

import { useCategoryContext } from '@/features/app/contexts/categories/CategoryContext'

const TransactionToggleTab = () => {
  const { transactionType, changeTransactionType } = useCategoryContext()
  return (
    <div className="flex justify-center items-center gap-1 bg-gray-100 rounded-md w-30 h-10 mt-5 ml-5">
      <div
        className={`${transactionType === 'income' ? 'bg-white rounded-md' : ''} py-1 px-2 cursor-pointer`}
        onClick={() => changeTransactionType('income')}
      >
        収入
      </div>
      <div
        className={`${transactionType === 'expense' ? 'bg-white rounded-md' : ''} py-1 px-2 cursor-pointer`}
        onClick={() => changeTransactionType('expense')}
      >
        支出
      </div>
    </div>
  )
}

export default TransactionToggleTab
