'use client'

import { useSignUpContext } from '../contexts/SignUpContext'

const SignUpForm = () => {
  const {
    email,
    password,
    passwordConfirmation,
    isAbleToSubmit,
    loading,
    errorMessages,
    handleSubmit,
    handleClickLogin,
    handleSetEmail,
    handleSetPassword,
    handleSetPasswordConfirmation,
  } = useSignUpContext()

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
          <div className="rounded-md outline-1 -outline-offset-1 outline-gray-300">
            <input
              type="password_confirmation"
              className="w-full py-1 px-3"
              placeholder="パスワード（確認）"
              value={passwordConfirmation}
              onChange={handleSetPasswordConfirmation}
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
          onClick={handleClickLogin}
        >
          ログイン
        </span>
        してください
      </div>
    </div>
  )
}

export default SignUpForm
