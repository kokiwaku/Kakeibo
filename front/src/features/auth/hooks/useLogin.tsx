import { useState, useEffect } from 'react'
import { Event } from '@/types/event'
import { useRouter, redirect } from 'next/navigation'
import { login } from '../apis/login'
import { paths } from '@/config/paths'

export const useLogin = () => {
  // state
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const isAbleToSubmit = email.trim() !== '' && password.trim() !== ''
  const [loading, setLoading] = useState(false)
  const [errorMessages, setErrorMessages] = useState<Array<string>>([])
  const router = useRouter()

  // event 操作
  const handleSetEmail: Event['onChangeInput'] = (event) => {
    setEmail(event.target.value)
  }
  const handleSetPassword: Event['onChangeInput'] = (event) => {
    setPassword(event.target.value)
  }
  const handleClickSignUp = () => {
    router.push(paths.auth.signup)
  }

  /**
   * ログイン ボタンを押した時の処理
   * @param event
   * @returns
   */
  const handleSubmit: Event['onSubmit'] = async (event) => {
    event.preventDefault()

    setLoading(true)

    const response = await login(email, password)

    setLoading(false)
    // response check
    if (response.code !== 200) {
      setErrorMessages(response.message ?? [])
      console.error(response.message)
      return
    }

    // 認証OK
    redirect(paths.app.home)
  }

  // 何かしら入力されたらエラーメッセージを削除
  useEffect(() => {
    setErrorMessages([])
  }, [email, password])

  return {
    email,
    password,
    isAbleToSubmit,
    loading,
    errorMessages,
    handleSetEmail,
    handleSetPassword,
    handleClickSignUp,
    handleSubmit,
  }
}
