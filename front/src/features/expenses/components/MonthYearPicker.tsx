import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/react/24/outline'
import { Label, Input } from '@headlessui/react'
import { useState } from 'react'

const MonthYearPicker = () => {
  const today = new Date()
  const year = today.getFullYear()
  const month = String(today.getMonth() + 1).padStart(2, '0')
  const [inputDate, setInputDate] = useState(`${year}-${month}`)

  /**
   * 前月ボタンクリック時の処理
   */
  const handlePrevMonthClick = () => {
    // inputDateをDate型に変換
    const date = new Date(inputDate)
    // 1ヶ月前の日付を取得
    date.setMonth(date.getMonth() - 1)
    // inputDateにセット
    setInputDate(date.toISOString().slice(0, 7))
  }

  /**
   * 次月ボタンクリック時の処理
   */
  const handleNextMonthClick = () => {
    // inputDateをDate型に変換
    const date = new Date(inputDate)
    // 1ヶ月後の日付を取得
    date.setMonth(date.getMonth() + 1)
    // inputDateにセット
    setInputDate(date.toISOString().slice(0, 7))
  }

  /**
   * inputの値が変更された時の処理
   * @param e
   */
  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setInputDate(e.target.value)
  }

  return (
    <div className="flex items-center gap-2">
      <button onClick={handlePrevMonthClick}>
        <ChevronLeftIcon className="h-5 w-5" />
      </button>
      <div>
        <Input
          type="month"
          className="w-30"
          value={inputDate}
          onChange={handleInputChange}
        />
      </div>
      <button onClick={handleNextMonthClick}>
        <ChevronRightIcon className="h-5 w-5" />
      </button>
    </div>
  )
}

export default MonthYearPicker
