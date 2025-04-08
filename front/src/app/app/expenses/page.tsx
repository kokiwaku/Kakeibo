'use client'

import React from 'react'
import TransactionHeader from '@/components/TransactionHeader'
import TransactionModal from '@/components/TransactionModal'
import TransactionList from '@/components/TransactionList'
import { TransactionItem } from '@/types/models/transaction'

const Page = () => {
  // TODO 仮 データ表示用
  const transactionList: TransactionItem[] = [
    {
      id: 1,
      date: new Date('2021/01/01'),
      category: '食費 > 食料品',
      amount: 5000,
      memo: '夕食',
    },
    {
      id: 2,
      date: new Date('2021/01/02'),
      category: '交通費 > 電車',
      amount: 1000,
      memo: '通勤',
    },
  ]
  return (
    <main className="flex flex-col gap-10">
      <TransactionHeader />
      <TransactionList transactionList={transactionList} />
      <TransactionModal />
    </main>
  )
}
export default Page
