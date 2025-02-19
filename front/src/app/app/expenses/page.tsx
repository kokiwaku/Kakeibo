import React from 'react'
import ExpenceModal from '@/features/expenses/components/ExpenceModal'
import ExpenceList from '@features/expenses/components/ExpenceList'
import ExpenceHeader from '@features/expenses/components/ExpenceHeader'

const Page = () => {
  return (
    <main className="flex flex-col gap-17 py-25 px-10">
      <ExpenceHeader />
      <ExpenceList />
      <ExpenceModal />
    </main>
  )
}
export default Page
