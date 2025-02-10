import React from 'react'

const Page = () => {
  return (
    <div className="min-h-full">
      <div className="flex">
        <SidePanel />
        <main className="flex-1 p-6">
          <div className="bg-white rounded-lg shadow-sm p-6">
            <h2 className="text-2xl text-gray-900 mb-4">Hello Tailwind!</h2>
            <p className="text-gray-600">
              Tailwindの設定が正しく適用されています。
            </p>
            {/* Tailwindのユーティリティクラスのデモ */}
            <div className="mt-6 space-y-4">
              <button className="bg-primary-500 text-white px-4 py-2 rounded-md hover:bg-primary-600 transition-colors">
                プライマリボタン
              </button>
              <div className="bg-secondary-500 text-white p-4 rounded-md">
                セカンダリカラーの背景
              </div>
              <div className="animate-fade-in bg-blue-100 p-4 rounded-md">
                フェードインアニメーション
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  )
}

export default Page

const SidePanel = () => {
  return (
    <aside className="w-64 bg-white shadow-sm p-6">
      <nav className="space-y-2">
        <a href="#" className="block text-gray-600 hover:text-primary-500">
          メニュー1
        </a>
        <a href="#" className="block text-gray-600 hover:text-primary-500">
          メニュー2
        </a>
        <a href="#" className="block text-gray-600 hover:text-primary-500">
          メニュー3
        </a>
      </nav>
    </aside>
  )
}
