'use client'

import React, { useCallback, useEffect, useState } from 'react'
import { useRouter } from 'next/navigation'
import { routes } from '@/config/routes'
import { validateToken, logout, getUserInfo } from '@/features/app/apis/auth'
import { UserInfo } from '@/types/models/user'

export const useAuth = () => {
  const router = useRouter()
  // トークンの検証が完了しているかどうか
  const [isTokenValidated, setIsTokenValidated] = useState(false)
  // ユーザー情報
  const [userInfo, setUserInfo] = useState<UserInfo>()
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
      return
    }

    // ユーザー情報を取得
    const userInfoResponse = await getUserInfo()
    if (userInfoResponse.code !== 200 || !userInfoResponse.data?.user) {
      // ログインページにリダイレクト
      router.push(routes.auth.login)
      return
    }

    // ユーザー情報をセット
    const user = userInfoResponse.data.user
    setUserInfo({
      user: {
        id: user.id,
        name: user.name,
        email: user.email,
      },
    })

    setIsTokenValidated(true)
  }

  useEffect(() => {
    // 初回レンダリング時のみ認証状態を検証
    handleValidateToken()
  }, [])

  return {
    handleLogout,
    validateToken,
    isTokenValidated,
    userInfo,
  }
}
