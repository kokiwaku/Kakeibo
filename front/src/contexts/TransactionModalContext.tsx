'use client'

import React, {
  createContext,
  ReactNode,
  useContext,
  useState,
  useRef,
} from 'react'
import { Category } from '@/types/models/category'
import { TransactionType } from '@/types/models/transaction'

export type CrudType = 'create' | 'update' | 'delete'

export type TransactionModalContextType = {
  isOpenModal: boolean
  crudType: CrudType
  openModal: (type: CrudType) => void
  closeModal: () => void
  modalRef: any
  transactionType: TransactionType
  categoryList: Category[]
}

// 明示的な型アノテーションを追加
export const TransactionModalContext =
  createContext<TransactionModalContextType>({} as TransactionModalContextType)

type ModalProviderProps = {
  transactionType: TransactionType
  categoryList: Category[]
  children: ReactNode
}
export const TransactionModalProvider: React.FC<ModalProviderProps> = ({
  transactionType,
  categoryList,
  children,
}) => {
  const [isOpenModal, setIsOpenModal] = useState(false)
  const [crudType, setCrudType] = useState<CrudType>('create')
  // modalに設定するref
  const modalRef = useRef()
  const openModal = (type: CrudType) => {
    setCrudType(type)
    setIsOpenModal(true)
  }
  const closeModal = () => setIsOpenModal(false)
  return (
    <TransactionModalContext.Provider
      value={{
        isOpenModal,
        crudType,
        openModal,
        closeModal,
        modalRef,
        transactionType,
        categoryList,
      }}
    >
      {children}
    </TransactionModalContext.Provider>
  )
}

export const useTransactionModalContext = () => {
  const context = useContext(TransactionModalContext)
  if (context === undefined) {
    throw new Error(
      'useTransactionModalContext must be used within a TransactionModalContext',
    )
  }
  return context
}
