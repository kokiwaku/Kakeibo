'use client'

import React, { useCallback, useEffect, useState } from 'react'
import { useRouter } from 'next/navigation'
import { routes } from '@/config/routes'

export const useAuth = () => {
  const router = useRouter()
  // ユーザー情報
  // ログアウト
  const handleLogout = () => {
    // TODO　tokenを無効にする
    // ログインページにリダイレクト
    router.push(routes.auth.login)
  }
  // token検証
  const validateToken = () => {
    // TODO　tokenを認証する
  }

  // 最初にtokenを検証する
  validateToken()

  return {
    handleLogout,
    validateToken,
  }
}
