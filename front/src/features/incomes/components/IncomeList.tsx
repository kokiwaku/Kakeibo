'use client'

import React, { useState, Dispatch, SetStateAction } from 'react'
import { useModalContext } from '@/features/incomes/contexts/ModalContext'

const IncomeList = () => {
  const { openModal } = useModalContext()
  // 仮のデータ
  const incomesList = [
    {
      id: 1,
      date: '2021/01/01',
      category: '給料',
      amount: 1000,
      memo: 'お年玉',
    },
    {
      id: 2,
      date: '2021/01/02',
      category: 'その他',
      amount: 2000,
      memo: 'お年玉',
    },
  ]
  return (
    <>
      <div className="flex gap-10">
        <h1 className="text-2xl font-bold">収入一覧</h1>
        <button
          className="bg-blue-500 text-white hover:bg-blue-200 rounded-md px-4 py-2 cursor-pointer"
          onClick={() => openModal('create')}
        >
          収入を追加
        </button>
      </div>
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
          {incomesList.map((income) => (
            <tr
              key={income.id}
              className="h-10 [&:not(:last-child)]:border-b [&:not(:last-child)]:border-gray-200"
            >
              <td className="p-4">{income.date}</td>
              <td className="p-4">{income.category}</td>
              <td className="p-4">{income.amount}</td>
              <td className="p-4">{income.memo}</td>
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

export default IncomeList
