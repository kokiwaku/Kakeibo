'use client'

import { useState, useCallback, useEffect } from 'react'
import { ChevronDownIcon, CheckIcon } from '@heroicons/react/16/solid'
import { useTransactionModalContext } from '@/contexts/TransactionModalContext'
import {
  CategoryType,
  DisplayCategoryType,
  SubCategoryType,
  DisplaySubCategoryType,
} from '@/types/CategoryType'

const CategorySelector = () => {
  const { modalRef, categoryList } = useTransactionModalContext()
  const [categoryLabel, setCategoryLabel] = useState<string>('未分類')
  const [focusedCategory, setFocusedCategory] = useState<CategoryType | null>(
    null,
  )
  // TODO: カテゴリは仮のデータなので、ユーザーごとの値をDBから取得して差し替えが必要
  const [selectedCategory, setSelectedCategory] = useState<CategoryType | null>(
    null,
  )
  const [displayCategory, setDisplayCategory] =
    useState<DisplayCategoryType | null>(null)
  const [selectedSubCategory, setSelectedSubCategory] =
    useState<SubCategoryType | null>(null)
  const [displaySubCategory, setDisplaySubCategory] =
    useState<DisplaySubCategoryType | null>(null)
  const [focusedSubCategory, setFocusedSubCategory] =
    useState<SubCategoryType | null>(null)

  /**
   * カテゴリ選択フォームクリック時
   */
  const handleCategorySelectorOpen = (
    event: React.MouseEvent<HTMLSpanElement, MouseEvent>,
  ) => {
    // セレクトボックスを表示
    // セレクトボックスの表示位置を設定
    const selectorRect = event.currentTarget.getBoundingClientRect()
    const modalRefRect = modalRef.current.getBoundingClientRect()
    setDisplayCategory({
      category: categoryList,
      position: {
        top: selectorRect.bottom - modalRefRect.top + 5,
        left: selectorRect.left - modalRefRect.left,
      },
    })
  }
  /**
   * カテゴリフォーカス時
   */
  const handleCategoryFocusOn = (
    event: React.MouseEvent<HTMLSpanElement, MouseEvent>,
    focusOnTargetCategory: CategoryType,
  ) => {
    setFocusedCategory(focusOnTargetCategory)
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
   * カテゴリフォーカスOFF時
   */
  const handleCategoryFocusOff = () => {
    setFocusedCategory(null)
  }
  /**
   * カテゴリにフォーカスのスタイルを当てるかどうか
   */
  const isApplyFocusStyleCategory = (applyTargetCategory: CategoryType) => {
    if (focusedCategory?.id === applyTargetCategory.id) {
      return true
    }
    // サブカテゴリーが表示中の場合
    return displaySubCategory?.category.id === applyTargetCategory.id
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
   * カテゴリー・サブカテゴリーの表示が残ることがあるのでクリックイベントを検知して削除
   */
  const handleClickOutside = () => {
    setDisplayCategory(null)
    setDisplaySubCategory(null)
  }
  document.addEventListener('mousedown', handleClickOutside)

  return (
    <>
      <div className="flex flex-col gap-0.5 w-full">
        <div>カテゴリ</div>
        {/* 選択フォーム */}
        <div
          className="grid w-full rounded-md bg-white py-1.5 pr-2 pl-3 text-left text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          onClick={(e) => handleCategorySelectorOpen(e)}
        >
          <span className="col-start-1 row-start-1 flex items-center gap-3 pr-6">
            <span className="block truncate">{categoryLabel}</span>
          </span>
          <ChevronDownIcon
            aria-hidden="true"
            className="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
          />
        </div>
      </div>
      {/* 選択フォームオプション */}
      {displayCategory?.category && (
        <div
          className="z-10 max-h-56 overflow-auto bg-white py-2 text-base ring-1 shadow-lg ring-black/5 rounded-md sm:text-sm"
          style={{
            position: 'fixed',
            top: displayCategory.position.top,
            left: displayCategory.position.left,
          }}
        >
          {displayCategory?.category.map((category) => (
            <div
              key={category.id}
              className={`flex items-center py-1 pl-1 pr-10 cursor-pointer ${
                isApplyFocusStyleCategory(category) &&
                'rounded-md outline-2 -outline-offset-2 outline-indigo-600'
              }`}
              onMouseEnter={(e) => {
                handleCategoryFocusOn(e, category)
              }}
              onMouseLeave={() => {
                handleCategoryFocusOff()
              }}
              onMouseDown={(e) => {
                handleCategoryClick(e, category)
              }}
            >
              <CheckIcon
                className={`size-5 ${!(selectedCategory?.id === category.id) && 'invisible'}`}
              />
              <span className="block truncate font-normal">
                {category.name}
              </span>
            </div>
          ))}
        </div>
      )}
      {displaySubCategory?.category?.subCategory && (
        <div
          className="z-20 cursor-pointer rounded-md max-h-56 w-sx overflow-auto bg-white py-2 text-base ring-1 shadow-lg ring-black/5 sm:text-sm"
          style={{
            position: 'fixed',
            top: displaySubCategory.position.top,
            left: displaySubCategory.position.right,
          }}
        >
          {displaySubCategory.category.subCategory.map((subCategory) => (
            <div
              key={subCategory.id}
              className={`py-1 pl-2 pr-5 bg-white text-gray-900 ${
                focusedSubCategory?.id === subCategory.id &&
                'rounded-md outline-2 -outline-offset-2 outline-indigo-600'
              }`}
              onMouseDown={() => {
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
