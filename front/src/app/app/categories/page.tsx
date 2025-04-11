import React from 'react'
import CategoriesHeader from '@/features/app/components/categories/CategoriesHeader'
import CategoriesContent from '@/features/app/components/categories/CategoriesContent'

const Page = () => {
  return (
    <>
      <main className="flex flex-col gap-7">
        <CategoriesHeader />
        <CategoriesContent />
      </main>
    </>
  )
}
export default Page
