'use client'

import { useState, useEffect } from 'react'
import { Label, Field, Textarea } from '@headlessui/react'
import CategorySelector from './expenseModalForm/CategorySelector'

const ExpenseModalForm = () => {
  const [date, setDate] = useState<string>('')
  const [amount, setAmount] = useState<number>()

  useEffect(() => {
    // フォームデフォルト値を設定
    // TODO 編集ページでは、編集対象のデータを取得してフォームに設定する
    // 日付のデフォルト値として今日の日付を設定
    const today = new Date()
    const year = today.getFullYear()
    const month = String(today.getMonth() + 1).padStart(2, '0')
    const day = String(today.getDate()).padStart(2, '0')
    setDate(`${year}-${month}-${day}`)
  }, [])

  return (
    <div className="flex flex-col gap-4">
      <div className="flex flex-col gap-1">
        <label htmlFor="date">日付</label>
        <div>
          <input
            id="date"
            type="date"
            name="date"
            className="w-full"
            value={date}
            onChange={(e) => setDate(e.target.value)}
          />
        </div>
      </div>
      <div className="flex flex-col gap-1  w-full">
        <CategorySelector />
      </div>
      <div className="flex flex-col gap-1 w-full">
        <label htmlFor="amount">金額</label>
        <input
          id="amount"
          type="number"
          name="amount"
          className="w-full"
          placeholder="金額を入力してください"
          value={amount}
          onChange={(e) => {
            setAmount(Number(e.target.value))
          }}
        />
      </div>
      <div className="flex flex-col gap-1 w-full">
        <Field>
          <Label>メモ</Label>
          <Textarea rows={3} className="w-full" />
        </Field>
      </div>
    </div>
  )
}

export default ExpenseModalForm
