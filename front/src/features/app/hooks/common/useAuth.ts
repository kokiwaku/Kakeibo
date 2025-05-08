'use client'

import React, { useCallback, useEffect, useState } from 'react'
import { useRouter } from 'next/navigation'
import { routes } from '@/config/routes'
import { validateToken, logout } from '@/features/app/apis/auth'

export const useAuth = () => {
  const router = useRouter()
  // トークンの検証が完了しているかどうか
  const [isTokenValidated, setIsTokenValidated] = useState(false)

  // ユーザー情報
  // ログアウト
  const handleLogout = async () => {
    await logout()
    router.push(routes.auth.login)
  }

  // token検証
  const handleValidateToken = async () => {
    // トークンが有効かどうかを確認
    const response = await validateToken()
    if (response.code !== 204) {
      // ログインページにリダイレクト
      router.push(routes.auth.login)
    }
  }

  // 最初にtokenを検証する
  useEffect(() => {
    handleValidateToken()
    setIsTokenValidated(true)
  }, [])

  return {
    handleLogout,
    validateToken,
    isTokenValidated,
  }
}
