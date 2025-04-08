import { useState, useEffect } from 'react'
import { Event } from '@/types/event'
import { useRouter, redirect } from 'next/navigation'
import { signUp } from '../apis/register-user'
import { paths } from '@/config/paths'

export const useSignUp = () => {
  // state
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

  // event 操作
  const handleSetEmail: Event['onChangeInput'] = (event) => {
    setEmail(event.target.value)
  }
  const handleSetPassword: Event['onChangeInput'] = (event) => {
    setPassword(event.target.value)
  }
  const handleSetPasswordConfirmation: Event['onChangeInput'] = (event) => {
    setPasswordConfirmation(event.target.value)
  }
  const handleClickLogin = () => {
    router.push(paths.auth.login)
  }

  /**
   * Sign up ボタンを押した時の処理
   * @param event
   * @returns
   */
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
    redirect(paths.app.home)
  }

  // 何かしら入力されたらエラーメッセージを削除
  useEffect(() => {
    setErrorMessages([])
  }, [email, password, passwordConfirmation])

  return {
    email,
    password,
    passwordConfirmation,
    isAbleToSubmit,
    loading,
    errorMessages,
    handleSetEmail,
    handleSetPassword,
    handleSetPasswordConfirmation,
    handleClickLogin,
    handleSubmit,
  }
}
