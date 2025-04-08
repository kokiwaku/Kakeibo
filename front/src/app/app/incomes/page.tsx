'use client'

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
      category: '給料',
      amount: 1000,
      memo: 'お年玉',
    },
    {
      id: 2,
      date: new Date('2021/01/02'),
      category: 'その他',
      amount: 2000,
      memo: 'お年玉',
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
