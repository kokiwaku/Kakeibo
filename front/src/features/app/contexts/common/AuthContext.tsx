'use client'

import React, { createContext, ReactNode, useContext } from 'react'
import { useAuth } from '@/features/app/hooks/common/useAuth'

type ContextType = {
  handleLogout: () => void
  isTokenValidated: boolean
}
export const AuthContext = createContext({} as ContextType)

type Props = {
  children: ReactNode
}
export const AuthProvider: React.FC<Props> = ({ children }) => {
  const { handleLogout, isTokenValidated } = useAuth()
  const value = {
    handleLogout,
    isTokenValidated,
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
