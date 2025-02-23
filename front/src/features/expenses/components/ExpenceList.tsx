'use client'

import React, { useState, Dispatch, SetStateAction } from 'react'
import {
  CrudType,
  useTransactionModalContext,
} from '@/contexts/TransactionModalContext'

const ExpenseList = () => {
  const { openModal } = useTransactionModalContext()
  // 仮のデータ
  const ExpenseList = [
    {
      id: 1,
      date: '2021/01/01',
      category: '食費 > 食料品',
      amount: 5000,
      memo: '夕食',
    },
    {
      id: 2,
      date: '2021/01/02',
      category: '交通費 > 電車',
      amount: 1000,
      memo: '通勤',
    },
  ]
  return (
    <>
      <table className="table-auto w-full text-left">
        <thead>
          <tr>
            <th className="p-4">日付</th>
            <th className="p-4">カテゴリ</th>
            <th className="p-4">金額</th>
            <th className="p-4">メモ</th>
            <th className="p-4">操作</th>
          </tr>
        </thead>
        <tbody className="">
          {ExpenseList.map((expense) => (
            <tr
              key={expense.id}
              className="h-10 [&:not(:last-child)]:border-b [&:not(:last-child)]:border-gray-200"
            >
              <td className="p-4">{expense.date}</td>
              <td className="p-4">{expense.category}</td>
              <td className="p-4">{expense.amount}</td>
              <td className="p-4">{expense.memo}</td>
              <td className="p-4">
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

export default ExpenseList
