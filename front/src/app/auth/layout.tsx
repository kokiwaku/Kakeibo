import { Metadata } from 'next'
import React, { ReactNode } from 'react'

export const metadata: Metadata = {
  title: 'Create Next App',
  description: 'Generated by create next app',
}

const AppLayout = ({ children }: { children: ReactNode }) => {
  return (
    <div className="container flex h-screen w-screen flex-col items-center justify-center">
      {children}
    </div>
  )
}

export default AppLayout
