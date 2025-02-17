'use client'

import { useState, useEffect } from 'react'
import {
  Label,
  Listbox,
  ListboxButton,
  ListboxOption,
  ListboxOptions,
  Description,
  Field,
  Textarea,
} from '@headlessui/react'
import { ChevronUpDownIcon } from '@heroicons/react/16/solid'
import { CheckIcon } from '@heroicons/react/20/solid'

const IncomeModalForm = () => {
  // TODO: 仮のデータ
  type categoryType = {
    id: number
    name: string
  }
  const categoryList: categoryType[] = [
    {
      id: 1,
      name: '給与',
    },
    {
      id: 2,
      name: '副業',
    },
    {
      id: 3,
      name: 'ボーナス',
    },
    {
      id: 4,
      name: '投資',
    },
  ]
  const [selectedCategory, setSelectedCategory] = useState<categoryType>(
    categoryList[0],
  )
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
        <Listbox value={selectedCategory} onChange={setSelectedCategory}>
          <Label>カテゴリ</Label>
          <div className="relative mt-2">
            <ListboxButton className="grid w-full cursor-default grid-cols-1 rounded-md bg-white py-1.5 pr-2 pl-3 text-left text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              <span className="col-start-1 row-start-1 flex items-center gap-3 pr-6">
                <span className="block truncate">{selectedCategory.name}</span>
              </span>
              <ChevronUpDownIcon
                aria-hidden="true"
                className="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
              />
            </ListboxButton>
            <ListboxOptions
              transition
              className="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base ring-1 shadow-lg ring-black/5 focus:outline-hidden data-leave:transition data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm"
            >
              {categoryList.map((category) => (
                <ListboxOption
                  key={category.id}
                  value={category}
                  className="group relative cursor-default py-2 pr-9 pl-3 text-gray-900 select-none data-focus:bg-indigo-600 data-focus:text-white data-focus:outline-hidden"
                >
                  <div className="flex items-center">
                    <span className="ml-3 block truncate font-normal group-data-selected:font-semibold">
                      {category.name}
                    </span>
                  </div>

                  <span className="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-data-selected:hidden group-data-focus:text-white">
                    <CheckIcon aria-hidden="true" className="size-5" />
                  </span>
                </ListboxOption>
              ))}
            </ListboxOptions>
          </div>
        </Listbox>
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

export default IncomeModalForm
