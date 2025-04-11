'use client'

import MonthYearPicker from '@/features/app/components/common/MonthYearPicker'
import { useTransactionModalContext } from '@/features/app/contexts/common/TransactionModalContext'

const TransactionHeader = () => {
  const { openModal, transactionType } = useTransactionModalContext()
  const transactionTypeStr = transactionType === 'incomes' ? '収入' : '支出'
  return (
    <div className="flex gap-10">
      <h1 className="text-2xl font-bold">{`${transactionTypeStr}一覧`}</h1>
      <MonthYearPicker />
      <button
        className="bg-blue-500 text-white hover:bg-blue-200 rounded-md px-4 py-2 cursor-pointer"
        onClick={() => openModal('create')}
      >
        {`${transactionTypeStr}を追加`}
      </button>
    </div>
  )
}

export default TransactionHeader
