'use client'

import React, { useState, Dispatch, SetStateAction } from 'react'
import {
  Dialog,
  DialogBackdrop,
  DialogPanel,
  DialogTitle,
} from '@headlessui/react'
import {
  ModalType,
  useModalContext,
} from '@/features/incomes/contexts/ModalContext'
import IncomeModalForm from '@/features/incomes/components/incomeModal/IncomeModalForm'

const IncomeModal = () => {
  const { isOpenModal, openModal, closeModal, modalType } = useModalContext()

  return (
    <Dialog open={isOpenModal} onClose={closeModal} className="relative z-10">
      <DialogBackdrop
        transition
        className="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"
      />

      <div className="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div className="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <DialogPanel
            transition
            className="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95"
          >
            {modalType === 'delete'
              ? () => <DeleteForm />
              : () => <UpsertForm />}
          </DialogPanel>
        </div>
      </div>
    </Dialog>
  )
}

export default IncomeModal

const UpsertForm = () => {
  const { closeModal, modalType } = useModalContext()
  const handleCancel = () => {
    // TODO キャンセル操作
    closeModal()
  }

  const handleSubmit = () => {
    // TODO Submit操作
    closeModal()
  }
  return (
    <>
      <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div className="sm:flex sm:items-start">
          <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
            <DialogTitle as="h2" className="text-lg weight-bold">
              {modalType === 'update' ? '収入を編集する' : '収入を登録する'}
            </DialogTitle>
            <div className="mt-2">
              <IncomeModalForm />
            </div>
          </div>
        </div>
      </div>
      <div className="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
        <button
          type="button"
          onClick={() => handleCancel()}
          className="inline-flex w-full justify-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto"
        >
          Cancel
        </button>
        <button
          type="button"
          data-autofocus
          onClick={() => handleSubmit()}
          className="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto"
        >
          Submit
        </button>
      </div>
    </>
  )
}

const DeleteForm = () => {
  const { closeModal, modalType } = useModalContext()
  const handleCancel = () => {
    // TODO キャンセル操作
    closeModal()
  }

  const handleSubmit = () => {
    // TODO Submit操作
    closeModal()
  }
  return (
    <>
      <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div className="sm:flex sm:items-start">
          <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
            <DialogTitle as="h2" className="text-lg weight-bold">
              収入を削除しますか???
            </DialogTitle>
          </div>
        </div>
      </div>
      <div className="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
        <button
          type="button"
          onClick={() => handleCancel()}
          className="inline-flex w-full justify-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-gray-500 sm:ml-3 sm:w-auto"
        >
          Cancel
        </button>
        <button
          type="button"
          data-autofocus
          onClick={() => handleSubmit()}
          className="mt-3 inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-red-500 sm:mt-0 sm:w-auto"
        >
          Delete
        </button>
      </div>
    </>
  )
}
