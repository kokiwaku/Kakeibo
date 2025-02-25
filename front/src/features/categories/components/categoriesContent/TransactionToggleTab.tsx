'use client'
import { useCategoryContext } from '@features/categories/contexts/CategoryContext'

const TransactionToggleTab = () => {
  const { transactionType, changeTransactionType } = useCategoryContext()
  return (
    <div className="flex justify-center items-center gap-1 bg-gray-100 rounded-md w-30 h-10">
      <div
        className={`${transactionType === 'incomes' ? 'bg-white rounded-md' : ''} py-1 px-2`}
        onClick={() => changeTransactionType('incomes')}
      >
        収入
      </div>
      <div
        className={`${transactionType === 'expenses' ? 'bg-white rounded-md' : ''} py-1 px-2`}
        onClick={() => changeTransactionType('expenses')}
      >
        支出
      </div>
    </div>
  )
}

export default TransactionToggleTab
