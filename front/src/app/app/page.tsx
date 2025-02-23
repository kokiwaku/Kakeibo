import React from 'react'
import SidePanel from '@/components/SidePanel'

const Page = () => {
  return (
    <main className="flex flex-col gap-17 py-25 px-10">
      <SidePanel />
      <div className="flex flex-1 flex-col">
        <div className="py-18 px-8">
          <h1 className="text-2xl font-bold">****年*月のサマリー</h1>
          <div className="mt-8">
            <p>ページの内容</p>
          </div>
        </div>
      </div>
    </main>
  )
}
export default Page
