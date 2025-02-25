import React from 'react'
import CategoriesHeader from '@features/categories/CategoriesHeader'
import CategoriesContent from '@features/categories/CategoriesContent'

const Page = () => {
  return (
    <>
      <main className="flex flex-col gap-7 py-25 px-10">
        <CategoriesHeader />
        <CategoriesContent />
      </main>
    </>
  )
}
export default Page
