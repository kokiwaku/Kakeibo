'use client'

import { useState, useRef, useCallback, useEffect, Fragment } from 'react'
import {
  Label,
  Listbox,
  ListboxButton,
  ListboxOption,
  ListboxOptions,
} from '@headlessui/react'
import { ChevronDownIcon, CheckIcon } from '@heroicons/react/16/solid'
import { useModalContext } from '@/features/expenses/contexts/ModalContext'

const CategorySelector = () => {
  type CategoryType = {
    id: number
    name: string
    subCategory?: { id: number; name: string }[]
  }
  type SubCategoryType = {
    id: number
    name: string
  }
  type DisplaySubCategoryType = {
    category: CategoryType
    position: {
      top: number
      right: number
    }
  }
  const { modalRef } = useModalContext()
  const [categoryLabel, setCategoryLabel] = useState<string>('未分類')
  // TODO: カテゴリは仮のデータなので、ユーザーごとの値をDBから取得して差し替えが必要
  const categoryList: CategoryType[] = [
    {
      id: 1,
      name: '食費',
      subCategory: [
        { id: 101, name: '食料品' },
        { id: 102, name: '外食' },
        { id: 103, name: 'カフェ' },
        { id: 104, name: '朝食' },
        { id: 105, name: '昼食' },
        { id: 106, name: '夕食' },
        { id: 107, name: '夜食' },
        { id: 108, name: 'その他食費' },
      ],
    },
    {
      id: 2,
      name: '日用品',
      subCategory: [
        { id: 201, name: '衣服' },
        { id: 202, name: '靴' },
        { id: 203, name: 'アクセサリー' },
        { id: 204, name: '化粧品' },
        { id: 205, name: '生活用品' },
        { id: 206, name: 'その他日用品' },
      ],
    },
    {
      id: 3,
      name: '趣味・娯楽',
      subCategory: [
        { id: 301, name: 'アウトドア' },
        { id: 302, name: 'スポーツ' },
        { id: 303, name: 'ゲーム' },
        { id: 304, name: '映画・音楽' },
        { id: 305, name: '本' },
        { id: 306, name: '旅行' },
        { id: 307, name: 'その他趣味' },
      ],
    },
    {
      id: 4,
      name: '交通費',
      subCategory: [
        { id: 401, name: '電車' },
        { id: 402, name: 'バス' },
        { id: 403, name: 'タクシー' },
        { id: 404, name: '飛行機' },
        { id: 405, name: 'その他交通費' },
      ],
    },
    {
      id: 5,
      name: '健康・医療',
      subCategory: [
        { id: 501, name: '医療費' },
        { id: 502, name: '薬' },
        { id: 503, name: '歯科' },
        { id: 504, name: 'フィットネス' },
        { id: 505, name: 'ボディケア' },
        { id: 506, name: 'その他医療費' },
      ],
    },
    {
      id: 6,
      name: '自動車',
      subCategory: [
        { id: 601, name: 'ガソリン' },
        { id: 602, name: '駐車場' },
        { id: 603, name: '車検・整備' },
        { id: 604, name: '高速料金' },
        { id: 605, name: 'その他自動車費' },
      ],
    },
    {
      id: 7,
      name: '教育・教養',
      subCategory: [
        { id: 701, name: '書籍' },
        { id: 702, name: '新聞・雑誌' },
        { id: 703, name: '習い事' },
        { id: 704, name: 'セミナー' },
        { id: 705, name: '学費' },
        { id: 706, name: 'その他教育費' },
      ],
    },
    {
      id: 8,
      name: '特別な支出',
      subCategory: [
        { id: 801, name: '冠婚葬祭' },
        { id: 802, name: '誕生日' },
        { id: 803, name: '記念日' },
        { id: 804, name: 'プレゼント' },
        { id: 805, name: 'その他特別費' },
      ],
    },
    {
      id: 9,
      name: '現金・カード',
      subCategory: [
        { id: 901, name: 'ATM引き出し' },
        { id: 902, name: '電子マネーチャージ' },
        { id: 903, name: 'カード引き落とし' },
        { id: 904, name: 'その他現金・カード' },
      ],
    },
    {
      id: 10,
      name: '通信費',
      subCategory: [
        { id: 1001, name: '携帯電話' },
        { id: 1002, name: '固定電話' },
        { id: 1003, name: 'インターネット' },
        { id: 1004, name: '放送視聴料' },
        { id: 1005, name: 'その他通信費' },
      ],
    },
    {
      id: 11,
      name: '住宅',
      subCategory: [
        { id: 1101, name: '家賃' },
        { id: 1102, name: '地震・火災保険' },
        { id: 1103, name: '修繕・メンテナンス' },
        { id: 1104, name: 'その他住宅費' },
      ],
    },
    {
      id: 12,
      name: '水道・光熱費',
      subCategory: [
        { id: 1201, name: '電気代' },
        { id: 1202, name: 'ガス代' },
        { id: 1203, name: '水道代' },
        { id: 1204, name: 'その他水道・光熱費' },
      ],
    },
    {
      id: 13,
      name: '税金・保険',
      subCategory: [
        { id: 1301, name: '所得税' },
        { id: 1302, name: '住民税' },
        { id: 1303, name: '年金保険料' },
        { id: 1304, name: '健康保険' },
        { id: 1305, name: '生命保険' },
        { id: 1306, name: '自動車保険' },
        { id: 1307, name: 'その他税・保険' },
      ],
    },
    {
      id: 16,
      name: 'その他',
      subCategory: [
        { id: 1601, name: '仕送り' },
        { id: 1602, name: '寄付金' },
        { id: 1603, name: '雑費' },
        { id: 1604, name: 'その他' },
      ],
    },
    {
      id: 17,
      name: '未分類',
      subCategory: [],
    },
  ]
  const [selectedCategory, setSelectedCategory] = useState<CategoryType | null>(
    null,
  )
  const [selectedSubCategory, setSelectedSubCategory] =
    useState<SubCategoryType | null>(null)
  const [displaySubCategory, setDisplaySubCategory] =
    useState<DisplaySubCategoryType | null>(null)
  const [focusedSubCategory, setFocusedSubCategory] =
    useState<SubCategoryType | null>(null)

  /**
   * カテゴリフォーカス時
   */
  const handleCategoryFocusOn = (
    event: React.MouseEvent<HTMLSpanElement, MouseEvent>,
    focusOnTargetCategory: CategoryType,
  ) => {
    // サブカテゴリを持っていない場合、終了
    if (!focusOnTargetCategory?.subCategory) {
      return
    }
    /**
     * サブカテゴリを表示する位置を算出
     * マウスオーバーされた要素の位置-modalの位置=modal上端からの相対位置
     */
    const mouseOverRect = event.currentTarget.getBoundingClientRect()
    const modalRefRect = modalRef.current.getBoundingClientRect()
    setDisplaySubCategory({
      category: focusOnTargetCategory,
      position: {
        top: mouseOverRect.top - modalRefRect.top + 5,
        right: mouseOverRect.right - modalRefRect.left - 30,
      },
    })
  }
  /**
   * カテゴリクリック時
   */
  const handleCategoryClick = (
    event: React.MouseEvent<HTMLDivElement, MouseEvent>,
    clickTargetCategory: CategoryType,
  ) => {
    // カテゴリだけを選択する動作になるため、サブカテゴリの選択状態はリセット
    setSelectedCategory(clickTargetCategory)
    setSelectedSubCategory(null)
  }

  /**
   * サブカテゴリフォーカス時
   */
  const handleSubCategoryFocusOn = (
    focusOnTargetSubCategory: SubCategoryType,
  ) => {
    setFocusedSubCategory(focusOnTargetSubCategory)
  }
  /**
   * サブカテゴリフォーカス外した時
   */
  const handleSubCategoryFocusOff = useCallback(() => {
    setFocusedSubCategory(null)
  }, [])
  /**
   * サブカテゴリクリック時
   */
  const handleSubCategoryClick = (clickTargetSubCategory: SubCategoryType) => {
    // カテゴリ & サブカテゴリを選択状態にする
    setSelectedSubCategory(clickTargetSubCategory)
    if (!displaySubCategory) {
      return
    }
    setSelectedCategory(displaySubCategory.category)
  }
  /**
   * カテゴリラベルに表示する文字列を決定
   */
  useEffect(() => {
    {
      selectedCategory && selectedSubCategory
        ? `${selectedCategory.name} > ${selectedSubCategory.name}`
        : '未分類'
    }
    if (!selectedCategory) {
      return
    }
    let newCategoryLabel = selectedCategory?.name
    if (selectedSubCategory) {
      newCategoryLabel = `${newCategoryLabel} > ${selectedSubCategory.name}`
    }
    setCategoryLabel(newCategoryLabel)
  }, [selectedCategory, selectedSubCategory])

  /**
   * サブカテゴリーの表示が残ることがあるのでクリックイベントを検知して削除
   */
  const handleClickOutside = () => {
    setDisplaySubCategory(null)
  }
  document.addEventListener('mousedown', handleClickOutside)

  return (
    <>
      <Listbox value={selectedCategory} onChange={setSelectedCategory}>
        <Label>カテゴリ</Label>
        <div className="mt-2 relative category-selector">
          <ListboxButton className="grid w-full rounded-md bg-white py-1.5 pr-2 pl-3 text-left text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            <span className="col-start-1 row-start-1 flex items-center gap-3 pr-6">
              <span className="block truncate">{categoryLabel}</span>
            </span>
            <ChevronDownIcon
              aria-hidden="true"
              className="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
            />
          </ListboxButton>
          <ListboxOptions
            transition
            className="absolute top-9 z-10 mt-1 mb-1 max-h-56 w-sx overflow-auto rounded-md bg-white py-2 text-base ring-1 shadow-lg ring-black/5 focus:outline-hidden data-leave:transition data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm"
          >
            {categoryList.map((category) => (
              <ListboxOption key={category.id} value={category} as={Fragment}>
                {({ focus, selected }) => (
                  <div
                    className={`flex items-center w-full py-1 pl-1 pr-10 cursor-pointer ${
                      (focus ||
                        displaySubCategory?.category.id === category.id) &&
                      'rounded-md outline-2 -outline-offset-2 outline-indigo-600'
                    }`}
                    onMouseEnter={(e) => {
                      handleCategoryFocusOn(e, category)
                    }}
                    onMouseDown={(e) => {
                      handleCategoryClick(e, category)
                    }}
                  >
                    <CheckIcon
                      className={`size-5 ${!selected && 'invisible'}`}
                    />
                    <span className="block truncate font-normal group-data-selected:font-semibold">
                      {category.name}
                    </span>
                  </div>
                )}
              </ListboxOption>
            ))}
          </ListboxOptions>
        </div>
      </Listbox>
      {displaySubCategory?.category?.subCategory && (
        <div
          className="z-20 cursor-pointer"
          style={{
            position: 'fixed',
            top: displaySubCategory.position.top,
            left: displaySubCategory.position.right,
          }}
          tabIndex={-1}
        >
          {displaySubCategory.category.subCategory.map((subCategory) => (
            <div
              key={subCategory.id}
              className={`py-1 pl-2 pr-5 bg-white text-gray-900${
                focusedSubCategory?.id === subCategory.id &&
                'rounded-md outline-2 -outline-offset-2 outline-indigo-600'
              }`}
              onMouseDown={() => {
                console.log('handleSubCategoryClick')
                handleSubCategoryClick(subCategory)
              }}
              onMouseEnter={() => {
                handleSubCategoryFocusOn(subCategory)
              }}
              onMouseLeave={() => {
                handleSubCategoryFocusOff()
              }}
            >
              <div className="flex items-center">
                <CheckIcon
                  className={`size-5 ${
                    selectedSubCategory?.id === subCategory.id
                      ? ''
                      : 'invisible'
                  }`}
                />
                <span className="block truncate font-normal">
                  {subCategory.name}
                </span>
              </div>
            </div>
          ))}
        </div>
      )}
    </>
  )
}

export default CategorySelector
