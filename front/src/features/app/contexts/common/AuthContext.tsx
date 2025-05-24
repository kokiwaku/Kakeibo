'use client'

import React, { createContext, ReactNode, useContext } from 'react'
import { useAuth } from '@/features/app/hooks/common/useAuth'
import { UserInfo } from '@/types/models/user'

type ContextType = {
  handleLogout: () => void
  isTokenValidated: boolean
  userInfo: UserInfo
}
export const AuthContext = createContext({} as ContextType)

type Props = {
  children: ReactNode
}
export const AuthProvider: React.FC<Props> = ({ children }) => {
  const { handleLogout, isTokenValidated, userInfo } = useAuth()
  const value = {
    handleLogout,
    isTokenValidated,
    userInfo,
  }
  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>
}

export const useAuthContext = () => {
  const context = useContext(AuthContext)
  if (context === undefined) {
    throw new Error('useAuthContext must be used within a AuthContext')
  }
  return context
}
