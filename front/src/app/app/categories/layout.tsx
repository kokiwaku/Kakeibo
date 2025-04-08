import { Metadata } from 'next'
import React, { ReactNode } from 'react'
import { CategoryProvider } from '@/features/categories/contexts/CategoryContext'

export const metadata: Metadata = {
  title: 'Create Next App',
  description: 'Generated by create next app',
}
const CategoriesLayout = ({ children }: { children: ReactNode }) => {
  return <CategoryProvider>{children}</CategoryProvider>
}

export default CategoriesLayout
