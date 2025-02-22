import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/react/24/outline'
import { Label, Input } from '@headlessui/react'
import { useState } from 'react'
import {
  getYearMonthISOString,
  getPrevYearMonth,
  getNextYearMonth,
  formatISOString,
} from '@utils/dateHelper'

const MonthYearPicker = () => {
  const [inputDate, setInputDate] = useState(getYearMonthISOString())

  /**
   * 前月ボタンクリック時の処理
   */
  const handlePrevMonthClick = () => {
    if (inputDate === '') {
      return
    }
    // inputDateをDate型に変換
    const prevYearMonth = getPrevYearMonth(new Date(inputDate))
    setInputDate(formatISOString(prevYearMonth))
  }

  /**
   * 次月ボタンクリック時の処理
   */
  const handleNextMonthClick = () => {
    if (inputDate === '') {
      return
    }
    const nextYearMonth = getNextYearMonth(new Date(inputDate))
    setInputDate(formatISOString(nextYearMonth))
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
      <button onClick={handlePrevMonthClick} className="cursor-pointer">
        <ChevronLeftIcon className="h-5 w-5" />
      </button>
      <div>
        <Input
          type="month"
          className="w-30 cursor-pointer"
          value={inputDate}
          onChange={handleInputChange}
        />
      </div>
      <button onClick={handleNextMonthClick} className="cursor-pointer">
        <ChevronRightIcon className="h-5 w-5" />
      </button>
    </div>
  )
}

export default MonthYearPicker
