'use client'

import React from 'react'
import { useTransactionModalContext } from '@/features/app/contexts/common/TransactionModalContext'
import { TransactionItem } from '@/types/models/transaction'
import { dateImplodeByDelimiter } from '@/utils/dateHelper'

type Props = {
  transactionList: TransactionItem[]
}
const TransactionList = ({ transactionList }: Props) => {
  const { openModal } = useTransactionModalContext()
  return (
    <>
      <table className="table-auto w-full text-left">
        <thead>
          <tr>
            <th className="p-4 w-32">日付</th>
            <th className="p-4 w-40">カテゴリ</th>
            <th className="p-4 w-32">金額</th>
            <th className="p-4 w-60">メモ</th>
            <th className="p-4 flex-1">操作</th>
          </tr>
        </thead>
        <tbody>
          {transactionList.map((transaction) => (
            <tr
              key={transaction.id}
              className="h-10 [&:not(:last-child)]:border-b [&:not(:last-child)]:border-gray-200"
            >
              <td className="p-4 w-32">
                {dateImplodeByDelimiter(transaction.date)}
              </td>
              <td className="p-4 w-40">{transaction.category}</td>
              <td className="p-4 w-32">{transaction.amount}</td>
              <td className="p-4 w-60">{transaction.memo}</td>
              <td className="p-4 flex-1">
                <div className="flex gap-2">
                  <button
                    className="bg-gray-500 text-white hover:bg-gray-200 rounded-md px-4 py-2 cursor-pointer"
                    onClick={() => openModal('update')}
                  >
                    編集
                  </button>
                  <button
                    className="bg-red-500 text-white hover:bg-red-200 rounded-md px-4 py-2 cursor-pointer"
                    onClick={() => openModal('delete')}
                  >
                    削除
                  </button>
                </div>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </>
  )
}

export default TransactionList
