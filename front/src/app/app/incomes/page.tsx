'use client'

import IncomeModal from '@/features/incomes/components/IncomeModal'
import IncomeList from '@features/incomes/components/IncomeList'

const Page = () => {
  return (
    <main className="flex flex-col gap-17 py-25 px-10">
      <IncomeList />
      <IncomeModal />
    </main>
  )
}
export default Page
