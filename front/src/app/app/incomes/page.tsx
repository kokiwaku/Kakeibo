'use client'

import IncomeCrudModal from '@/features/incomes/components/IncomeModal'
import IncomeList from '@features/incomes/components/IncomeList'

const Page = () => {
  return (
    <main className="flex flex-col gap-17 py-25 px-10">
      <IncomeList />
      <IncomeCrudModal />
    </main>
  )
}
export default Page
