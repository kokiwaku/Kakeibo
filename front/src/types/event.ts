import { ChangeEvent, FormEvent, KeyboardEvent, MouseEvent } from 'react'

export type Event = {
  onSubmit: (event: FormEvent<HTMLFormElement>) => void
  onChangeInput: (event: ChangeEvent<HTMLInputElement>) => void
  onClick: (event: MouseEvent<HTMLInputElement>) => void
  onKeyDown: (event: KeyboardEvent<HTMLInputElement>) => void
}
