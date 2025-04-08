'use client'

import React, { createContext, ReactNode, useContext } from 'react'
import { useSignUp } from '../hooks/useSignUp'
import { Event } from '@/types/event'

type ContextType = {
  email: string
  password: string
  passwordConfirmation: string
  isAbleToSubmit: boolean
  loading: boolean
  errorMessages: string[]
  handleSetEmail: Event['onChangeInput']
  handleSetPassword: Event['onChangeInput']
  handleSetPasswordConfirmation: Event['onChangeInput']
  handleSubmit: Event['onSubmit']
  handleClickLogin: Event['onClick']
}
export const SignUpContext = createContext({} as ContextType)

type Props = {
  children: ReactNode
}
export const SignUpProvider: React.FC<Props> = ({ children }) => {
  const {
    email,
    password,
    passwordConfirmation,
    isAbleToSubmit,
    loading,
    errorMessages,
    handleSetEmail,
    handleSetPassword,
    handleSetPasswordConfirmation,
    handleSubmit,
    handleClickLogin,
  } = useSignUp()

  const value = {
    email,
    password,
    passwordConfirmation,
    isAbleToSubmit,
    loading,
    errorMessages,
    handleSetEmail,
    handleSetPassword,
    handleSetPasswordConfirmation,
    handleSubmit,
    handleClickLogin,
  }

  return (
    <SignUpContext.Provider value={value}>{children}</SignUpContext.Provider>
  )
}

export const useSignUpContext = () => {
  const context = useContext(SignUpContext)
  if (context === undefined) {
    throw new Error('useSignUpContext must be used within a SignUpContext')
  }
  return context
}
