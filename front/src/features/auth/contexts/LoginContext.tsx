'use client'

import React, { createContext, ReactNode, useContext } from 'react'
import { useLogin } from '../hooks/useLogin'
import { Event } from '@/types/event'

type ContextType = {
  email: string
  password: string
  isAbleToSubmit: boolean
  loading: boolean
  errorMessages: string[]
  handleSetEmail: Event['onChangeInput']
  handleSetPassword: Event['onChangeInput']
  handleSubmit: Event['onSubmit']
  handleClickSignUp: Event['onClick']
}
export const LoginContext = createContext({} as ContextType)

type Props = {
  children: ReactNode
}
export const LoginProvider: React.FC<Props> = ({ children }) => {
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
  } = useLogin()

  const value = {
    email,
    password,
    isAbleToSubmit,
    loading,
    errorMessages,
    handleSetEmail,
    handleSetPassword,
    handleSubmit,
    handleClickSignUp,
  }

  return <LoginContext.Provider value={value}>{children}</LoginContext.Provider>
}

export const useLoginContext = () => {
  const context = useContext(LoginContext)
  if (context === undefined) {
    throw new Error('useLoginContext must be used within a LoginContext')
  }
  return context
}
