'use client'

import { useRouter } from 'next/navigation'
import { useState, useEffect } from 'react'
import { Event } from '@/types/event'
import { redirect } from 'next/navigation'
import { signUp } from '../apis/register-user'

const SignUpForm = () => {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [passwordConfirmation, setPasswordConfirmation] = useState('')
  const isAbleToSubmit =
    email.trim() !== '' &&
    password.trim() !== '' &&
    passwordConfirmation.trim() !== ''
  const [loading, setLoading] = useState(false)
  const [errorMessages, setErrorMessages] = useState<Array<string>>([])

  const router = useRouter()
  const handleClickLogin = () => {
    router.push('/auth/login')
  }

  // 何かしら入力されたらエラーメッセージを削除
  useEffect(() => {
    setErrorMessages([])
  }, [email, password, passwordConfirmation])

  const handleSubmit: Event['onSubmit'] = async (event) => {
    event.preventDefault()

    if (password !== passwordConfirmation) {
      alert('パスワードが一致しません')
      return
    }

    setLoading(true)

    const response = await signUp(email, email, password)

    setLoading(false)
    // response check
    if (response.code !== 200) {
      setErrorMessages(response.message ?? [])
      console.error(response.message)
      return
    }

    // 認証OK
    redirect('/app')
  }
  return (
    <div className="flex flex-col gap-5">
      <form onSubmit={handleSubmit}>
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
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>
          <div className="rounded-md outline-1 -outline-offset-1 outline-gray-300">
            <input
              type="password"
              className="w-full py-1 px-3"
              placeholder="パスワード"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>
          <div className="rounded-md outline-1 -outline-offset-1 outline-gray-300">
            <input
              type="password_confirmation"
              className="w-full py-1 px-3"
              placeholder="パスワード（確認）"
              value={passwordConfirmation}
              onChange={(e) => setPasswordConfirmation(e.target.value)}
            />
          </div>
          {/* エラーメッセージがあれば */}
          {errorMessages.length > 0 && (
            <div className="text-red-500 text-sm">
              {errorMessages.map((message) => (
                <div key={message}>{message}</div>
              ))}
            </div>
          )}
          <button
            type="submit"
            disabled={!isAbleToSubmit}
            className={`bg-black text-white rounded-md py-2 px-3 ${
              isAbleToSubmit && !loading
                ? 'cursor-pointer'
                : 'cursor-not-allowed opacity-50'
            }`}
          >
            サインアップ
          </button>
        </div>
      </form>
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

export default SignUpForm
