import Link from 'next/link'
import {
  ChartBarIcon,
  CurrencyYenIcon,
  ShoppingBagIcon,
  TagIcon,
  UserCircleIcon,
} from '@heroicons/react/24/outline'
import { paths } from '@/config/paths'

const SidePanel = () => {
  type Menu = {
    name: string
    url: string
    icon: React.ReactNode
  }
  const menuList: Menu[] = [
    {
      name: 'ダッシュボード',
      url: paths.app.home,
      icon: <ChartBarIcon className="h-5 w-5" />,
    },
    {
      name: '収入',
      url: paths.app.incomes,
      icon: <CurrencyYenIcon className="h-5 w-5" />,
    },
    {
      name: '支出',
      url: paths.app.expenses,
      icon: <ShoppingBagIcon className="h-5 w-5" />,
    },
    {
      name: 'カテゴリ',
      url: paths.app.categories,
      icon: <TagIcon className="h-5 w-5" />,
    },
  ]
  return (
    <aside className="w-64 flex flex-col gap-1.5 bg-white">
      <div className="p-4 bg-blue-500 text-white">
        <h1 className="text-2xl font-bold">MoneyFlow</h1>
      </div>
      <div className="flex items-center border-b border-gray-100 px-4 gap-2 h-15">
        <UserCircleIcon className="h-6 w-6" />
        <p>Test User Name</p>
      </div>
      <nav className="px-4">
        {menuList.map((menu, index) => (
          <Link key={index} className="flex items-center py-2" href={menu.url}>
            <p className="mr-2">{menu.icon}</p>
            <p>{menu.name}</p>
          </Link>
        ))}
      </nav>
      <div className="px-4 mt-10">
        <button className="bg-red-500 text-white hover:bg-red-300 rounded-md px-4 py-2 cursor-pointer">
          <Link className="flex items-center py-2" href={paths.auth.login}>
            ログアウト
          </Link>
        </button>
      </div>
    </aside>
  )
}

export default SidePanel
