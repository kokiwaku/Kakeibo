'use client'
import { PlusCircleIcon } from '@heroicons/react/16/solid'

const InputForm = () => {
  return (
    <>
      <div className="flex gap-3 items-center text-sm">
        <div className="mt-2 ml-3 pl-3 pr-3 py-2 rounded-md outline-1 -outline-offset-1 outline-gray-300">
          <input
            type="text"
            placeholder="新しいカテゴリを登録"
            className="w-full"
          />
        </div>
        <p>
          <PlusCircleIcon className="h-5 w-5 cursor-pointer" />
        </p>
      </div>
    </>
  )
}
export default InputForm
