'use client'

import { useRouter } from 'next/navigation'
import { useState } from 'react'
import { Event } from '@/types/event'
import { redirect } from 'next/navigation'
import { paths } from '@/config/paths'
import { useLoginContext } from '../contexts/LoginContext'

const LoginForm = () => {
  const {
    email,
    password,
    isAbleToSubmit,
    loading,
    errorMessages,
    handleSetEmail,
    handleSetPassword,
    handleSubmit,
    handleClickSignUp,
  } = useLoginContext()

  return (
    <div className="flex flex-col gap-5">
      <form onSubmit={handleSubmit}>
        <div className="flex flex-col gap-2 text-center">
          <h1 className="text-2xl font-semibold">アカウントにログイン</h1>
          <p>メールアドレスとパスワードを入力してください</p>
        </div>
        <div className="flex flex-col gap-2">
          <div className="rounded-md outline-1 -outline-offset-1 outline-gray-300">
            <input
              type="email"
              className="w-full py-1 px-3"
              placeholder="name@exapmle.com"
              value={email}
              onChange={handleSetEmail}
            />
          </div>
          <div className="rounded-md outline-1 -outline-offset-1 outline-gray-300">
            <input
              type="password"
              className="w-full py-1 px-3"
              placeholder="パスワード"
              value={password}
              onChange={handleSetPassword}
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
            ログイン
          </button>
        </div>
      </form>
      <div className="text-sm">
        アカウントをお持ちでない場合は
        <span
          className="px-1 cursor-pointer underline underline-offset-4"
          onClick={handleClickSignUp}
        >
          サインアップ
        </span>
        してください
      </div>
    </div>
  )
}

export default LoginForm
