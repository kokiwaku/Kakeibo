'use client'

import { useRouter } from 'next/navigation'

const Page = () => {
  const router = useRouter()
  const handleClickLogin = () => {
    router.push('/auth/login')
  }
  return (
    <div className="flex flex-col gap-5">
      <div className="flex flex-col gap-2 text-center">
        <h1 className="text-2xl font-semibold">アカウント作成</h1>
        <p>メールアドレスとパスワードを入力してください</p>
      </div>
      <div className="flex flex-col gap-2">
        <div className="rounded-md outline-1 -outline-offset-1 outline-gray-300">
          <input
            type="email"
            className="w-full py-1 px-3"
            placeholder="name@exapmle.com"
          />
        </div>
        <div className="rounded-md outline-1 -outline-offset-1 outline-gray-300">
          <input
            type="password"
            className="w-full py-1 px-3"
            placeholder="パスワード"
          />
        </div>
        <div className="rounded-md outline-1 -outline-offset-1 outline-gray-300">
          <input
            type="password_confirmation"
            className="w-full py-1 px-3"
            placeholder="パスワード（確認）"
          />
        </div>
        <button className="bg-black text-white rounded-md py-2 px-3 cursor-pointer">
          サインアップ
        </button>
      </div>
      <div className="text-sm">
        既にアカウントをお持ちの場合は
        <span
          className="px-1 cursor-pointer underline underline-offset-4"
          onClick={() => handleClickLogin()}
        >
          ログイン
        </span>
        してください
      </div>
    </div>
  )
}

export default Page
